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
class Controllers extends Base
{
    /**
     * Extjs grid key
     * @var string
     */
    protected $_key = 'mvc-controllers';

    /**
     * Grid title
     * @var string
     */
    protected $_title = 'Controllers';

    /**
     * Container model
     * @var string
     */
    protected $_containerModel = '\ExtjsCms\Model\Mvc\Controllers';

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
			'module' => new Column\JoinOne('Module', '\ExtjsCms\Model\Mvc\Module'),
			'name' => new Column\Name("Controller"),
			'actions' => new Column\JoinMany('Actions', '\ExtjsCms\Model\Mvc\Action', null, null, ', ', 5),
			'status' => new Column\Collection("Status", ['active' => 'Active', 'not_active' => 'Not active'])
		];

		$this->_columns['actions']->setAction ('site-mvc-action', 'mvccontroller');
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
                    'path' => ['\ExtjsCms\Model\Mvc\Module'],
                    'filter' => [
                        Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
                    ]
                ]
    		]),
			'id' => new Field\Primary('Id'),
       		'mvcmodule' => new Field\Join('Modules', '\ExtjsCms\Model\Mvc\Module')
        ]);
    }
}
