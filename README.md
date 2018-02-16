# Laravel Facebook

[![Build Status](https://img.shields.io/travis/faustbrian/Laravel-Facebook/master.svg?style=flat-square)](https://travis-ci.org/faustbrian/Laravel-Facebook)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/faustbrian/laravel-facebook.svg?style=flat-square)]()
[![Latest Version](https://img.shields.io/github/release/faustbrian/Laravel-Facebook.svg?style=flat-square)](https://github.com/faustbrian/Laravel-Facebook/releases)
[![License](https://img.shields.io/packagist/l/faustbrian/Laravel-Facebook.svg?style=flat-square)](https://packagist.org/packages/faustbrian/Laravel-Facebook)

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

``` bash
$ composer require faustbrian/laravel-facebook
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

If you discover a security vulnerability within this package, please send an e-mail to hello@brianfaust.me. All security vulnerabilities will be promptly addressed.

## Credits

- [Brian Faust](https://github.com/faustbrian)
- [All Contributors](../../contributors)

## License

[MIT](LICENSE) © [Brian Faust](https://brianfaust.me)
