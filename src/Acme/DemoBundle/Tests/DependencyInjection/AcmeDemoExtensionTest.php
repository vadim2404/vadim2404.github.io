<?php

namespace Acme\DemoBundle\Tests\DependencyInjection;

use Acme\DemoBundle\DependencyInjection\AcmeDemoExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AcmeDemoExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testValid()
    {
        $container = $this->getMockBuilder('Symfony\Component\DependencyInjection\ContainerBuilder')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        
        $container->expects($this->at(0))
            ->method('setParameter')
            ->with($this->stringEndsWith('id'), $this->equalTo('value'))
        ;
        
        (new AcmeDemoExtension())->load($this->getValidConf(), $container);
    }
    
    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testInvalidId()
    {
        (new AcmeDemoExtension())->load([[]], new ContainerBuilder());
    }
    
    protected function getValidConf()
    {
        return [[
            'id' => 'value',
        ]];
    }
}
