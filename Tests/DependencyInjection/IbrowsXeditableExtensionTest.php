<?php

namespace Ibrows\XeditableBundle\Tests\DependencyInjection;

use Ibrows\XeditableBundle\Tests\StandaloneTest;
use Symfony\Component\DependencyInjection\ContainerInterface;

class IbrowsXeditableExtensionTest extends StandaloneTest
{

    /** @var ContainerInterface $container */
    protected $container;

    public function setUp()
    {
        parent::setUp();

        $this->container = self::$kernel->getContainer();
    }

    public function testDefaultIsLoaded()
    {
        $this->assertTrue(
            $this->container->has('ibrows_xeditable.mapper.factory'),
            'The mapper factory is not loaded.'
        );

        $this->assertTrue(
            $this->container->has('ibrows_xeditable.twig.extension'),
            'The twig extension is not loaded.'
        );
    }

    public function testDefaultIsInstanceOf()
    {
        $this->isInstanceOf(
            'Ibrows\XeditableBundle\Twig\TwigExtension',
            $this->container->get('ibrows_xeditable.twig.extension'),
            'Twig extension is not an instance of Ibrows\XeditableBundle\Twig\TwigExtension'
        );

        $this->isInstanceOf(
            'Ibrows\XeditableBundle\Mapper\XeditableMapperFactory',
            $this->container->get('ibrows_xeditable.mapper.factory'),
            'Form mapper extension is not an instance of Ibrows\XeditableBundle\Mapper\XeditableMapperFactory'
        );
    }

}