<?php

namespace Acme\DemoBundle\Tests\Form;

use Acme\DemoBundle\Form\UserType;
use Symfony\Component\Form\Test\TypeTestCase;

class UserTypeTest extends TypeTestCase
{
    protected $form;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->form = $this->factory->create(new UserType());
    }

    public function testSubmitValidData()
    {
        $formData = array(
            'name' => 'test',
            'email' => 'test@example.com',
        );

        $this->form->submit($formData);

        $this->assertTrue($this->form->isValid());
        $this->assertTrue($this->form->isSynchronized());
        $this->assertInstanceOf('Acme\DemoBundle\Entity\User', $this->form->getData());

        $children = $this->form->createView()->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
