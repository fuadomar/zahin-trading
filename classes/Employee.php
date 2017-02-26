<?php
class Employee extends EmployeeCore {
    /**
     * Return list of employees
     *
     * @param bool $active_only Filter employee by active status
     * @return array|false Employees or false
     */
    public static function getTerritoryManagers($active_only = true)
    {
        return Db::getInstance()->executeS('
			SELECT `id_employee`, `firstname`, `lastname`
			FROM `'._DB_PREFIX_.'employee` e
			INNER JOIN `'._DB_PREFIX_.'profile_lang` pl ON (e.`id_profile` = pl.`id_profile`)
			WHERE pl.`name` = \'Territory Manager\'
			'.($active_only ? ' AND `active` = 1' : '').'
			ORDER BY `lastname` ASC
		');
    }
}
