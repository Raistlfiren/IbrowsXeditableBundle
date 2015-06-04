<?php

namespace Ibrows\XeditableBundle\Tests\Twig;


use Ibrows\XeditableBundle\Twig\TwigExtension;

class TwigExtensionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var TwigExtension $ext
     */
    private $ext;

    protected function setUp()
    {
        $this->ext = new TwigExtension();
    }

    public function testXeditInlineRender()
    {
        //$this->ext->xeditInlineRender('test', 'form');
    }
}