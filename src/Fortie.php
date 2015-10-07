<?php namespace Wetcat\Fortie;


use Wetcat\Fortie\Accounts\Provider as AccountProvider;


class Fortie
{


  protected $accountProvider;


  /**
   * Create a new Neo object.
   */
  public function __construct(AccountProvider $accountProvider = null)
  {
    $this->accountProvider = $accountProvider ?: new AccountProvider();
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


}
