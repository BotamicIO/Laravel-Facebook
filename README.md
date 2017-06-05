# Laravel Facebook

I would appreciate you taking the time to look at my [Patreon](https://www.patreon.com/faustbrian) and considering to support me if I'm saving you some time with my work.

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

If you discover a security vulnerability within this package, please send an e-mail to Brian Faust at hello@brianfaust.de. All security vulnerabilities will be promptly addressed.

## Credits

- [Brian Faust](https://github.com/faustbrian)
- [All Contributors](../../contributors)

## License

[MIT](LICENSE) © [Brian Faust](https://brianfaust.de)
