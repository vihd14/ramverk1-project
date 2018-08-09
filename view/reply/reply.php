<?php

namespace Anax\View;

use \Anax\User\UserLoginForm;
use \Anax\Session\Session;

/**
* View to reply to a comment.
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

if ($session->has("user")) : ?>
    <h1>Write reply</h1>
    <p>Use Markdown to style your reply.
        See <a style="padding: unset; text-decoration: underline" href="https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet">cheat sheet</a>
        for help on how to use Markdown.
    </p>
    <p style="font-style: italic; color: grey; font-size: 90%">OBS! Separate each tag with a space and comma
        (see example in placeholder). Don´t put spaces in a tag, use camel case instead (ex. flowerPots, housePlants).
    </p>

    <?= $form ?>
<?php else : ?>
    <p>You need to <a href="<?= $urlToLogin ?>">sign in</a> to post a reply.</p>
    <?php
    return;
endif; ?>
