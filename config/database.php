<?php

//$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$heroku_psql_url = parse_url(getenv('DATABASE_URL'));
print_r($heroku_psql_url);


return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */



    //'default' => env('DB_CONNECTION', 'mysql'),
    'default' => env('DB_CONNECTION', 'pgsql '),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    
    //$heroku_psql_url['path']
    'connections' => [
        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', $heroku_psql_url['host']),
            'port' => env('DB_PORT', $heroku_psql_url['port']),
            //'database' => env('DB_DATABASE', ltrim($heroku_psql_url['path'],'/')),
            'database' => env('DB_DATABASE', ltrim($heroku_psql_url['path'],'/')),
            'username' => env('DB_USERNAME',$heroku_psql_url['user']),
            'password' => env('DB_PASSWORD', $heroku_psql_url['pass']),
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => $heroku_psql_url['scheme'],
            'sslmode' => 'prefer',
        ],
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
        ],

        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

        // 'pgsql' => [
        //     'driver' => 'pgsql',
        //     'host' => env('DB_HOST', '127.0.0.1'),
        //     'port' => env('DB_PORT', '5432'),
        //     'database' => env('DB_DATABASE', 'forge'),
        //     'username' => env('DB_USERNAME', 'forge'),
        //     'password' => env('DB_PASSWORD', ''),
        //     'charset' => 'utf8',
        //     'prefix' => '',
        //     'schema' => 'public',
        //     'sslmode' => 'prefer',
        // ],
        'pgsql_local' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'tasks'),
            'username' => env('DB_USERNAME', 'postgres'),
            'password' => env('DB_PASSWORD', '123456'),
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => 'predis',

        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => 0,
        ],

    ],

];
