<?php

namespace Vihd14\Reply\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Vihd14\Reply\Reply;
use \Vihd14\Comment\Comment;

/**
 * Form to create an item.
 */
class CreateReplyForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di)
    {
        parent::__construct($di);
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $commentId = array_slice(explode('/', rtrim($url, '/')), -1)[0];
        $this->form->create(
            [
                "id" => __CLASS__,
                // "legend" => "Details of the item",
            ],
            [
                "commentId" => [
                    "type" => "number",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "label" => "Comment id:",
                    "value" => $commentId,
                ],
                "title" => [
                    "type" => "text",
                    "label" => "Title:",
                    "validation" => ["not_empty"],
                ],
                "email" => [
                    "type" => "text",
                    "label" => "E-mail:",
                    "validation" => ["not_empty"],
                ],
                "reply" => [
                    "type" => "textarea",
                    "label" => "Reply:",
                    "class" => "comment-section",
                    "validation" => ["not_empty"],
                ],
                "submit" => [
                    "type" => "submit",
                    "value" => "Publish",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
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
        $reply->commentId = $this->form->value("commentId");
        $reply->title = $this->form->value("title");
        $reply->email = $this->form->value("email");
        $reply->reply = $this->form->value("reply");
        $reply->save();
        $this->di->get("response")->redirect("comments");
    }
}
