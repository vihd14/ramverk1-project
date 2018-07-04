<?php

namespace Anax\User\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Anax\User\User;

/**
 * Example of FormModel implementation.
 */
class UpdateUserForm extends FormModel
{
    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Anax\DI\DIInterface $di a service container
     * @param integer             $id to update
     */
    public function __construct(DIInterface $di, $acronym)
    {
        parent::__construct($di);
        $user = $this->getItemDetails($acronym);
        $this->form->create(
            [
                "id" => __CLASS__,
                // "legend" => "Create user",
            ],
            [
                "id" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $user->id,
                ],

                "acronym" => [
                    "type"        => "text",
                    "label"       => "Användarnamn:",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $user->acronym,
                ],

                "email" => [
                    "type"       => "text",
                    "label"       => "E-mail:",
                    "validation" => ["not_empty"],
                    "value" => $user->email,
                ],

                "password" => [
                    "type"        => "password",
                    "label"       => "Lösenord:",
                    "validation" => ["not_empty"],
                    //"value" => $user->password,
                ],

                "password-again" => [
                    "type"        => "password",
                    "label"       => "Lösenord igen:",
                    "validation" => [
                        "match" => "password",
                        "not_empty"
                    ],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Spara",
                    "callback" => [$this, "callbackSubmit"]
                ],
                "reset" => [
                    "type"      => "reset",
                    "value"     => "Återställ"
                ],
            ]
        );
    }



    /**
     * Get details on item to load form with.
     *
     * @param integer $id get details on item with id.
     *
     * @return Comment
     */
    public function getItemDetails($acronym)
    {
        $user = new User();
        $user->setDb($this->di->get("db"));
        $user->find("acronym", $acronym);
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
        // Get values from the submitted form
        // $acronym       = $this->form->value("acronym");
        // $email         = $this->form->value("email");
        $password      = $this->form->value("password");
        $passwordAgain = $this->form->value("password-again");

        // Check password matches
        if ($password !== $passwordAgain) {
            $this->form->rememberValues();
            $this->form->addOutput("Password did not match.");
            return false;
        }

        $user = new User();
        $user->setDb($this->di->get("db"));
        $user->find("acronym", $this->form->value("acronym"));
        $user->email = $this->form->value("email");
        $user->setPassword($password);
        $user->save();
        $this->di->get("response")->redirect("user");

        // $user->setPassword($password);
    }
}
