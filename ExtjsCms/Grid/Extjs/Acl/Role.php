<?php
/**
 * @namespace
 */
namespace ExtjsCms\Grid\Extjs\Acl;

use ExtjsCms\Grid\Base,
    Engine\Crud\Grid\Column,
    Engine\Crud\Grid\Filter\Extjs as Filter,
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
			'id'        => new Column\Primary('Id'),
			'name'      => new Column\Name('Name'),
            //'accesslist'=> new Column\JoinMany('Role access list', '\ExtjsCms\Model\Acl\Accesslist', null, null, ', ', 5),
			//'inherit'   => new Column\JoinMany('Role inherit', '\ExtjsCms\Model\Acl\RoleInherit', null, null, ', ', 5),
            'description'      => new Column\Text('Desc', 'description')
		];
		//$this->_columns['inherit']->setAction('acl-role-inherit', 'role');
        //$this->_columns['accesslist']->setAction('acl-access-list', 'role');
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
                Criteria::COLUMN_ID     => Criteria::CRITERIA_EQ,
                Criteria::COLUMN_NAME   => Criteria::CRITERIA_BEGINS
			]),
			'id'        => new Field\Primary('Id'),
            'name'      => new Field\Name('Name')
        ]);
    }
}
