# Ivision Base Wordpress Theme

## Project setup

1. Prepare a virtual host for the project
2. Prepare a clean MySQL database
3. Clone the repository
4. Run `composer install`
5. Run `npm install` or `yarn install`
6. Install Wordpress in the browser

## Project configuration

1. Change theme directory name `content/themes/[theme]`
2. Change theme name in `content/themes/[theme]/style.css`
3. Change theme name in `gruntfile.js` 
```
project: {
    app: 'content/themes/[theme]'
}
```
4. Change theme name in `wp-config.php`
```
/**
 * Default theme name.
 */
define( 'WP_DEFAULT_THEME', 'theme' );
```
5. Configure `composer.json` (change names, add plugins, setup specific versions)
6. Configure `package.json` (change names, add plugins, update versions)


### Building CSS & JS

1. Modify files in `content/theme/[theme]/assets`
2. Quick build for development - run `grunt`
3. Build for production - run `grunt ivn:build`