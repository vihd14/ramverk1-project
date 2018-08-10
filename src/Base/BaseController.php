<?php

namespace Vihd14\Base;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;

// use \Vihd14\Comment\Comment;
// use \Vihd14\Reply\Reply;
// use \Vihd14\User\User;

/**
 * A controller class for index page.
 */
class BaseController implements
    ConfigureInterface,
    InjectionAwareInterface
{
    use ConfigureTrait,
        InjectionAwareTrait;



    /**
     * Show all replies.
     *
     * @return void
     */
    public function showIndex()
    {
        $title = "H&G - Home";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $db = $this->di->get("db");

        //Get 5 latest comments from database
        $latestComments = $db->connect()
                             ->select()
                             ->from("Comments")
                             ->orderBy("id desc")
                             ->limit(5)
                             ->execute()
                             ->fetchAll();

        //Get all tags
        $sqltags = "SELECT tags FROM Comments";

        $popularTags = $db->connect()
                          ->execute($sqltags)
                          ->fetchAll();

        //Get 3 most active users
        $sqluserscom = "SELECT email FROM Comments";
        $sqlusersrep = "SELECT email FROM Replies";

        $emailCom = $db->connect()
                       ->execute($sqluserscom)
                       ->fetchAll();

        $emailRep = $db->connect()
                        ->execute($sqlusersrep)
                        ->fetchAll();
                        
        $activeUsers = array_merge($emailCom, $emailRep);

        $data = [
            "latestComments" => $latestComments,
            "popularTags" => $popularTags,
            "activeUsers" => $activeUsers,
        ];

        $view->add("index/index", $data);

        $pageRender->renderPage(["title" => $title]);
    }
}
