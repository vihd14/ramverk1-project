<?php

namespace Vihd14\Comment\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Vihd14\Comment\Comment;

use \Anax\Session\Session;

/**
 * Form to create an item.
 */
class CreateForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di)
    {
        parent::__construct($di);
        $session = new Session();
        $userEmail = $session->get("email");
        $this->form->create(
            [
                "id" => __CLASS__,
                // "legend" => "Details of the item",
            ],
            [
                "title" => [
                    "type" => "text",
                    "label" => "Title:",
                    "validation" => ["not_empty"],
                ],
                "email" => [
                    "type" => "text",
                    "label" => "E-mail:",
                    "readonly" => true,
                    "validation" => ["not_empty"],
                    "value" => $userEmail,
                ],
                "text" => [
                    "type" => "textarea",
                    "label" => "Comment:",
                    "class" => "comment-section",
                    "validation" => ["not_empty"],
                ],
                "tags" => [
                    "type" => "textarea",
                    "class" => "tag-section",
                    "placeholder" => "flowers, wallpaper, gardening",
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
        $comment = new Comment();
        $comment->setDb($this->di->get("db"));
        $comment->title = $this->form->value("title");
        $comment->email = $this->form->value("email");
        $comment->text = $this->form->value("text");
        $comment->tags = $this->form->value("tags");
        $comment->save();

        $this->di->get("response")->redirect("comments");
    }
}
