<?php

namespace Anax\User\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Anax\User\User;

/**
 * Form to delete a user.
 */
class DeleteUserForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di, $id)
    {
        parent::__construct($di);
        $user = $this->getItemDetails($id);
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
                    "value" => $user->id,
                ],

                "acronym" => [
                    "type" => "text",
                    "label" => "User name:",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $user->acronym,
                ],

                "email" => [
                    "type" => "text",
                    "label" => "E-mail:",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $user->email,
                ],

                "submit" => [
                    "type" => "submit",
                    "options" => $this->getAllItems($id),
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
    protected function getAllItems($id)
    {
        $user = new User();
        $user->setDb($this->di->get("db"));
        $users = ["-1" => "Choose an object"];
        $obj = $user->find("id", $id);
        $users[$obj->id] = "{$obj->email} ({$obj->id})";

        return $users;
        // $user = new User();
        // $user->setDb($this->di->get("db"));
        // $users = ["-1" => "Choose an object"];
        // foreach ($user->findAll() as $obj) {
        //     $users[$obj->id] = "{$obj->acronym} ({$obj->id})";
        // }
        //
        // return $users;
    }



    /**
     * Get details on item to load form with.
     *
     * @param integer $id get details on item with id.
     *
     * @return User
     */
    public function getItemDetails($id)
    {
        $user = new User();
        $user->setDb($this->di->get("db"));
        $user->find("id", $id);
        return $user;
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        $user = new User();
        $user->setDb($this->di->get("db"));
        $user->find("id", $this->form->value("id"));
        $user->delete();
        $this->di->get("response")->redirect("user/deleted");
    }
}
