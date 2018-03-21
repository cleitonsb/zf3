<?php


namespace User\Form;


use Zend\Form\Form;
use Zend\Form\Element;

class LoginForm extends Form
{

    public function __construct($name=null)
    {
        parent::__construct('login');

        $email = new Element\Text('email');
        $email->setLabel('Email')
              ->setAttribute('id', 'loginemail');
        
        $this->add($email);
        
        $email = new Element\Password('senha');
        $email->setLabel('Senha')
              ->setAttribute('id', 'loginsenha');
        
        $this->add($email);
        
        $button = new Element\Button('btnentrar');
        $button->setLabel('Entrar')
               ->setAttribute('id', 'btnEntrar');
                
        $this->add($button);
    }
}