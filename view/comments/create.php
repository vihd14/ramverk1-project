<?php

namespace Anax\View;

use \Anax\User\UserLoginForm;
use \Anax\Session\Session;

/**
* View to create a new comment.
*/
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

//Start Session
$session = new Session();

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToLogin = url("user/login");
$urlToViewItems = url("comments");

?><h1>Write a post</h1>
<?php if ($session->has("user")) : ?>
    <p>Use Markdown to style your comment.
        See <a style="padding: unset; text-decoration: underline" href="https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet">cheat sheet</a>
        for help on how to use Markdown.
    </p>
    <p style="font-style: italic; color: grey; font-size: 90%">OBS! Separate each tag with a space and comma
        (see example in placeholder). Don´t put spaces in a tag, use camel case instead (ex. flowerPots, housePlants).
    </p>
    <?= $form ?>
<?php else : ?>
    <p>You need to <a href="<?= $urlToLogin ?>">sign in</a> to post.</p>
    <p>Don´t have an account? Sign up <a href="../user/create">here</a>!</p>
    <?php
    return;
endif; ?>
