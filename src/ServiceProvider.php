<?php

namespace Jeylabs\Laravel\DropboxDriver;

use Storage;
use League\Flysystem\Filesystem;
use Dropbox\Client as DropboxClient;
use League\Flysystem\Dropbox\DropboxAdapter;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('dropbox', function ($app, $config) {
            return new Filesystem(
                new DropboxAdapter(
                    new DropboxClient($config['token'], $config['secret']),
                    $this->generatePrefix($config)
                )
            );
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function generatePrefix($config)
    {
        $appUrl = $config['app_url'];
        $prefix = $config['prefix'];
        $prefixPath = $this->trimSlash($prefix);
        if ($appUrl){
            $urlPrfix = $this->removeHttp($appUrl);
            $pathPrefix = $this->trimSlash($prefix);
            $prefixPath = $urlPrfix.$pathPrefix;
        }
        return $prefixPath;
    }

    private function removeHttp($url) {
        $domain =  str_replace(array('http://','https://'), '', $url).'/';
        return $this->trimSlash($domain);
    }

    private function trimSlash($link){
        return trim( $link, "/" ).'/';
    }
}
