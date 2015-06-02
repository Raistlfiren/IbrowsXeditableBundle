<?php

namespace Ibrows\XeditableBundle\Tests\StandaloneTestBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends Controller
{

    /**
     * @Route("/test", name="test")
     * @return array
     */
    public function testAction()
    {
        return array();
    }
}