<?php
class AdminOrdersController extends AdminOrdersControllerCore {
    public function __construct() {
        parent::__construct();

        if(!$this->context->employee->isSuperAdmin()) {
            $this->_where = ' AND c.`id_employee` = ' . $this->context->employee->id;
        }
    }
}