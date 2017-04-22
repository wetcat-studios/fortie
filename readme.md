[![Build Status](https://travis-ci.org/wetcat-studios/fortie.svg)](https://travis-ci.org/wetcat-studios/fortie)

# Fortie

A simple [Fortnox](https://www.fortnox.se/) PHP package, including Laravel Service Provider for easy integration in Laravel.

## Installation

The easiest way to install this package is through Composer.

```
composer require wetcat/fortie dev-master
```

Or add `"wetcat/fortie": "dev-master"` to your `composer.json`.

If you don't have Composer you should [install it](https://getcomposer.org/download/).

## Configuration

In Laravel you can publish the config file with `php artisan vendor:publish --provider="Wetcat\Fortie\FortieServiceProvider" --tag="config"`, after this the file should be available in `app/fortie.php`. Use the details provided by Fortnox when you signed up.

The **Access Token** is not provided when signing up, you need to get that seperately using your **Auth Code** and **Client Secret**. Read more about this process [here](http://developer.fortnox.se/documentation/general/authentication/).

The configruation file should look something like this:

```php
<?php 

return [

  'default' => [

    // Your specific access token
    'access_token'   => '<your access token>',

    // Your specific client secret
    'client_secret'  => '<your client secret>',

    // The type you're sending
    'content_type'   => 'application/json',

    // The type you're accepting as response
    'accepts'        => 'application/json', 

    // The URL to the Fortnox API
    'endpoint'       => 'https://api.fortnox.se/3/',

  ],

];
```

Note that XML is not fully supported yet, the package can read and will attempt to translate the responses from Fortnox into XML structures, but when sending data to Fortnox it will always send in json.

## Usage

### Laravel

In laravel the easiest way to use Fortie is to add the ServiceProvider, in `config/app.php` add the following line to `providers` array.

```php
<?php

return [
    
    ...

    'providers' => [

        ...

        Wetcat\Fortie\FortieServiceProvider::class,

    ],

    ...

];

```

When you've included the Service Provider you can then use dependency injection in your BaseController to make fortie available in all controllers.

```php

[...]

use Wetcat\Fortie\Fortie;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $fortie;

    public function __construct(Fortie $fortie)
    {
        $this->fortie = $fortie;
    }

}
```

Just call `$this->fortie->...` to access Fortie.

```php

class MyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd($this->fortie->accounts()->all());
    }

    ...

}
```

Of course you can also inject Fortie into any Laravel controller method to limit application wide access to Fortnox.

```php

[...]

use Wetcat\Fortie\Fortie;

class MyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Fortie $fortie)
    {
        dd($fortie->accounts()->all());
    }

    ...

}
```

### Non-laravel

In Laravel the ServiceProvider takes care of setting up Fortie using the configuration file, if used outside of Laravel you need to instantiate Fortie using the configuration provided by Fortnox.

```php
$fortie = new Fortie(
    $endpoint,
    $access_token,
    $client_secret,
    $content_type,
    $accepts
);
```

### Access tokens

To get an access token (for use with your integration) you need to request it using a `authroization-code`.

In Laravel you can use the Artisan command to easily get the access token.

```
php artisan fortie:activate code=<your authorization code>
```

### Providers

The package is set up with multiple providers, each provider is mapped towards a specific endpoint in the REST api. For example **accounts** are mapped to the **accounts()** method.

```php
$arrayOfAccounts = $fortie->accounts()->all();
```

For details on the usage of all providers you should consult [the Wiki](https://github.com/wetcat-studios/fortie/wiki).

#### Currently implemented providers

* Accounts
* Archive (Needs to be verified)
* Articles
* Company Settings
* Contracts
* Currencies
* Customers
* Employees (Needs to be verified)
* Financial years
* Invoices
* Offers
* Orders
* Price lists
* Prices
* Projects
* Suppliers
* Units
* Vouchers

#### Not implemented yet

* Article File Connections
* Article URL Connections
* Contract Accruals
* Contract Templates
* Cost Centres
* Inbox
* Invoice accruals
* Invoice payments
* Locked period
* Modes of payment
* Print templates
* Supplier Invoice Accruals
* Supplier Invoice External URL connections
* Supplier Invoice File Connections
* Supplier Invoice Payments
* Supplier Invoices
* Tax reductions
* Terms of Deliveries
* Terms of payments
* Voucher File Connections
* Voucher Series
* Way of Deliveries

## Dependencies

This package is built with the following dependencies.

* [Guzzle](https://github.com/guzzle/guzzle)
* [sabre/xml](https://github.com/fruux/sabre-xml)

## License

Copyright 2015 Andreas Göransson

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.