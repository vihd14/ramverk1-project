<?php
/**
 * Routes for user controller.
 */
return [
    "routes" => [
        [
            "info" => "Create a reply",
            "requestMethod" => "get|post",
            "path" => "reply/{id:digit}",
            "callable" => ["replyController", "getPostCreateItemReply"],
        ],
        [
            "info" => "Delete a reply",
            "requestMethod" => "get|post",
            "path" => "delete/{item:digit}",
            "callable" => ["replyController", "getPostDeleteItem"],
        ],
        [
            "info" => "Update a reply",
            "requestMethod" => "get|post",
            "path" => "update/{item:digit}",
            "callable" => ["replyController", "getPostUpdateItem"],
        ],
    ]
];
