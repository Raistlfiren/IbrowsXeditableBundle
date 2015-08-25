<?php

namespace Ibrows\XeditableBundle\Tests\Mapper;

use Ibrows\XeditableBundle\Mapper\XeditableMapperFactory;
use Ibrows\XeditableBundle\Tests\StandaloneTest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Router;

class XeditableMapperFactoryTest extends StandaloneTest
{

    /**
     * @var XeditableMapperFactory $xeditable
     */
    protected $xeditable;

    public function setUp()
    {
        $l = $this->getMock('Symfony\Component\Config\Loader\LoaderInterface');
        $f = $this->getMock('Symfony\Component\Form\FormFactoryInterface');
        $e = $this->getMock('Symfony\Bundle\FrameworkBundle\Templating\EngineInterface');
        $v = $this->getMock('Symfony\Component\Validator\ValidatorInterface');
        $routing = __DIR__ . '../config/routing.yml';
        //$r = new Router($l, $routing);
        $r = $this->getMock('Symfony\Component\Routing\Router', NULL, array($l, $routing));

        $this->xeditable = $this->getMock(
            'Ibrows\XeditableBundle\Mapper\XeditableMapperFactory',
            array(),
            array($f, $e, $v, $r)
        );
        //parent::setUp();

        //$this->xeditable = self::$kernel->getContainer()->get('ibrows_xeditable.mapper.factory');

    }

    public function testCreateFormFromRequestBasicInitialization()
    {
        /*$mock = $this
            ->getMockBuilder('\Ibrows\XeditableBundle\Mapper\XeditableMapperFactory')
            ->disableOriginalConstructor()
            ->getMock();*/

        $this->xeditable->createFormFromRequest(
            'simple',
            array('person' => 1),
            NULL,
            'form',
            NULL,
            array()
        );

        $this->xeditable->expects($this->once())
            ->method('createForm');

        /*$mock->expects($this->once())
            ->method('createForm')
            ->with(
                'simple',
                array('person' => 1),
                NULL,
                'form',
                NULL,
                array()
            )->will($this->returnValue(NULL));*/


        /*$form = $this->xeditable->createFormFromRequest(
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
        );*/

    }

}