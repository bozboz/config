# Config

## Installation

1. `composer install bozboz/config`
2. Add service provider to `app/config.php`
    `Bozboz\Config\Providers\SiteConfig::class,`
3. Publish vendor migrations `php artisan vendor:publish`
4. Migrate `php artisan migrate`

## Usage

`app('siteConfig')->get('<alias>')`

All views have access to a `$config` variable. Can be used like: `{{ $config->get('<alias>')`