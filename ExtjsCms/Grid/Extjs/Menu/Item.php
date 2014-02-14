<?php
/**
 * @namespace
 */
namespace ExtjsCms\Grid\Extjs\Menu;

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
			'id'         => new Column\Primary('Id'),
            'menu'       => new Column\JoinOne('Menu', '\ExtjsCms\Model\Menu\Menus'),
            'image'      => new Column\Image("Icon"),
            'title'      => new Column\Name('Title'),
			'module'     => new Column\JoinOne('Module', ['\ExtjsCms\Model\Mvc\Controller', '\ExtjsCms\Model\Mvc\Module']),
			'controller' => new Column\JoinOne('Controller', '\ExtjsCms\Model\Mvc\Controller'),
            'parent'     => new Column\JoinOne('Parent', '\ExtjsCms\Model\Menu\Item'),
            //'childs'    => new Column\JoinMany('Childs', '\ExtjsCms\Model\Menu\Item', null, null, ', ', 5),
            'alias'      => new Column\Text('Alias'),
            'position'   => new Column\Numeric('Position'),
			'status'     => new Column\Collection("Status", 'status', ['active' => 'Active', 'not_active' => 'Not active']),
            'description'=> new Column\Text('Desc', 'description')
		];
		//$this->_columns['parent']->setAction('menu-item', 'parent');
    }

    /**
     * Initialize grid filters
     *
     * @return void
     */
    protected function _initFilters()
    {
        $this->_filter = new Filter([
			'search'    => new Field\Search('Search', 'search', [
				[
    				'path' => null,
    				'filters' => [
						Criteria::COLUMN_ID => Criteria::CRITERIA_EQ,
                        Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
					]
				],
				[
					'path' => ['\ExtjsCms\Model\Menu\Menus'],
					'filters' => [
						Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
					]
                ],
                [
                    'path' => ['\ExtjsCms\Model\Menu\Item'],
                    'filters' => [
                        Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS
                    ]
                ]
		    ]),
			'id'         => new Field\Primary('Id'),
            'controller' => new Field\Join('Controller', '\ExtjsCms\Model\Mvc\Controller'),
       		'menu'       => new Field\Join('Menu', '\ExtjsCms\Model\Menu\Menus'),
			'parent'     => new Field\Join('Parent', '\ExtjsCms\Model\Menu\Item'),
            'status'     => new Field\ArrayToSelect('Status', 'status', ['active' => 'Active', 'not_active' => 'Not active'])
        ]);
    }

    /**
     * Return menu options
     *
     * @return array
     */
    public function getMenuOptions()
    {
        $this->_limitParamValue = 100;
        $rows = $this->getColumnData();
        $options = [];
        foreach ($rows as $row) {
            $option = [];
            $option['title'] = $row['title'];
            $option['controller'] = ($row['module'] && $row['controller']) ?
                \Phalcon\Text::camelize($row['module']).".controller.".\Phalcon\Text::camelize($row['controller'])
                : '';
            $options[] = $option;
        }

        return $options;
    }
}
