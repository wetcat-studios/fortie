<?php namespace Wetcat\Fortie\Providers\SupplierInvoices;

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

abstract class Filter {

  /**
   * Retrieves all invoices with the status “cancelled”
   */
  const CANCELLED = 'cancelled';


  /**
   * Retrieves all invoices that has been fully paid
   */
  const FULLY_PAID = 'fullypaid';


  /**
   * Retrieves all invoices that is unpaid
   */
  const UNPAID = 'unpaid';


  /**
   * Retrieves all invoices that is unpaid and overdue
   */
  const UNPAID_OVERDUE = 'unpaidoverdue';


  /**
   * Retrieves all invoices that is unbooked
   */
  const INBOOKED = 'unbooked';

};
