<?php

namespace Ibrows\XeditableBundle\Tests\Mapper;

use Ibrows\XeditableBundle\Mapper\XeditableMapperFactory;
use Ibrows\XeditableBundle\Tests\StandaloneTest;

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

    public function testCreateFormFromRequest()
    {

        $form = $this->xeditable->createFormFromRequest(
            'test',
            array(),
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
    }

    /*public function testConstruct()
    {
        $mock = $this
            ->getMockBuilder('\Ibrows\XeditableBundle\Mapper\XeditableMapperFactory')
            ->disableOriginalConstructor();

        $mockFormFactory = $this
            ->getMockBuilder('Symfony\Component\Form\FormBuilderInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $mockEngine = $this
            ->getMockBuilder('Symfony\Bundle\FrameworkBundle\Templating\EngineInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $mockValidator = $this
            ->getMockBuilder('Symfony\Component\Validator\ValidatorInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $mockRouter = $this
            ->getMockBuilder('Symfony\Component\Routing\Router')
            ->disableOriginalConstructor()
            ->getMock();

    }*/

}