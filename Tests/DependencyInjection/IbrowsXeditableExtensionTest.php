<?php

namespace Ibrows\XeditableBundle\Tests\DependencyInjection;


use Ibrows\XeditableBundle\DependencyInjection\IbrowsXeditableExtension;
use Ibrows\XeditableBundle\Tests\AppKernel;
use Ibrows\XeditableBundle\Tests\StandaloneTest;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Form\FormFactory;

class IbrowsXeditableExtensionTest extends StandaloneTest
{

    /** @var ContainerBuilder $container */
    protected $container;

    public function setUp()
    {
        parent::setUp();

        $this->container = new ContainerBuilder();
        $loader = new IbrowsXeditableExtension();
        $loader->load(array(array()), $this->container);
    }

    public function testDefault()
    {
        $this->assertTrue(
            $this->container->hasDefinition('ibrows_xeditable.mapper.factory'),
            'The mapper factory is not loaded.'
        );

        $this->assertTrue(
            $this->container->hasDefinition('ibrows_xeditable.twig.extension'),
            'The twig extension is not loaded.'
        );

        $this->isInstanceOf(
            'Ibrows\XeditableBundle\Twig\TwigExtension',
            $this->container->get('ibrows_xeditable.twig.extension'),
            'Twig extension is not instance of Ibrows\XeditableBundle\Twig\TwigExtension'
        );

        $this->isInstanceOf(
            'Ibrows\XeditableBundle\Mapper\XeditableMapperFactory',
            $this->container->get('ibrows_xeditable.mapper.factory'),
            'Twig extension is not instance of Ibrows\XeditableBundle\Mapper\XeditableMapperFactory'
        );
    }

    public function testDefaultArgumentsForFormMapper()
    {
        $test = $this->container->getDefinition('ibrows_xeditable.mapper.factory');

        echo 'hi';
    }
}