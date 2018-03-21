<?php

namespace Admin\Form\Factory;

use Interop\Container\ContainerInterface;
use Admin\InputFilter\NfeInputFilter;
use Admin\Form\NfeForm;

class NfeFormFactory
{
    function __invoke(ContainerInterface $container)
    {
        $inputFilter = new NfeInputFilter();
        $form   = new NfeForm();
        $form->setInputFilter($inputFilter);
        
        return $form;
    }
}