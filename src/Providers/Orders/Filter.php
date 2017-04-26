<?php namespace Wetcat\Fortie\Providers\Orders;

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
   * Retrieves all orders with the status “cancelled”
   */
  const CANCELLED = 'cancelled';


  /**
   * Retrieves all orders that has been expired
   */
  const EXPIRED = 'expired';


  /**
   * Retrieves all offers where an invoice has been created
   */
  const CREATED = 'invoicecreated';


  /**
   * Retrieves all orders where an invoice has not been created
   */
  const NOT_CREATED = 'invoicenotcreated';

};
	