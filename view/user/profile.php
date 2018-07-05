<?php

namespace Anax\View;

use \Anax\User\UserLoginForm;
use \Anax\User\UpdateUserForm;
use \Anax\Session\Session;

/**
* View to display profile page.
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
$urlToCreate = url("user/create");
$urlToLogout = url("user/logout");
$urlToAdminPage = url("user/admin");

?>

<?php if ($session->has("user")) : ?>
    <h1>Profile for <?= $session->get("user"); ?> </h1>
    <?php $emailHash = md5(strtolower(trim($session->get("email")))); ?>
    <img src="https://www.gravatar.com/avatar/<?= $emailHash ?>?s=200&d=retro" />
    <p><b>E-mail:</b> <?= $session->get("email"); ?></p>

    <a class="button-link" href="<?= $urlToLogout ?>">Sign out</a>
    <a class="button-link" href="<?= url("user/update/{$session->get("user")}"); ?>">Edit profile</a>

    <?php if ($session->get("user") == "admin") : ?>
        <a href="<?= $urlToAdminPage ?>">Manage users</a>
    <?php endif; ?>

<?php else : ?>
    <h1>Profile</h1>
    <p>No user signed in.</p>
    <a class="button-link" href="<?= $urlToLogin ?>">Sign in</a>
    <a class="button-link" href="<?= $urlToCreate ?>">Create user</a>
    <?php
    return;
endif; ?>
