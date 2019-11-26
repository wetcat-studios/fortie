<?php namespace Wetcat\Fortie\Providers\Units;

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

use Wetcat\Fortie\FortieRequest;
use Wetcat\Fortie\Providers\ProviderBase;
use Wetcat\Fortie\Traits\CountTrait;
use Wetcat\Fortie\Traits\CreateTrait;
use Wetcat\Fortie\Traits\DeleteTrait;
use Wetcat\Fortie\Traits\FetchTrait;
use Wetcat\Fortie\Traits\FindTrait;
use Wetcat\Fortie\Traits\UpdateTrait;

class Provider extends ProviderBase {

  use CountTrait,
      CreateTrait,
      DeleteTrait,
      FetchTrait,
      FindTrait,
      UpdateTrait;

  protected static $wrapper = 'Unit';
  protected static $wrapperGroup = 'Units';

  protected $attributes = [
    'Url',
    'Code',
    'Description',
  ];


  protected $writeable = [
    'Code',
    'Description',
  ];


  protected $required_create = [
    'Code',
    'Description',
  ];


  protected $required_update = [
  ];


  /**
   * The possible values for filtering the units.
   */
  protected $available_filters = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'units';

}
