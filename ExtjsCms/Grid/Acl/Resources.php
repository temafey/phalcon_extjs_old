<?php
/**
 * @namespace
 */
namespace ExtjsCms\Grid\Acl;

use ExtjsCms\Grid\Base,
    Engine\Crud\Grid\Column,
    Engine\Crud\Grid\Filter,
    Engine\Crud\Grid\Filter\Field,
    Engine\Filter\SearchFilterInterface as Criteria;

/**
 * Class
 *
 * @category   Module
 * @package
 * @subpackage Grid
 */
class Resource extends Base
{
    /**
     * Extjs grid key
     * @var string
     */
    protected $_key = '';

    /**
     * Grid title
     * @var string
     */
    protected $_title = '';

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
     * Initialize grid columns
     *
     * @return void
     */
    protected function _initColumns()
    {
		$this->_columns = [
			'id' => new Column\Primary('Id'),
			'acl_module_id' => new Column\JoinOne('Module', 'ExtjsCms\Model\Acl\Module'),
			'name' => new Column\Name('Name'),
			'privilege' => new Column\JoinMany('Привелегии', 'ExtjsCms\Model\Acl\Privilege',null,null,', ', 5)
		];
		$this->_columns['privilege']->setAction ('acl-privilege', 'acl_resource');
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
