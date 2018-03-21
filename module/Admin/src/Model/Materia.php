<?php
namespace Admin\Model;
 
class Materia
{
    public $idmateria;
    public $nome;
    public $valor;
    public $comissao;
    public $sit;
 
    public function exchangeArray($data)
    {
        $this->idmateria	= (!empty($data['idmateria'])) ? $data['idmateria'] : null;
        $this->nome         = (!empty($data['nome'])) ? $data['nome'] : null;
        $this->valor        = (!empty($data['valor'])) ? $data['valor'] : null;
        $this->comissao     = (!empty($data['comissao'])) ? $data['comissao'] : null;
        $this->sit 			= (!empty($data['sit'])) ? $data['sit'] : null;
    }
}