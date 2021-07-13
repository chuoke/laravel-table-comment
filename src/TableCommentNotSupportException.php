<?php

namespace Chuoke\LaravelTableComment;

use Exception;

class TableCommentNotSupportException extends Exception
{
    public function __construct($databaseDriver)
    {
        parent::__construct("The {$databaseDriver} not support table comment.");
    }
}
