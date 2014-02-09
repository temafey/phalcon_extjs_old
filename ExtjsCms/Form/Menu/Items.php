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
 * @category   Module
 * @package
 * @subpackage Form
 */
class Items extends Base
{
    /**
     * Extjs form key
     * @var string
     */
    protected $_key = '';

    /**
     * Form title
     * @var string
     */
    protected $_title = '';

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
     * Initialize form fields
     *
     * @return void
     */
    protected function _initFields()
    {
		$this->_fields = [
			'id' => new Field\Primary('Id'),
			'menu_id' => new Field\JoinOne('Menu', '\ExtjsCms\Model\Menu\Menus'),
			'label' => new Field\Name('Name'),
			'image' => new Field\Image("Icon"),
            'parent' => new Field\JoinOne('Parent', '\ExtjsCms\Model\Minu\Item'),
			'childs' => new Field\JoinMany('Childs', 'Db_Site_MenuItemsParent', null, null, ', ', 5),
			'module' => new Field\JoinOne('Module', '\ExtjsCms\Model\Mvc\Module'),
			'controller' => new Field\JoinOne('Controller', '\ExtjsCms\Model\Mvc\Controller'),
			'action' => new Field\JoinOne('Action', '\ExtjsCms\Model\Mvc\Action'),
			'param' => new Field\Text('Param')
		];
		$this->_fields['parent_id']->setAction ('site-menuitem', 'menuparent');
		//$this->_fields['parent_id']->setAction ('navigation_item', 'parent');
		if(!isset($this->_params['menuparent'])) {
		    if(!isset($this->_params['search'])) {
			    $this->_params['menuparent'] = 0;
		    }
		}
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
