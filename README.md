#  Evaluation Test App

## Requirements

The minimum requirement by this project is
 - PHP 5.6.0.0
 - Node.js 6.0

### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project using the following command:

~~~
composer global require "fxp/composer-asset-plugin:~1.1.1"
composer install
~~~

## Virtual Host Setup

*Windows*
[Link 1](http://foundationphp.com/tutorials/apache_vhosts.php)
[Link 2](https://www.kristengrote.com/blog/articles/how-to-set-up-virtual-hosts-using-wamp)

*Mac*
[Link 1](http://coolestguidesontheplanet.com/set-virtual-hosts-apache-mac-osx-10-9-mavericks-osx-10-8-mountain-lion/)
[Link 2](http://coolestguidesontheplanet.com/set-virtual-hosts-apache-mac-osx-10-10-yosemite/)

*Debian Linux*
[Link 1](https://www.digitalocean.com/community/tutorials/how-to-set-up-apache-virtual-hosts-on-ubuntu-14-04-lts)
[Link 2](http://www.unixmen.com/setup-apache-virtual-hosts-on-ubuntu-15-04/)

Sample Virtual Host Config for Apache
```apache
<VirtualHost *:80>
    ServerAdmin admin@example.com
    DocumentRoot "<WebServer Root Dir>/evaluation-app/app/web"
    ServerName local.evaluation-app.com
    <Directory <WebServer Root Dir>/evaluation-app/app/web>
       AllowOverride all
       Options -MultiViews
      Require all granted
    </Directory>
</VirtualHost>
```

**Modify Hosts File**

Add the following line to your hosts file

`127.0.0.1   local.evaluation-app.com`


**Restart your WebServer**

## Setup Environment Variables
Make a copy of `.env.sample` to `.env` in the env directory.


## Install Node.js, NPM and Bower

If you don't have Node.js installed, please go ahead and grab it [here](https://nodejs.org/). NPM is the package manager for Node.js and comes bundled with Node.js

To confirm that you have Node.js installed, run the following in your terminal:
```bash
node -v
```
You should get something like `v6.9.1`.

To confirm that you have NPM installed, run the following in your terminal:
```bash
npm -v
```
You should get something like `3.10.9`.

To install Bower, simply run the following in your terminal:
```bash
npm install -g bower
```
To confirm that you have Bower installed, you can simply run `bower -v` in your terminal and it should return something like `1.7.9`.

### Install Node.js and Bower Modules
```bash
npm install
bower install
```

## Credits
- Akinwunmi Taiwo <akinwunmi49@gmail.com>
- [All Contributors](https://github.com/CottaCush/yii2-base-template/graphs/contributors)

