<?php

namespace Anax\View;

use \Anax\User\User;

/**
* View to display profile page.
*/
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());


// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

?><h1>User accounts</h1>
<div class="user-wrapper">
    <?php foreach ($items as $item) : ?>
        <a href="<?= url("user/user-overview/{$item->acronym}"); ?>">
            <div class="users-list">
                <?php $emailHash = md5(strtolower(trim($item->email))); ?>
                <img src="https://www.gravatar.com/avatar/<?= $emailHash ?>?s=100&d=identicon" class="figcenter" />
                <p><b>User:</b> <?= $item->acronym; ?> </p>
                <p><b>E-mail:</b> <?= $item->email; ?></p>
            </div>
        </a>
    <?php endforeach; ?>
</div>
