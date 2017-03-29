<?php

use Symfony\Component\Yaml\Yaml;

/*
  Obtain the secrets file to ensure safety. Please fill in the database entry
  when creating an environment localy.
*/

// TODO: For some reason Travis CI is smarter with symlinks than my local machine?
if(getenv('TRAVIS')) {
  $configfile = "/config.yml";
} else {
  $configfile = "/../../../common/config/config.yml";
}

$yaml = Yaml::parse(file_get_contents(__DIR__ . $configfile));
$database = $yaml['database'];

//var_dump(__DIR__); exit;

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
