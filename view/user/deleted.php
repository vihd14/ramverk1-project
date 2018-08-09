<?php

namespace Anax\View;

use \Anax\User\UserLoginForm;
use \Anax\Session\Session;

/**
 * View to display logout user page.
 */

//Start Session
$session = new Session();

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

$urlToCreate = url("user/create");

?>

<h2>User <?= $session->get("user") ?> was deleted.</h2>

<?php

$session->delete("user");

?><a class="button-link" href="<?= $urlToCreate ?>">Create new account</a>
