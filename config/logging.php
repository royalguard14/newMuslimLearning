<?php

use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

date_default_timezone_set('Asia/Manila');
$date = date('Ymd');


return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */

    'channels' => [



        'department_adding' => [
            'driver' => 'single',
            'path' => storage_path('logs/'.$date.' department_adding.log'),
            'level' => 'info',
        ],


        'position_adding' => [
                    'driver' => 'single',
                    'path' => storage_path('logs/'.$date.' position_adding.log'),
                    'level' => 'info',
                ],


        'dup_employee' => [
            'driver' => 'single',
            'path' => storage_path('logs/'.$date.'dup_employee.log'),
            'level' => 'info',
        ],



        'error_found' => [
            'driver' => 'single',
            'path' => storage_path('logs/'.$date.'error_found.log'),
            'level' => 'info',
        ],



        'reg_employee' => [
            'driver' => 'single',
            'path' => storage_path('logs/'.$date.'reg_employee.log'),
            'level' => 'info',
        ],



        'attendance_error' => [
            'driver' => 'single',
            'path' => storage_path('logs/'.$date.'attendance_error.log'),
            'level' => 'info',
        ],

        


        
        'stack' => [
            'driver' => 'stack',
            'channels' => ['daily'],
            'ignore_exceptions' => false,
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
            'days' => 14,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Log',
            'emoji' => ':boom:',
            'level' => 'critical',
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => 'debug',
            'handler' => SyslogUdpHandler::class,
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
            ],
        ],

        'stderr' => [
            'driver' => 'monolog',
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => 'debug',
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => 'debug',
        ],
    ],

];
