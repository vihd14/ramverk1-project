<?php
namespace Viza\CNavigation;

$urlHome  = $app->url->create("");
$urlChat = $app->url->create("comments");
$urlAbout = $app->url->create("about");
$urlProfile = $app->url->create("user");

$menu = array(
  'home'  => array('text'=>'HOME',  'url'=>$urlHome),
  'comments' => array('text'=>'CHAT ROOM', 'url'=>$urlChat),
  'about' => array('text'=>'ABOUT', 'url'=>$urlAbout),
  'user' => array('text'=>'PROFIL', 'url'=>$urlProfile),
);

class CNavigation
{
    public static function generateMenu($items, $class)
    {
        $html = "<nav class='$class'>\n";

        foreach ($items as $key => $item) {
            $basename = str_replace(".php", "", basename($_SERVER['REQUEST_URI']));
            $selected = ($basename == $key)
                ? 'selected'
                : null;
            $html .= "<a href='{$item['url']}' class='{$selected}'>{$item['text']}</a>\n";
        }
        $html .= "</nav>\n";
        return $html;
    }
}

echo CNavigation::generateMenu($menu, "navbar rm-default rm-desktop");
// echo CNavigation::generateMenu($menu, "navbarMax rm-default rm-mobile");
