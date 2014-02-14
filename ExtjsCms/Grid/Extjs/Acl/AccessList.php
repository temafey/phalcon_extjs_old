<?php
/**
 * @namespace
 */
namespace ExtjsCms\Grid\Extjs\Acl;

use ExtjsCms\Grid\Base,
    Engine\Crud\Grid\Column,
    Engine\Crud\Grid\Filter,
    Engine\Crud\Grid\Filter\Field,
    Engine\Filter\SearchFilterInterface as Criteria;

/**
 * Class Privilege
 *
 * @category    Module
 * @package     Acl
 * @subpackage  Grid
 */
class AccessList extends Base
{
    /**
     * Extjs grid key
     * @var string
     */
    protected $_key = 'acl-access-list';

    /**
     * Grid title
     * @var string
     */
    protected $_title = 'Access list';

    /**
     * Container model
     * @var string
     */
    protected $_containerModel = '\ExtjsCms\Model\Acl\AccessList';

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
			'id'       => new Column\Primary('Id'),
			'name'     => new Column\Name('Name'),
            'role'     => new Column\JoinOne('Role', '\ExtjsCms\Model\Acl\Role'),
			'resource' => new Column\JoinOne('Resource', '\ExtjsCms\Model\Acl\Resource'),
			'access'   => new Column\JoinOne('Access', '\ExtjsCms\Model\Acl\Access'),
            'allowed'  => new Column\Collection('Status', ['0' => 'not active', '1' => 'active'])
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
			'search'    => new Field\Search('Search', 'search', [
                [
                    'path' => null,
                    'filters' => [
                        Criteria::COLUMN_ID => Criteria::CRITERIA_EQ,
                        Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS,
                    ],
                ],
                [
                    'path' => 'ExtjsCms\Model\Acl\Resource',
                    'filters' => [
                        Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
                    ],
                ],
                [
                    'path' => 'ExtjsCms\Model\Acl\Access',
                    'filters' => [
                        Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
                    ],
                ],
                [
                    'path' => 'ExtjsCms\Model\Acl\Role',
                    'filters' => [
                        Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
                    ],
                ]
			]),
			'id'       => new Field\Primary('Id'),
            'name'     => new Field\Name('Name'),
            'role'     => new Field\Join('Role', '\ExtjsCms\Model\Acl\Role'),
            'resource' => new Field\Join('Resource', '\ExtjsCms\Model\Acl\Resource'),
			'access'   => new Field\Join('Access', '\ExtjsCms\Model\Acl\Access')
        ]);
    }
}
