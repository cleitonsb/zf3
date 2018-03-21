<?php


namespace Admin\Model;

class Nfe
{
    public $id;
    public $cfop;
    public $naturezaop;

    public function exchangeArray(array $data)
    {
        $this->id           = (!empty($data['id'])) ? $data['id'] : null;
        $this->cfop         = (!empty($data['cfop'])) ? $data['cfop'] : null;
        $this->naturezaop   = (!empty($data['naturezaop'])) ? $data['naturezaop'] : null;
    }

    public function getArrayCopy()
    {
        return [
            'id'            => $this->id,
            'cfop'          => $this->cfop,
            'naturezaop'    => $this->naturezaop,
        ];
    }

}