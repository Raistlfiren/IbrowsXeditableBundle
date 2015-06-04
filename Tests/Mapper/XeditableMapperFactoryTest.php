<?php

namespace Ibrows\XeditableBundle\Tests\Mapper;

use Ibrows\XeditableBundle\Mapper\XeditableMapperFactory;
use Ibrows\XeditableBundle\Tests\StandaloneTest;
use Symfony\Component\HttpFoundation\Request;

class XeditableMapperFactoryTest extends StandaloneTest
{

    /**
     * @var XeditableMapperFactory $xeditable
     */
    protected $xeditable;

    public function setUp()
    {
        parent::setUp();

        $this->xeditable = self::$kernel->getContainer()->get('ibrows_xeditable.mapper.factory');

    }

    public function testCreateFormFromRequestBasicInitialization()
    {

        $form = $this->xeditable->createFormFromRequest(
            'simple',
            array('person' => 1),
            NULL,
            'form',
            NULL,
            array()
        );

        $this->assertInstanceOf(
            'Ibrows\XeditableBundle\Mapper\XeditableFormMapper',
            $form,
            'createFormFromRequest is not returning an xeditable form mapper.'
        );

        $this->assertInstanceOf(
            'Symfony\Component\Form\FormInterface',
            $form->getForm(),
            'createFormFromRequest is not returning an form interface'
        );

    }

}