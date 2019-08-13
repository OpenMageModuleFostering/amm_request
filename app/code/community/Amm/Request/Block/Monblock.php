<?php
class Amm_Request_Block_Monblock extends Mage_Core_Block_Template
{
     public function __construct()
    {
        parent::__construct();

        $session = $this->_getSession()->toArray();

        $column = 'id_customer';
        $value = $session['id'];

        $collection = Mage::getModel('request/request')->getCollection()->addFilter($column,$value)->setOrder('dcreate','desc');

        $this->setCollection($collection);
    }

    protected function _getSession()
    {   
        return Mage::getSingleton('customer/session');
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
 
        $pager = $this->getLayout()->createBlock('page/html_pager', 'custom.pager');
        $pager->setAvailableLimit(array(5=>5,10=>10,20=>20,'all'=>'all'));
        $pager->setCollection($this->getCollection());
        $this->setChild('pager', $pager);
        $this->getCollection()->load();
        return $this;
    }
 
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }


         public function showblock()
     {   

         $return = '';
         $collection = $this->getCollection();
         
            if($collection->getSize()){
                $return = $this->getPagerHtml().'
                <div class="request_table">
                  <table>
                      <tr>
                        <th style="width:100px;">Created</th>
                        <th>Theme</th>
                        <th style="width:50px;">Status</th>
                      </tr>';
               foreach($collection as $data){
                  $return .= '<tr class="clicktagtr" onclick="fshowtr('.$data->getData('id').');return false;">
                          <td style="width:100px;">'.$data->getData('dcreate').'</td>
                          <td>'.$data->getData('theme').'</td>
                          <td style="width:50px;">'.($data->getData('flag_new_message')==1?'[ <span class="request_new">new</span> ]':'[ ready ]').'</td>
                        </tr>
                        <tr id="showtr'.$data->getData('id').'" style="display:none;">
                          <td colspan="3">
                            <p><strong>Message</strong></p>
                            <p>'.$data->getData('message').'</p>
                            <p><strong>Answer</strong></p>
                            <p>'.$data->getData('answer').'</p>
                            <p>&nbsp;</p>
                          </td>
                        </tr>';
               }
                $return .= '</table>
                  '.$this->getPagerHtml().'
                  <p>&nbsp;</p>
                </div>';
            }

         return $return;
     }


}