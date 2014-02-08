<?php
/**
 * @namespace
 */
namespace ExtjsCms\Controller;

use Phalcon\Mvc\View;

/**
 * @RoutePrefix("/admin/extjs", name="home")
 */
class InstallController extends Base
{
    public function initialize()
    {
    }

    /**
     * @Route("/apps/{crudModule:[A-Za-z]+}/controller/{crudGrid:[A-Za-z]+}.js", methods={"GET"}, name="crud-grid")
     */
    public function controllerAction($module, $grid)
    {
        $this->_grid($module, $grid);
        echo file_get_contents(PUBLIC_PATH."/extjs/apps/".ucfirst($module)."/controller/".ucfirst($grid).".js");
    }

    /**
     * @Route("/apps/{crudModule:[A-Za-z]+}/model/{crudGrid:[A-Za-z]+}.js", methods={"GET"}, name="crud-grid")
     */
    public function modelAction($module, $grid)
    {
        $this->_grid($module, $grid);
        echo file_get_contents(PUBLIC_PATH."/extjs/apps/".ucfirst($module)."/model/".ucfirst($grid).".js");
    }

    /**
     * @Route("/apps/{crudModule:[A-Za-z]+}/store/{crudGrid:[A-Za-z]+}.js", methods={"GET"}, name="crud-grid")
     */
    public function storeAction($module, $grid)
    {
        $this->_grid($module, $grid);
        echo file_get_contents(PUBLIC_PATH."/extjs/apps/".ucfirst($module)."/store/".ucfirst($grid).".js");
    }

    /**
     * @Route("/apps/{crudModule:[A-Za-z]+}/store/{crudGrid:[A-Za-z]+}Local.js", methods={"GET"}, name="crud-grid")
     */
    public function storeLocalAction($module, $grid)
    {
        $this->_grid($module, $grid);
        echo file_get_contents(PUBLIC_PATH."/extjs/apps/".ucfirst($module)."/store/".ucfirst($grid)."Local.js");
    }

    /**
     * @Route("/apps/{crudModule:[A-Za-z]+}/view/{crudGrid:[A-Za-z]+}/Grid.js", methods={"GET"}, name="crud-grid")
     */
    public function gridAction($module, $grid)
    {
        $this->_grid($module, $grid);
        echo file_get_contents(PUBLIC_PATH."/extjs/apps/".ucfirst($module)."/view/".$grid."/Grid.js");
    }

    /**
     * @Route("/apps/{crudModule:[A-Za-z]+}/view/{crudGrid:[A-Za-z]+}/Win.js", methods={"GET"}, name="crud-grid")
     */
    public function winAction($module, $grid)
    {
        $this->_grid($module, $grid);
        echo file_get_contents(PUBLIC_PATH."/extjs/apps/".ucfirst($module)."/view/".$grid."/Win.js");
    }

    /**
     * @Route("/apps/{crudModule:[A-Za-z]+}/view/{crudForm:[A-Za-z]+}/Form.js", methods={"GET"}, name="crud-form")
     */
    public function formAction($module, $form)
    {
        $this->_form($module, $form);
        echo file_get_contents(PUBLIC_PATH."/extjs/apps/".ucfirst($module)."/view/".$form."/Form.js");
    }

    /**
     * Render javascript models
     *
     * @param string $module
     * @param string $grid
     */
    protected function _grid($module, $grid)
    {
        $params = $this->request->getQuery();
        $params2 =$this->dispatcher->getParams();
        $gridName = $this->_getGrid($module, $grid);
        $grid = new $gridName($params);
        $grid->render();

        $this->view->setRenderLevel(View::LEVEL_NO_RENDER);
    }

    /**
     * Render javascript models
     *
     * @param string $module
     * @param string $form
     */
    protected function _form($module, $form)
    {
        $params = $this->request->getRawBody();
        $formName = $this->_getForm($module, $form);

        $form = new $formName();
        $form->render();

        $this->view->setRenderLevel(View::LEVEL_NO_RENDER);
    }
}

