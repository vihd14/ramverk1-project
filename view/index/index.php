<?php

namespace Anax\View;

/**
* View to view all existing tags.
*/
?><h1>Welcome to the Home & Garden website</h1>
<p>
    This is the site where you can learn and ask questions about everything you want to know
    about your home and garden. In the comment section you can see every previously asked question, ask
    questions of your own or submit answers to other users questions.
    <br><br>
    If you want to be a part of the community you need to set up a <a href="user/create">user account</a>. You will need to be signed in
    to post comments and answers.
</p>

<div class="index-wrapper">
    <div class="top-comments">
        <h2>Latest comments</h2>
        <?php foreach ($latestComments as $comment) : ?>
            - <a href="<?= url("comments/comment-view/{$comment->id}"); ?>"><?= $comment->title ?></a><br><br>
        <?php endforeach; ?>
    </div>

    <div class="top-tags">
        <h2>Top tags</h2>
        <?php
        $tag_array = array();

        foreach ($popularTags as $item) :
            if ($item->tags != null) {
                $explodedArray = explode(", ", $item->tags);

                foreach ($explodedArray as $value) {
                    array_push($tag_array, $value);
                }
            }
        endforeach;
        $tag_count = array_count_values($tag_array);
        $tag_unique = array_unique($tag_array);
        $tag_array = array_combine($tag_unique, $tag_count);

        arsort($tag_array);

        foreach ($tag_array as $key => $value) {
            echo "<a href='comments/tag/{$key}'>#{$key}</a> ({$value})<br><br>";
        } ?>
    </div>

    <div class="top-users">
        <h2>Most active users</h2>
        <?php
        $userArray = array();

        foreach ($activeUsers as $user) {
            array_push($userArray, $user->email);
        }

        $user_count = array_count_values($userArray);
        $user_unique = array_unique($userArray);
        $userArray = array_combine($user_unique, $user_count);
        arsort($userArray);

        foreach ($userArray as $key => $value) {
            echo "<p>{$key} ({$value})</p>";
        }
        ?>
    </div>
</div>
