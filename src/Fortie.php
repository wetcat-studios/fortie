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
use Wetcat\Fortie\Providers\Accounts\Provider as AccountProvider;
use Wetcat\Fortie\Providers\Archive\Provider as ArchiveProvider;
use Wetcat\Fortie\Providers\ArticleFileConnections\Provider as ArticleFileConnectionsProvider;
use Wetcat\Fortie\Providers\ArticleUrlConnections\Provider as ArticleUrlConnectionsProvider;
use Wetcat\Fortie\Providers\Articles\Provider as ArticleProvider;
use Wetcat\Fortie\Providers\AttendanceTransactions\Provider as AttendanceTransactionsProvider;
use Wetcat\Fortie\Providers\CompanySettings\Provider as CompanySettingsProvider;
use Wetcat\Fortie\Providers\ContactAccruals\Provider as ContactAccrualsProvider;
use Wetcat\Fortie\Providers\ContractTemplates\Provider as ContractTemplatesProvider;
use Wetcat\Fortie\Providers\Contracts\Provider as ContractProvider;
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
use Wetcat\Fortie\Providers\Suppliers\Provider as SupplierProvider;
use Wetcat\Fortie\Providers\TaxReductions\Provider as TaxReductionsProvider;
use Wetcat\Fortie\Providers\TermsOfDeliveries\Provider as TermsOfDeliveriesProvider;
use Wetcat\Fortie\Providers\TermsOfPayments\Provider as TermsOfPaymentsProvider;
use Wetcat\Fortie\Providers\TrustedEmailSenders\Provider as TrustedEmailSendersProvider;
use Wetcat\Fortie\Providers\Units\Provider as UnitProvider;
use Wetcat\Fortie\Providers\VoucherFileConnections\Provider as VoucherFileConnectionsProvider;
use Wetcat\Fortie\Providers\VoucherSeries\Provider as VoucherSeriesProvider;
use Wetcat\Fortie\Providers\Vouchers\Provider as VoucherProvider;
use Wetcat\Fortie\Providers\WayOfDeliveries\Provider as WayOfDeliveriesProvider;

/**
 * Starting point for all interactions with the Fortnox API. After
 * setting this class up it will automatically register all the 
 * providers.
 */
class Fortie
{

  /**
   * Absence transactions
   */
  protected $absenceTransactionsProvider;


  /**
   * Account Charts
   */
  protected $accountChartsProvider;


  /**
   * The Account provider provides access to all the account endpoints.
   */
  protected $accountsProvider;


  /**
   * Provides access to archives endpoints.
   */
  protected $archiveProvider;


  /**
   * Article File Connections
   */
  protected $articleFileConnectionsProvider;


  /**
   * Article URL Connections
   */
  protected $articleURLConnectionsProvider;


  /**
   * Provides access to article endpoints.
   */
  protected $articlesProvider;


  /**
   * Attendance transactions
   */
  protected $attendanceTransactionsProvider;


  /**
   * Provides access to the company settings endpoint. This is read-only.
   */
  protected $companySettingsProvider;


  /**
   * Contract Accruals
   */
  protected $contractAccrualsProvider;


  /**
   * Contract Templates
   */
  protected $contractTemplatesProvider;


  /**
   * Provides access to the contracts endpoint.
   */
  protected $contractsProvider;


  /**
   * Cost Centers
   */
  protected $costCentersProvider;


  /**
   * Provides access to currencies.
   */
  protected $currenciesProvider;


  /**
   * Provides access to customer endpoints.
   */
  protected $customersProvider;


  /**
   * Employees
   */
  protected $employeesProvider;


  /**
   * Financial Years
   */
  protected $financialYearsProvider;


  /**
   * Inbox
   */
  protected $inboxProvider;


  /**
   * Invoice Accruals
   */
  protected $invoiceAccrualsProvider;


  /**
   * Invoice Payments
   */
  protected $invoicePaymentsProvider;


  /**
   * Provides access to invoices actions and endpoints.
   */
  protected $invoicesProvider;


  /**
   * Labels
   */
  protected $labelsProvider;


  /**
   * Locked Period
   */
  protected $lockedPeriodProvider;
  

  /**
   * Modes of Payments
   */
  protected $modesOfPaymentsProvider;


  /**
   * Provides access to offers actions and endpoints.
   */
  protected $offersProvider;


  /**
   * Provides access to orders.
   */
  protected $ordersProvider;


  /**
   * Predefined Accounts
   */
  protected $predefinedAccountsProvider;


  /**
   * Predefined Voucher Series
   */
  protected $predefinedVoucherSeriesProvider;


  /**
   * Provides access to price lists.
   */
  protected $priceListsProvider;


  /**
   * Provides access to prices.
   */
  protected $pricesProvider;


  /**
   * Print Templates
   */
  protected $printTemplatesProvider;


  /**
   * Provides access to projects.
   */
  protected $projectsProvider;


  /**
   * Salary transactions
   */
  protected $salaryTransactionsProvider;


  /**
   * Schedule times
   */
  protected $scheduleTimesProvider;


  /**
   * Supplier Invoice Accruals
   */
  protected $supplierInvoiceAccrualsProvider;


  /**
   * Supplier Invoice External URL Connections
   */
  protected $supplierInvoiceExternalURLConnectionsProvider;


  /**
   * Supplier Invoice File Connections
   */
  protected $supplierInvoiceFileConnectionsProvider;


  /**
   * Supplier Invoice Payments
   */
  protected $supplierInvoicePaymentsProvider;


  /**
   * Supplier Invoices
   */
  protected $supplierInvoicesPRovider;


  /**
   * Provides access to suppliers.
   */
  protected $suppliersProvider;


  /**
   * Tax Reductions
   */
  protected $taxReductionsProvider;


  /**
   * Terms of Deliveries
   */
  protected $termsOfDeliveriesProvider;


  /**
   * Terms of Payments
   */
  protected $termsOfPaymentsProvider;


  /**
   * Trusted Email Senders
   */
  protected $trustedEmailSendersProvider;
  

  /**
   * Provides access to units.
   */
  protected $unitsProvider;


  /**
   * Voucher File Connections
   */
  protected $voucherFileConnectionsProvider;


  /**
   * Voucher Series
   */
  protected $voucherSeriesProvider;
  

  /**
   * Provides access to vouchers.
   */
  protected $vouchersProvider;


  /**
   * Way of Deliveries
   */
  protected $wayOfDeliveriesProvider;


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
    $this->absenceTransactionsProvider = new AbsenceTransactionsProvider($client);
    $this->accountChartsProvider = new AccountChartsProvider($client);
    $this->accountsProvider = new AccountsProvider($client);
    $this->archiveProvider = new ArchiveProvider($client);
    $this->articleFileConnectionsProvider = new ArticleFileConnectionsProvider($client);
    $this->articleURLConnectionsProvider = new ArticleURLConnectionsProvider($client);
    $this->articlesProvider = new ArticlesProvider($client);
    $this->attendanceTransactionsProvider = new AttendanceTransactionsProvider($client);
    $this->companySettingsProvider = new CompantSettingsProvider($client);
    $this->contractAccrualsProvider = new ContractAccrualsProvider($client);
    $this->contractTemplatesProvider = new ContractTemplatesProvider($client);
    $this->contractsProvider = new ContractsProvider($client);
    $this->costCentersProvider = new CostCentersProvider($client);
    $this->currenciesProvider = new CurrenciesProvider($client);
    $this->customersProvider = new CustomersProvider($client);
    $this->employeesProvider = new EmployeesProvider($client);
    $this->financialYearsProvider = new FinancialYearsProvider($client);
    $this->inboxProvider = new InboxProvider($client);
    $this->invoiceAccrualsProvider = new InvoiceAccrualsProvider($client);
    $this->invoicePaymentsProvider = new InvoicePaymentsProvider($client);
    $this->invoicesProvider = new InvoicesProvider($client);
    $this->labelsProvider = new LabelsProvider($client);
    $this->lockedPeriodProvider = new LockedPeriodProvider($client);
    $this->modesOfPaymentsProvider = new ModesOfPaymentsProvider($client);
    $this->offersProvider = new OffersProvider($client);
    $this->ordersProvider = new OrdersProvider($client);
    $this->predefinedAccountsProvider = new PredefinedAccountsProvider($client);
    $this->predefinedVoucherSeriesProvider = new PredefinedVoucherSeriesProvider($client);
    $this->priceListsProvider = new PriceListsProvider($client);
    $this->pricesProvider = new PricesProvider($client);
    $this->printTemplatesProvider = new PrintTemplatesProvider($client);
    $this->projectsProvider = new ProjectsProvider($client);
    $this->salaryTransactionsProvider = new SalaryTransactionsProvider($client);
    $this->scheduleTimesProvider = new ScheduleTimesProvider($client);
    $this->supplierInvoiceAccrualsProvider = new SupplierInvoiceAccrualsProvider($client);
    $this->supplierInvoiceExternalURLConnectionsProvider = new SupplierInvoiceExternalURLConnectionsProvider($client);
    $this->supplierInvoiceFileConnectionsProvider = new SupplierInvoiceFileConnectionsProvider($client);
    $this->supplierInvoicePaymentsProvider = new SupplierInvoicePaymentsProvider($client);
    $this->supplierInvoicesProvider = new SupplierInvoicesProvider($client);
    $this->suppliersProvider = new SuppliersProvider($client);
    $this->taxReductionsProvider = new TaxReductionsProvider($client);
    $this->termsOfDeliveriesProvider = new TermsOfDeliveriesProvider($client);
    $this->termsOfPaymentsProvider = new TermsOfPaymentsProvider($client);
    $this->trustedEmailSendersProvider = new TrustedEmailSendersProvider($client);
    $this->unitsProvider = new UnitsProvider($client);
    $this->voucherFileConnectionsProvider = new VoucherFileConnectionsProvider($client);
    $this->voucherSeriesProvider = new VoucherSeriesProvider($client);
    $this->vouchersProvider = new VouchersProvider($client);
    $this->wayOfDeliveriesProvider = new WayOfDeliveriesProvider($client);
  }


  /**
   * Absence transactions
   */
  public function absenceTransactions ()
  {
    return $this->absenceTransactionsProvider;
  }


  /**
   * Account Charts
   */
  public function accountCharts ()
  {
    return $this->accountChartsProvider;
  }


  /**
   * Get the accounts provider.
   *
   * @return AccountProvider
   */
  public function accounts ()
  {
    return $this->accountsProvider;
  }


  /**
   * Get the archive provider.
   *
   * @return ArchiveProvider
   */
  public function archive ()
  {
    return $this->archiveProvider;
  }


  /**
   * Article File Connections
   */
  public function articleFileConnections ()
  {
    return $this->articleFileConnectionsProvider;
  }


  /**
   * Article URL Connections
   */
  public function articleURLConnections ()
  {
    return $this->articleURLConnectionsProvider;
  }


  /**
   * Get the articles provider.
   *
   * @return ArticleProvider
   */
  public function articles ()
  {
    return $this->articlesProvider;
  }


  /**
   * Attendance transactions
   */
  public function attendanceTransactions ()
  {
    return $this->attendanceTransactionsProvider;
  }


  /**
   * Company Settings
   */
  public function companySettings ()
  {
    return $this->companySettingsProvider;
  }


  /**
   * Contract Accruals
   */
  public function contractAccruals ()
  {
    return $this->contractAccrualsProvider;
  }


  /**
   * Contract Templates
   */
  public function contractTemplates ()
  {
    return $this->contractTemplatesProvider;
  }


  /**
   * Contracts
   */
  public function contracts ()
  {
    return $this->contractsProvider;
  }


  /**
   * Cost Centers
   */
  public function costCenters ()
  {
    return $this->costCentersProvider;
  }


  /**
   * Currencies
   */
  public function currencies ()
  {
    return $this->currenciesProvider;
  }


  /**
   * Customers
   */
  public function customers ()
  {
    return $this->customersProvider;
  }


  /**
   * Employees
   */
  public function employees ()
  {
    return $this->employeesProvider;
  }


  /**
   * Financial Years
   */
  public function financialYears ()
  {
    return $this->financialYearsProvider;
  }


  /**
   * Inbox
   */
  public function inbox ()
  {
    return $this->inboxProvider;
  }


  /**
   * Invoice Accruals
   */
  public function invoiceAccruals ()
  {
    return $this->invoiceAccrualsProvider;
  }


  /**
   * Invoice Payments
   */
  public function invoicePayments ()
  {
    return $this->invoicePaymentsProvider;
  }


  /**
   * Invoices
   */
  public function invoices ()
  {
    return $this->invoicesProvider;
  }


  /**
   * Labels
   */
  public function labels ()
  {
    return $this->labelsProvider;
  }


  /**
   * Locked Period
   */
  public function lockedPeriod ()
  {
    return $this->lockedPeriodProvider;
  }


  /**
   * Modes of Payments
   */
  public function modesOfPayments ()
  {
    return $this->modesOfPaymentsProvider;
  }


  /**
   * Offers
   */
  public function offers ()
  {
    return $this->offersProvider;
  }


  /**
   * Orders
   */
  public function orders ()
  {
    return $this->ordersProvider;
  }


  /**
   * Predefined Accounts
   */
  public function predefinedAccounts ()
  {
    return $this->predefinedAccountsProvider;
  }


  /**
   * Predefined Voucher Series
   */
  public function predefinedVoucherSeries ()
  {
    return $this->predefinedVoucherSeriesProvider;
  }


  /**
   * Price Lists
   */
  public function priceLists ()
  {
    return $this->priceListsProvider;
  }


  /**
   * Prices
   */
  public function prices ()
  {
    return $this->pricesProvider;
  }


  /**
   * Print Templates
   */
  public function printTemplates ()
  {
    return $this->printTemplatesProvider;
  }


  /**
   * Projects
   */
  public function projects ()
  {
    return $this->projectsProvider;
  }


  /**
   * Salary transactions
   */
  public function salaryTransactions ()
  {
    return $this->salaryTransactionsProvider;
  }


  /**
   * Schedule times
   */
  public function scheduleTimes ()
  {
    return $this->scheduleTimesProvider;
  }


  /**
   * Supplier Invoice Accruals
   */
  public function supplierInvoiceAccruals ()
  {
    return $this->supplierInvoiceAccrualsProvider;
  }


  /**
   * Supplier Invoice External URL Connections
   */
  public function supplierInvoiceExternalURLConnections ()
  {
    return $this->supplierInvoiceExternalURLConnectionsProvider;
  }


  /**
   * Supplier Invoice File Connections
   */
  public function supplierInvoiceFileConnections ()
  {
    return $this->supplierInvoiceFileConnectionsProvider;
  }


  /**
   * Supplier Invoice Payments
   */
  public function supplierInvoicePayments ()
  {
    return $this->supplierInvoicePaymentsProvider;
  }


  /**
   * Supplier Invoices
   */
  public function supplierInvoices ()
  {
    return $this->supplierInvoicesProvider;
  }


  /**
   * Suppliers
   */
  public function suppliers ()
  {
    return $this->suppliersProvider;
  }


  /**
   * Tax Reductions
   */
  public function taxReductions ()
  {
    return $this->taxReductionsProvider;
  }


  /**
   * Terms of Deliveries
   */
  public function termsOfDeliveries ()
  {
    return $this->termsOfDeliveriesProvider;
  }


  /**
   * Terms of Payments
   */
  public function termsOfPayments ()
  {
    return $this->termsOfPaymentsProvider;
  }


  /**
   * Trusted Email Senders
   */
  public function trustedEmailSenders ()
  {
    return $this->trustedEmailSendersProvider;
  }


  /**
   * Units
   */
  public function units ()
  {
    return $this->unitsProvider;
  }


  /**
   * Voucher File Connections
   */
  public function voucherFileConnections ()
  {
    return $this->voucherFileConnectionsProvider;
  }


  /**
   * Voucher Series
   */
  public function voucherSeries ()
  {
    return $this->voucherSeriesProvider;
  }


  /**
   * Vouchers
   */
  public function vouchers ()
  {
    return $this->vouchersProvider;
  }


  /**
   * Way of Deliveries
   */
  public function wayOfDeliveries ()
  {
    return $this->wayOfDeliveriesProvider;
  }

}
