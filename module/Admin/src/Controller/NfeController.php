<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Model\NfeTable;
use Admin\Form\NfeForm;
use Admin\Model\Nfe;

class NfeController extends AbstractActionController
{
    
    
    /**
     * @var NfeTable
     */
    private $table;
    private $form;
    
    public function __construct(NfeTable $table, NfeForm $form)
    {
        $this->table = $table;
        $this->form  = $form;
    }
    
    public function indexAction()
    {
        $nfeTable = $this->table;
        
        return new ViewModel([
            'nfes' => $nfeTable->fetchAll()
        ]);
        
        return $this->response;
    }
     
    public function novoAction()
    {
        
        $form = $this->form;
        $form->get('submit')->setValue('Salvar Nova');
        
        $request = $this->getRequest();
        
        if(!$request->isPost()){
            return new ViewModel([
                'form' => $form,
            ]);
        }
        
        $form->setData($request->getPost());
        
        if (!$form->isValid()) {
            return ['form' => $form];
        }
        
        $nfe = new Nfe();
        $nfe->exchangeArray($form->getData());
        $this->table->save($nfe);
        
        return $this->redirect()->toRoute('nfe');
    }
    
    public function editarAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        
        if (!$id) {
            return $this->redirect()->toRoute('nfe');
        }
        
        try {
            $nfe = $this->table->find($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('nfe');
        }
        
        $form = new NfeForm();
        $form->bind($nfe);
        $form->get('submit')->setAttribute('value', 'Salvar');
        
        $request = $this->getRequest();
        
        if (!$request->isPost()) {
            return [
                'id' => $id,
                'form' => $form
            ];
        }
        
        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return [
                'id' => $id,
                'form' => $form
            ];
        }
        
        $this->table->save($nfe);
        return $this->redirect()->toRoute('nfe');
    }
    
    public function deletarAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('nfe');
        }
        
        $this->table->delete($id);
        return $this->redirect()->toRoute('nfe');
        
    }
}
