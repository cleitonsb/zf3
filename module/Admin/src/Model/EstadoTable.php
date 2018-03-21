<?php
 
// namespace de localizacao do nosso model
namespace Admin\Model;

// import Zend\Db
use Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGatewayInterface;
 
class EstadoTable
{
    private $tableGateway;
    
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    /**
     * Recuperar todos os elementos da tabela contatos
     *
     * @return ResultSet
     */
    public function fetchAll()
    {
        return $this->tableGateway->select();
    }
    
    public function fetchArray(){
        $arrayRet = [];
        foreach ($this->fetchAll() as $estados){
            $arrayRet[$estados->uf] = $estados->nome;
        }
        
        return $arrayRet;
    }
    
    /**
     * Localizar linha especifico pelo id da tabela 
     * @param int $id     
     */
    public function find($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('idestado' => $id));
        $row = $rowset->current();
        if (!$row)
            throw new \Exception("Não foi encontrado contado de idestado = {$id}");
 
        return $row;
    }
    
    
}