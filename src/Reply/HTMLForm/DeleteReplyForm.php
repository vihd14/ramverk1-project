<?php

namespace Vihd14\Reply\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Vihd14\Reply\Reply;

/**
 * Form to delete an item.
 */
class DeleteReplyForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di, $id)
    {
        parent::__construct($di);
        $reply = $this->getItemDetails($id);
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $commentId = array_slice(explode('/', rtrim($url, '/')), -1)[0];
        $this->form->create(
            [
                "id" => __CLASS__,
                // "legend" => "Delete an item",
            ],
            [
                "id" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $reply->id,
                ],
                "commentId" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "label" => "Comment id:",
                    "value" => $commentId,
                ],
                "title" => [
                    "type" => "text",
                    "label" => "Title:",
                    "readonly" => true,
                    "value" => $reply->title,
                ],
                "email" => [
                    "type" => "text",
                    "label" => "E-mail:",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $reply->email,
                ],
                "reply" => [
                    "type" => "textarea",
                    "label" => "Comment:",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $reply->reply,
                ],
                "submit" => [
                    "type" => "submit",
                    "options" => $this->getItem($id),
                    "class" => "delete",
                    "value" => "Delete",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Get all items as array suitable for display in select option dropdown.
     *
     * @return array with key value of all items.
     */
    protected function getItem($id)
    {
        $reply = new Reply();
        $reply->setDb($this->di->get("db"));
        $replies = ["-1" => "Choose an object"];
        $obj = $reply->find("id", $id);
        $replies[$obj->id] = "{$obj->email} ({$obj->id})";

        return $replies;
    }




    /**
     * Get details on item to load form with.
     *
     * @param integer $id get details on item with id.
     *
     * @return Reply
     */
    public function getItemDetails($id)
    {
        $reply = new Reply();
        $reply->setDb($this->di->get("db"));
        $reply->find("id", $id);
        return $reply;
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        $reply = new Reply();
        $reply->setDb($this->di->get("db"));
        $reply->find("id", $this->form->value("id"));
        $reply->delete();
        $this->di->get("response")->redirect("comments");
    }
}
