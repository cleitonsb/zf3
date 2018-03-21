<?php 
namespace User\InputFilter;

use Zend\InputFilter\InputFilter;
use Zend\Filter\StringTrim;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;

class LoginInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name'          => 'email',
            'required'      => true,
            'filters'       => [
                ['name' => StringTrim::class],
            ],
            'validators'    => [
                [
                    'name'      => NotEmpty::class,
                    'options'   => [
                        'messages'  => [
                            NotEmpty::IS_EMPTY  => 'Campo obrigatório',
                        ],
                    ]
                ],
                [
                    'name'      => EmailAddress::class,
                    'options'   => [
                        'messages' => [
                            EmailAddress::INVALID            => "Formato do email inválido",
                            EmailAddress::INVALID_FORMAT     => "Emai com formato inválido. O padrão do formato é email@dominio",
                            
                        ]
                    ]
                ],
            ],
        ]);
        
        $this->add([
            'name'          => 'senha',
            'required'      => true,                        
            'validators'    => [
                [
                    'name'      => NotEmpty::class,
                    'options'   => [
                        'messages'  => [
                            NotEmpty::IS_EMPTY  => 'Campo obrigatório',
                        ],
                    ]
                ],                
            ]
        ]);
    }
}

