<?php
/**
 * Routes for controller.
 */
return [
    "routes" => [
        [
            "info" => "Controller index.",
            "requestMethod" => "get",
            "path" => "",
            "callable" => ["commentController", "getComments"],
        ],
        [
            "info" => "View a comment and its replies.",
            "requestMethod" => "get",
            "path" => "comment-view/{id:digit}",
            "callable" => ["commentController", "getCommentView"],
        ],
        [
            "info" => "Create an item.",
            "requestMethod" => "get|post",
            "path" => "create",
            "callable" => ["commentController", "getPostCreateItem"],
        ],
        [
            "info" => "Display all tags.",
            "requestMethod" => "get",
            "path" => "tags",
            "callable" => ["commentController", "getTagIndex"],
        ],
        [
            "info" => "Display comments with tag.",
            "requestMethod" => "get",
            "path" => "tag/{tagname:alpha}",
            "callable" => ["commentController", "getCommentsFromTag"],
        ],
        [
            "info" => "Delete an item.",
            "requestMethod" => "get|post",
            "path" => "delete/{id:digit}",
            "callable" => ["commentController", "getPostDeleteItem"],
        ],
        [
            "info" => "Update an item.",
            "requestMethod" => "get|post",
            "path" => "update/{id:digit}",
            "callable" => ["commentController", "getPostUpdateItem"],
        ],
    ]
];
