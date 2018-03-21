<?php 
namespace Admin\InputFilter;

use Zend\InputFilter\InputFilter;
use Zend\Filter\StringTrim;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;
use Zend\I18n\Filter\Alnum;
use Zend\Validator\File\IsImage;
use Zend\Validator\File\Size;

class UsuarioInputFilter extends InputFilter
{
    public function __construct()
    {
        /* $this->add([
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
                            EmailAddress::INVALID_FORMAT     => "Emai com formato inválido.",
                            EmailAddress::INVALID_HOSTNAME   => "'%hostname%' não é um endereço válido",
                            EmailAddress::INVALID_MX_RECORD  => "'%hostname%' não foi encontrado",
                            EmailAddress::INVALID_SEGMENT    => "'%hostname%' não é uma rota de rede válida.",
                            EmailAddress::DOT_ATOM           => "'%localPart%' formato não compatível com dot-atom",
                            EmailAddress::QUOTED_STRING      => "'%localPart%' não pode ser combinado com o formato da string citada",
                            EmailAddress::INVALID_LOCAL_PART => "'%localPart%' não é uma nome válido para o endereço de e-mail",
                            EmailAddress::LENGTH_EXCEEDED    => "Tamanho máximo do campo excedido",
                        ]
                    ]
                ],
            ],
        ]);
        
        $this->add([
            'name'          => 'nome',
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
                
        $this->add([
            'name'          => 'cep',
            'required'      => true,
            'filters'       => [
                ['name' => StringTrim::class],
                ['name' => Alnum::class],
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
            ],
        ]);
        
        $this->add([
            'name'          => 'cpf',
            'required'      => true,
            'filters'       => [
                ['name' => StringTrim::class],
                ['name' => Alnum::class],
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
            ],
        ]);
        
        $this->add([
            'name'          => 'rg',
            'required'      => true,
            'filters'       => [
                ['name' => StringTrim::class],
                ['name' => Alnum::class],
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
            ],
        ]); */
        
        $this->add([
            'name'          => 'telefone1',
            'required'      => false,            
        ]);
        
        $this->add([
            'name'          => 'telefone2',
            'required'      => false,
        ]);
        
        $this->add([
            'name'          => 'senha',
            'required'      => false,
        ]);
        
        $this->add([
            'name'          => 'avatar',
            'required'      => true,
            'validators'    => [
                [
                    'name'      => IsImage::class,
                    'options'   => [
                        'messages'  => [
                            IsImage::FALSE_TYPE   => "Arquivo não é uma imagem.",
                            IsImage::NOT_DETECTED => "Não foi identificado o mimetype do arquivo",
                            IsImage::NOT_READABLE => "Não foi possível ler o arquivo",
                        ],
                    ]
                ],
                [
                    'name'      => Size::class,
                    'options'   => [
                        'min' => '10KB',
                        'max' => '2MB',  
                    ]
                ],
            ],
        ]);
    }
}