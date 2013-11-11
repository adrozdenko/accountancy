accountancy [![Build Status](https://travis-ci.org/adrozdenko/accountancy.png?branch=master)](https://travis-ci.org/adrozdenko/accountancy)
===========

App for home accountancy 


Installing
----------
```bash
$ git clone https://github.com/adrozdenko/accountancy.git
$ cd accountancy
$ php bin/composer.phar install
```

Before Check-In
---------------
Run Behat
```bash
$ bin/behat --ansi
```
Run phpcs
```bash
$ bin/phpcs src/ --standard=vendor/instaclick/symfony2-coding-standard/Symfony2/
```
