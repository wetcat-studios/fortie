<?php namespace Wetcat\Fortie\Providers\Contracts;

abstract class Filter {

  /**
   * Retrieves all active contracts
   */
  const ACTIVE = 'active';


  /**
   * Retrieves all inactive contracts
   */
  const INACTIVE = 'inactive';


  /**
   * Retrieves all finished contracts
   */
  const FINISHED = 'finished';

};
