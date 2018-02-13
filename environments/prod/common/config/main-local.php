<?php

use Symfony\Component\Yaml\Yaml;

/*
  Obtain the secrets file to ensure safety. Please fill in the database entry
  when creating an environment locally. When an environment variable is given
  this value is used as an config file. This comes in handy when deploying and
  you don't want to send your config files continuously.
*/

// The storage for the config file and env obtaining:
$configFile = getenv('CONFIG_PATH');

// Check if env was set, otherwise use default entry (i.e. in development)
if (!$configFile)
    $configFile = '/config.yml';

// Parse content
$yaml = Yaml::parse(file_get_contents(__DIR__ . $configFile));
$database = $yaml['database'];

return [
    'components' => [
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => "mysql:host={$database['location']};dbname=" . $database['name'],
            'username' => $database['username'],
            'password' => $database['password'],
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => \yii\swiftmailer\Mailer::class,
            'viewPath' => '@common/mail',
        ],
    ],
];
