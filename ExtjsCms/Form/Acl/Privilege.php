<?php
/**
 * @namespace
 */
namespace ExtjsCms\Form\Acl;

use ExtjsCms\Form\Base,
    Engine\Crud\Form\Field;

/**
 * Class Privilege
 *
 * @category    Module
 * @package     Acl
 * @subpackage  Form
 */
class Privilege extends Base
{
    /**
     * Extjs form key
     * @var string
     */
    protected $_key = 'acl-privilege';

    /**
     * Form title
     * @var string
     */
    protected $_title = 'Privilege';

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
     * Initialize form fields
     *
     * @return void
     */
    protected function _initFields()
    {
		$this->_fields = [
			'id' => new Field\Primary('Id'),
			'name' => new Field\Name('Name'),
			'acl_resource_id' => new Field\JoinOne('Ресурс', 'ExtjsCms\Model\Acl\Resource'),
			'module' => new Field\JoinOne('Module', ['ExtjsCms\Model\Acl\Resource', 'ExtjsCms\Model\Acl\Module']),
			'role' => new Field\JoinMany('Roles', ['ExtjsCms\Model\Acl\RolePrivilege', 'ExtjsCms\Model\Acl\Role'], null, null, ', ', 5, '100')
		];
		$this->_fields['role']->setAction ('acl-role', 'privilege');
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
