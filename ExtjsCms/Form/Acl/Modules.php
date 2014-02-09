<?php
/**
 * @namespace
 */
namespace ExtjsCms\Form\Acl;

use ExtjsCms\Form\Base,
    Engine\Crud\Form\Field;

/**
 * Class Module
 *
 * @category    Module
 * @package     Acl
 * @subpackage  Form
 */
class Module extends Base
{
    /**
     * Extjs form key
     * @var string
     */
    protected $_key = 'acl-module';

    /**
     * Form title
     * @var string
     */
    protected $_title = 'Module';

    /**
     * Container model
     * @var string
     */
    protected $_containerModel = '\ExtjsCms\Model\Acl\Module';

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
			'name' => new Field\Name("Name"),
			'resources' => new Field\JoinMany('Resources', 'ExtjsCms\Model\Acl\Resource', null, null, ', ', 5, '100')
		];

		$this->_fields['resource']->setAction ('acl-resource', 'acl_module');
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
                Criteria::COLUMN_ID => Criteria::CRITERIA_EQ,
                Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
            ]),
			'id' => new Field\Primary('Id'),
            'name' => new Field\Name('Name')
		]);
	}
}
