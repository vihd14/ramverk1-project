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


?><h1>Admin page</h1>

<?php if ($session->has("user") && $session->get("user") == "admin") : ?>
    <h3>
        <a class="button-link" href="<?= url("user/delete"); ?>">Remove user</a>
    </h3>
    <div class="admin-grid">
        <?php foreach ($items as $item) : ?>
            <div class="users-list-admin">
                <?php $emailHash = md5(strtolower(trim($item->email))); ?>
                <img src="https://www.gravatar.com/avatar/<?= $emailHash ?>?s=200&d=retro" class="figcenter" />
                <p><b>User:</b> <?= $item->acronym; ?></p>
                <p><b>E-mail:</b> <?= $item->email; ?></p>
                <a class="button-link" href="<?= url("user/update/{$item->acronym}"); ?>">Update profile</a>
            </div>
        <?php endforeach ?>
    </div>

<?php else : ?>
    <p><strong>You do not have access to this page.</strong></p>
    <?php
    return;
endif; ?>
