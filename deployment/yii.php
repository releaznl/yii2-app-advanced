<?php
namespace Deployer;

desc('Executes Yii2 tasks');
task('yii', [
  'yii:init',
  'migrate'
]);

task('yii:init', function() {
    $init = getenv('settings')['yii']['init'];
    if($init)
    {
        init_yii($init);
    }
});

function init_yii($environment)
{
    run("cd {{release_path}} && php init --env={$environment} --overwrite=All-");
}
