<?php

namespace Anax\User\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Anax\User\User;

/**
 * Example of FormModel implementation.
 */
class CreateUserForm extends FormModel
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
                // "legend" => "Create user",
            ],
            [
                "acronym" => [
                    "type"        => "text",
                    "label"       => "User name:",
                ],

                "email" => [
                    "type"       => "text",
                    "label"       => "E-mail:",
                ],

                "password" => [
                    "type"        => "password",
                    "label"       => "Password:",
                ],

                "password-again" => [
                    "type"        => "password",
                    "label"       => "Password again:",
                    "validation" => [
                        "match" => "password"
                    ],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Create user",
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
        $acronym       = $this->form->value("acronym");
        $email         = $this->form->value("email");
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
        $user->acronym = $acronym;
        $user->email = $email;
        $user->setPassword($password);
        $user->save();

        $this->form->addOutput("User " . $acronym . " was created.");
        $this->form->addOutput('<a class="button-link" href="login">Log in</a>');
        return true;
    }
}
