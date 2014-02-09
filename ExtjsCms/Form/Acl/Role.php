<?php
/**
 * @namespace
 */
namespace ExtjsCms\Form\Acl;

use ExtjsCms\Form\Base,
    Engine\Crud\Form\Field;

/**
 * Class Role
 *
 * @category    Module
 * @package     Acl
 * @subpackage  Form
 */
class Role extends Base
{
    /**
     * Extjs form key
     * @var string
     */
    protected $_key = 'acl-role';

    /**
     * Form title
     * @var string
     */
    protected $_title = 'Role';

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
     * Initialize form fields
     *
     * @return void
     */
    protected function _initFields()
    {
		$this->_fields = [
			'id' => new Field\Primary('Id'),
			'name' => new Field\Name('Name'),
			'privilege' => new Field\JoinMany('Privileges', ['ExtjsCms\Model\Acl\RolePrivilege', 'ExtjsCms\Model\Acl\Privilege'], null, null, ', ', 5, '100')
		];
		$this->_fields['privilege']->setAction ('acl-privilege', 'role');
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
