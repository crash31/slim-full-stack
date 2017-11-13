# Full Stack Boilerplate

_ A Comprehensive Full Stack Environment built with [Slim Framework](https://www.slimframework.com/) _

A special thanks to [codeburst.io](https://codeburst.io/) for the foundation for this project's Webpack configuration, the basis for which found [here](https://codeburst.io/easy-guide-for-webpack-2-0-from-scratch-fe508a3ce44e).

## Instructions

_ A list of instruction to follow in order to set up your Full Stack Environment. _

### Install and set up project.

Clone this git repository.

Run composer to install backend dependencies. This should create a 'vendor' folder in your project directory.

  ```
  composer install
  ```

Run npm to install the frontend dependencies. This should create a 'node_modules' folder in your project directory.

  ```
  npm install
  ```

You should now be up and running and ready to start developing.



---

# Slim Framework 3 Skeleton Application

Use this skeleton application to quickly setup and start working on a new Slim Framework 3 application. This application uses the latest Slim 3 with the PHP-View template renderer. It also uses the Monolog logger.

This skeleton application was built for Composer. This makes setting up a new Slim Framework application quick and easy.

## Install the Application

Run this command from the directory in which you want to install your new Slim Framework application.

    php composer.phar create-project slim/slim-skeleton [my-app-name]

Replace `[my-app-name]` with the desired directory name for your new application. You'll want to:

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` is web writeable.

To run the application in development, you can also run this command.

	php composer.phar start

Run this command to run the test suite

	php composer.phar test

That's it! Now go build something cool.
