<?php namespace Wetcat\Fortie;


use Wetcat\Fortie\Accounts\Provider as AccountProvider;
use Wetcat\Fortie\Articles\Provider as ArticleProvider;
use Wetcat\Fortie\CompanySettings\Provider as CompanySettingsProvider;
use Wetcat\Fortie\Invoices\Provider as InvoiceProvider;
use Wetcat\Fortie\Customers\Provider as CustomerProvider;


class Fortie
{


  protected $accountProvider;
  protected $articleProvider;
  protected $companySettingsProvider;
  protected $invoiceProvider;
  protected $customerProvider;


  /**
   * Create a new Neo object.
   */
  public function __construct(
    AccountProvider $accountProvider = null,
    ArticleProvider $articleProvider = null,
    CompanySettingsProvider $companySettingsProvider = null,
    InvoiceProvider $invoiceProvider = null,
    CustomerProvider $customerProvider = null
  ) {
    $this->accountProvider = $accountProvider ?: new AccountProvider;
    $this->articleProvider = $articleProvider ?: new ArticleProvider;
    $this->companySettingsProvider = $companySettingsProvider ?: new CompanySettingsProvider;
    $this->invoiceProvider = $invoiceProvider ?: new InvoiceProvider;
    $this->customerProvider = $customerProvider ?: new CustomerProvider;
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

}
