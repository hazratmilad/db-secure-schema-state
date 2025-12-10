<?php

namespace Milad\MySqlSecureSchemaState;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Connection;

class MySqlSecureSchemaStateServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Verify the service provider is loading
        dd('MySqlSecureSchemaState package loaded');

        // Register the resolver as early as possible
        Connection::resolverFor('mysql', function ($connection, $database, $prefix, $config) {
            dd('MySQL connection resolver called');
            return new MySqlSecureConnection($connection, $database, $prefix, $config);
        });
    }

    public function boot()
    {
        dd('MySqlSecureSchemaState package booted');
    }
}