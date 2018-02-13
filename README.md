# Releaz Yii2 Advanced Template

This project contains the sources of a custom Yii2 Advanced Template. In default this 
template has deploy and development support. 

- For development it contains easy readable config support. (`config.yml`) Please 
read below for more information.
- For deployment it is using an customized Deployer instance. Please visit the following links 
for more information: 
    - [Packagist](https://packagist.org/packages/releaz/deployer)
    - [Github](https://github.com/johankladder/releaz-deployer)
    - [Dutch documentation](https://johankladder.github.io/releaz-deployer/) 

## Maintainable and readable configuration:

This project contains config files that are created upon initialisation of the application. 
Please use these configuration files to determine 'params' or 'locals'. In default you're 
able to set main-local content via the config file.

The config files are created to make configuration more readable and dynamic. It's easy to fill
in and its customizable per environment.


## Supported environments:
- Develop
- Production
- Acceptance (Production with debug errors on)

## Development:
When developing inside this application, please use `php init` to make sure you are in the development environment. When done, the `common/config/config.yml` needs to be created. This file can be duplicated from the .example file and adapted to your needs.
- When adding more configs to the above file, please make sure you also do this in the `environment/[stage]/common/config/config.yml.example` to ensure every body else in your team has an new example to base their configs on.

### Migrations
Run the first migration to create the user table:
```
php yii migrate
```

Run the rbac migrations:
```
php yii migrate --migrationPath=@yii/rbac/migrations/
```
### Initialize Rbac
Use the RbacController in console/controllers to create the guest and admin roles including the user 'admin' with password 'asdasd':
```
php yii rbac/init
```

## Deployment:
Deploying is done in with the help of [Deployer](https://github.com/deployphp/deployer). To make use of it, use it from the vendor folder after composer installed all the dependencies. Also define an `deploy-config.yml` file in the root of the project. This file can be duplicated from the `deploy-config.yml.example` and adapted  to your needs.
