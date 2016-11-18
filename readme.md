Ad Server Application [![Build Status](https://travis-ci.org/Seldar/adserver.svg?branch=master)](https://travis-ci.org/Seldar/adserver) [![codecov.io](http://codecov.io/github/Seldar/adserver/coverage.svg?branch=master)](http://codecov.io/github/Seldar/adserver?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Seldar/adserver/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Seldar/adserver/?branch=master)
========================================================================================================================================================================================================================================================================================

The "Ad Server Application" is an application which enables CRUD operations to be executed on Banners and Campaigns, and ultimetly serves banners to publishers. 

Requirements
------------

  * PHP ^5.3;
  * [PHPUnit ^5.6](https://github.com/sebastianbergmann/phpunit)
  * [DbUnit ^1.2](https://github.com/sebastianbergmann/dbunit).
  * [Doctrine2](https://github.com/doctrine/doctrine2) 

Installation
------------


Install using composer:

```bash
$ composer install
```

Create Database scheme using doctrine:

```bash
$ vendor/bin/doctrine orm:schema-tool:create
```

Usage
-----

After installation point your browser to root directory. UnitTests can be run on src/Tests/ folder.