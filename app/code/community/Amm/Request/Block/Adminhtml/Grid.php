<?php
class Amm_Request_Block_Adminhtml_Grid extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
     //where is the controller
     $this->_controller = 'adminhtml_request';
     $this->_blockGroup = 'request';
     //text in the admin header
     $this->_headerText = "All Customer's Requests";
     //value of the add button
     //$this->_addButtonLabel = 'Add a contact';
     parent::__construct();
    $this->_removeButton('add');
    }
}