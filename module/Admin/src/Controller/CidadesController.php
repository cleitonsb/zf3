<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Admin\Model\CidadeTable;

class CidadesController extends AbstractActionController
{
    private $table;    
    
    public function __construct(CidadeTable $table)
    {
        $this->table = $table;
    }
    
    
    public function buscaAction()
    {
        $uf = $this->params()->fromRoute('uf');
        
        $saida = '[';
        foreach ($this->table->findbyuf($uf) as $cidade){
            $saida.=json_encode($cidade).',';
        }
        
        echo $saida = ($saida != '[') ? substr($saida,0,-1)."]" : '{erro:"erro ao buscar os cidades"}';
        
        return $this->response;
    }
    
   
}
