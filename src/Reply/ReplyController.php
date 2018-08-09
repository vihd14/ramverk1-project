<?php

namespace Vihd14\Reply;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Vihd14\Reply\HTMLForm\CreateReplyForm;
use \Vihd14\Reply\HTMLForm\DeleteReplyForm;
use \Vihd14\Reply\HTMLForm\UpdateReplyForm;

/**
 * A controller class.
 */
class ReplyController implements
    ConfigureInterface,
    InjectionAwareInterface
{
    use ConfigureTrait,
        InjectionAwareTrait;

    /**
     * @var $data description
     */
    //private $data;



    /**
     * Show all items.
     *
     * @return void
     */
    public function getAllReplies()
    {
        $title = "H&G - Replies";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $reply = new Reply();
        $reply->setDb($this->di->get("db"));

        $data = [
            "items" => $reply->findAll(),
        ];

        $view->add("reply/replies", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Handler with form to create a reply to an existing reply.
     *
     * @return void
     */
    public function getPostCreateItemReply()
    {
        $title      = "H&G - Reply";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new CreateReplyForm($this->di);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
        ];

        $view->add("reply/reply", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Handler with form to delete an item.
     *
     * @return void
     */
    public function getPostDeleteItem($id)
    {
        $title      = "H&G - Remove";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new DeleteReplyForm($this->di, $id);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
        ];

        $view->add("reply/delete", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Handler with form to update an item.
     *
     * @return void
     */
    public function getPostUpdateItem($id)
    {
        $title      = "H&G - Edit";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new UpdateReplyForm($this->di, $id);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
        ];

        $view->add("reply/update", $data);

        $pageRender->renderPage(["title" => $title]);
    }
}
