<?php

namespace Ibrows\XeditableBundle\Tests\Mapper;

use Ibrows\XeditableBundle\Mapper\XeditableMapperFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class XeditableMapperFactoryTest extends KernelTestCase
{

    /**
     * @var XeditableMapperFactory $xeditable
     */
    protected $xeditable;

    /**
     * @var RouteCollection $route
     */
    protected $routes;

    public function setUp()
    {
        self::bootKernel();
        $this->xeditable = static::$kernel
            ->getContainer()->get('ibrows_xeditable.mapper.factory');
        $route = new Route('/test', array());
        $this->routes = new RouteCollection();
        $this->routes->add('test_route', $route);

        $context = new RequestContext($_SERVER['REQUEST_URI']);

        $matcher = new UrlMatcher($this->routes, $context);

        /*$this->route = static::$kernel
            ->getContainer()->get('router')->generate('test_route', array(), false);*/
    }

    public function testCreateFormFromRequest()
    {
        $test = $this->routes;
        $test = 'hi';
        $form = $this->xeditable->createFormFromRequest(
            $this->routes->get('test_route'),
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