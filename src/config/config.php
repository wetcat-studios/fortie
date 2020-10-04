<?php


/*

   Copyright The Fortie authors

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

return [

    'default' => [

        // Your specific access token
        'access_token' => 'your-access-token-here',

        // Your specific client secret
        'client_secret' => 'your-client-secret-here',

        // The type you're sending
        'content_type' => 'application/json',

        // The type you're accepting as response
        'accepts' => 'application/json',

        // The URL to the Fortnox API
        'endpoint' => 'https://api.fortnox.se/3/',

        // Rate limit (number of requests per second)
        'rate_limit' => 4,
    ],

];
