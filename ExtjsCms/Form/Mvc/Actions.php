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
class Actions extends Base
{
    /**
     * Extjs form key
     * @var string
     */
    protected $_key = 'mvc-actions';

    /**
     * Form title
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
     * Initialize form fields
     *
     * @return void
     */
    protected function _initFields()
    {
		$this->_fields = [
			'id' => new Field\Primary('Id'),
			'modules' => new Field\JoinOne('Module', ['\ExtjsCms\Model\Mvc\Controllers', '\ExtjsCms\Model\Mvc\Module']),
			'controllers' => new Field\JoinOne('Controller', '\ExtjsCms\Model\Mvc\Controllers'),
			'name' => new Field\Name("Action"),
			'status' => new Field\Collection("Status", 'status', ['active' => 'Active', 'not_active' => 'Not active'])
		];
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
