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

use Wetcat\Fortie\Providers\AbsenceTransactions\Provider as AbsenceTransactionsProvider;
use Wetcat\Fortie\Providers\AccountCharts\Provider as AccountChartsProvider;
use Wetcat\Fortie\Providers\Accounts\Provider as AccountsProvider;
use Wetcat\Fortie\Providers\Archive\Provider as ArchiveProvider;
use Wetcat\Fortie\Providers\ArticleFileConnections\Provider as ArticleFileConnectionsProvider;
use Wetcat\Fortie\Providers\ArticleUrlConnections\Provider as ArticleUrlConnectionsProvider;
use Wetcat\Fortie\Providers\Articles\Provider as ArticlesProvider;
use Wetcat\Fortie\Providers\AttendanceTransactions\Provider as AttendanceTransactionsProvider;
use Wetcat\Fortie\Providers\CompanySettings\Provider as CompanySettingsProvider;
use Wetcat\Fortie\Providers\ContractAccruals\Provider as ContractAccrualsProvider;
use Wetcat\Fortie\Providers\ContractTemplates\Provider as ContractTemplatesProvider;
use Wetcat\Fortie\Providers\Contracts\Provider as ContractsProvider;
use Wetcat\Fortie\Providers\CostCenters\Provider as CostCentersProvider;
use Wetcat\Fortie\Providers\Currencies\Provider as CurrenciesProvider;
use Wetcat\Fortie\Providers\Customers\Provider as CustomersProvider;
use Wetcat\Fortie\Providers\Employees\Provider as EmployeesProvider;
use Wetcat\Fortie\Providers\FinancialYears\Provider as FinancialYearsProvider;
use Wetcat\Fortie\Providers\Inbox\Provider as InboxProvider;
use Wetcat\Fortie\Providers\InvoiceAccruals\Provider as InvoiceAccrualsProvider;
use Wetcat\Fortie\Providers\InvoicePayments\Provider as InvoicePaymentsProvider;
use Wetcat\Fortie\Providers\Invoices\Provider as InvoicesProvider;
use Wetcat\Fortie\Providers\Labels\Provider as LabelsProvider;
use Wetcat\Fortie\Providers\LockedPeriod\Provider as LockedPeriodProvider;
use Wetcat\Fortie\Providers\ModesOfPayments\Provider as ModesOfPaymentsProvider;
use Wetcat\Fortie\Providers\Offers\Provider as OffersProvider;
use Wetcat\Fortie\Providers\Orders\Provider as OrdersProvider;
use Wetcat\Fortie\Providers\PredefinedAccounts\Provider as PredefinedAccountsProvider;
use Wetcat\Fortie\Providers\PredefinedVoucherSeries\Provider as PredefinedVoucherSeriesProvider;
use Wetcat\Fortie\Providers\PriceLists\Provider as PriceListsProvider;
use Wetcat\Fortie\Providers\Prices\Provider as PricesProvider;
use Wetcat\Fortie\Providers\PrintTemplates\Provider as PrintTemplatesProvider;
use Wetcat\Fortie\Providers\Projects\Provider as ProjectsProvider;
use Wetcat\Fortie\Providers\SalaryTransactions\Provider as SalaryTransactionsProvider;
use Wetcat\Fortie\Providers\ScheduleTimes\Provider as ScheduleTimesProvider;
use Wetcat\Fortie\Providers\SupplierInvoiceAccruals\Provider as SupplierInvoiceAccrualsProvider;
use Wetcat\Fortie\Providers\SupplierInvoiceExternalURLConnections\Provider as SupplierInvoiceExternalURLConnectionsProvider;
use Wetcat\Fortie\Providers\SupplierInvoiceFileConnections\Provider as SupplierInvoiceFileConnectionsProvider;
use Wetcat\Fortie\Providers\SupplierInvoicePayments\Provider as SupplierInvoicePaymentsProvider;
use Wetcat\Fortie\Providers\SupplierInvoices\Provider as SupplierInvoicesProvider;
use Wetcat\Fortie\Providers\Suppliers\Provider as SuppliersProvider;
use Wetcat\Fortie\Providers\TaxReductions\Provider as TaxReductionsProvider;
use Wetcat\Fortie\Providers\TermsOfDeliveries\Provider as TermsOfDeliveriesProvider;
use Wetcat\Fortie\Providers\TermsOfPayments\Provider as TermsOfPaymentsProvider;
use Wetcat\Fortie\Providers\TrustedEmailSenders\Provider as TrustedEmailSendersProvider;
use Wetcat\Fortie\Providers\Units\Provider as UnitsProvider;
use Wetcat\Fortie\Providers\VoucherFileConnections\Provider as VoucherFileConnectionsProvider;
use Wetcat\Fortie\Providers\VoucherSeries\Provider as VoucherSeriesProvider;
use Wetcat\Fortie\Providers\Vouchers\Provider as VouchersProvider;
use Wetcat\Fortie\Providers\WayOfDeliveries\Provider as WayOfDeliveriesProvider;

/**
 * Starting point for all interactions with the Fortnox API. After
 * setting this class up it will automatically register all the 
 * providers.
 */
class Fortie
{
  /**
   * Storage for Guzzle client
   */
  protected $client;

  /**
   * Create a new Fortie object.
   */
  public function __construct(
    $endpoint,
    $access_token,
    $client_secret,
    $content_type,
    $accepts,
    $config = []
  ) {
    // Set up Guzzle client
    $this->client = new \GuzzleHttp\Client(array_merge([
      'base_uri'  => $endpoint,
      'headers'   => [
        'Access-Token'  => $access_token,
        'Client-Secret' => $client_secret,
        'Content-Type'  => $content_type,
        'Accept'        => $accepts
      ],
      'timeout'   => 3.0,
    ], $config));
  }


  /**
   * Absence transactions
   */
  public function absenceTransactions ()
  {
    return new AbsenceTransactionsProvider($this->client);
  }


  /**
   * Account Charts
   */
  public function accountCharts ()
  {
    return new AccountChartsProvider($this->client);
  }


  /**
   * Get the accounts provider.
   *
   * @return AccountProvider
   */
  public function accounts ()
  {
    return new AccountsProvider($this->client);
  }


  /**
   * Get the archive provider.
   *
   * @return ArchiveProvider
   */
  public function archive ()
  {
    return new ArchiveProvider($this->client);
  }


  /**
   * Article File Connections
   */
  public function articleFileConnections ()
  {
    return new ArticleFileConnectionsProvider($this->client);
  }


  /**
   * Article URL Connections
   */
  public function articleURLConnections ()
  {
    return new ArticleURLConnectionsProvider($this->client);
  }


  /**
   * Get the articles provider.
   *
   * @return ArticleProvider
   */
  public function articles ()
  {
    return new ArticlesProvider($this->client);
  }


  /**
   * Attendance transactions
   */
  public function attendanceTransactions ()
  {
    return new AttendanceTransactionsProvider($this->client);
  }


  /**
   * Company Settings
   */
  public function companySettings ()
  {
    return new CompanySettingsProvider($this->client);
  }


  /**
   * Contract Accruals
   */
  public function contractAccruals ()
  {
    return new ContractAccrualsProvider($this->client);
  }


  /**
   * Contract Templates
   */
  public function contractTemplates ()
  {
    return new ContractTemplatesProvider($this->client);
  }


  /**
   * Contracts
   */
  public function contracts ()
  {
    return new ContractsProvider($this->client);
  }


  /**
   * Cost Centers
   */
  public function costCenters ()
  {
    return new CostCentersProvider($this->client);
  }


  /**
   * Currencies
   */
  public function currencies ()
  {
    return new CurrenciesProvider($this->client);
  }


  /**
   * Customers
   */
  public function customers ()
  {
    return new CustomersProvider($this->client);
  }


  /**
   * Employees
   */
  public function employees ()
  {
    return new EmployeesProvider($this->client);
  }


  /**
   * Financial Years
   */
  public function financialYears ()
  {
    return new FinancialYearsProvider($this->client);
  }


  /**
   * Inbox
   */
  public function inbox ()
  {
    return new InboxProvider($this->client);
  }


  /**
   * Invoice Accruals
   */
  public function invoiceAccruals ()
  {
    return new InvoiceAccrualsProvider($this->client);
  }


  /**
   * Invoice Payments
   */
  public function invoicePayments ()
  {
    return new InvoicePaymentsProvider($this->client);
  }


  /**
   * Invoices
   */
  public function invoices ()
  {
    return new InvoicesProvider($this->client);
  }


  /**
   * Labels
   */
  public function labels ()
  {
    return new LabelsProvider($this->client);
  }


  /**
   * Locked Period
   */
  public function lockedPeriod ()
  {
    return new LockedPeriodProvider($this->client);
  }


  /**
   * Modes of Payments
   */
  public function modesOfPayments ()
  {
    return new ModesOfPaymentsProvider($this->client);
  }


  /**
   * Offers
   */
  public function offers ()
  {
    return new OffersProvider($this->client);
  }


  /**
   * Orders
   */
  public function orders ()
  {
    return new OrdersProvider($this->client);
  }


  /**
   * Predefined Accounts
   */
  public function predefinedAccounts ()
  {
    return new PredefinedAccountsProvider($this->client);
  }


  /**
   * Predefined Voucher Series
   */
  public function predefinedVoucherSeries ()
  {
    return new PredefinedVoucherSeriesProvider($this->client);
  }


  /**
   * Price Lists
   */
  public function priceLists ()
  {
    return new PriceListsProvider($this->client);
  }


  /**
   * Prices
   */
  public function prices ()
  {
    return new PricesProvider($this->client);
  }


  /**
   * Print Templates
   */
  public function printTemplates ()
  {
    return new PrintTemplatesProvider($this->client);
  }


  /**
   * Projects
   */
  public function projects ()
  {
    return new ProjectsProvider($this->client);
  }


  /**
   * Salary transactions
   */
  public function salaryTransactions ()
  {
    return new SalaryTransactionsProvider($this->client);
  }


  /**
   * Schedule times
   */
  public function scheduleTimes ()
  {
    return new ScheduleTimesProvider($this->client);
  }


  /**
   * Supplier Invoice Accruals
   */
  public function supplierInvoiceAccruals ()
  {
    return new SupplierInvoiceAccrualsProvider($this->client);
  }


  /**
   * Supplier Invoice External URL Connections
   */
  public function supplierInvoiceExternalURLConnections ()
  {
    return new SupplierInvoiceExternalURLConnectionsProvider($this->client);
  }


  /**
   * Supplier Invoice File Connections
   */
  public function supplierInvoiceFileConnections ()
  {
    return new SupplierInvoiceFileConnectionsProvider($this->client);
  }


  /**
   * Supplier Invoice Payments
   */
  public function supplierInvoicePayments ()
  {
    return new SupplierInvoicePaymentsProvider($this->client);
  }


  /**
   * Supplier Invoices
   */
  public function supplierInvoices ()
  {
    return new SupplierInvoicesProvider($this->client);
  }


  /**
   * Suppliers
   */
  public function suppliers ()
  {
    return new SuppliersProvider($this->client);
  }


  /**
   * Tax Reductions
   */
  public function taxReductions ()
  {
    return new TaxReductionsProvider($this->client);
  }


  /**
   * Terms of Deliveries
   */
  public function termsOfDeliveries ()
  {
    return new TermsOfDeliveriesProvider($this->client);
  }


  /**
   * Terms of Payments
   */
  public function termsOfPayments ()
  {
    return new TermsOfPaymentsProvider($this->client);
  }


  /**
   * Trusted Email Senders
   */
  public function trustedEmailSenders ()
  {
    return new TrustedEmailSendersProvider($this->client);
  }


  /**
   * Units
   */
  public function units ()
  {
    return new UnitsProvider($this->client);
  }


  /**
   * Voucher File Connections
   */
  public function voucherFileConnections ()
  {
    return new VoucherFileConnectionsProvider($this->client);
  }


  /**
   * Voucher Series
   */
  public function voucherSeries ()
  {
    return new VoucherSeriesProvider($this->client);
  }


  /**
   * Vouchers
   */
  public function vouchers ()
  {
    return new VouchersProvider($this->client);
  }


  /**
   * Way of Deliveries
   */
  public function wayOfDeliveries ()
  {
    return new WayOfDeliveriesProvider($this->client);
  }

}
