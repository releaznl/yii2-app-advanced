<?php

use Symfony\Component\Yaml\Yaml;

/*
  Obtain the secrets file to ensure safety. Please fill in the database entry
  when creating an environment localy.
*/

$configFile = '/config.yml';

$yaml = Yaml::parse(file_get_contents(__DIR__ . $configfile));
$database = $yaml['database'];
$email = $yaml['email'];

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
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => $email['mailhost'],
                'username' => $email['mailusername'],
                'password' => $email['mailpassword'],
                'port' => '587',
//             	'encryption' => 'tls',
            ],
        ],
    ],
];
