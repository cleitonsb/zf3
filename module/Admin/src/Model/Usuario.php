<?php
namespace Admin\Model;

class Usuario
{
    public $idusuario;
    public $nome;
    public $cpf;
    public $rg;
    public $logradouro;
    public $bairro;
    public $numero;
    public $cep;
    public $idcidade;
    public $cidade;
    public $uf;
    public $telefone1;
    public $telefone2;
    public $email;
    public $dtcadastro;
    public $sit;
    public $senha;
    public $perfil;    
    public $observacao;
    public $dtnascimento;
    
    public function exchangeArray($data)
    {
        $this->idusuario			= (!empty($data['idusuario'])) ? $data['idusuario'] : null;
        $this->nome	 			    = (!empty($data['nome'])) ? $data['nome'] : null;
        $this->cpf	     			= (!empty($data['cpf'])) ? $data['cpf'] : null;
        $this->rg    				= (!empty($data['rg'])) ? $data['rg'] : null;
        $this->logradouro   		= (!empty($data['logradouro'])) ? $data['logradouro'] : null;
        $this->bairro	    		= (!empty($data['bairro'])) ? $data['bairro'] : null;
        $this->numero     			= (!empty($data['numero'])) ? $data['numero'] : null;
        $this->cep					= (!empty($data['cep'])) ? $data['cep'] : null;
        $this->telefone1			= (!empty($data['telefone1'])) ? $data['telefone1'] : null;
        $this->telefone2			= (!empty($data['telefone2'])) ? $data['telefone2'] : null;
        $this->email				= (!empty($data['email'])) ? $data['email'] : null;
        $this->idcidade				= (!empty($data['idcidade'])) ? $data['idcidade'] : null;
        $this->dtcadastro			= (!empty($data['dtcadastro'])) ? $data['dtcadastro'] : null;
        $this->sit					= (isset($data['sit'])) ? $data['sit'] : true;
        $this->perfil				= (!empty($data['perfil'])) ? $data['perfil'] : null;
        $this->senha				= (!empty($data['senha'])) ? $data['senha'] : null;
        $this->cidade				= (!empty($data['cidade'])) ? $data['cidade'] : null;
        $this->uf					= (!empty($data['uf'])) ? $data['uf'] : null;
        $this->observacao			= (!empty($data['observacao'])) ? $data['observacao'] : null;
        $this->dtnascimento			= (!empty($data['dtnascimento'])) ? $data['dtnascimento'] : null;        
    }
}