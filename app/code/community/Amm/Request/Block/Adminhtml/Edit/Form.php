<?php
class Amm_Request_Block_Adminhtml_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {  
        parent::__construct();     
        $this->setId('request_edit');
    } 

    protected function _prepareForm()
    {
         if (Mage::getSingleton('adminhtml/session')->getRequestData())
        {
            $data = Mage::getSingleton('adminhtml/session')->getRequestData();
            Mage::getSingleton('adminhtml/session')->getRequestData(null);
        }
        elseif (Mage::registry('request_data'))
        {
            $data = Mage::registry('request_data')->getData();
        }
        else
        {
            $data = array();
        }

         $form = new Varien_Data_Form(
                array(
                  'id' => 'edit_form',
                  'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))
                     ),
                 'method' => 'post',
                 )
              );
        $form->setUseContainer(true);
        $this->setForm($form);

        $fieldset = $form->addFieldset('request_edit', array(
             'legend' =>Mage::helper('request')->__('Request Information'),
             'style'  => 'width:100%;',
        ));

        $fieldset->addField('theme', 'text', array(
             'label'     => Mage::helper('request')->__('theme'),
             'style'     => 'width:500px;',
             'required'  => true, 
             'name'      => 'theme',
        ));
 
        $fieldset->addField('message', 'editor', array(
             'label'     => Mage::helper('request')->__('Message'),
             'style'     => 'width:500px; height:200px;',
             'required'  => true,
             'name'      => 'message',
        ));
 
        $fieldset->addField('answer', 'editor', array(
             'label'     => Mage::helper('request')->__('Answer'),
             'style'     => 'width:500px; height:100px;',
             'required'  => true,
             'name'      => 'answer',
        ));

        $fieldset->addField('flag_new_message', 'select', array(
             'label'     => Mage::helper('request')->__('Status'),
             'name'      => 'flag_new_message',
             'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('request')->__('New'),
                ),
 
                array(
                    'value'     => 0,
                    'label'     => Mage::helper('request')->__('Done'),
                ),
            ),
        ));
 
        $form->setValues($data);

      return parent::_prepareForm();
   }
}