<?php

namespace Anax\View;

use \Vihd14\Comment\Comment;

/**
* View to view all existing tags.
*/

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

?><h1>Tags</h1>

<?php if (!$items) : ?>
    <p>No tags to show...</p>
    <?php
    return;
endif;

$tag_array = array();

foreach ($items as $item) :
    if ($item->tags != null) {
        $explodedArray = explode(", ", $item->tags);

        foreach ($explodedArray as $value) {
            array_push($tag_array, $value);
        }
        $tag_array = array_unique($tag_array);
        asort($tag_array);
    }
endforeach;

foreach ($items as $item) {
    $tag_array = explode(", ", $item->tags);
    echo "<a href='tag/{$item->tags}'>#" . implode("</a>, <a href='tags'>#", $tag_array) . "</a><p></p>";
}
