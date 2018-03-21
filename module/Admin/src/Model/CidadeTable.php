<?php

namespace Admin\Model;

use Zend\Db\TableGateway\TableGatewayInterface;
 
class CidadeTable
{
    private $tableGateway;
    
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
 
    /**
     * Recuperar todos os elementos da tabela
     */
    public function fetchAll()
    {
        return $this->tableGateway->select();
    }
 
    /**
     * Localizar linha especifico pelo id da tabela 
     * @param int $id
     * @return mixed
     */
    public function find($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('idcidade' => $id));
        $row = $rowset->current();
        
        return $row;
    }
    
    public function findbyuf($uf)
    {
        return $this->tableGateway->select("sit = true and uf = '".$uf."'");
    }
    
    public function findbyidestado($id)
    {
    	$id  = (int) $id;
    	return $this->tableGateway->select("sit = true and idestado = {$id}");
    }
}