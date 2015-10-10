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

In Laravel you change use the published configuration file found at `config/fortie.php`, it should look something like the following. Fill this in with the details provided by Fortnox when you signed up.

The **Access Token** is not provided when signing up, you need to get that seperately using your **Auth Code** and **Client Secret**. Read more about this process [here](http://developer.fortnox.se/documentation/general/authentication/).

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

### Configuration

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
* Articles
* Company Settings
* Currencies
* Customers
* Invoices
* Orders
* Price lists
* Prices
* Projects

#### Not implemented yet

* Archive
* Article File Connections
* Article URL Connections
* Contract Accruals
* Contract Templates
* Contracts
* Cost Centres
* Financial years
* Inbox
* Invoice accruals
* Invoice payments
* Locked period
* Modes of payment
* Offers
* Print templates
* Supplier Invoice Accruals
* Supplier Invoice External URL connections
* Supplier Invoice File Connections
* Supplier Invoice Payments
* Supplier Invoices
* Suppliers
* Tax reductions
* Terms of Deliveries
* Terms of payments
* Units
* Voucher File Connections
* Voucher Series
* Vouchers
* Way of Deliveries

## Dependencies

This package is built with the following dependencies.

* [Guzzle](https://github.com/guzzle/guzzle)
* [sabre/xml](https://github.com/fruux/sabre-xml)

## License

Copyright [2015] [Andreas Göransson]

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.