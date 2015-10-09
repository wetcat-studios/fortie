<?php namespace Wetcat\Fortie;


use Wetcat\Fortie\Accounts\Provider as AccountProvider;
use Wetcat\Fortie\Articles\Provider as ArticleProvider;
use Wetcat\Fortie\CompanySettings\Provider as CompanySettingsProvider;


class Fortie
{


  protected $accountProvider;
  protected $articleProvider;
  protected $companySettingsProvider;


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

}
