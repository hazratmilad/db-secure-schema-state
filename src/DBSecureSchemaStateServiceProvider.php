<?php

namespace Milad\DBSecureSchemaState;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Connection;

class DBSecureSchemaStateServiceProvider extends ServiceProvider
{
    public function register()
    {
        Connection::resolverFor('mysql', function ($connection, $database, $prefix, $config) {
            return new MySqlSecureConnection($connection, $database, $prefix, $config);
        });

        Connection::resolverFor('pgsql', function ($connection, $database, $prefix, $config) {
            return new PostgresSecureConnection($connection, $database, $prefix, $config);
        });
    }
}