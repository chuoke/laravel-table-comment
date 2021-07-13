<?php

namespace Chuoke\LaravelTableComment;

use Illuminate\Database\Connection;
use Illuminate\Database\Migrations\Migration as AbstractMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\Grammar;
use Illuminate\Support\Fluent;

class Migration extends AbstractMigration
{
    public function __construct()
    {
        $this->addCommentTableMethod();
    }

    protected function addCommentTableMethod()
    {
        Blueprint::macro('comment', function ($comment) {
            if (! Grammar::hasMacro('compileCommentTable')) {
                Grammar::macro('compileCommentTable', function (Blueprint $blueprint, Fluent $command, Connection $connection) {
                    switch ($databaseDriver = $connection->getDriverName()) {
                        case 'mysql':
                            /** @var \Illuminate\Database\Schema\Grammars\MySqlGrammar $this */
                            return 'alter table ' . $this->wrapTable($blueprint) . $this->modifyComment($blueprint, $command);
                        case 'pgsql':
                            /** @var \Illuminate\Database\Schema\Grammars\PostgresGrammar $this */
                            return sprintf(
                                'comment on table %s is %s',
                                $this->wrapTable($blueprint),
                                "'" . str_replace("'", "''", $command->comment) . "'"
                            );
                        case 'sqlserver':
                        case 'sqlite':
                        default:
                            throw new TableCommentNotSupportException($databaseDriver);
                    }
                });
            }

            /** @var \Illuminate\Database\Schema\Blueprint $this */
            return $this->addCommand('commentTable', compact('comment'));
        });
    }
}
