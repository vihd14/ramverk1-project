<?php

namespace Anax\View;

use \Anax\User\UserLoginForm;
use \Anax\Session\Session;

/**
* View to display all comments.
*/
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

//Start Session
$session = new Session();

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToCreate = url("comments/create");

?><h1>Questions and answers</h1>

<a style="text-decoration: underline" href="<?= $urlToCreate ?>">Post a new question</a>

<?php if (!$items) : ?>
    <p>No posts to show...</p>
    <?php
    return;
endif;

foreach ($items as $item) : ?>
<div class="posted-comment">
    <p class="comment-id"><?= $item->id ?>.</p>
    <?php $emailHash = md5(strtolower(trim($session->get("email")))); ?>
    <img class="comment-img-email" src="https://www.gravatar.com/avatar/<?= $emailHash ?>?s=50&d=retro" />
    <p class="comment-img-email"><?= $item->email ?></p>
    <p class="comment-text"><?= $item->text ?></p>
    <?php if ($session->has("user") && $session->get("email") == $item->email || $session->get("user") == "admin") : ?>
        <a class="button-link right" href="<?= url("comments/update/{$item->id}"); ?>">Edit</a>
        <a class="button-link right" href="<?= url("comments/delete/{$item->id}"); ?>">Delete</a>

    <?php endif; ?>
</div>
<?php endforeach;
