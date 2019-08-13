<?php
class Amm_Request_Block_Adminhtml_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{
   public function __construct()
   {
        $this->_objectId = 'id';  
        $this->_controller = 'adminhtml'; 
        $this->_blockGroup = 'request';
        $this->_mode = 'edit';
        $this->_updateButton('save', 'label','save');
        $this->_updateButton('delete', 'label', 'delete');
        parent::__construct();
        $this->_removeButton('reset');

        if( $this->getRequest()->getParam($this->_objectId) ) {
            $requestData = Mage::getModel('request/request')->load($this->getRequest()->getParam($this->_objectId));
            Mage::register('request_edit', $requestData);
        }
    }
 
    public function getHeaderText()
    {
        return 'Edit';
    }
}