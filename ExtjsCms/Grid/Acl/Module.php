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
 * Class Module
 *
 * @category    Module
 * @package     Acl
 * @subpackage  Grid
 */
class Module extends Base
{
    /**
     * Extjs grid key
     * @var string
     */
    protected $_key = 'acl-module';

    /**
     * Grid title
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
     * Initialize grid columns
     *
     * @return void
     */
    protected function _initColumns()
    {
		$this->_columns = [
			'id' => new Column\Primary('Id'),
			'name' => new Column\Name("Name"),
			'resources' => new Column\JoinMany('Resources', 'ExtjsCms\Model\Acl\Resource', null, null, ', ', 5, '100')
		];

		$this->_columns['resource']->setAction ('acl-resource', 'aclmodule');
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
                Criteria::COLUMN_ID => Criteria::CRITERIA_EQ,
                Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
            ]),
			'id' => new Field\Primary('Id'),
            'name' => new Field\Name('Name')
		]);
	}
}
