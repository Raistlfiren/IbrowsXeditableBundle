<?php

namespace Ibrows\XeditableBundle\Mapper;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;

abstract class AbstractFormXeditableMapper extends AbstractXeditableMapper
{
    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * @var bool
     */
    protected $renderFormPrototype = true;

    /**
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param string $path
     * @param null $form
     * @param bool $removeOther
     * @return FormInterface
     * @throws \Exception
     */
    protected function getFormByPath($path, $form = null, $removeOther = false)
    {
        //Set the form, if it isn't set
        if (!$form) {
            $form = $this->form;
        }

        //If no path is set, then return the whole form
        if (!$path) {
            return $form;
        }

        //Explode every part on a period
        $parts = explode(".", $path);

        //Look through form for field names...
        //Finds information for that particular field
        while (!is_null($name = array_shift($parts))) {

            //Check to see if the basic form doesn't include the type name
            if (!$form->has($name)) {

                //Now loop through all of the children elements to see if it a collection type
                foreach($form->all() as $childForm) {

                    if (!$childForm instanceof Form) {
                        //It must not be, so return new exception
                        throw new \Exception("$name not found in form {$form->getName()}");
                    } else {
                        //Oh it seems like it is so see if childform has the element and store it in an array or throw exception
                        if (!$childForm->has($name)) {
                            throw new \Exception("$name not found in form {$form->getName()}");
                        } else {
                            $form[] = $childForm->get($name);
                        }
                    }
                }

            } else {
                $form = $form->get($name);
            }

            if ($removeOther) { //remove other childs to save time & reduce db requests
                foreach ($form->all() as $childname => $child) {
                    if ($name != $childname) {
                        $form->remove($childname);
                    }
                }
            }
        }

        //Return form if something is found
        return $form;
    }

    /**
     * Get Value from options or form
     * $options['value']
     * or form->viewData if $options['viewData']
     * default form->getData
     * @param FormInterface $form
     * @param $options
     * @return mixed
     */
    protected function getValue(FormInterface $form, $options)
    {
        if (isset($options['value'])) {
            return $options['value'];
        } elseif (isset($options['viewData']) && $options['viewData']) {
            return $form->getViewData();
        } else {
            return $form->getData();
        }
    }

    /**
     * @param FormInterface $form
     * @param array $attributes
     * @param array $options
     * @return array
     */
    protected function getEditParameters(FormInterface $form, array $attributes = array(), array $options = array())
    {
        return array(
            'form'       => $form->createView(),
            'attributes' => $attributes,
            'options'    => $options
        );
    }

    /**
     * @return string
     */
    protected function getErrorTemplate()
    {
        return 'IbrowsXeditableBundle::xeditableformerrors.html.twig';
    }

    /**
     * @param FormInterface $subform
     * @return Response
     */
    protected function renderError(FormInterface $subform = null)
    {
        $params = array(
            'form' => $this->form->createView(),
        );

        if ($subform) {
            $params['subform'] = $subform->createView();
        }

        return new Response(
            $this->getEngine()->render(
                $this->getErrorTemplate(),
                $params
            ), 400
        );
    }

    /**
     * @return EngineInterface
     */
    abstract protected function getEngine();

    /**
     * @param array $options
     * @return string
     */
    protected function getRenderTemplate(array $options = array())
    {
        return isset($options['template']) ? $options['template'] : 'IbrowsXeditableBundle::xeditable.html.twig';
    }

    /**
     * @param array $options
     * @return bool
     */
    protected function getRenderFormPrototype(array $options = array())
    {
        return array_key_exists('renderFormPrototype', $options) ? $options['renderFormPrototype'] : $this->renderFormPrototype;
    }

    /**
     * @param boolean $renderFormPrototype
     */
    public function setRenderFormPrototype($renderFormPrototype)
    {
        $this->renderFormPrototype = $renderFormPrototype;
    }

    /**
     * @param array $options
     * @return string
     */
    protected function getFormTemplate(array $options = array())
    {
        return isset($options['template']) ? $options['template'] : 'IbrowsXeditableBundle::xeditableform.html.twig';
    }
}