<?php

namespace Anax\User\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Anax\User\User;
use \Anax\Session\Session;

/**
 * Example of FormModel implementation.
 */
class UserLoginForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di)
    {
        parent::__construct($di);

        $this->form->create(
            [
                "id" => __CLASS__,
                // "legend" => "Login user"
            ],
            [
                "user" => [
                    "type"        => "text",
                    "label"       => "Användarnamn:",
                ],

                "email" => [
                    "type"        => "text",
                    "label"       => "E-mail:",
                ],

                "password" => [
                    "type"        => "password",
                    "label"       => "Lösenord:",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Logga in",
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
        // Get values from the submitted form
        $id            = $this->form->value("id");
        $acronym       = $this->form->value("user");
        $email         = $this->form->value("email");
        $password      = $this->form->value("password");

        $session = new Session();
        $user = new User();
        $user->setDb($this->di->get("db"));
        $res = $user->verifyPassword($acronym, $password);

        if (!$res) {
            $this->form->rememberValues();
            $this->form->addOutput("User or password did not match.");
            return false;
        } elseif ($session->has("id")) {
            $this->form->addOutput("User already logged in.");
            return false;
        }

        $session->set("id", $id);
        $session->set("user", $acronym);
        $session->set("email", $email);
        $session->set("password", $password);
        $this->di->get("response")->redirect("user");
        return true;
        //exit;
    }
}
