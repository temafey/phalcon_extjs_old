<?php
/**
 * @namespace
 */
namespace ExtjsCms\Model\Acl;

/**
 * Class event.
 *
 * @category   Module
 * @package    Event
 * @subpackage Model
 */
class RoleInherit extends \Engine\Mvc\Model
{
    /**
     * Default name column
     * @var string
     */
    protected $_nameExpr = 'role_inherit';

    /**
     * Default order name
     * @var string
     */
    protected $_orderExpr = 'role_id';

    /**
     * Order is asc order direction
     * @var bool
     */
    protected $_orderAsc = true;

    /**
     *
     * @var integer
     */
    public $id;
     
    /**
     *
     * @var string
     */
    public $role_id;
     
    /**
     *
     * @var string
     */
    public $role_inherit;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo("role_id", "\ExtjsCms\Model\Acl\Role", "id", ['alias' => 'Role']);
    }

    /**
     * Return table name
     * @return string
     */
    public function getSource()
    {
        return "core_acl_role_inherit";
    }
     
}
