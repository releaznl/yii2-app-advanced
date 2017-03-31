<?php
namespace Deployer;

desc('Deploys a Yii2 application, complete with given settings.');
task('deploy-yii', [
  'deploy',
  'files',
  'sync',
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
