<?php

namespace Anax\View;

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
<p>
    Post any question or comment you like, or answer the existing comments. To reply or view previous replies, click on the comments title.
</p>
<a style="text-decoration: underline" href="<?= $urlToCreate ?>">Post a new question</a>

<?php if (!$items) : ?>
    <p>No posts to show...</p>
    <?php
    return;
endif;

$tag_array = array();

foreach ($items as $item) : ?>
    <div class="posted-comment">
        <h2 class="comment-title"><a href="<?= url("comments/comment-view/{$item->id}"); ?>"><?= $item->title ?></a></h2>
        <p class="comment-text"><?= $di->get("textfilter")->markdown($item->text) ?></p>

        <?php if ($item->tags != null) : ?>
            <div class="tag-section"><?php
            $tag_array = explode(", ", $item->tags);
            foreach ($tag_array as $tag) {
                echo "<a href='comments/tag/{$tag}'>#{$tag}</a> ";
            }
            ?></div>
        <?php endif;

        $emailHash = md5(strtolower(trim($item->email))); ?>
        <img class="comment-img" src="https://www.gravatar.com/avatar/<?= $emailHash ?>?s=50&d=identicon" />
        <p class="comment-email"><?= $item->email ?></p>

        <?php if ($session->has("user") && $session->get("email") == $item->email || $session->get("user") == "admin") : ?>
            <div class="edit-delete">
                <a class="button-link" href="<?= url("comments/update/{$item->id}"); ?>">Edit</a>
                <a class="button-link delete" href="<?= url("comments/delete/{$item->id}"); ?>">Delete</a>
            </div>

        <?php endif; ?>
    </div>
<?php endforeach;
