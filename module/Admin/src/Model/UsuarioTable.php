<?php


namespace Admin\Model;

use Zend\Db\TableGateway\Exception\RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Db\Sql\Select;

class UsuarioTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        /* $where = "";
        if(isset($busca['busca']) and $busca['busca']!="") $where = " and (fantasia like '%".$busca['busca']."%' || razaosocial like '%".$busca['busca']."%')";
        
        if($paginator){ */
            /* $select = new Select();
            $select->from(array('u' => 'usuarios'))
                   ->join(array('c'=>'cidades'), 'c.idcidade = u.idcidade', array('cidade' => 'nome', 'uf' => 'uf', 'sitcidade' => 'sit'),'left')
                   ->where('idusuario > 0'.$where)
                   ->order('idusuario desc'); 
            
            $adapter = new DbSelect($select, $adapterOrSqlObject);
            $paginator = new \Zend\Paginator\Paginator($adapter);
            $paginator->setItemCountPerPage($countPerPage);
            $paginator->setCurrentPageNumber($currentPage);
            
            return $paginator; */
        // }
        
        return $this->tableGateway->select(['sit' => true]); 
    }

    public function save(Usuario $usuario)
    {
        $data = [
            'nome'				    => $usuario->nome,
            'cpf'					=> $usuario->cpf,
            'rg'					=> $usuario->rg,
            'logradouro'			=> $usuario->logradouro,
            'bairro'				=> $usuario->bairro,
            'numero'				=> $usuario->numero,
            'cep'					=> $usuario->cep,
            'telefone1'				=> $usuario->telefone1,
            'telefone2'				=> $usuario->telefone2,
            'email'					=> $usuario->email,
            'idcidade'				=> $usuario->idcidade,
            'sit'					=> $usuario->sit,
            'perfil'				=> $usuario->perfil,
            'dtnascimento'			=> $usuario->dtnascimento,
            'observacao'			=> $usuario->observacao,            
        ];
        
        if($usuario->idusuario == NULL){
            
            $data['dtcadastro']	= date("Y-m-d H:i:s");
            $data['senha']		= password_hash($usuario->senha, PASSWORD_BCRYPT);
            
            echo $this->tableGateway->insert($data);
                        
        }else{
            
            if($usuario->senha != null){
                $data['senha']  = password_hash($usuario->senha, PASSWORD_BCRYPT);
            }
            
            $this->tableGateway->update($data, ["idusuario" => $usuario->idusuario]);
            return $usuario->idusuario;
        }
    }
    
    function uploadAvatar($id, $files){
        try{
            //-- salvar arquivos ---------------------------------
            if($files != ""){
                //$adapter = new file \Zend\File\Transfer\Adapter\Http();
                $adapter->setDestination(ROOT_PATH."/public/sistema/uploads/usuarios");
                
                $destino = ROOT_PATH."/public/sistema/uploads/usuarios";
                
                //-- avatar -------------------------------------
                
                $ext = "";
                if(isset($files['avatar']) and $files['avatar'] != ""){
                    $arr = explode("/", $files['avatar']['type']);
                    if($arr[1] == 'jpeg' || $arr[1] == 'png') $ext = $arr[1];
                    
                    $adapter->addFilter('File\Rename', array('target' => $destino."/".$id . '.' .$ext, 'overwrite' => true));
                    
                    if($adapter->receive($files['avatar']['name'])){
                        
                        list($width, $height) = getimagesize($destino."/". $id . '.' .$ext);
                        
                        if($ext == 'jpeg'){
                            $image = imagecreatefromjpeg($destino."/". $id . '.' .$ext);
                            
                        }elseif($ext == 'png'){
                            $image = imagecreatefrompng($destino."/". $id . '.' .$ext);
                        }
                        
                        $vert = (260 * $height) / $width;
                        
                        $image_p = imagecreatetruecolor(260, 260);
                        imagecopyresampled($image_p, $image, 0, 0, 0, 0, 260, $vert, $width, $height);
                        imagejpeg($image_p, $destino."/". $id . '_avatar.jpg', 80);
                        imagedestroy($image_p);
                        
                        unlink($destino."/". $id . '.' .$ext);
                        
                        return true;
                    }else{
                        return false;
                    }
                }
            }
        }catch (\Exception $e){ echo $e->getMessage();
        throw new \Exception($e->getMessage());
        return false;
        }
    }
    

    public function find($id)
    {
        
        $sql = $this->tableGateway->getSql();
        $select = $sql->select();
        $select->join('cidades', 'cidades.idcidade = usuarios.idcidade');
                    
        return $results = $this->tableGateway->selectWith($select);        
    }

    public function delete($id)
    {
        $this->tableGateway->update(['sit' => false],['id' => (int)$id]);
    }

}