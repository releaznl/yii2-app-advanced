<?php
namespace Deployer;

desc('Executes Yii2 tasks');
task('yii', [
  'yii:init',
  'migrate'
]);

desc("Inits the remote application with the value of init section");
task('yii:init', function() {
    $init = get('settings')['yii']['init'];
    if($init)
    {
        init_yii($init);
    }
});

function init_yii($environment)
{
    run("cd {{release_path}} && php init --env={$environment} --overwrite=All");
}
