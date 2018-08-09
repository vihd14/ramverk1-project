<?php

namespace Anax\View;

/**
 * View to update a reply.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$item = isset($item) ? $item : null;

?><h1>Edit post</h1>
<p style="font-style: italic; color: grey; font-size: 90%">Use Markdown to style your comment. See <a style="padding: unset; text-decoration: underline" href="https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet">cheat sheet</a> for help on how to use Markdown.</p>

<?= $form ?>
