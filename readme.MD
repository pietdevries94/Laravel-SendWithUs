Laravel SendWithUs
===============

This repository is derived from [Laravel-Dropbox by Graham Campbell](https://github.com/GrahamCampbell/Laravel-Dropbox)

## Installation

Checkout the repository to a folder and manually update your require block:

```json
{
    "require": {
        "compenda/sendwithus": "^3.0"
    }
}
```
Append the following to the end of the composer file (before the closing `}`):

Once Laravel SendWithUs is installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

* `'Compenda\SendWithUs\SendWithUsServiceProvider'`

You can register the SendWithUs facade in the `aliases` key of your `config/app.php` file if you like.

* `'SendWithUs' => 'Compenda\SendWithUs\Facades\SendWithUs'`


## Configuration

Laravel Dropbox requires connection configuration.

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

To be written.

[Check the base package for more information on how to use this package](https://github.com/sendwithus/sendwithus_php)
