<?php

namespace Admin\Model;

use Zend\Db\TableGateway\TableGatewayInterface;
 
class MateriaTable
{
    private $tableGateway;
    
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    /**
     * Recuperar todos os elementos da tabela
     * @return object
     */   
    public function fetchAll()
    {
        return $this->tableGateway->select();
    }
    
    public function fetchArray(){
        $arrayRet = []; 
        foreach ($this->fetchAll() as $materias){
            $arrayRet[$materias->idmateria] = $materias->nome;
        }
        
        return $arrayRet;
    }
 
    /**
     * Localizar linha especifico pelo id da tabela tb_usuarios
     *
     * @param type $id
     * @return \Model\Usuario
     * @throws \Exception
     */
    public function find($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('idmateria' => $id));
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