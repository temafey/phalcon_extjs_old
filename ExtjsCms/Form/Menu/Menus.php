<?php
/**
 * @namespace
 */
namespace ExtjsCms\Form\Menu;

use ExtjsCms\Form\Base,
    Engine\Crud\Form\Field;

/**
 * Class
 *
 * @category    Module
 * @package     Menu
 * @subpackage  Form
 */
class Menus extends Base
{
    /**
     * Extjs form key
     * @var string
     */
    protected $_key = 'menu-menus';

    /**
     * Form title
     * @var string
     */
    protected $_title = 'Menus';

    /**
     * Container model
     * @var string
     */
    protected $_containerModel = '\ExtjsCms\Model\Menu\Menus';

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
			'key' => new Field\Name('Name'),
			'items' => new Field\JoinMany('Items', '\ExtjsCms\Model\Menu\Item', null, null, ', ', 5, '150')
		];
		$this->_fields['items']->setAction('site-menuitem', 'menu');
    }

    /**
     * Initialize form filters
     *
     * @return void
     */
    protected function _initFilters()
    {
        $this->_filter = new Filter([
    		'search' => new Field\Search('Search', 'search',
    			[
    				Criteria::COLUMN_ID => Criteria::CRITERIA_EQ,
    				Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
    				//'price_description' => Criteria::CRITERIA_BEGINS
    			]
		    ),
			'id' => new Field\Primary('Id')
        ]);
    }
}
