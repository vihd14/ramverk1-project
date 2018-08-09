<?php

namespace Anax\User;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Anax\User\HTMLForm\UserLoginForm;
use \Anax\User\HTMLForm\CreateUserForm;
use \Anax\User\HTMLForm\UpdateUserForm;
use \Anax\User\HTMLForm\DeleteUserForm;

use \Vihd14\Comment\Comment;
use \Vihd14\Reply\Reply;

/**
 * A controller class.
 */
class UserController implements
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
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getIndex()
    {
        $title      = "H&G - Profil";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $user = new User();
        $user->setDb($this->di->get("db"));

        $data = [
            "items" => $user->findAll(),
        ];

        $view->add("user/profile", $data);

        $pageRender->renderPage(["title" => $title]);
    }


    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getAllUsers()
    {
        $title      = "H&G - Users";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $user = new User();
        $user->setDb($this->di->get("db"));

        $data = [
            "items" => $user->findAll(),
        ];

        $view->add("user/users", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getUserOverview()
    {
        $title      = "H&G - User overview";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $user = new User();
        $user->setDb($this->di->get("db"));
        $comment = new Comment();
        $comment->setDb($this->di->get("db"));
        $reply = new Reply();
        $reply->setDb($this->di->get("db"));


        $data = [
            "users" => $user->findAll(),
            "items" => $comment->findAll(),
            "replies" => $reply->findAll()
        ];

        $view->add("user/user-overview", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getLogout()
    {
        $title      = "H&G - Logged out";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $user = new User();
        $user->setDb($this->di->get("db"));

        $data = [
            "items" => $user->findAll(),
        ];

        $view->add("user/logout", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getPostLogin()
    {
        $title      = "H&G - Sign in";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new UserLoginForm($this->di);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
        ];

        $view->add("user/login", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getPostCreateUser()
    {
        $title      = "H&G - Create user";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new CreateUserForm($this->di);

        $form->check();

        $data = [
            "content" => $form->getHTML(),
        ];

        $view->add("default2/article", $data);

        $pageRender->renderPage(["title" => $title]);
    }


    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getPostUpdate($acronym)
    {
        $title      = "H&G - Update profile";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new UpdateUserForm($this->di, $acronym);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
        ];

        $view->add("user/update", $data);

        $pageRender->renderPage(["title" => $title]);
    }


    /**
     * Handler with form to delete an item.
     *
     * @return void
     */
    public function getPostDeleteItem($acronym)
    {
        $title      = "H&G - Delete user";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new DeleteUserForm($this->di, $acronym);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
        ];

        $view->add("user/delete", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getPostDeleted()
    {
        $title      = "Deleted account - Viza's page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $user = new User();
        $user->setDb($this->di->get("db"));

        $data = [
            "items" => $user->findAll(),
        ];

        $view->add("user/deleted", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getAdminPage()
    {
        $title      = "H&G - Admin page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $user = new User();
        $user->setDb($this->di->get("db"));

        $data = [
            "items" => $user->findAll(),
        ];

        $view->add("user/admin", $data);

        $pageRender->renderPage(["title" => $title]);
    }
}
