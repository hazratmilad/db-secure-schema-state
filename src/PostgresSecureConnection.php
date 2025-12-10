<?php

namespace Milad\DBSecureSchemaState;

use Illuminate\Database\PostgresConnection;

class PostgresSecureConnection extends PostgresConnection
{
    /**
     * Get the schema state for the connection.
     *
     * @param  \Illuminate\Filesystem\Filesystem|null  $files
     * @param  callable|null  $processFactory
     * @return \Illuminate\Database\Schema\SchemaState
     */
    public function getSchemaState($files = null, callable $processFactory = null)
    {
        return new PostgresSecureSchemaState(
            $this,
            $files,
            $processFactory
        );
    }
}