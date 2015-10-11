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

use Wetcat\Fortie\Providers\Accounts\Provider as AccountProvider;
use Wetcat\Fortie\Providers\Archive\Provider as ArchiveProvider;
use Wetcat\Fortie\Providers\Articles\Provider as ArticleProvider;
use Wetcat\Fortie\Providers\CompanySettings\Provider as CompanySettingsProvider;
use Wetcat\Fortie\Providers\Contracts\Provider as ContractProvider;
use Wetcat\Fortie\Providers\Invoices\Provider as InvoiceProvider;
use Wetcat\Fortie\Providers\Customers\Provider as CustomerProvider;
use Wetcat\Fortie\Providers\Currencies\Provider as CurrencyProvider;
use Wetcat\Fortie\Providers\Orders\Provider as OrderProvider;
use Wetcat\Fortie\Providers\PriceLists\Provider as PriceListProvider;
use Wetcat\Fortie\Providers\Prices\Provider as PriceProvider;
use Wetcat\Fortie\Providers\Projects\Provider as ProjectProvider;
use Wetcat\Fortie\Providers\Suppliers\Provider as SupplierProvider;
use Wetcat\Fortie\Providers\Units\Provider as UnitProvider;
use Wetcat\Fortie\Providers\Vouchers\Provider as VoucherProvider;

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
   * Provides access to archives endpoints.
   */
  protected $archiveProvider;

  /**
   * Provides access to article endpoints.
   */
  protected $articleProvider;

  /**
   * Provides access to the company settings endpoint. This is read-only.
   */
  protected $companySettingsProvider;

  /**
   * Provides access to the contracts endpoint.
   */
  protected $contractProvider;

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
   * Provides access to price lists.
   */
  protected $priceListProvider;

  /**
   * Provides access to prices.
   */
  protected $priceProvider;

  /**
   * Provides access to projects.
   */
  protected $projectProvider;

  /**
   * Provides access to suppliers.
   */
  protected $supplierProvider;

  /**
   * Provides access to units.
   */
  protected $unitProvider;

  /**
   * Provides access to vouchers.
   */
  protected $voucherProvider;


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
    $this->archiveProvider = new ArchiveProvider($client);
    $this->articleProvider = new ArticleProvider($client);
    $this->companySettingsProvider = new CompanySettingsProvider($client);
    $this->contracts = new ContractProvider($client);
    $this->invoiceProvider = new InvoiceProvider($client);
    $this->customerProvider = new CustomerProvider($client);
    $this->currencyProvider = new CurrencyProvider($client);
    $this->orderProvider = new OrderProvider($client);
    $this->priceListProvider = new PriceListProvider($client);
    $this->priceProvider = new PriceProvider($client);
    $this->projectProvider = new ProjectProvider($client);
    $this->supplierProvider = new SupplierProvider($client);
    $this->unitProvider = new UnitProvider($client);
    $this->voucherProvider = new VoucherProvider($client);
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
   * Get the archive provider.
   *
   * @return ArchiveProvider
   */
  public function archive ()
  {
    return $this->archiveProvider; }


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
   * Get the contracts provider.
   *
   * @return ContractProvider
   */
  public function contracts ()
  {
    return $this->contractProvider;
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


  /**
   * Get the price lists provider.
   *
   * @return PriceListProvider
   */
  public function priceLists ()
  {
    return $this->priceListProvider;
  }


  /**
   * Get the price provider.
   *
   * @return PriceProvider
   */
  public function prices ()
  {
    return $this->priceProvider;
  }


  /**
   * Get the project provider.
   *
   * @return ProjectProvider
   */
  public function projects ()
  {
    return $this->projectProvider;
  }


  /**
   * Get the supplier provider.
   *
   * @return SupplierProvider
   */
  public function projects ()
  {
    return $this->supplierProvider;
  }


  /**
   * Get the supplier provider.
   *
   * @return SupplierProvider
   */
  public function units ()
  {
    return $this->unitProvider;
  }


  /**
   * Get the voucher provider.
   *
   * @return VoucherProvider
   */
  public function vouchers ()
  {
    return $this->voucherProvider;
  }

}
