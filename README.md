# Pineapple
## _Magebit Junior Dev application task_
MVC application with single form as email subscription & data output page with filtering and search options.
Languages contained - HTML - CSS/SASS - JS - PHP - MySQL
---

_This instance is powered by:_

- MySQL 8
- PHP 8
- Apache2
---
## Installation
---

- Clone repository to htdocs of webserver
- Do some configuration (step by step listed below)
- Create database & import sql dump (attached in repository)


Web application main config file location 
```
 .approot. /app/config/config.php
 ```
> Database params
```
// DB Params
define('DB_HOST', 'YOUR_DATABASE_HOST');
define('DB_USER', 'YOUR_DATABASE_USER');
define('DB_PASS', 'YOUR_DATABASE_PASSWORD');
define('DB_NAME', 'YOUR_DATABASE_NAME');
```

> Site URL & Site Name
```
// URL Root
define('URLROOT', 'YOURSITE.COM');
// Site Name
define('SITENAME', 'YOUR_SITE_NAME');
```

> Apache config -> /etc/apache2/apache2.conf
```sh
// Locate this row and edit so it matches
<Directory />
        Options FollowSymLinks
        AllowOverride All
        Require all granted
</Directory>

<Directory /usr/share>
        AllowOverride All
        Require all granted
</Directory>

<Directory /var/www/>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
</Directory>

// Enabling .htaccess file
<FilesMatch "^\.ht">
        Require all granted
</FilesMatch>

// Define php handler 
<FilesMatch "^\.php$">
SetHandler application/x-httpd-php
</FilesMatch>


```
>Apache virtualhost -> /etc/apache2/sites-available/000-default.conf
For this instance didn't change default virtual host, if needed You can add new file and disable default one.
```sh
    // Add this or edit so it matches Your application root
        ServerName YOURSITE.COM
        DocumentRoot /var/www/html

        <Directory /var/www/html>
                Options -Indexes +FollowSymLinks
                AllowOverride All
        </Directory>

```
> Make sure mod_rewrite module is enabled 
```sh
$ sudo a2enmod rewrite
```
-------------
## Pages
---
    Main page - SITEURL/
    Database output table - SITEURL/emails



