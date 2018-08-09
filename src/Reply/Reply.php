<?php

namespace Vihd14\Reply;

use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class Reply extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Replies";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $title;
    public $email;
    public $reply;
    public $commentId;
}
