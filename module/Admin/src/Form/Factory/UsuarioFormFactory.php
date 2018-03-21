<?php

namespace Admin\Form\Factory;

use Interop\Container\ContainerInterface;
use Admin\Form\UsuarioForm;
use Admin\InputFilter\UsuarioInputFilter;

class UsuarioFormFactory
{
    function __invoke(ContainerInterface $container)
    {
        $inputFilter = new UsuarioInputFilter();
        $form = new UsuarioForm();
        $form->setInputFilter($inputFilter);
        
        return $form;
    }
}