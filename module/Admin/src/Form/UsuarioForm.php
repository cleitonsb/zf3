<?php


namespace Admin\Form;


use Zend\Form\Form;
use Zend\Form\Element;

class UsuarioForm extends Form
{

    public function __construct($name=null)
    {
        parent::__construct('usuario');
        
        $this->add([
            'name' => 'idusuario',
            'type' => 'hidden',
        ]);
                
        $this->add([
            'name' => 'nome',
            'type' => 'text',
            'options' => [
                'label'=> 'Nome'
            ]
        ]);
                
        $this->add([
            'name' => 'cpf',
            'type' => 'text',
            'options' => [
                'label'=> 'CPF'
            ]
        ]);
                
        $this->add([
            'name' => 'rg',
            'type' => 'text',
            'options' => [
                'label'=> 'RG'
            ]
        ]);
                
        $this->add([
            'name' => 'logradouro',
            'type' => 'text',
            'options' => [
                'label'=> 'Logradouro'
            ]
        ]);
                
        $this->add([
            'name' => 'bairro',
            'type' => 'text',
            'options' => [
                'label'=> 'Bairro'
            ]
        ]);
                
        $this->add([
            'name' => 'numero',
            'type' => 'text',
            'options' => [
                'label'=> 'Número'
            ]
        ]);
                
        $this->add([
            'name' => 'cep',
            'type' => 'text',
            'options' => [
                'label'=> 'CEP'
            ]
        ]);
                
        $this->add([
            'name' => 'idcidade',
            'type' => 'select',
            'options' => [
                'label'=> 'Cidade',
                'disable_inarray_validator' => true,
            ]
        ]);
        
        $this->add([
            'name' => 'uf',
            'type' => 'select',
            'options' => [
                'label'=> 'UF',
                'disable_inarray_validator' => true,
            ]
        ]);
                
        $this->add([
            'name' => 'telefone1',
            'type' => Element\Tel::class,
            'options' => [
                'label'=> 'Telefone'
            ]
        ]);
                
        $this->add([
            'name' => 'telefone2',
            'type' => Element\Tel::class,
            'options' => [
                'label'=> 'Telefone'
            ]
        ]);
                
        $this->add([
            'name' => 'email',
            'type' => 'email',
            'options' => [
                'label'=> 'E-mail'
            ]
        ]);
        
        $this->add([
            'name' => 'senha',
            'type' => 'password',
            'options' => [
                'label'=> 'Senha'
            ]
        ]);
        
        $this->add([
            'name' => 'confirmasenha',
            'type' => 'password',
            'options' => [
                'label'=> 'Confirmação da senha'
            ]
        ]);
        
        $perfil = new Element\Select('perfil');
        $perfil->setLabel('Perfil');
        $perfil->setValueOptions([
            '1' => 'Administrador',
            '2' => 'Usuário',
        ]);
        
        $this->add($perfil);
                        
        $this->add([
            'name' => 'observacao',
            'type' => Element\Textarea::class,
            'options' => [
                'label'=> 'Observação'
            ]
        ]);
                
        $this->add([
            'name' => 'dtnascimento',
            'type' => 'text',
            'options' => [
                'label'=> 'Data nasc'
            ]
        ]);
        
        $this->add([
            'name' => 'avatar',
            'type' => Element\File::class,
            'options' => [
                'label'=> 'Avatar'
            ]
        ]);
      
        $salvar = new Element\Button('btnsalvar');
        $salvar->setLabel('Salvar')
            ->setAttribute('id', 'btnSalvar')
            ->setValue('Salvar');
        
        $this->add($salvar);
        
        $deletar = new Element\Button('btndeletar');
        $deletar->setLabel('Deletar')
                ->setAttribute('id', 'btnDeletar')
                ->setValue('Deletar');
        
        $this->add($deletar);
    }

}