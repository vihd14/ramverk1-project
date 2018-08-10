<?php

namespace Vihd14\Reply\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Vihd14\Reply\Reply;

/**
 * Form to update an item.
 */
class UpdateReplyForm extends FormModel
{
    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Anax\DI\DIInterface $di a service container
     * @param integer             $id to update
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
                // "legend" => "Update details of the item",
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
                    "validation" => ["not_empty"],
                    "value" => $reply->title,
                ],
                "email" => [
                    "type" => "text",
                    "label" => "E-mail:",
                    "validation" => ["not_empty"],
                    "value" => $reply->email,
                ],
                "reply" => [
                    "type" => "textarea",
                    "label" => "Reply:",
                    "validation" => ["not_empty"],
                    "value" => $reply->reply,
                ],
                "submit" => [
                    "type" => "submit",
                    "value" => "Save",
                    "callback" => [$this, "callbackSubmit"]
                ],
                "reset" => [
                    "type"  => "reset",
                    "value" => "Reset",
                    "class" => "button-link"
                ],
            ]
        );
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
        $reply->commentId = $this->form->value("commentId");
        $reply->title = $this->form->value("title");
        $reply->email = $this->form->value("email");
        $reply->reply = $this->form->value("reply");
        $reply->save();
        $this->di->get("response")->redirect("comments/comment-view/{$reply->commentId}");
    }
}
