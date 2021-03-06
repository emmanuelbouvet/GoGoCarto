Installation and Production Instructions
========================================

Feel free to add some more informations if you solve installation issues !

*There is a script for debian installation called install_debian.sh in this docs directory !*

Requirements
------------

1. Php
2. [Composer](https://getcomposer.org/download/) 
3. [Nodejs](https://nodejs.org/en/download/)
4. [Git](https://git-scm.com/)
5. Web Server (Apache, Ngninx, [Wamp server](http://www.wampserver.com/) ...)
6. MongoDB (http://php.net/manual/fr/mongodb.installation.php)

Installation
------------

### Cloning repo (clone dev branch)
```
cd path-to-php-server-folder (default linux /var/www/html, windows c:/wamp/www... )
git clone -b dev https://github.com/Biopen/CartoV3.git
cd CartoV3/
```

### Installing dependencies 
Php dependency (symfony, bundles...) 
```
php path-to/composer.phar install or composer install
```
*During installation, config/parameters file will be created, leave default fields*

Workflow dependencies (compiling sass and javascript)
```
npm install gulp
npm install -g gulp
npm install
```

Start
-----
Dumping assets
```
php bin/console assets:install --symlink web
```

First build of Javascript and Css
```
gulp build
```

Start watching for file change (automatic recompile)
```
gulp watch
```


Generate Database
-----------------

Go to symfony console : http://localhost/PagesVertes/web/app_dev.php/_console
```
doctrine:mongodb:schema:create
doctrine:mongodb:generate:hydrators
doctrine:mongodb:generate:proxies
doctrine:mongodb:fixtures:load
```

Load defaul admin user "admin/admin"
```
doctrine:fixtures:load
```

Then generate if necessary random point on the map :
app:elements:generate 200

Everthing is ready, enjoy :
http://localhost/PagesVertes/web/app_dev.php

Production
----------

1. Dump assetic in symfony console to update the web/templates files
```assetic:dump```

2. Generate compressed js and css files
```
gulp build
gulp production
```

3. enable gz compression in your web server

4. In the distant console (http://yoursite.com/web/app_dev.php/_console)
```
cache:clear --env=prod
```

5. Make sure that the var folder is writable ```chmod -R 771 var/```