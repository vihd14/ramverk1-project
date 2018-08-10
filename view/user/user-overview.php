<?php

namespace Anax\View;

use \Vihd14\Comment\Comment;
use \Vihd14\Reply\Reply;
use \Anax\User\User;
use \Anax\Session\Session;

/**
* View to display profile page.
*/
// Start the session.
$session = new Session();
// Gather incoming variables and use default values if not set
$users = isset($users) ? $users : null;
$items = isset($items) ? $items : null;
$replies = isset($replies) ? $replies : null;

// Fetching acronym from url to match with user.
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$username = array_slice(explode('/', rtrim($url, '/')), -1)[0];

?><h1>User overview for <?= $username ?></h1>
<?php foreach ($users as $user) :
    if ($user->acronym == $username) : ?>
        <div class="user-overview">
            <?php $emailHash = md5(strtolower(trim($user->email))); ?>
            <img src="https://www.gravatar.com/avatar/<?= $emailHash ?>?s=100&d=identicon" class="figcenter" />
            <p><b>Email:</b> <?= $user->email ?> </p>

            <h2 class="user-overview-h2">Comments by <?= $username ?></h2>
            <?php foreach ($items as $item) :
                if ($user->email == $item->email) : ?>
                    - <a href="<?= url("comments/comment-view/{$item->id}"); ?>"><?= $item->title ?></a><br><br><?php
                endif;
endforeach; ?>

            <h2 class="user-overview-h2">Replies by <?= $username ?></h2>
            <?php foreach ($replies as $reply) :
                if ($user->email == $reply->email) :
                    foreach ($items as $item) :
                        if ($item->id == $reply->commentId) : ?>
                            Reply to: <a href="<?= url("comments/comment-view/{$reply->commentId}") ?>"><?= $item->title ?></a><br><br><?php
                        endif;
                    endforeach;
                endif;
endforeach; ?>
            <?php if ($session->has("user") && $session->get("email") == $user->email || $session->get("user") == "admin") : ?>
                <a class="button-link" href="<?= url("user/update/{$user->acronym}"); ?>">Update profile</a>
                <a class="button-link delete" href="<?= url("user/delete/{$user->id}"); ?>">Delete</a>
            <?php endif; ?>
        </div><?php
    endif;
endforeach; ?>
