accountancy [![Build Status](https://travis-ci.org/adrozdenko/accountancy.png?branch=master)](https://travis-ci.org/adrozdenko/accountancy)
===========

App for home accountancy 


Installing
----------
```bash
$ git clone https://github.com/adrozdenko/accountancy.git
$ cd accountancy
$ composer install
```

Before Check-In
---------------
Run Behat
```bash
$ bin/behat --ansi
```
Run phpunit
```bash
$ bin/phpunit
```
Run phpcs
```bash
$ bin/phpcs src/ test/src/ --standard=vendor/instaclick/symfony2-coding-standard/Symfony2/
```
