<?php

namespace Ibrows\XeditableBundle\Tests\StandaloneTestBundle\Controller;


use Ibrows\XeditableBundle\Tests\StandaloneTestBundle\Entity\Number;
use Ibrows\XeditableBundle\Tests\StandaloneTestBundle\Entity\Person;
use Ibrows\XeditableBundle\Tests\StandaloneTestBundle\Form\PersonType;
use Ibrows\XeditableBundle\Tests\StandaloneTestBundle\Form\SimplePersonType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FormController extends Controller
{

    /**
     * @param Request $request
     * @param int $person
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function simpleAction(Request $request, $person = 1)
    {
        $personEntity = new Person();
        $personEntity->setId($person);
        $personEntity->setFirstname('John');
        $personEntity->setLastname('Doe');

        $xeditableFactory = $this->get('ibrows_xeditable.mapper.factory');

        $xeditableFactory = $xeditableFactory->createFormFromRequest(
            'simple', //target route where data would be sent after submit
            array('person' => $personEntity->getId()), // parameters  for the target route
            $request, // request to get information about the current view, to find forward paramters
            new SimplePersonType(),  // a form type with a name and a firstName field
            $personEntity, // form data for the form type
            array() // form options for the form type
        );

        return $this->render('StandaloneTestBundle:Person:simple.html.twig', array(
            'form'  =>  $xeditableFactory
        ));
    }

    /**
     * @param Request $request
     * @param int $person
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function collectionAction(Request $request, $person = 1)
    {
        $personEntity = new Person();
        $personEntity->setId($person);
        $personEntity->setFirstname('John');
        $personEntity->setLastname('Doe');

        $number = new Number();
        $number->setNumber('12344121');
        $personEntity->addNumber($number);

        $number = new Number();
        $number->setNumber('12344121');
        $personEntity->addNumber($number);

        $xeditableFactory = $this->get('ibrows_xeditable.mapper.factory');

        $xeditableFactory = $xeditableFactory->createCollectionFormSimple(
            'simple', //target route where data would be sent after submit
            new PersonType(),  // a form type with a name and a firstName field
            $personEntity, // form data for the form type
            NULL, //Current object...
            $request, // request to get information about the current view, to find forward paramters
            array() // form options for the form type
        );

        return $this->render('StandaloneTestBundle:Person:collection.html.twig', array(
            'form'  =>  $xeditableFactory
        ));
    }
}