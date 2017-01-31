<?php

/**
 * ADT API
 * Official & Core API for ADT  [ADT](http://adtcore.io)  Main API 
 *
 * OpenAPI spec version: 1.0.0
 * 
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen.git
 * Do not edit the class manually.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Models\DrugModels\Drug;

// 
use App\Models\VisitModels\Appointment;
use App\Models\VisitModels\Visit;
use App\Models\VisitModels\VisitItem;
// Event
use App\Events\DispensePatientEvent;

class DispenseApi extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
    }

    public function dispensepost($patient_id){
        $input = Request::all();
        $patient['patient_id'] = $patient_id;
        $visit_information = array_merge($input, $patient);
        event(new DispensePatientEvent($visit_information));
    }

}