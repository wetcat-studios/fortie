[![Build Status](https://travis-ci.org/wetcat-studios/fortie.svg)](https://travis-ci.org/wetcat-studios/fortie)

# Fortie

A simple [Fortnox](https://www.fortnox.se/) PHP package, including Laravel Service Providers.

## Installation

The easiest way to install this package is through Composer.

```
composer require wetcat/fortie dev-master
```

Or add `"wetcat/fortie": "dev-master"` to your `composer.json`.

If you don't have Composer you should [install it](https://getcomposer.org/download/).

## Configure

Todo

## Usage

Each Fortnox provider is registered as a chainable method within the Fortnox object, to access a provider you would call its method and then call the needed method on that provider.

To get a list of the available accounts in your Fortnox user you would call:

```php
$accounts = $fortie->accounts()->listAllAccounts();
```

To create a new object in Fortnox you would also need to supply an array with the data you want to save. Each provider knows what is acceptable (readable and writeable) and will perform some simple sanitizing on your array to remove illegal keys. You should however always consult the [Fortnox developer documentation](http://developer.fortnox.se/documentation/) to understand what is legal data.

If you want to create a new account in your Fortnox user you would call:

```php
$params = [
  'Number' => 6666,
  'Description' => 'Goodwill'
];
$account = $fortie->accounts()->createAccount($params);
```

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