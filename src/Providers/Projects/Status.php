<?php namespace Wetcat\Fortie\Providers\Projects;

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

class Status {

  /**
   * Project was not started yet
   */
  const NOT_STARTED = 'NOTSTARTED';


  /**
   * Project was started, and is ongoing
   */
  const ONGOING = 'ONGOING';


  /**
   * Project was completed
   */
  const COMPLETED = 'COMPLETED';

};
