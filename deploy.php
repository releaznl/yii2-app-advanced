<?php
namespace Deployer;

require 'recipe/yii.php';

use Symfony\Component\Yaml\Yaml;

// Configuration

$yaml = Yaml::parse(file_get_contents(__DIR__ . "/deploy-config.yml"));

$general = $yaml['general'];
set('repository', $general['ssh_repo_url']);
set('git_tty', true); // [Optional] Allocate tty for git on first deployment
set('shared_files', []);
set('shared_dirs', []);
set('writable_dirs', []);

// Hosts
foreach($yaml['server'] as $host) {
  host($host['host'])
      ->user($host['ssh_user'])
      ->forwardAgent()
      ->stage($host['stage'])
      ->set('branch', $host['branch'])
      ->set('deploy_path', $host['deploy_path']);
}

// Tasks

desc('Restart PHP-FPM service');
task('php-fpm:restart', function () {
    // The user must have rights for restart service
    // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
    run('sudo systemctl restart php-fpm.service');
});
after('deploy:symlink', 'php-fpm:restart');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
