<?php
/**
 * @namespace
 */
namespace ExtjsCms\Controller;

use Phalcon\Mvc\View;

/**
 * @RoutePrefix("/admin", name="home")
 */
class IndexController extends Base
{
    public function initialize()
    {
    }

    public function indexAction()
    {
        $params = $this->request->getQuery();
        $params2 =$this->dispatcher->getParams();
        $this->view->setRenderLevel(View::LEVEL_NO_RENDER);
    }
}

