<?php
namespace Admin\Model;
 
class Logerros
{
	public $idlogerro;
    public $descricao;
    public $pagina;
    
    public function exchangeArray($data)
    {
    	$this->idlogerro    = (!empty($data['idlogerro'])) ? $data['idlogerro'] : null;
        $this->descricao	= (!empty($data['descricao'])) ? $data['descricao'] : null;
        $this->pagina    	= (!empty($data['pagina'])) ? $data['pagina'] : null;        
    }
}