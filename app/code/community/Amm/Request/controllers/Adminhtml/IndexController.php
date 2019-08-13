<?php
class Amm_Request_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{

	protected function _initAction()
    {
        $this->loadLayout()->_setActiveMenu('adminhtml/adminhtml')->_addBreadcrumb('request Manager','request Manager');
       return $this;
    }

	public function indexAction()
	{
	    $this->_initAction()->renderLayout();
	}

	public function editAction()
      {
		$id = $this->getRequest()->getParam('id', null);
        $model = Mage::getModel('request/request');
        if ($id) {
            $model->load((int) $id);
            if ($model->getId()) {
                $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
                if ($data) {
                    $model->setData($data)->setId($id);
                }
            } else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('request')->__('Request does not exist'));
                $this->_redirect('*/*/');
            }
        }
        Mage::register('request_data', $model);
 
        $this->_initAction();
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->renderLayout();
       }

       public function newAction()
       {
          $this->_forward('edit');
       }

       public function saveAction()
       {	   
         if ($this->getRequest()->getPost())
         {
           try {
                 $postData = $this->getRequest()->getPost();
				 $postData['danswer']=date('Y-m-d H:i');
				 if($postData['answer']!=''){ $postData['flag_new_message']=0; }
				 
				// var_dump($postData);
				 
                 $testModel = Mage::getModel('request/request');
               if( $this->getRequest()->getParam('id') <= 0 )
                  $testModel->setCreatedTime(Mage::getSingleton('core/date')->gmtDate());
                  $testModel->addData($postData)->setUpdateTime(Mage::getSingleton('core/date')->gmtDate())->setId($this->getRequest()->getParam('id'))->save();
                 Mage::getSingleton('adminhtml/session')->addSuccess('successfully saved');
                 Mage::getSingleton('adminhtml/session')->setrequestData(false);
                 $this->_redirect('*/*/');
                	return;
          		} catch (Exception $e){
	                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
	                Mage::getSingleton('adminhtml/session')->setrequestData($this->getRequest()->getPost());
	                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
	                return;
                }
         }
		 
             $this->_redirect('*/*/');
       }

       public function deleteAction()
          {
              if($this->getRequest()->getParam('id') > 0)
              {
                try
                {
                    $testModel = Mage::getModel('request/request');
                    $testModel->setId($this->getRequest()->getParam('id'))->delete();
                    Mage::getSingleton('adminhtml/session')->addSuccess('successfully deleted');
                    $this->_redirect('*/*/');
                 }
                 catch (Exception $e)
                  {
                           Mage::getSingleton('adminhtml/session')
                                ->addError($e->getMessage());
                           $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                  }
             }
            $this->_redirect('*/*/');
       }

}