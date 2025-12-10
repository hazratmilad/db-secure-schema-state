# DB Secure Schema State for Laravel
### SSL-enabled, Postgres-enhanced and MySQL-enhanced schema dumps with MariaDB safety

This package overrides Laravel's `MySqlSchemaState` and `PostgresSchemaState` to provide full SSL support when dumping
schemas, while protecting MariaDB users from unsupported flags.

## ✨ Features

- SSL CA / CERT / KEY support
- Optional SSL verification toggles
- Automatically disabled for MariaDB
- Drop-in replacement for Laravel's SchemaState
- No framework modifications required

## 📦 Installation

```bash
composer require hazratmilad/db-secure-schema-state
