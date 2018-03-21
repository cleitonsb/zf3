<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Model\UsuarioTable;
use Admin\Form\UsuarioForm;
use Admin\Model\EstadoTable;
use Admin\Model\CidadeTable;
use Admin\Model\Usuario;


class UsuariosController extends AbstractActionController
{
    /**
     * @var UsuarioTable
     */
    private $usuarioTable;
    private $form;
    private $estadoTable;
    private $materiaTable;
    private $cidadeTable;
    
    public function __construct(UsuarioForm $form, UsuarioTable $usuarioTable, EstadoTable $estadoTable, CidadeTable $cidadeTable)
    {
        $this->usuarioTable     = $usuarioTable;
        $this->form             = $form;
        $this->estadoTable      = $estadoTable;
        $this->cidadeTable      = $cidadeTable;
    }
    
    
    public function indexAction()
    {
        
        $usuarios = $this->usuarioTable->fetchAll();
        
        return new ViewModel([
            'usuarios' => $usuarios
        ]);
    }
    
    public function buscaAction()
    {
        
        /* $request = $this->getRequest();
        
        if(!$request->isPost()){
            return new ViewModel([
                'form' => $form,
            ]);
        }
        
        $form->setData($request->getPost()); */
        
        $modelEstados = new EstadoTable();
        
        return new ViewModel([
            'usuarios' => $this->usuarioTable->fetchAll(),
            'estados'  => $modelEstados->fetchAll(),
        ]);
    }
    
    public function cadastroAction()
    {
        
        $id = (int)$this->params()->fromRoute('id', 0);
        
        $usuario = ($id!=0) ? $this->usuarioTable->find($id) : null;
        
        return new ViewModel([
            'usuario'   => $usuario,
            'form'      => $this->form,
            'estados'   => $this->estadoTable->fetchArray(),
        ]);
    }
    
    public function salvarAction()
    {
        
        try{
            
            $form = $this->form;        
            $request = $this->getRequest();
            
            if($request->isPost()){
                $data = $this->getRequest()->getPost();
                $form->setData($data);
                
                if($form->isValid()){
                    $formData = $form->getData();
                    
                    $usuario = new Usuario();
                    $usuario->exchangeArray($formData);
                    
                    //echo $this->usuarioTable->save($usuario);
                                                        
                }else{
                    
                    $camposErr = $form->getMessages();
                    
                    $arrayErr = [];
                    $i=0;
                    foreach ($camposErr as $crow => $cvalue){
                        
                        $arrayErr[$i]['campo'] = $crow;
                        
                        $arrayMsg = [];
                        foreach ($cvalue as $row => $value){
                            $arrayMsg[] = $value;
                        }
                        
                        $arrayErr[$i]['msg'] = $arrayMsg;
                        
                        $i++;
                    }
                    
                    echo json_encode($arrayErr);
                }
            }
            
            
        }catch (\Exception $e){ 
            echo json_encode($e->getMessage());
        }
            
        return $this->response;
    }
}
