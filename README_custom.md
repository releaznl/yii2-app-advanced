
[![Build Status](https://travis-ci.org/johankladder/yii2-app-advanced.svg?branch=master)](https://travis-ci.org/johankladder/yii2-app-advanced)
[![Code Climate](https://codeclimate.com/github/johankladder/yii2-app-advanced/badges/gpa.svg)](https://codeclimate.com/github/johankladder/yii2-app-advanced)

Custom Yii 2 Advanced Project Template
======================================

This template contains the sources of the Yii2 Advance Project Template with a custom touch. Added functionality:
- Deployment; Custom Deployer tasks to ease up deployment of the application.
- Config handling; No more local specific files in the repository, even deployment secrets aren't pushed

## Development:
When developing inside this application, please use `php init` to make sure you are in the development environment. When done, the `common/config/config.yml` needs to be created. This file can be duplicated from the .example file and adapted to your needs.
- When adding more configs to the above file, please make sure you also do this in the `environment/[stage]/common/config/config.yml.example` to ensure every body else in your team has an new example to base their configs on.

## Deployment:
Deploying is done in with the help of [Deployer](https://github.com/deployphp/deployer). To make use of it, use it from the vendor folder after composer installed all the dependencies. Also define an `deploy-config.yml` file in the root of the project. This file can be duplicated from the `deploy-config.yml.example` and adapted  to your needs.

When initializing a deployment situation. Make sure you have ssh access to the remote server 
and the server has pull rights to the repository. This ssh-access needs to be via useragent. See the 
password section below for more information.

To start a deployment, make sure Deployer has been installed by composer and run `vendor/bin/dep deploy-yii [stage]` to start 
 deployment based on the given config files. The first time of deployment an empty `config.yml` file is created in 
 the shared folder of the remote deployment environment. This file can than be edited on the server, just like in 
 development. This file is shared between deployments and is therefore not needed to be uploaded.

## Passwords
Mentioned that no passwords are asked to login with SSH? The module is using forward-agent. To ensure your user has access to the remote server with forward-agent and no passwords are asked:
   - Copy your public key to the remote server's known-hosts with `ssh-copy-id remoteusername@remotehost`
   - Try `ssh-add -L` to see if your public key is added to the agent. If not run: `ssh-add`
   - Try `ssh remoteuser@remotehost`. Now no password should be asked as it is inside your agent.

## Environments:
In default three environments are set.
- Development (See Yii Advanced documentation)
- Production (See Yii Advanced documentation)
- Acceptance
    - This environment is an production environment with exception debug handling being
    active.


## Example configuration:
```yaml
# General information:
general:
  ssh_repo_url: 'git@github.com:johankladder/yii2-app-advanced.git'

# Staging servers:
server:
  # The production server
  production:
    host: 'applicationname.com'
    stage: 'production'
    branch: 'master'
    deploy_path: '/var/www/applicationname.com'
    ssh_user: 'username'

  # The development server
  development:
    host: 'dev.applicationname.com'
    stage: 'development'
    branch: 'develop'
    deploy_path: '/var/www/dev.applicationname.com'
    ssh_user: 'username'

  # An custom deployment server:
  custom:
    host: 'localhost'
    stage: 'test'
    branch: 'develop'
    deploy_path: '/var/www/test.applicationname.com'
    ssh_user: 'username'
    settings:
      yii:
        init: 'Development'
      files:
        upload-files:
          - 'common/config/afile.yml'
        show:
          - 'common/config/afile.yml'
      migrate:
        rbac: true
        db: true
      sync:
        uploads:
          create_if_not_exists: true
          source: 'shared/uploads/'
          dest: 'shared/uploads'

```

### Key explanation:

Key | Explanation | Required
--- | --- | ---
`host:` | The server host address (Where should the stage be deployed to) | Yes
`stage:` | The name of the stage. (This stage name can be used when using `dep deploy [stagename]`) | Yes
`branch:` | The branch that the stage contains. (This is the branch that will be pulled on the remote server) | Yes
`deploy_path:` | The path where the sources should be pulled on the remote server. (Should always be absolute) | Yes
`ssh_user:` | The user that is needed for logging in at the remote server. | Yes
`settings:` | Contains specific settings for the given stage. | No
`yii/init:` | The initialisation environment for Yii2 apps. In an default situation this can be 'Development' or 'Production'. | No
`files:upload-files` | Paths to files that needs to be uploaded to the remote server to the same location (paths are seen from project folder).  | No
`files:show` | Shows the content of an file. Prefixed with the release_path. | No
`migrate:rbac` | Migrates the RBAC functionality of Yii2. | No
`migrate:db` | Migrates the 'normal' database migrations | No
`sync:*` | Special feature for syncing remote files with for example an shared folder. That way developers can maintain shared files and sync them to the remote server, without loss of user created files. The uploads key is required when using this functionality, but only used for visual purpose. (rsync) | No
`sync:create_if_not_exists` | Create the destination folder if not exists. | No
`sync:source` | Path to folder (from project root) | When using sync option -> Yes, else no.
`sync:dest` | Destination path (from deploy path) | When using sync option -> Yes, else no.
