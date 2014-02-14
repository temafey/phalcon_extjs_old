<?php
/**
 * @namespace
 */
namespace ExtjsCms\Controller;

use Phalcon\Mvc\View;

/**
 * @RoutePrefix("/admin", name="admin")
 */
class AdminController extends Base
{
    public function initialize()
    {
    }

    /**
     * @Route("/menu/options", methods={"GET"}, name="menu-options")
     */
    public function optionsAction()
    {
        $result = $this->_getMenuOptions();
        echo json_encode($result);

        $this->view->setRenderLevel(View::LEVEL_NO_RENDER);
    }

    protected function _getMenuOptions()
    {
        $grid = new \ExtjsCms\Grid\Extjs\Menu\Item(['menu' => '1', 'status' => 'active']);
        $options = $grid->getMenuOptions();

        return $options;
    }

}

