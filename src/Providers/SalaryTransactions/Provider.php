<?php namespace Wetcat\Fortie\Providers\SalaryTransactions;

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
    'EmployeeId',
    'SalaryCode',
    'SalaryRow',
    'Date',
    'Number',
    'Amount',
    'Total',
    'Expense',
    'VAT',
    'TextRow',
  ];


  protected $writeable = [
    'EmployeeId',
    'SalaryCode',
    'SalaryRow',
    'Date',
    'Number',
    'Amount',
    'Total',
    'Expense',
    'VAT',
    'TextRow',
  ];


  protected $required_create = [
  ];


  protected $required_update = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'salarytransactions';


  /**
   * List all salary transactions
   *
   * Lists all salary transactions for all employees. Supports query-string
   * parameters employeeid and date for filtering the result.
   *
   * @return array
   */
  public function all ()
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath);

    return $this->send($req->build());
  }


  /**
   * Retrieve a salary transaction.
   *
   * Retrieves a single salary transaction
   *
   * @param $salaryRow
   * @return array
   */
  public function find ($salaryRow)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath)->path($salaryRow);

    return $this->send($req->build());
  }


  /**
   * Create a salary transaction.
   *
   * Creates a new salary transaction for an employee.
   *
   * Usable “SalaryCode”s:
   *
   * You can get a list of usable salary codes from Register, Lönearter och koder,
   * Lönearter by choosing one of two tables and printing (Utskrift in the toolbar).
   * Depending on which salary code table (löneartstabell) that is set in the
   * settings (Inställningar, Lön, Avtal för arbetare/tjänsteman – Allmänt) you can
   * choose the salary code to use from either salary code table. Make sure to use
   * the correct table that is used for the employee (Register, Personal, Anställning,
   * Personaltyp) you want to sent the salary transaction for. Some salary codes do
   * not exist in every table.
   *
   * @param array   $data
   * @return array
   */
  public function create (array $data)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath);
    $req->wrapper('SalaryTransaction');
    $req->data($data);
    $req->setRequired($this->required_create);

    return $this->send($req->build());
  }


  /**
   * Update a salary transaction.
   *
   * Updates a salary transaction.
   *
   * Usable “SalaryCode”s:
   *
   * You can get a list of usable salary codes from Register, Lönearter och koder,
   * Lönearter by choosing one of two tables and printing (Utskrift in the toolbar).
   * Depending on which salary code table (löneartstabell) that is set in the settings
   * (Inställningar, Lön, Avtal för arbetare/tjänsteman – Allmänt) you can choose
   * the salary code to use from either salary code table. Make sure to use the
   * correct table that is used for the employee (Register, Personal, Anställning,
   * Personaltyp) you want to sent the salary transaction for. Some salary codes
   * do not exist in every table.
   *
   * @param $salaryRow
   * @param array   $data
   * @return array
   */
  public function update ($salaryRow, array $data)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($salaryRow);
    $req->wrapper('CostCenter');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }

}
