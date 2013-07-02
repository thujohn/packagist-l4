# Packagist

Packagist API for Laravel 4

[![Build Status](https://travis-ci.org/thujohn/packagist-l4.png?branch=master)](https://travis-ci.org/thujohn/packagist-l4)


## Installation

Add `thujohn/packagist` to `composer.json`.

    "thujohn/packagist": "dev-master"
    
Run `composer update` to pull down the latest version of Packagist.

Now open up `app/config/app.php` and add the service provider to your `providers` array.

    'providers' => array(
        'Thujohn\Packagist\PackagistServiceProvider',
    )

Now add the alias.

    'aliases' => array(
        'Packagist' => 'Thujohn\Packagist\PackagistFacade',
    )


## Examples

Search a package
The second parameter enable/disable the pagination

	Route::get('/', function()
	{
		return Packagist::search(array('q' => 'laravel'), false);
	});

Get a package

	Route::get('/', function()
	{
		return Packagist::package('thujohn/packagist');
	});

Get all packages

	Route::get('/', function()
	{
		return Packagist::packages();
	});