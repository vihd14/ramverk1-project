<?php

namespace Anax\View;

use \Anax\Session\Session;

/**
 * View to sign in.
 */

 //Start Session
 $session = new Session();
// Gather incoming variables and use default values if not set
$item = isset($item) ? $item : null;

$urlToCreate = url("user/create");
$urlToLogout = url("user/logout");

?><h1>Sign in</h1>
<?php if ($session->has("user")): ?>
    <p>User already signed in.</p>
    <a class="button-link" href="<?= $urlToLogout ?>">Sign out</a>
    <?php else : ?>
        <?= $form ?>
        <p>Don't have a user account?</p>
        <a class="button-link" href="<?= $urlToCreate ?>">Create user</a>
<?php endif; ?>
