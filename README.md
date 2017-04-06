
# Laravel Dropbox Driver

Dropbox storage driver for Laravel.

## Installation

```php
composer require jeylabs/laravel-dropbox-storage-driver
```

## Usage

In your ```config/app.php```, add the service provider:

```php
'providers' => [

    Jeylabs\Laravel\DropboxDriver\ServiceProvider::class,

],
```

Next, add the following in ```app/filesystems.php```:
```php
'disks' => [

    'dropbox' => [
        'driver' => 'dropbox',
        'app_secret' => env('DROPBOX_APP_SECRET'),
        'token' => env('DROPBOX_TOKEN'),
    ],

],
```

Then, in your ```.env``` file:
```
DROPBOX_APP_SECRET=your_app_secret_key
DROPBOX_TOKEN=your_access_token
```

**Dealing with Dropbox for the first time? Here's the [link](https://www.dropbox.com/developers/apps/create) to create your first application and generate your app secret key and access token.**

## License

[MIT](https://opensource.org/licenses/MIT)
