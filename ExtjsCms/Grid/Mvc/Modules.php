<?php
/**
 * @namespace
 */
namespace ExtjsCms\Grid\Mvc;

use ExtjsCms\Grid\Base,
    Engine\Crud\Grid\Column,
    Engine\Crud\Grid\Filter,
    Engine\Crud\Grid\Filter\Field,
    Engine\Filter\SearchFilterInterface as Criteria;

/**
 * Class
 *
 * @category    Module
 * @package     Mvc
 * @subpackage  Grid
 */
class Modules extends Base
{
    /**
     * Extjs grid key
     * @var string
     */
    protected $_key = 'mvc-modules';

    /**
     * Grid title
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
     * Initialize grid columns
     *
     * @return void
     */
    protected function _initColumns()
    {
		$this->_columns = [
			'id' => new Column\Primary('Id'),
			'name' => new Column\Name("Module"),
			'controllers' => new Column\JoinMany('Controllers', '\ExtjsCms\Model\Mvc\Controllers', null, null, ', ', 5),
			'status' => new Column\Collection("Status", ['active' => 'Active', 'not_active' => 'Not active'])
			//'menu_role' => new Column\JoinOne('Роль', 'ExtjsCms\Model\Acl\Role', null, null, ', ', 9, '150')
		];
		$this->_columns['controllers']->setAction('site-mvc-controllers', 'mvcmodule');
    }

    /**
     * Initialize grid filters
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
