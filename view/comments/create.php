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
    <?= $form ?>
<?php else : ?>
    <p>You need to <a href="<?= $urlToLogin ?>">sign in</a> to post.</p>
    <?php
    return;
endif; ?>
