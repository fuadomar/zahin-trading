<?php
include(_PS_MODULE_DIR_.'territory'.DIRECTORY_SEPARATOR.'territory.php');

class AdminOrdersController extends AdminOrdersControllerCore {
    /** @var array territory list */
    protected $territories_array = array();
    protected $ordered_by_array = array();

    public function __construct() {
        parent::__construct();

        if(Configuration::get('IS_TERRITORY')) {
            if($this->context->employee->isSuperAdmin()) {
                $territories = TerritoryModel::getAll();
            } else if($this->context->employee->id_territory > 0) {
                $territories = TerritoryModel::getTerritoryWithId($this->context->employee->id_territory);
                $this->_where = ' AND c.`id_territory` = ' . $this->context->employee->id_territory;
            } else {
                $territories = array();
                $this->_where = ' AND FALSE';
            }

            $this->ordered_by_array = array('Customer' => 'Customer', 'Employee' => 'Employee');

            foreach ($territories as $territory) {
                $this->territories_array[$territory['name']] = $territory['name'];
            }

            $this->_join = $this->_join.
                ' LEFT JOIN `'._DB_PREFIX_.'territory` t ON c.`id_territory` = t.`id_territory`';

            $custom_columns = array(
                'territory' => array('title' => $this->l('Territory'), 'type' => 'select', 'list' => $this->territories_array,
                    'filter_key' => 't!name', 'class' => 'fixed-width-lg'),
                'ordered_by' => array('title' => $this->l('Ordered By'), 'type' => 'select', 'list' => $this->ordered_by_array,
                    'filter_key' => 'a!ordered_by', 'class' => 'fixed-width-lg')
            );

            $this->fields_list = array_merge(
                array_slice($this->fields_list, 0, 5),
                $custom_columns,
                array_slice($this->fields_list, 5)
            );
        }
    }
}
