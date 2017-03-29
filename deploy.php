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
      ->set('deploy_path', $host['deploy_path'])
      ->set('settings', $host['settings']);
}

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Add php files containing custom tasks
require __DIR__ . '/deployment/sync.php';
