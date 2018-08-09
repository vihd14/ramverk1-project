<?php
namespace Viza\CNavigation;

$urlHome  = $app->url->create("");
$urlComments = $app->url->create("comments");
$urlAbout = $app->url->create("about");
$urlTags = $app->url->create("comments/tags");
$urlUsers = $app->url->create("user/users");
$urlProfile = $app->url->create("user");
$urlLogin = $app->url->create("user/login");

$menu = array(
    'home'  => array('text'=>'HOME', 'url'=>$urlHome),
    'comments' => array('text'=>'COMMENTS', 'url'=>$urlComments),
    'tags' => array('text'=>'TAGS', 'url'=>$urlTags),
    'users' => array('text'=>'USERS', 'url'=>$urlUsers),
    'user' => array('text'=>'PROFIL', 'url'=>$urlProfile),
    'about' => array('text'=>'ABOUT', 'url'=>$urlAbout),
    'login' => array('text'=>'SIGN IN', 'url'=>$urlLogin),
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
