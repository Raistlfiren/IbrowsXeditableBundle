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

    }

}