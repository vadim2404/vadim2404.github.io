<?php

namespace Acme\DemoBundle\Twig\Extension;

class SqrExtension extends \Twig_Extension
{
    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('sqr', [$this, 'sqr']),
        ];
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'acme_demo_twig_extension_sqrextension';
    }
    
    /**
     * Pow 2
     * 
     * @param integer|double $number
     * @return integer|double
     */
    public function sqr($number)
    {
        return $number * $number;
    }
}
