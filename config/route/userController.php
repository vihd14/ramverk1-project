<?php
/**
 * Routes for user controller.
 */
return [
    "routes" => [
        [
            "info" => "User Controller index.",
            "requestMethod" => "get",
            "path" => "",
            "callable" => ["userController", "getIndex"],
        ],
        [
            "info" => "See all users.",
            "requestMethod" => "get",
            "path" => "users",
            "callable" => ["userController", "getAllUsers"],
        ],
        [
            "info" => "User overview.",
            "requestMethod" => "get",
            "path" => "user-overview/{user:alpha}",
            "callable" => ["userController", "getUserOverview"],
        ],
        [
            "info" => "Logout a user.",
            "requestMethod" => "get|post",
            "path" => "logout",
            "callable" => ["userController", "getLogout"],
        ],
        [
            "info" => "Login a user.",
            "requestMethod" => "get|post",
            "path" => "login",
            "callable" => ["userController", "getPostLogin"],
        ],
        [
            "info" => "Create a user.",
            "requestMethod" => "get|post",
            "path" => "create",
            "callable" => ["userController", "getPostCreateUser"],
        ],
        [
            "info" => "Update a user.",
            "requestMethod" => "get|post",
            "path" => "update/{user}",
            "callable" => ["userController", "getPostUpdate"],
        ],
        [
            "info" => "Delete an item.",
            "requestMethod" => "get|post",
            "path" => "delete/{user}",
            "callable" => ["userController", "getPostDeleteItem"],
        ],
        [
            "info" => "Account was deleted.",
            "requestMethod" => "get|post",
            "path" => "deleted",
            "callable" => ["userController", "getPostDeleted"],
        ],
        [
            "info" => "Admin page.",
            "requestMethod" => "get|post",
            "path" => "admin",
            "callable" => ["userController", "getAdminPage"],
        ],
    ]
];
