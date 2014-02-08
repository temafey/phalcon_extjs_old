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
        $options = [
                [
                    'title' => 'Events',
                    'controller' => 'Event.controller.Event'
                ],
                [
                    'title' => 'Members',
                    'controller' => 'Event.controller.Member'
                ],
                [
                    'title' => 'Campaign',
                    'controller' => 'Event.controller.Campaign'
                ],
                [
                    'title' => 'Category',
                    'controller' => 'Event.controller.Category'
                ],
                [
                    'title' => 'Locations',
                    'controller' => 'Event.controller.Location'
                ],
                [
                    'title' => 'Tags',
                    'controller' => 'Event.controller.Tag'
                ],
                [
                    'title' => 'Venues',
                    'controller' => 'Event.controller.Venue'
                ],
                [    'title' => 'Event categories',
                    'controller' => 'Event.controller.EventCategory'
                ],
                [
                    'title' => 'Event site',
                    'controller' => 'Event.controller.EventSite'
                ],
                [
                    'title' => 'Event members',
                    'controller' => 'Event.controller.EventMember'
                ],
                [
                    'title' => 'Event tags',
                    'controller' => 'Event.controller.EventTag'
                ],
                [
                    'title' => 'Campaign contacts',
                    'controller' => 'Event.controller.CampaignContact'
                ],
                [
                    'title' => 'Member networks',
                    'controller' => 'Event.controller.MemberNetwork'
                ],
                [
                    'title' => 'Member filters',
                    'controller' => 'Event.controller.MemberFilter'
                ]
            ];

        return $options;
    }

}

