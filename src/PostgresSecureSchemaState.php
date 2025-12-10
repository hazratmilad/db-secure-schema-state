<?php

namespace Milad\DBSecureSchemaState;

use Illuminate\Database\Schema\PostgresSchemaState;

class PostgresSecureSchemaState extends PostgresSchemaState
{
    protected function connectionString()
    {
        $value = ' --username="${:LARAVEL_LOAD_USER}" --host="${:LARAVEL_LOAD_HOST}" --port="${:LARAVEL_LOAD_PORT}"';

        $config = $this->connection->getConfig();
        $useSsl = $config['dump']['use_ssl'] ?? false;
        $sslMode = $config['dump']['ssl_mode'] ?? null;

        if (!empty($config['password'])) {
            $value .= ' --no-password';
        }

        if ($useSsl) {
            if ($sslMode) {
                $value .= " --set=sslmode={$sslMode}";
            } else {
                $value .= ' --set=sslmode=require';
            }

            if (isset($config['sslcert'])) {
                $value .= ' --set=sslcert="${:LARAVEL_LOAD_SSL_CERT}"';
            }

            if (isset($config['sslkey'])) {
                $value .= ' --set=sslkey="${:LARAVEL_LOAD_SSL_KEY}"';
            }

            if (isset($config['sslrootcert'])) {
                $value .= ' --set=sslrootcert="${:LARAVEL_LOAD_SSL_ROOT_CERT}"';
            }
        }

        return $value;
    }

    protected function baseVariables(array $config)
    {
        $config['host'] ??= '';

        return array_merge(parent::baseVariables($config), [
            'LARAVEL_LOAD_SSL_CERT' => $config['sslcert'] ?? '',
            'LARAVEL_LOAD_SSL_KEY' => $config['sslkey'] ?? '',
            'LARAVEL_LOAD_SSL_ROOT_CERT' => $config['sslrootcert'] ?? '',
        ]);
    }
}