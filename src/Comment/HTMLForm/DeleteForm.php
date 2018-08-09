<?php

namespace Vihd14\Comment\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Vihd14\Comment\Comment;

/**
 * Form to delete an item.
 */
class DeleteForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di, $id)
    {
        parent::__construct($di);
        $comment = $this->getItemDetails($id);
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
                    "value" => $comment->id,
                ],

                "title" => [
                    "type" => "text",
                    "label" => "Title:",
                    "readonly" => true,
                    "value" => $comment->title,
                ],

                "email" => [
                    "type" => "text",
                    "label" => "E-mail:",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $comment->email,
                ],

                "text" => [
                    "type" => "textarea",
                    "label" => "Comment:",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $comment->text,
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
        $comment = new Comment();
        $comment->setDb($this->di->get("db"));
        $comments = ["-1" => "Choose an object"];
        $obj = $comment->find("id", $id);
        $comments[$obj->id] = "{$obj->email} ({$obj->id})";

        return $comments;
    }




    /**
     * Get details on item to load form with.
     *
     * @param integer $id get details on item with id.
     *
     * @return Comment
     */
    public function getItemDetails($id)
    {
        $comment = new Comment();
        $comment->setDb($this->di->get("db"));
        $comment->find("id", $id);
        return $comment;
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
        $comment->find("id", $this->form->value("id"));
        $comment->delete();
        $this->di->get("response")->redirect("comments");
    }
}
