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
class AccessList extends \Engine\Mvc\Model
{
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
    public $resource_id;
     
    /**
     *
     * @var string
     */
    public $access_id;
     
    /**
     *
     * @var integer
     */
    public $allowed;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo("member_id", "\ExtjsCms\Model\Member", "id", ['alias' => 'Member']);
        $this->belongsTo("resource_id", "\ExtjsCms\Model\Acl\Resource", "id", ['alias' => 'Resource']);
        $this->belongsTo("access_id", "\ExtjsCms\Model\Acl\Access", "id", ['alias' => 'Access']);
    }

    /**
     * Return table name
     * @return string
     */
    public function getSource()
    {
        return "core_acl_access_list";
    }
     
}
