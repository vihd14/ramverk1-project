<?php

namespace Anax\View;

use \Vihd14\Comment\Comment;
use \Anax\User\User;

/**
* View to view all existing tags.
*/

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;
$user = isset($users) ? $users : null;


?><h1>Welcome to the Home & Garden website</h1>

<?php if (!$items) : ?>
    <p>No tags to show...</p>
    <?php
    return;
endif;

// $tag_array = array();
//
foreach ($items as $item) :
    if ($item->tags == $tag) : ?>
        <a href="<?= url("comments/comment-view/{$item->id}"); ?>"><?= $item->title, " - ", $session->get("user") ?></a>
    <?php endif;
endforeach; ?>
