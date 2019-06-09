# Laravel Facebook

[![Build Status](https://img.shields.io/travis/artisanry/Facebook/master.svg?style=flat-square)](https://travis-ci.org/artisanry/Facebook)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/artisanry/facebook.svg?style=flat-square)]()
[![Latest Version](https://img.shields.io/github/release/artisanry/Facebook.svg?style=flat-square)](https://github.com/artisanry/Facebook/releases)
[![License](https://img.shields.io/packagist/l/artisanry/Facebook.svg?style=flat-square)](https://packagist.org/packages/artisanry/Facebook)

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

``` bash
$ composer require artisanry/facebook
```

## Usage

``` php
Route::get('/facebook', function (Request $request) {
    $facebook = Facebook::create([
        'clientId' => 'your-client-id',
        'clientSecret' => 'your-client-secret',
        'redirectUri' => 'https://homestead.app/facebook',
    ]);

    try {
        $response = $facebook->authorize($request);

        if (is_string($response)) {
            return redirect($response);
        }

        dd($facebook->getUser());
    } catch (Exception $e) {
        dd('Error: '. $e->getMessage());
    }
});
```

## Testing

``` bash
$ phpunit
```

## Security

If you discover a security vulnerability within this package, please send an e-mail to hello@basecode.sh. All security vulnerabilities will be promptly addressed.

## Credits

This project exists thanks to all the people who [contribute](../../contributors).

## License

Mozilla Public License Version 2.0 ([MPL-2.0](./LICENSE)).
