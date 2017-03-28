
[![Build Status](https://travis-ci.org/johankladder/yii2-app-advanced.svg?branch=master)](https://travis-ci.org/johankladder/yii2-app-advanced)
[![Code Climate](https://codeclimate.com/github/johankladder/yii2-app-advanced/badges/gpa.svg)](https://codeclimate.com/github/johankladder/yii2-app-advanced)

Custom Yii 2 Advanced Project Template
======================================

This template contains the sources of the Yii2 Advance Project Template with a custom touch. Added functionality:
- Deployment; Custom Deployer tasks to ease deployment of the application.
- Config handling; No more local specific files in the repository, even deployment secrets aren't pushed

## Development:
When developing inside this application, please use `php init` to make sure you are in the development environment. When done, the `common/config/config.yml` needs to be created. This file can be duplicated from the .example file and adapted to your needs.
- When adding more configs to the above file, please make sure you also do this in the `environment/[stage]/common/config/config.yml.example` to ensure every body else in your team has an new example to base their configs on.

## Deployment:
Deploying is done in with the help of [Deployer](https://github.com/deployphp/deployer). To make use of it, use it from the vendor folder after composer installed all the dependencies. Also define an `deploy-config.yml` file in the root of the project. This file can be duplicated from the `deploy-config.yml.example` and adapted  to your needs.

### Explanation:
```yaml
general:
  ssh_repo_url: 'git@github.com:johankladder/yii2-app-advanced.git'
server:
  production:
    host: 'applicationname.com'
    stage: 'production'
    branch: 'master'
    deploy_path: '/var/www/applicationname.com'
    ssh_user: 'username'
  development:
    host: 'dev.applicationname.com'
    stage: 'development'
    branch: 'develop'
    deploy_path: '/var/www/dev.applicationname.com'
    ssh_user: 'username'
  custom:
    host: 'localhost'
    stage: 'test'
    branch: 'develop'
    deploy_path: '/var/www/test.local'
    ssh_user: 'johankladder'
```

In the server section you can add different amount of stages. The keys that are given, are not used by Deployer. Explanation:

Key | Explanation
--- | --- |
`host:` | The server host address (Where should the stage be deployed to)
`stage:` | The name of the stage. (This stage name can be used when using `dep deploy [stagename]`)
`branch:` | The branch that the stage contains. (This is the branch that will be pulled on the remote server)
`deploy_path:` | The path where the sources should be pulled on the remote server. (Should always be absolute)
`ssh_user:` | The user that is needed for logging in at the remote server.

### Passwords
Mentioned that no passwords are asked to login with SSH? The module is using forward-agent. To ensure your user has access to the remote server with forward-agent and no passwords are asked:
  - Try `ssh-add -L` to see if your public key is added to the agent. If not run: `ssh-add`
  - Copy your public key to the remote server's known-hosts with `ssh-copy-id remoteusername@remotehost`
  - Try `ssh remoteuser@remotehost`. Now no password should be asked as it is inside your agent.







--------------------------------------

## Yii 2 Advanced Project Template

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-app-advanced/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-app-advanced/downloads.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-advanced.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-advanced)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
