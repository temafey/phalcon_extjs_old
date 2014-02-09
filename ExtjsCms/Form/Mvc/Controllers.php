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
class Controllers extends Base
{
    /**
     * Extjs form key
     * @var string
     */
    protected $_key = 'mvc-controllers';

    /**
     * Form title
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
     * Initialize form fields
     *
     * @return void
     */
    protected function _initFields()
    {
		$this->_fields = [
			'id' => new Field\Primary('Id'),
			'module' => new Field\JoinOne('Module', '\ExtjsCms\Model\Mvc\Module'),
			'name' => new Field\Name("Controller"),
			'actions' => new Field\JoinMany('Actions', '\ExtjsCms\Model\Mvc\Action', null, null, ', ', 5),
			'status' => new Field\Collection("Status", ['active' => 'Active', 'not_active' => 'Not active'])
		];

		$this->_fields['actions']->setAction ('site-mvc-action', 'mvccontroller');
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
