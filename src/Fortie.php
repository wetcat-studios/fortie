<?php namespace Wetcat\Fortie;


use Wetcat\Fortie\Accounts\Provider as AccountProvider;
use Wetcat\Fortie\Articles\Provider as ArticleProvider;


class Fortie
{


  protected $accountProvider;
  protected $articleProvider;


  /**
   * Create a new Neo object.
   */
  public function __construct(
    AccountProvider $accountProvider = null,
    ArticleProvider $articleProvider = null
  ) {
    $this->accountProvider = $accountProvider ?: new AccountProvider;
    $this->articleProvider = $articleProvider ?: new ArticleProvider;
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


}
