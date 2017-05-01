<?php namespace Wetcat\Fortie\Providers\Vouchers;

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

use Wetcat\Fortie\Providers\ProviderBase;
use Wetcat\Fortie\FortieRequest;

class Provider extends ProviderBase {

  protected $attributes = [
    'Url',
    'Comments',
    'CostCenter',
    'Description',
    'Project',
    'ReferenceNumber',
    'ReferenceType',
    'TransactionDate',
    'VoucherNumber',
    'VoucherRows',
    'VoucherSeries',
    'Year',
    // Voucher rows
    'Account',
    'CostCenter',
    'Credit',
    'Description',
    'Debit',
    'Project',
    'Removed',
    'TransactionInformation',
  ];


  protected $writeable = [
    'Comments',
    'CostCenter',
    'Description',
    'Project',
    'TransactionDate',
    'VoucherRows',
    'VoucherSeries',
    // Voucher rows
    'Account',
    'CostCenter',
    'Credit',
    'Description',
    'Debit',
    'Project',
    'TransactionInformation',
  ];


  protected $required_create = [
    'Description',
    'TransactionDate',
  ];


  protected $required_update = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'vouchers';


  /**
   * Retrieves a list of vouchers. The vouchers are returned sorted by 
   * voucher series and voucher number with the lowest number appearing 
   * first.
   *
   * Note that vouchers have two keys, one for voucher series and one 
   * for voucher number. The financial year is also specified for each 
   * voucher, this is due to the same voucher series and number is used 
   * each year.
   *
   * So to get a unique voucher you need the voucher series, the voucher
   * number and the financial year. These properties will always be 
   * returned where ever vouchers is used.
   *
   * @return array
   */
  public function all ($year)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath);
    $req->param('financialyear', $year);

    return $this->send($req->build());
  }


  /**
   * Retrieves a list of vouchers in a specific voucher series. The 
   * vouchers are returned sorted by voucher number with the lowest number 
   * appearing first.
   *
   * To retrieve a list of vouchers based on a voucher series we use 
   * something called sublist, this is added to the URL together with the 
   * voucher series.
   *
   * @param $sublist
   * @param $series
   * @return array
   */
  public function series ($series, $year)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath)->path('sublist')->path($series);
    $req->param('financialyear', $year);

    return $this->send($req->build());
  }


  /**
   * Retrieves the details of a voucher. To get a unique voucher you need 
   * to supply the voucher series and the voucher number, in addition to 
   * this you also need to supply the financial year in which the voucher 
   * exists
   *
   * @return array
   */
  public function find ($series, $number, $year)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath)->path($series)->path($number);
    $req->param('financialyear', $year);

    return $this->send($req->build());
  }


  /**
   * The created voucher will be returned if everything succeeded, if 
   * there was any problems an error will be returned.
   *
   * @param array   $data
   * @return array
   */
  public function create (array $data)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath);
    $req->wrapper('Voucher');
    $req->setRequired($this->required_create);
    $req->data($data);

    return $this->send($req->build());
  }

}
