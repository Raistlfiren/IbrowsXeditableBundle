<?php

namespace Ibrows\XeditableBundle\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

abstract class StandaloneTest extends WebTestCase {

    /**
     * @var Client
     */
    protected $client;

    /**
     * {@inheritDoc}
     */
    protected static function createKernel(array $options = array()) {
        $configFile = isset($options['config']) ? $options['config'] : 'config.yml';

        return new AppKernel($configFile);
    }

    /**
     * {@inheritDoc}
     */
    protected function setUp() {
        $this->client = static::createClient();
    }

}