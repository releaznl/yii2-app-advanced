<?php

use Symfony\Component\Yaml\Yaml;

/*
  Obtain the secrets file to ensure safety. Please fill in the database entry
  when creating an environment localy. When an environment variable is given
  this value is used as an config file. This comes in handy when deploying and
  you dont want to send your config files continously.
*/

// The storage for the config file and env obtaining:
$configfile = getenv('CONFIG_PATH');

// Check if env was set, otherwise use default entry (i.e. in development)
if(!$configfile)
  $configfile = "/config.yml";

// Parse content
$yaml = Yaml::parse(file_get_contents(__DIR__ . $configfile));
$database = $yaml['database'];

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => "mysql:host={$database['location']};dbname=" . $database['name'],
            'username' => $database['username'],
            'password' => $database['password'],
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];
