<?php
/**
 * @namespace
 */
namespace ExtjsCms\Grid\Menu;

use ExtjsCms\Grid\Base,
    Engine\Crud\Grid\Column,
    Engine\Crud\Grid\Filter,
    Engine\Crud\Grid\Filter\Field,
    Engine\Filter\SearchFilterInterface as Criteria;

/**
 * Class Item
 *
 * @category    Module
 * @package     Menu
 * @subpackage  Grid
 */
class Item extends Base
{
    /**
     * Extjs grid key
     * @var string
     */
    protected $_key = 'menu-item';

    /**
     * Grid title
     * @var string
     */
    protected $_title = 'Menu items';

    /**
     * Container model
     * @var string
     */
    protected $_containerModel = '\ExtjsCms\Model\Menu\Item';

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
			'menu_id' => new Column\JoinOne('Menu', '\ExtjsCms\Model\Menu\Menus'),
			'label' => new Column\Name('Name'),
			'image' => new Column\Image("Icon"),
            'parent' => new Column\JoinOne('Parent', '\ExtjsCms\Model\Minu\Item'),
			'childs' => new Column\JoinMany('Childs', 'Db_Site_MenuItemsParent', null, null, ', ', 5),
			'module' => new Column\JoinOne('Module', '\ExtjsCms\Model\Mvc\Module'),
			'controller' => new Column\JoinOne('Controller', '\ExtjsCms\Model\Mvc\Controller'),
			'action' => new Column\JoinOne('Action', '\ExtjsCms\Model\Mvc\Action'),
			'param' => new Column\Text('Param')
		];
		$this->_columns['parent_id']->setAction ('site-menuitem', 'menuparent');
		//$this->_columns['parent_id']->setAction ('navigation_item', 'parent');
		if(!isset($this->_params['menuparent'])) {
		    if(!isset($this->_params['search'])) {
			    $this->_params['menuparent'] = 0;
		    }
		}
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
                        Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
					]
				],
				[
					'path' => ['\ExtjsCms\Model\Menu\Menus'],
					'filter' => [
						Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
					]
                ],
                [
                    'path' => ['\ExtjsCms\Model\Menu\Item'],
                    'filter' => [
                        Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
                    ]
                ]
		    ]),
			'id' => new Field\Primary('Id'),
       		'menu' => new Field\Join('menu_id', 'Меню', 'Db_Site_Menu'),
			'menuparent' => new Field\Standart('parent_id', 'Родитель', Criteria::CRITERIA_EQ),
			//'menuparent' => new Field\Join('parent_id', 'Родитель', 'Db_Site_MenuItemsParent')
        ]);
    }
}
