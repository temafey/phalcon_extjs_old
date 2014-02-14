<?php
/**
 * @namespace
 */
namespace ExtjsCms\Form\Extjs\Acl;

use ExtjsCms\Form\Base,
    Engine\Crud\Form\Field;

/**
 * Class Privilege
 *
 * @category    Module
 * @package     Acl
 * @subpackage  Form
 */
class AccessList extends Base
{
    /**
     * Extjs form key
     * @var string
     */
    protected $_key = 'acl-access-list';

    /**
     * Form title
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
     * Initialize form fields
     *
     * @return void
     */
    protected function _initFields()
    {
		$this->_fields = [
			'id'        => new Field\Primary('Id'),
			'name'      => new Field\Name('Name'),
            'role'      => new Field\ManyToOne('Role', '\ExtjsCms\Model\Acl\Role'),
			'resource'  => new Field\ManyToOne('Resource', '\ExtjsCms\Model\Acl\Resource'),
			'access'    => new Field\ManyToOne('Access', '\ExtjsCms\Model\Acl\Access'),
            'allowed'   => new Field\ArrayToSelect('Status', null, ['0' => 'not active', '1' => 'active'])
		];
    }
}
