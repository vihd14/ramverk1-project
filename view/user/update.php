<?php

namespace Anax\View;

/**
 * View to update a profile.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$item = isset($item) ? $item : null;

?><h1>Updatera profil</h1>

<?= $form ?>

<a href="../../user">Tillbaka till profil</a>
