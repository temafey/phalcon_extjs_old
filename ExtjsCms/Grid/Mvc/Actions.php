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
class Actions extends Base
{
    /**
     * Extjs grid key
     * @var string
     */
    protected $_key = 'mvc-actions';

    /**
     * Grid title
     * @var string
     */
    protected $_title = 'Actions';

    /**
     * Container model
     * @var string
     */
    protected $_containerModel = '\ExtjsCms\Model\Mvc\Action';

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
			'modules' => new Column\JoinOne('Module', ['\ExtjsCms\Model\Mvc\Controllers', '\ExtjsCms\Model\Mvc\Module']),
			'controllers' => new Column\JoinOne('Controller', '\ExtjsCms\Model\Mvc\Controllers'),
			'name' => new Column\Name("Action"),
			'status' => new Column\Collection("Status", 'status', ['active' => 'Active', 'not_active' => 'Not active'])
		];
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
				[
					'path' => null,
					'filter' => [
						Criteria::COLUMN_ID => Criteria::CRITERIA_EQ,
						Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
					],
				],
				[
					'path' => ['\ExtjsCms\Model\Mvc\Controllers'],
					'filter' => [
						Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
					]
				],
				[
					'path' => ['\ExtjsCms\Model\Mvc\Controllers', '\ExtjsCms\Model\Mvc\Module'],
					'filter' => [
						Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
					]
				]
			]),
    		'id' => new Field\Primary('Id'),
    		'mvcmodule' => new Field\Join('module_id', 'Modules', '\ExtjsCms\Model\Mvc\Module', ['\ExtjsCms\Model\Mvc\Controllers', '\ExtjsCms\Model\Mvc\Module']),
       		'mvccontroller' => new Field\Join('Controllers', '\ExtjsCms\Model\Mvc\Controllers'),
    		'parent' => new Field\Join('Controllers', '\ExtjsCms\Model\Mvc\Controllers'),
    		'modulename' => new Field\Join('Modules', '\ExtjsCms\Model\Mvc\Module', ['\ExtjsCms\Model\Mvc\Controllers', '\ExtjsCms\Model\Mvc\Module']),
    		'controllername' => new Field\Join('Controllers', '\ExtjsCms\Model\Mvc\Controllers'),
    		'actionname' => new Field\Standart('name', 'Action', Criteria::CRITERIA_EQ),
        ]);
    }
}
