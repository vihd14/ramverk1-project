<?php

namespace Anax\View;

use \Anax\DI\DIInterface;
use \Anax\HTMLForm\FormModel;
use \Anax\Reply\Reply;

/**
 * View to delete a reply.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Create urls for navigation
$urlToView = url("comments");

?><h1>Remove post</h1>
<p>Are you sure you want to delete this post?</p>

<?php  ?>

<?= $form ?>

<p>
    <a class="button-link" href="<?= $urlToView ?>">Back to chat room</a>
</p>
