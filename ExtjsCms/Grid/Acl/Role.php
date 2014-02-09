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
 * Class Role
 *
 * @category    Module
 * @package     Acl
 * @subpackage  Grid
 */
class Role extends Base
{
    /**
     * Extjs grid key
     * @var string
     */
    protected $_key = 'acl-role';

    /**
     * Grid title
     * @var string
     */
    protected $_title = 'Roles';

    /**
     * Container model
     * @var string
     */
    protected $_containerModel = '\ExtjsCms\Model\Acl\Role';

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
			'name' => new Column\Name('Name'),
			'privilege' => new Column\JoinMany('Privileges', ['ExtjsCms\Model\Acl\RolePrivilege', 'ExtjsCms\Model\Acl\Privilege'], null, null, ', ', 5, '100')
		];
		$this->_columns['privilege']->setAction ('acl-privilege', 'role');
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
                    'path' => ['ExtjsCms\Model\Acl\RolePrivilege', 'ExtjsCms\Model\Acl\Privilege'],
                    'filter' => [
                        Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
                    ],
                ]
			]),
			'id' => new Field\Primary('Id'),
            'name' => new Field\Name('Name'),
			'privilege' => new Field\Join('acl_privilege_id', 'Privileges', 'ExtjsCms\Model\Acl\Privilege', ['ExtjsCms\Model\Acl\RolePrivilege', 'ExtjsCms\Model\Acl\Privilege'])
        ]);
    }
}
