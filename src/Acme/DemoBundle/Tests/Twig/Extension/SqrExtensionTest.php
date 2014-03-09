<?php

namespace Acme\DemoBundle\Tests\Twig\Extension;

use Acme\DemoBundle\Twig\Extension\SqrExtension;

class SqrExtensionTest extends \Twig_Test_IntegrationTestCase
{
    /**
     * {@inheritDoc}
     */
    public function getExtensions()
    {
        return [
            new SqrExtension(),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getFixturesDir()
    {
        return __DIR__ . '/Fixtures/';
    }
}