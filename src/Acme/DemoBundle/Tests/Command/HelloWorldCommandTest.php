<?php

namespace Acme\DemoBundle\Tests\Command;

use Acme\DemoBundle\Command\HelloWorldCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class HelloWorldCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $application = new Application();
        $application->add(new HelloWorldCommand());
        
        $command = $application->find('acme:hello');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command' => 'acme:hello',
            'who' => 'test',
        ]);
        
        $this->assertRegExp('/test\!$/i', $commandTester->getDisplay());
    }
}
