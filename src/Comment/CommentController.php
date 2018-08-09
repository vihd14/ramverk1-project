<?php

namespace Vihd14\Comment;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Vihd14\Comment\HTMLForm\CreateForm;
use \Vihd14\Comment\HTMLForm\CreateReplyForm;
use \Vihd14\Comment\HTMLForm\EditForm;
use \Vihd14\Comment\HTMLForm\DeleteForm;
use \Vihd14\Comment\HTMLForm\UpdateForm;
use \Vihd14\Reply\Reply;

/**
 * A controller class.
 */
class CommentController implements
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
    public function getComments()
    {
        $title      = "H&G - Comments";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $comment = new Comment();
        $comment->setDb($this->di->get("db"));

        $data = [
            "items" => $comment->findAll(),
        ];

        $view->add("comments/comments", $data);

        $pageRender->renderPage(["title" => $title]);
    }


    /**
     * Show comment view with replys.
     *
     * @return void
     */
    public function getCommentView()
    {
        $title      = "H&G - Comment view";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $comment = new Comment();
        $comment->setDb($this->di->get("db"));
        $reply = new Reply();
        $reply->setDb($this->di->get("db"));

        $data = [
            "items" => $comment->findAll(),
            "replies" => $reply->findAll(),
        ];

        $view->add("comments/comment-view", $data);

        $pageRender->renderPage(["title" => $title]);
    }


    /**
     * Show all tags.
     *
     * @return void
     */
    public function getTagIndex()
    {
        $title = "H&G - Tags";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $comment = new Comment();
        $comment->setDb($this->di->get("db"));
        $reply = new Reply();
        $reply->setDb($this->di->get("db"));

        $data = [
            "items" => $comment->findAll("tags"),
            "replies" => $reply->findAll("tags"),
        ];

        $view->add("comments/tags", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Show all comments with the same tag.
     *
     * @return void
     */
    public function getCommentsFromTag()
    {
        $title = "H&G - Comments from tag";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $comment = new Comment();
        $comment->setDb($this->di->get("db"));
        $reply = new Reply();
        $reply->setDb($this->di->get("db"));

        $data = [
            "items" => $comment->findAll("tags"),
            "replies" => $reply->findAll("tags"),
        ];

        $view->add("comments/tag", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Handler with form to create a new item.
     *
     * @return void
     */
    public function getPostCreateItem()
    {
        $title      = "H&G - Create";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new CreateForm($this->di);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
        ];

        $view->add("comments/create", $data);

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
        $form       = new DeleteForm($this->di, $id);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
        ];

        $view->add("comments/delete", $data);

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
        $form       = new UpdateForm($this->di, $id);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
        ];

        $view->add("comments/update", $data);

        $pageRender->renderPage(["title" => $title]);
    }
}
