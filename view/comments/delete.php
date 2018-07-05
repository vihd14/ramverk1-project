<?php

namespace Anax\View;

use \Anax\DI\DIInterface;
use \Anax\HTMLForm\FormModel;
use \Anax\Comment\Comment;

/**
 * View to delete a comment.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Create urls for navigation
$urlToView = url("comments");

?><h1>Remove post</h1>

<?php  ?>

<?= $form ?>

<p>
    <a class="button-link" href="<?= $urlToView ?>">Back to chat room</a>
</p>
