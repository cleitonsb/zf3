<?php
namespace Admin\Model;
 
class Estado
{
    public $idestado;
    public $nome;
    public $ibge;
    public $uf;
    public $regiao;
    public $sit;
 
    public function exchangeArray($data)
    {
        $this->idestado		= (!empty($data['idestado'])) ? $data['idestado'] : null;
        $this->nome         = (!empty($data['nome'])) ? $data['nome'] : null;
        $this->ibge         = (!empty($data['ibge'])) ? $data['ibge'] : null;
        $this->uf           = (!empty($data['uf'])) ? $data['uf'] : null;
        $this->regiao       = (!empty($data['regiao'])) ? $data['regiao'] : null;
        $this->sit 			= (!empty($data['sit'])) ? $data['sit'] : null;
    }
}