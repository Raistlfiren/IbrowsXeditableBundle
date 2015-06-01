<?php

namespace Ibrows\XeditableBundle\Mapper;

use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Validator\ValidatorInterface;

class XeditableFormMapper extends AbstractFormXeditableMapper
{
    /**
     * @var EngineInterface
     */
    protected $engine;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var array
     */
    protected $parameters = array();

    /**
     * @param FormInterface $form instance of a new form builder
     * @param EngineInterface $engine instance of the default twig engine
     * @param string $url route to update/delete entity
     * @param null $validator type of validation
     * @param bool $validateExtra if there is any extra validation set
     * @throws \Exception
     */
    public function __construct(FormInterface $form, EngineInterface $engine, $url = null, $validator = null, $validateExtra = false)
    {
        //Setup new object with all of the required information
        $this->form = $form;
        $this->engine = $engine;

        if ($validateExtra and !$validator) {
            throw new \Exception("Validator must not be set if validateExtra enabled");
        }

        if ($validateExtra) {
            $this->validator = $validator;
        }

        parent::__construct($url);
    }

    /**
     * @param Request $request
     * @return Response|void
     */
    public function handleRequest(Request $request)
    {
        //remove not in path children
        $path = $request->request->get('path');
        $subform = $this->getFormByPath($path, null, true);

        $this->form->submit($request, true);

        if ($this->validator) {
            $this->validate($subform);
            if ($subform->isValid()) {
                return;
            }
        } else {
            if ($this->form->isValid()) {
                return;
            }
        }

        return $this->renderError($subform);
    }

    /**
     * @param string $path
     * @param array $attributes
     * @param array $options
     * @throws \Exception
     * @return string
     */
    public function render($path = null, array $attributes = array(), array $options = array())
    {
        //Path is the second parameter given in the render function
        //Look for path in form object, otherwise return exception
        if (!$form = $this->getFormByPath($path)) {
            throw new \Exception("Path $path invalid");
        }

        //Get the attributes from the render function in the TWIG template
        $attributes = $this->getAttributes($attributes);

        //Get the options from the render function in the TWIG template
        $options = $this->getOptions($options);

        //Get fields individual value
        $value = $this->getValue($form, $options);

        //Get fields render template - xeditable.html.twig
        $template = $this->getRenderTemplate($options);

        //Merge all of the attributes together and prepend xeditable to the id
        $attributes = array_merge(
            array(
                'id' => 'xeditable_' . $this->form->getName() . '_' . $path
            ),
            $form->getConfig()->getOption('attr', array()),
            $attributes
        );

        if ($this->getRenderFormPrototype($options)) {
            $rendredFormXeditable = $this->renderXeditable($path);
            $attributes['data-form'] = $rendredFormXeditable;
        }

        return $this->engine->render(
            $template,
            $this->getViewParameters(
                $form,
                $path,
                $value,
                $attributes,
                $options
            )
        );
    }

    /**
     * @param string $path
     * @param array $attributes
     * @param array $options
     * @throws \Exception
     * @return string
     */
    public function renderXeditable($path = null, array $attributes = array(), array $options = array())
    {
        //Get all attribute set on the object
        $attributes = $this->getAttributes($attributes);

        //Get all of the options set on the object
        $options = $this->getOptions($options);

        //Clone the form of the field
        if (!$form = $this->getFormByPath($path, clone $this->form, true)) {
            throw new \Exception("Path $path invalid");
        }

        //Get the form template
        $template = $this->getFormTemplate($options);

        //Render the template with the data
        return $this->engine->render($template, $this->getEditParameters($form, $attributes, $options));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ibrows_xeditable_form';
    }

    /**
     * @return EngineInterface
     */
    protected function getEngine()
    {
        return $this->engine;
    }

    /**
     * @param FormInterface $subform
     */
    protected function validate(FormInterface $subform)
    {
        $path = (string)$subform->getPropertyPath();
        $parentData = null;
        $validationGroups = array();

        if ($subform->getParent()) {
            $parentData = $subform->getParent()->getData();
            $validationGroups = $subform->getParent()->getConfig()->getOption('validation_groups');
        } else {
            $parentData = $subform->getData();
            $subform->getConfig()->getOption('validation_groups');
        }

        foreach ($subform as $subsubform) {
            $this->validate($subsubform);
        }

        $constraintViolationList = $this->validator->validateProperty($parentData, $path, $validationGroups);

        if ($constraintViolationList->count() == 0) {
            return;
        } else {
            foreach ($constraintViolationList as $violation) {
                $subform->addError(
                    new FormError(
                        $violation->getMessage(),
                        $violation->getMessageTemplate(),
                        $violation->getMessageParameters(),
                        $violation->getMessagePluralization()
                    )
                );
            }
        }
    }
}