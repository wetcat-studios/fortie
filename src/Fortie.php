<?php namespace Wetcat\Fortie;

/*

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

*/

use Wetcat\Fortie\Accounts\Provider as AccountProvider;
use Wetcat\Fortie\Articles\Provider as ArticleProvider;
use Wetcat\Fortie\CompanySettings\Provider as CompanySettingsProvider;
use Wetcat\Fortie\Invoices\Provider as InvoiceProvider;
use Wetcat\Fortie\Customers\Provider as CustomerProvider;
use Wetcat\Fortie\Currencies\Provider as CurrencyProvider;
use Wetcat\Fortie\Orders\Provider as OrderProvider;

/**
 * Starting point for all interactions with the Fortnox API. After
 * setting this class up it will automatically register all the 
 * providers.
 */
class Fortie
{

  /**
   * The Account provider provides access to all the account endpoints.
   */
  protected $accountProvider;

  /**
   * Provides access to article endpoints.
   */
  protected $articleProvider;

  /**
   * Provides access to the company settings endpoint. This is read-only.
   */
  protected $companySettingsProvider;

  /**
   * Provides access to invoices actions and endpoints.
   */
  protected $invoiceProvider;

  /**
   * Provides access to customer endpoints.
   */
  protected $customerProvider;

  /**
   * Provides access to currencies.
   */
  protected $currencyProvider;

  /**
   * Provides access to orders.
   */
  protected $orderProvider;


  /**
   * Create a new Neo object.
   */
  public function __construct(
    $endpoint,
    $access_token,
    $client_secret,
    $content_type,
    $accepts
  ) {
    // Set up Guzzle client
    $client = new \GuzzleHttp\Client([
      'base_uri'  => $endpoint,
      'headers'   => [
        'Access-Token'  => $access_token,
        'Client-Secret' => $client_secret,
        'Content-Type'  => $content_type,
        'Accept'        => $accepts
      ],
      'timeout'   => 3.0,
    ]);

    // Set up providers
    $this->accountProvider = new AccountProvider($client);
    $this->articleProvider = new ArticleProvider($client);
    $this->companySettingsProvider = new CompanySettingsProvider($client);
    $this->invoiceProvider = new InvoiceProvider($client);
    $this->customerProvider = new CustomerProvider($client);
    $this->currencyProvider = new CurrencyProvider($client);
    $this->orderProvider = new OrderProvider($client);
  }


  /**
   * Get the accounts provider.
   *
   * @return AccountProvider
   */
  public function accounts ()
  {
    return $this->accountProvider;
  }


  /**
   * Get the articles provider.
   *
   * @return ArticleProvider
   */
  public function articles ()
  {
    return $this->articleProvider;
  }

  /**
   * Get the company settings provider.
   *
   * @return CompanySettingsProvider
   */
  public function companySettings ()
  {
    return $this->companySettingsProvider;
  }


  /**
   * Get the invoice provider.
   *
   * @return InvoiceProvider
   */
  public function invoices ()
  {
    return $this->invoiceProvider;
  }


  /**
   * Get the customer provider.
   *
   * @return CustomerProvider
   */
  public function customers ()
  {
    return $this->customerProvider;
  }


  /**
   * Get the currency provider.
   *
   * @return CustomerProvider
   */
  public function currencies ()
  {
    return $this->currencyProvider;
  }


  /**
   * Get the order provider.
   *
   * @return OrderProvider
   */
  public function orders ()
  {
    return $this->orderProvider;
  }

}
