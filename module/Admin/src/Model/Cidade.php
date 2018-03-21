<?php
namespace Admin\Model;
 
class Cidade
{
    public $idcidade;
    public $nome;
    public $ibge;
    public $uf;
    public $idestado;
    public $sit;
 
    public function exchangeArray($data)
    {
        $this->idcidade		= (!empty($data['idcidade'])) ? $data['idcidade'] : null;
        $this->nome         = (!empty($data['nome'])) ? $data['nome'] : null;
        $this->ibge         = (!empty($data['ibge'])) ? $data['ibge'] : null;
        $this->uf           = (!empty($data['uf'])) ? $data['uf'] : null;
        $this->idestado     = (!empty($data['idestado'])) ? $data['idestado'] : null;
        $this->sit 			= (!empty($data['sit'])) ? $data['sit'] : null;
    }
}