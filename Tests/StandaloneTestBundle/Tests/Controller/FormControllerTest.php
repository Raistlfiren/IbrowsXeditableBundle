<?php

namespace Ibrows\XeditableBundle\Tests\StandaloneTestBundle\Tests;


use Ibrows\XeditableBundle\Tests\StandaloneTest;

class FormControllerTest extends StandaloneTest
{

    public function testSimpleAction()
    {
        $crawler = $this->client->request('GET', '/simple/1');

        $this->assertEquals(
            '200',
            $this->client->getResponse()->getStatusCode(),
            'Page displayed ' . $this->client->getResponse()->getStatusCode() . ' instead of a 200 on /simple/1'
        );

        $this->assertEquals(
            2,
            $crawler->filter('a')->count(),
            'Two links were not created when displaying the form'
        );

        $this->assertEquals(
            '<input type="text" id="simple_person_form_firstname" name="simple_person_form[firstname]" required="required" value="John" />',
            $crawler->filter('a')->attr('data-form'),
            'First name is not rendering properly on the form'
        );

    }

}