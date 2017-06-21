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