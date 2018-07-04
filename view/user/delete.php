<?php

namespace Anax\View;

/**
 * View to delete a user.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Create urls for navigation
$urlToView = url("user");
$urlToAdmin = url("admin");


?><h1>Ta bort användare</h1>

<?= $form ?>

<p>
    <a href="<?= $urlToView ?>">Tillbaka</a>
</p>
