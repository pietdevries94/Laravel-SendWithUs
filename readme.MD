Laravel SendWithUs
===============

A package to use [sendwithus_php](https://github.com/sendwithus/sendwithus_php) with [Laravel 5](https://laravel.com)

This repository is derived from [Laravel-Dropbox by Graham Campbell](https://github.com/GrahamCampbell/Laravel-Dropbox)

## Installation

Either [PHP](https://php.net/) 5.5+ or [HHVM](http://hhvm.com/) 3.6+ are required.

To get the latest version of Laravel SendWithUs, simply require the project using [Composer](https://getcomposer.org/):

```
$ composer require compenda/sendwithus
```

Instead, you may of course manually update your require block and run composer update if you so choose:

```json
{
    "require": {
        "compenda/sendwithus": "^0.1.0"
    }
}
```

Once Laravel SendWithUs is installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

* `'Compenda\SendWithUs\SendWithUsServiceProvider'`

You can register the SendWithUs facade in the `aliases` key of your `config/app.php` file if you like.

* `'SendWithUs' => 'Compenda\SendWithUs\Facades\SendWithUs'`


## Configuration

Laravel Sendwithus requires connection configuration.

To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish
```

This will create a `config/sendwithus.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

There are two config options:

##### Default Connection Name

This option (`'default'`) is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `'main'`.

##### SendWithUs Connections

This option (`'connections'`) is where each of the connections are setup for your application. Example configuration has been included, but you may add as many connections as you would like.


## Usage

##### SendWithUsManager

This is the class of most interest. It is bound to the ioc container as `'sendwithus'` and can be accessed using the `Facades\SendWithUs` facade. This class implements the `ManagerInterface` by extending `AbstractManager`. The interface and abstract class are both part of my [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package, so you may want to go and checkout the docs for how to use the manager class over at [that repo](https://github.com/GrahamCampbell/Laravel-Manager#usage). Note that the connection class returned will always be an instance of `\sendwithus\API`.

##### Facades\SendWithUs

This facade will dynamically pass static method calls to the `'sendwithus'` object in the ioc container which by default is the `SendWithUsManager` class.

##### SendWithUsServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

##### Real Examples

Here you can see an example of just how simple this package is to use. Out of the box, the default adapter is `main`. After you enter your authentication details in the config file, it will just work:

```php
use Compenda\SendWithUs\Facades\SendWithUs;
// you can alias this in config/app.php if you like

$emails = SendWithUs::emails();
// we're done here - how easy was that, it just works!

$segments = SendWithUs::get_segments();
// this example is simple, and there are far more methods available
```

The sendwithus manager will behave like it is a `\sendwithus\API` class. If you want to call specific connections, you can do with the `connection` method:

```php
use Compenda\SendWithUs\Facades\SendWithUs;

// the alternative connection is the other example provided in the default config
// let's create a copy ref so we can copy a file to the main connection
$emails = SendWithUs::connection('alternative')->emails();
```

With that in mind, note that:

```php
use Compenda\SendWithUs\Facades\SendWithUs;

// writing this:
$emails = SendWithUs::connection('main')->emails();

// is identical to writing this:
$emails = SendWithUs::emails();

// and is also identical to writing this:
$emails = SendWithUs::connection('main')->emails();

// this is because the main connection is configured to be the default
SendWithUs::getDefaultConnection(); // this will return main

// we can change the default connection
SendWithUs::setDefaultConnection('alternative'); // the default is now alternative
```

If you prefer to use dependency injection over facades, then you can easily inject the manager like so:

```php
use Compenda\SendWithUs\SendWithUsManager;
use Illuminate\Support\Facades\App; // you probably have this aliased already

class Foo
{
    protected $sendwithus;

    public function __construct(SendWithUsManager $sendwithus)
    {
        $this->sendwithus = $sendwithus;
    }

    public function bar()
    {
        return $this->sendwithus->emails();
    }
}

App::make('Foo')->bar();
```

For more information on how to use the `\sendwithus\API` class we are calling behind the scenes here, check out the repository at https://github.com/sendwithus/sendwithus_php, and the manager class at https://github.com/GrahamCampbell/Laravel-Manager#usage.

##### Further Information

There are other classes in this package that are not documented here. This is because they are not intended for public use and are used internally by this package.


## License

Laravel-SendWithUs is licensed under [The MIT License (MIT)](LICENSE).
