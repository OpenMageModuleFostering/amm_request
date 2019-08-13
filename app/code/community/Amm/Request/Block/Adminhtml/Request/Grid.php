<?php
class Amm_Request_Block_Adminhtml_Request_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
   public function __construct()
   {
       parent::__construct();
       $this->setId('request_grid');
       $this->setDefaultSort('id');
       $this->setDefaultDir('DESC');
       $this->setSaveParametersInSession(true);
   }
   protected function _prepareCollection()
   {
      $collection = Mage::getModel('request/request')->getCollection()->setOrder('dcreate','desc');
	  
    $resource = Mage::getSingleton('core/resource');

	  $collection->getSelect()
	  ->join( array('ce1' => $resource->getTableName('customer_entity')), 'ce1.entity_id=main_table.id_customer', array('email' => 'email'))
	  ->join( array('ce2' => $resource->getTableName('customer_entity_varchar')), 'ce2.entity_id=main_table.id_customer AND ce2.attribute_id=5', array('buyer_first_name' => 'value'))
	  ->join( array('ce3' => $resource->getTableName('customer_entity_varchar')), 'ce3.entity_id=main_table.id_customer AND ce3.attribute_id=7', array('buyer_last_name' => 'value'));
	  
      $this->setCollection($collection);
      return parent::_prepareCollection();
    }
   protected function _prepareColumns()
   {
		$this->addColumn('First Name',
               array(
                    'header' => 'First Name',
                    'align' =>'left',
					          'filter' => false,
                    'index' => 'buyer_first_name',
              ));
		$this->addColumn('Last Name',
               array(
                    'header' => 'Last Name',
                    'align' =>'left',
					          'filter'    => false,
                    'index' => 'buyer_last_name',
              ));
       $this->addColumn('Email',
               array(
                    'header' => 'Email',
                    'align' =>'left',
                    'index' => 'email',
              ));
       $this->addColumn('Theme', array(
                    'header' => 'Theme',
                    'align' =>'left',
                    'index' => 'theme',
             ));
        $this->addColumn('Created', array(
                     'header' => 'Created',
                     'align' =>'left',
                     'index' => 'dcreate',
          ));
        $this->addColumn('Answered', array(
                     'header' => 'Answered',
                     'align' =>'left',
					           'filter'    => false,
                     'index' => 'danswer',
          ));
        $this->addColumn('Status', array(
                     'header' => 'Status',
                     'align' =>'left',
					           'filter'    => false,
                     'index' => 'flag_new_message',
					           'type'  => 'options',
					           'options' => array('0' => 'ready', '1' => 'new'),
          ));
         return parent::_prepareColumns();
    }
    public function getRowUrl($row)
    {
         return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}