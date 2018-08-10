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
    <div class="admin-grid">
        <?php foreach ($items as $item) : ?>
            <div class="users-list-admin">
                <?php $emailHash = md5(strtolower(trim($item->email))); ?>
                <img src="https://www.gravatar.com/avatar/<?= $emailHash ?>?s=200&d=identicon" class="figcenter" />
                <p><b>User:</b> <?= $item->acronym; ?></p>
                <p><b>E-mail:</b> <?= $item->email; ?></p>
                <a class="button-link" href="<?= url("user/update/{$item->acronym}"); ?>">Update profile</a>
                <a class="button-link delete" href="<?= url("user/delete/{$item->id}"); ?>">Delete</a><br>
                <p style="border-bottom: 1px solid grey;"></p>
            </div>
        <?php endforeach ?>
    </div>

<?php else : ?>
    <p><strong>You do not have access to this page.</strong></p>
    <?php
    return;
endif; ?>
