<?php
return [
    'development' => [ //development
        'settings' => [
            'displayErrorDetails' => true, // set to false in production
            'addContentLengthHeader' => true, // Allow the web server to send the content-length header

            // Renderer settings
            'renderer' => [
                'template_path' => __DIR__ . '/../templates/',
                'cache' => false,
                'debug' => true,
            ],

            //database settings
            'db' => [
                //local version
                'database_type' => 'mysql',
                'database_name' => 'slim-full-stack',
                'server' => '127.0.0.1',
                'username' => 'root',
                'password' => '',
            ],

            // Monolog settings
            'logger' => [
                'name' => 'slim-app',
                'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                'level' => \Monolog\Logger::DEBUG,
            ]

        ],
    ],
    'production' => [ //production
        'settings' => [
            'displayErrorDetails' => true, // set to false in production
            'addContentLengthHeader' => false, // Allow the web server to send the content-length header

            // Renderer settings
            'renderer' => [
                'template_path' => __DIR__ . '/../templates/',
                'cache' => false,
                'debug' => false,
            ],

            //database settings
            'db' => [

                //localhost version
                'database_type' => 'mysql',
                'database_name' => 'slim-full-stack',
                'server' => '127.0.0.1',
                'username' => 'root',
                'password' => '',

                /*
                //google app engine sample
                'dsn' => [
            		// The mysql driver name for DSN driver parameter
            		'driver' => 'mysql',
            		// The parameters with key and value for DSN
                    //'host' => '127.0.0.1',
                    'dbname' => 'test_db',
                    'unix_socket' => '/cloudsql/gae-test-182701:us-central1:gae-test-sql',
                    //'port' => '3306',
            	],
        		'username' => 'root',
        		'password' => 'uCPMIyiIHF1JM345',
                */
            ],

            // Monolog settings
            'logger' => [
                'name' => 'slim-app',
                'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                'level' => \Monolog\Logger::DEBUG,
            ],

        ],
    ],
];
