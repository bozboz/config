# Config

## Installation

1. `composer require bozboz/config`
2. Add service provider to app/config.php `Bozboz\Config\Providers\SiteConfig::class,`
3. Publish vendor migrations `php artisan vendor:publish`
4. Migrate `php artisan migrate`

## Usage

`app('siteConfig')->get('<alias>')`

`Bozboz\Config\Config` can be injected as a dependency

All views have access to a `$config` variable. Can be used like: `{{ $config->get('<alias>') }}`

Fetch a collection of all config belonging to a tag: `$config->tag('<tag>')`
