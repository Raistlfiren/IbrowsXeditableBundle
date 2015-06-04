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

    public function testGetFunction()
    {
        $this->assertArrayHasKey(
            'xedit_inline_render',
            $this->ext->getFunctions()
        );
    }

    public function testXeditInlineRender()
    {
        $mock = $this->getMockBuilder('Ibrows\XeditableBundle\Model\XeditableMapperInterface')
            ->getMock();

        $mock->expects($this->once())
            ->method('render')
            ->with($this->equalTo(array()), $this->equalTo(array()))
            ->will($this->returnValue('input'));

        $this->assertEquals(
            'input',
            $this->ext->xeditInlineRender($mock, array(), array())
        );
    }

    public function testGetName()
    {

        $this->assertEquals(
            'ibrows_xeditable',
            $this->ext->getName()
        );

    }
}