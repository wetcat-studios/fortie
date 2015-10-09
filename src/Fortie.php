<?php namespace Wetcat\Fortie;


use Wetcat\Fortie\Accounts\Provider as AccountProvider;
use Wetcat\Fortie\Articles\Provider as ArticleProvider;
use Wetcat\Fortie\CompanySettings\Provider as CompanySettingsProvider;
use Wetcat\Fortie\Invoice\Provider as InvoiceProvider;


class Fortie
{


  protected $accountProvider;
  protected $articleProvider;
  protected $companySettingsProvider;
  protected $invoiceProvider;


  /**
   * Create a new Neo object.
   */
  public function __construct(
    AccountProvider $accountProvider = null,
    ArticleProvider $articleProvider = null,
    CompanySettingsProvider $companySettingsProvider = null
  ) {
    $this->accountProvider = $accountProvider ?: new AccountProvider;
    $this->articleProvider = $articleProvider ?: new ArticleProvider;
    $this->companySettingsProvider = $companySettingsProvider ?: new CompanySettingsProvider;
    $this->invoiceProvider = $invoiceProvider ?: new InvoiceProvider;
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
   * Get the articles provider.
   *
   * @return ArticleProvider
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

}
