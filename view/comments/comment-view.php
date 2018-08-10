<?php

namespace Anax\View;

use \Anax\User\UserLoginForm;
use \Anax\Session\Session;

/**
* View to display all comments.
*/

//Start Session
$session = new Session();

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;
$replies = isset($replies) ? $replies : null;

$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$commentId = array_slice(explode('/', rtrim($url, '/')), -1)[0];
$tag_array = array();

foreach ($items as $item) :
    if ($item->id == $commentId) : ?>
        <div class="posted-comment">
            <h2><?= $item->title ?></h2>
            <p class="comment-text"><?= $di->get("textfilter")->markdown($item->text) ?></p>

            <?php if ($item->tags != null) : ?>
                <div class="tag-section"><?php
                $tag_array = explode(", ", $item->tags);
                echo "<a href='../tag/{$item->tags}'>#" . implode("</a>, <a href='../tags'>#", $tag_array) . "</a>";
                ?></div>
            <?php endif;

            $emailHash = md5(strtolower(trim($item->email))); ?>
            <img class="comment-img" src="https://www.gravatar.com/avatar/<?= $emailHash ?>?s=50&d=identicon" />
            <p class="comment-email"><?= $item->email ?></p>

            <?php if ($session->has("user")) : ?>
                <a class="button-link" href="<?= url("reply/reply/{$item->id}"); ?>">Reply</a>
            <?php endif; ?>

            <?php if ($session->has("user") && $session->get("email") == $item->email || $session->get("user") == "admin") : ?>
                <div class="edit-delete">
                    <a class="button-link" href="<?= url("comments/update/{$item->id}"); ?>">Edit</a>
                    <a class="button-link delete" href="<?= url("comments/delete/{$item->id}"); ?>">Delete</a>
                </div>
            <?php endif; ?>
        </div>
        <?php foreach ($replies as $reply) :
            if ($reply->commentId == $commentId) : ?>
                <div class="comment-reply">
                    <div class="posted-comment" style="border: unset; border: 2px solid grey;">
                        <h2><?= $reply->title ?></h2>
                        <p class="reply-text"><?= $di->get("textfilter")->markdown($reply->reply) ?></p>
                        <p class="reply-line"></p>
                        <?php $emailHash = md5(strtolower(trim($reply->email))); ?>
                        <img class="comment-img" src="https://www.gravatar.com/avatar/<?= $emailHash ?>?s=50&d=identicon" />
                        <p class="comment-email"><?= $reply->email ?></p>

                        <?php if ($session->has("user")) : ?>
                            <a class="button-link" href="<?= url("reply/reply/{$reply->id}"); ?>">Reply</a>
                        <?php endif; ?>

                        <?php if ($session->has("user") && $session->get("email") == $reply->email || $session->get("user") == "admin") : ?>
                            <div class="edit-delete">
                                <a class="button-link" href="<?= url("reply/update/{$reply->id}"); ?>">Edit</a>
                                <a class="button-link delete" href="<?= url("reply/delete/{$reply->id}"); ?>">Delete</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div><?php
            endif;
endforeach;
    endif;
endforeach; ?>
