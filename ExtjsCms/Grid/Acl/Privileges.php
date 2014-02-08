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
class Privilege extends Base
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
    protected $_containerModel = '\ExtjsCms\Model\Acl\Privilege';

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
			'acl_resource_id' => new Column\JoinOne('Ресурс', 'ExtjsCms\Model\Acl\Resource'),
			'module' => new Column\JoinOne('Module', ['ExtjsCms\Model\Acl\Resource', 'ExtjsCms\Model\Acl\Module']),
			'role' => new Column\JoinMany('Roles', ['ExtjsCms\Model\Acl\RolePrivilege', 'ExtjsCms\Model\Acl\Role'], null, null, ', ', 5, '100')
		];
		$this->_columns['role']->setAction ('acl-role', 'privilege');
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
                    'path' => 'ExtjsCms\Model\Acl\Resource',
                    'filter' => [
                        Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
                    ],
                ],
                [
                    'path' => ['ExtjsCms\Model\Acl\RolePrivilege', 'ExtjsCms\Model\Acl\Role'],
                    'filter' => [
                        Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
                    ],
                ],
                [
                    'path' => ['ExtjsCms\Model\Acl\Resource', 'ExtjsCms\Model\Acl\Module'],
                    'filter' => [
                        Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
                    ],
                ]
			]),
			'id' => new Field\Primary('Id'),
            'name' => new Field\Name('Name'),
            'acl_resource' => new Field\Join('acl_resource_id', 'Ресурс', 'ExtjsCms\Model\Acl\Resource'),
			'role' => new Field\Join('acl_role_id', 'Роли', 'ExtjsCms\Model\Acl\Role', ['ExtjsCms\Model\Acl\RolePrivilege', 'ExtjsCms\Model\Acl\Role']),
			'parent' => new Field\Join('acl_resource_id', 'Ресурс', 'ExtjsCms\Model\Acl\Resource')
        ]);
    }
}
