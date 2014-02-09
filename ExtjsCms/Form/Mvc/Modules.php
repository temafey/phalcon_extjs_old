<?php
/**
 * @namespace
 */
namespace ExtjsCms\Form\Mvc;

use ExtjsCms\Form\Base,
    Engine\Crud\Form\Field;

/**
 * Class
 *
 * @category    Module
 * @package     Mvc
 * @subpackage  Form
 */
class Modules extends Base
{
    /**
     * Extjs form key
     * @var string
     */
    protected $_key = 'mvc-modules';

    /**
     * Form title
     * @var string
     */
    protected $_title = 'Modules';

    /**
     * Container model
     * @var string
     */
    protected $_containerModel = '\ExtjsCms\Model\Mvc\Module';

    /**
     * Container condition
     * @var array|string
     */
    protected $_containerConditions = null;

    /**
     * Initialize form fields
     *
     * @return void
     */
    protected function _initFields()
    {
		$this->_fields = [
			'id' => new Field\Primary('Id'),
			'name' => new Field\Name("Module"),
			'controllers' => new Field\JoinMany('Controllers', '\ExtjsCms\Model\Mvc\Controllers', null, null, ', ', 5),
			'status' => new Field\Collection("Status", ['active' => 'Active', 'not_active' => 'Not active'])
			//'menu_role' => new Field\JoinOne('Роль', 'ExtjsCms\Model\Acl\Role', null, null, ', ', 9, '150')
		];
		$this->_fields['controllers']->setAction('site-mvc-controllers', 'mvcmodule');
    }

    /**
     * Initialize form filters
     *
     * @return void
     */
    protected function _initFilters()
    {
        $this->_filter = new Filter([
			'search' => new Field\Search('Search', 'search', [
                Criteria::COLUMN_ID => Criteria::CRITERIA_EQ,
                Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
		    ]),
			'id' => new Field\Primary('Id')
        ]);
    }
}
