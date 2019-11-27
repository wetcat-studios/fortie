<?php namespace Wetcat\Fortie\Providers\AccountCharts;

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
use Wetcat\Fortie\Traits\FetchTrait;

class Provider extends ProviderBase {

  use FetchTrait;

  protected $wrapper = 'AccountChart';
  protected $wrapperGroup = 'AccountCharts';

  protected $attributes = [
    'Name',
  ];


  protected $writeable = [
  ];


  protected $required_create = [
  ];


  protected $required_update = [
  ];


  /**
   * The possible values for filtering.
   *
   * @var array
   */
  protected $available_filters = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'accountcharts';
}
