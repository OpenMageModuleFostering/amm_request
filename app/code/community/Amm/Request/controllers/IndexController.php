<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Catalog
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Amm_Request_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * Index action
     */
    
    protected function _getSession()
    {		
        return Mage::getSingleton('customer/session');
    }

    public function indexAction()
    { 
    	$session = $this->_getSession();
    	if(!$session->isLoggedIn()){
    		$this->_redirectUrl(Mage::helper('customer')->getLoginUrl());
    	}else{

		    $this->loadLayout();

            $navigationBlock = $this->getLayout()->getBlock('customer_account_navigation');
            if ($navigationBlock) {
                $navigationBlock->setActive('request');
            }

        $this->renderLayout();
        
      }
    }

    public function addAction()
    {
        $session = $this->_getSession()->toArray();
        $theme = mb_substr(strip_tags(''.$this->getRequest()->getPost('form_MR_theme')),0,100,'utf-8');
        $message = strip_tags(''.$this->getRequest()->getPost('form_MR_message'));
        $date_now = date("Y-m-d H:i");
     
        if(isset($theme) && $theme!='' && isset($message) && $message!=''){
          $form_save = Mage::getModel('request/request');
          $form_save->setData('id_customer', $session['id']);
          $form_save->setData('theme', $theme);
          $form_save->setData('message', $message);
          $form_save->setData('dcreate', $date_now);
          $form_save->setData('flag_new_message', 1);
          $form_save->save();
        }

		$this->_redirectUrl(Mage::getBaseUrl().'request/');
    }

}
