<?php
 
// namespace de localizacao do nosso model
namespace Admin\Model;

use Zend\Db\Sql\Sql;

use Zend\Db\Sql\Select;

// import Zend\Db
use Zend\Db\ResultSet\ResultSet;

use Zend\Db\TableGateway\TableGatewayInterface;
 
class LogerrosTable
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
    public function fetchAll($busca=array(), $paginator=false, $currentPage = 1, $countPerPage = 2)
    {

    	$where = "";
    	if(isset($busca['busca']) and $busca['busca']!="") $where = " and (nome like '%".$busca['busca']."%' || sobrenome like '%".$busca['busca']."%')";
    	
    	if($paginator){
	    	$select = new Select();
	    	$select->from('usuarios')->where('idusuario > 0'.$where)->order('idusuario desc'); 
	    	 
	    	$adapter = new \Zend\Paginator\Adapter\DbSelect($select, $this->adapter, $this->resultSetPrototype);
	    	$paginator = new \Zend\Paginator\Paginator($adapter);
	    	$paginator->setItemCountPerPage($countPerPage);
	    	$paginator->setCurrentPageNumber($currentPage);
	    	
	    	return $paginator;	    	
    	}
    	
    	return $this->tableGateway->select("sit = true ".$where);
    }
    
    /**
     * Localizar linha especifico pelo id da tabela tb_montadoras
     *
     * @param array $id
     * @return \Model\Montadora
     * @throws \Exception
     */
    public function find($busca)
    {
        $id  = (int) $busca['idparceiro'];
        $where = " and c.idparceiro = '".$id."'";
         
        $sql = new Sql($this->adapter);
        $select = $sql->select();
        $select->from(array('c' => 'parceiros'))
        	->join(array('ci'=>'cidades'), 'c.idcidade = ci.idcidade', array('idestado' => 'idestado'),'left')
        	->where('idparceiro > 0'.$where);
                
        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute(); 
        
        if (!$resultSet)
            throw new \Exception("Não foi encontrado didparceiro = {$id}");
 
        return $resultSet;
    }
    
    public function salvaCadastro(Logerros $logerros){
    	try{
    		
    		$data = array(
    			'descricao'		=> $logerros->descricao,
    			'pagina'		=> $logerros->pagina,    			
    		);
        
    		if($logerros->idlogerro == NULL){
    			$this->tableGateway->insert($data);
    			return $this->tableGateway->lastInsertValue;
    		}else{
    			$this->tableGateway->update($data, "idlogerro = '".$logerros->idlogerro."'");
    			return $logerros->idlogerro;
    		}    		
    	}catch (\Exception $e){
    		throw new \Exception($e->getMessage());
    		return false;
    	}
    }
    
    public function deletarCadastro($id){
    	try{
    		$this->tableGateway->update(array('sit' => false), "idparceiro = '".$id."'");
    		return true;
    	}catch (\Exception $e){
    		throw new \Exception('erro');
    	}
    }
    
    /**
     * Retorna a quantidade de registro em banco de dados
     * @throws \Exception
     * @return integer
     */
    public function count()
    {
    	$row = $this->tableGateway->select("sit = true");
    	return $row->count();
    }
}