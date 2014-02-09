<?php
/**
 * @namespace
 */
namespace ExtjsCms\Form\Acl;

use ExtjsCms\Form\Base,
    Engine\Crud\Form\Field;

/**
 * Class Resource
 *
 * @category    Module
 * @package     Acl
 * @subpackage  Form
 */
class Resource extends Base
{
    /**
     * Extjs form key
     * @var string
     */
    protected $_key = 'acl-resource';

    /**
     * Form title
     * @var string
     */
    protected $_title = 'Resource';

    /**
     * Container model
     * @var string
     */
    protected $_containerModel = '\ExtjsCms\Model\Acl\Resource';

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
			'acl_module_id' => new Field\JoinOne('Module', 'ExtjsCms\Model\Acl\Module'),
			'name' => new Field\Name('Name'),
			'privilege' => new Field\JoinMany('Привелегии', 'ExtjsCms\Model\Acl\Privilege',null,null,', ', 5)
		];
		$this->_fields['privilege']->setAction ('acl-privilege', 'acl_resource');
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
                        Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS,
                    ],
                ],
				[
                    'path' => 'ExtjsCms\Module\Acl\Module',
                    'filter' => [
                        Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
                    ],
                ]
			]),
			'id' => new Field\Primary('Id'),
            'name' => new Field\Name('Name'),
            'acl_module' => new Field\Join('acl_module_id', 'Модуль', 'ExtjsCms\Model\Acl\Module'),
            'parent' => new Field\Join('acl_module_id', 'Модуль', 'ExtjsCms\Model\Acl\Module')
        ]);
    }
}
