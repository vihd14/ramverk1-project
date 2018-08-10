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

$urlToReply = url("reply/reply");

$tag_array = array();

foreach ($items as $item) : ?>
    <h1><?= $item->title ?></h1>
    <div class="posted-comment">
        <?php $emailHash = md5(strtolower(trim($item->email))); ?>
        <img class="comment-img" src="https://www.gravatar.com/avatar/<?= $emailHash ?>?s=50&d=identicon" />
        <p class="comment-email"><?= $item->email ?></p>
        <p class="comment-text"><?= $di->get("textfilter")->markdown($item->reply) ?></p>

        <?php if ($item->tags != null) : ?>
            <div class="tag-section"><?php
            $tag_array = explode(", ", $item->tags);
            echo "<a href='tags'>#" . implode("</a>, <a href='comments/tags'>#", $tag_array) . "</a>";
            ?></div>
        <?php endif;

if ($session->has("user")) : ?>
    <a class="button-link" href="<?= url("reply/reply/{$item->id}"); ?>">Reply</a><?php
endif;

if ($session->has("user") && $session->get("email") == $item->email || $session->get("user") == "admin") : ?>
    <div class="edit-delete">
        <a class="button-link" href="<?= url("reply/update/{$item->id}"); ?>">Edit</a>
        <a class="button-link delete" href="<?= url("reply/delete/{$item->id}"); ?>">Delete</a>
    </div><?php
endif; ?>
    </div>
<?php endforeach;
