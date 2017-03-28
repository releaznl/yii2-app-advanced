<?php
namespace Deployer;

require 'recipe/yii.php';

// Configuration

set('repository', 'git@domain.com:username/repository.git');
set('git_tty', true); // [Optional] Allocate tty for git on first deployment
add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('project.com')
    ->stage('production')
    ->set('deploy_path', '/var/www/project.com');

host('dev.project.com')
    ->stage('develop')
    ->set('deploy_path', '/var/www/project.com');


// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
