<?php

namespace Anax\View;

use \Vihd14\Comment\Comment;
use \Anax\User\UserLoginForm;
use \Anax\Session\Session;

/**
* View to view all existing tags.
*/

//Start Session
$session = new Session();

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;
$replies = isset($replies) ? $replies : null;

$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$tag = array_slice(explode('/', rtrim($url, '/')), -1)[0];

?><h1>Comments with tag <?= $tag ?></h1>

<?php if (!$items) : ?>
    <p>No tags to show...</p>
    <?php
    return;
endif;

foreach ($items as $item) :
    if ($item->tags == $tag) : ?>
        <a href="<?= url("comments/comment-view/{$item->id}"); ?>"><?= $item->title, " - ", $session->get("user") ?></a><?php
    endif;
endforeach; ?>
