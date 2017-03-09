<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$api = $app->make(Dingo\Api\Routing\Router::class);

$api->version('v1', function ($api) {
    $api->post('/auth/login', [ 'as' => 'api.auth.login', 'uses' => 'App\Http\Controllers\Auth\AuthController@postLogin'  ]);

    $api->group([], function ($api) { //'middleware' => 'api.auth', 
        // Auth
        $api->get('/', [ 'uses' => 'App\Http\Controllers\APIController@getIndex', 'as' => 'api.index' ]);
        $api->get('/auth/user', [ 'uses' => 'App\Http\Controllers\Auth\AuthController@getUser', 'as' => 'api.auth.user' ]);
        $api->patch('/auth/refresh', [ 'uses' => 'App\Http\Controllers\Auth\AuthController@patchRefresh', 'as' => 'api.auth.refresh' ]);
        $api->delete('/auth/invalidate', [ 'uses' => 'App\Http\Controllers\Auth\AuthController@deleteInvalidate', 'as' => 'api.auth.invalidate' ]);
        $api->get('test', 'App\Http\Controllers\TestController@get_test');
        $api->get('test/{id}', 'App\Http\Controllers\TestController@get_test_with_id');

        
        $api->group(['prefix' => 'users'], function($api){
            $api->get('/', 'App\Http\Controllers\UserApi@usersget');
            $api->get('/{usersId}', 'App\Http\Controllers\UserApi@usersByIdget');
            $api->post('/', 'App\Http\Controllers\UserApi@userspost');
            $api->put('/{usersId}', 'App\Http\Controllers\UserApi@usersput');
            $api->delete('/{usersId}', 'App\Http\Controllers\UserApi@usersdelete');
        });
        $api->group(['prefix' => 'patients'], function($api){
            $api->get('/', 'App\Http\Controllers\PatientsApi@patientsget');
            $api->get('/{patientId}', 'App\Http\Controllers\PatientsApi@getPatientById');
            $api->post('/', 'App\Http\Controllers\PatientsApi@addPatient');
            $api->put('/{patientId}', 'App\Http\Controllers\PatientsApi@updatePatient');
            $api->delete('/{patientId}', 'App\Http\Controllers\PatientsApi@deletePatient');

            // check ccc_number
            $api->get('/ccc_number/{ccc_number}', 'App\Http\Controllers\PatientsApi@check_ccc_number');

            /*
            *   Patient additions routes
            */
            // allergies
            $api->get('/{patientId}/allergies', 'App\Http\Controllers\PatientsApi@patientAllergiesget');
            $api->post('/{patientId}/allergies/{allergieId}', 'App\Http\Controllers\PatientsApi@patientAllergiespost');

            $api->get('/{patientId}/allergies/{allergieId}', 'App\Http\Controllers\PatientsApi@patientAllergiesbyIdget');
            $api->put('/{patientId}/allergies/{allergieId}', 'App\Http\Controllers\PatientsApi@patientAllergiesput');
            $api->delete('/{patientId}/allergies/{allergieId}', 'App\Http\Controllers\PatientsApi@patientAllergiesdelete');
            
            // dependants
            $api->get('/{patientId}/dependants', 'App\Http\Controllers\PatientsApi@patientDependantsget');
            $api->post('/{patientId}/dependants', 'App\Http\Controllers\PatientsApi@patientDependantspost');

            $api->get('/{patientId}/dependants/{dependantId}', 'App\Http\Controllers\PatientsApi@patientDependantsbyIdget');
            $api->put('/{patientId}/dependants/{dependantId}', 'App\Http\Controllers\PatientsApi@patientDependantput');
            $api->delete('/{patientId}/dependants/{dependantId}', 'App\Http\Controllers\PatientsApi@patientDependantsdelete');
            // other allergies
            $api->get('/{patientId}/allergies_other', 'App\Http\Controllers\PatientsApi@patientOtherAllergiesget');
            $api->post('/{patientId}/allergies_other', 'App\Http\Controllers\PatientsApi@patientOtherAllergiespost');

            $api->get('/{patientId}/allergies_other/{otherallergieId}', 'App\Http\Controllers\PatientsApi@patientOtherAllergiesbyIdget');
            $api->put('/{patientId}/allergies_other/{otherallergieId}', 'App\Http\Controllers\PatientsApi@patientOtherAllergiesput');
            $api->delete('/{patientId}/allergies_other/{otherallergieId}', 'App\Http\Controllers\PatientsApi@patientOtherAllergiesdelete');
            // familyplanning
            $api->get('/{patientId}/familyplanning', 'App\Http\Controllers\PatientsApi@patientFamilyPlanningget');
            $api->post('/{patientId}/familyplanning', 'App\Http\Controllers\PatientsApi@patientFamilyPlanningpost');

            $api->get('/{patientId}/familyplanning/{familyplanId}', 'App\Http\Controllers\PatientsApi@patientFamilyPlanningbyIdget');
            $api->put('/{patientId}/familyplanning/{familyplanId}', 'App\Http\Controllers\PatientsApi@patientFamilyPlanningput');
            $api->delete('/{patientId}/familyplanning/{familyplanId}', 'App\Http\Controllers\PatientsApi@patientFamilyPlanningdelete');
            // prophylaxis
            $api->get('/{patientId}/prophylaxis', 'App\Http\Controllers\PatientsApi@patientProphylaxisget');
            $api->post('/{patientId}/prophylaxis', 'App\Http\Controllers\PatientsApi@patientProphylaxispost');

            $api->get('/{patientId}/prophylaxis/{prophylaxisId}', 'App\Http\Controllers\PatientsApi@patientProphylaxisByIdget');
            $api->put('/{patientId}/prophylaxis/{prophylaxisId}', 'App\Http\Controllers\PatientsApi@patientProphylaxisput');
            $api->delete('/{patientId}/prophylaxis/{prophylaxisId}', 'App\Http\Controllers\PatientsApi@patientProphylaxisdelete');

            // temp routes for patients 

            // illnesses
            $api->get('/{patientId}/illnesses', 'App\Http\Controllers\PatientsApi@patientIllnessget');
            $api->get('/{patientId}/illnesses/{illnessId}', 'App\Http\Controllers\PatientsApi@patientIllnessByIdget');
            $api->post('/{patientId}/illnesses', 'App\Http\Controllers\PatientsApi@patientIllnesspost');
            $api->put('/{patientId}/illnesses/{illnessId}', 'App\Http\Controllers\PatientsApi@patientIllnessput');
            $api->delete('/{patientId}/illnesses/{illnessId}', 'App\Http\Controllers\PatientsApi@patientIllnessdelete');

            // illnesses other
            $api->get('/{patientId}/illnesses_other', 'App\Http\Controllers\PatientsApi@getpatientOtherIllness');
            $api->get('/{patientId}/illnesses_other/{illnessId}', 'App\Http\Controllers\PatientsApi@getpatientOtherIllnessbyId');
            $api->post('/{patientId}/illnesses_other', 'App\Http\Controllers\PatientsApi@addPatientOtherIllness');
            $api->put('/{patientId}/illnesses_other/{illnessId}', 'App\Http\Controllers\PatientsApi@updatePatientOtherIllness');
            $api->delete('/{patientId}/illnesses_other/{illnessId}', 'App\Http\Controllers\PatientsApi@deletePatientOtherIllness');


            // partner
            $api->get('/{patientId}/partners', 'App\Http\Controllers\PatientsApi@patientPartnerget');
            $api->post('/{patientId}/partners', 'App\Http\Controllers\PatientsApi@patientPartnerpost');

            $api->get('/{patientId}/partners/{partnerId}', 'App\Http\Controllers\PatientsApi@patientPartnerByIdget');
            $api->put('/{patientId}/partners/{partnerId}', 'App\Http\Controllers\PatientsApi@patientPartnerput');
            $api->delete('/{patientId}/partners/{partnerId}', 'App\Http\Controllers\PatientsApi@patientPartnerdelete');

            // status
            $api->get('/{patientId}/status', 'App\Http\Controllers\PatientsApi@patientStatusget');
            $api->post('/{patientId}/status', 'App\Http\Controllers\PatientsApi@patientStatuspost');

            $api->get('/{patientId}/status/{statusId}', 'App\Http\Controllers\PatientsApi@patientStatusByIdget');
            $api->put('/{patientId}/status/{statusId}', 'App\Http\Controllers\PatientsApi@patientStatusput');
            $api->delete('/{patientId}/status/{statusId}', 'App\Http\Controllers\PatientsApi@patientStatusdelete');

            // tb
            $api->get('/{patientId}/tb', 'App\Http\Controllers\PatientsApi@patientTbget');
            $api->post('/{patientId}/tb', 'App\Http\Controllers\PatientsApi@patientTbpost');

            $api->get('/{patientId}/tb/{tbId}', 'App\Http\Controllers\PatientsApi@patientTbByIdget');
            $api->put('/{patientId}/tb/{tbId}', 'App\Http\Controllers\PatientsApi@patientTbput');
            $api->delete('/{patientId}/tb/{tbId}', 'App\Http\Controllers\PatientsApi@patientTbdelete');
            //  viralload

            $api->get('/{patientId}/viralload', 'App\Http\Controllers\PatientsApi@patientviralload');
            $api->post('/{patientId}/viralload', 'App\Http\Controllers\PatientsApi@addPatientviralload');
            $api->put('/{patientId}/viralload/{viralloadId}', 'App\Http\Controllers\PatientsApi@updatePatientviralload');
            $api->delete('/{patientId}/viralload/{viralloadId}', 'App\Http\Controllers\PatientsApi@deletePatientviralload');
            
        });
        $api->group(['prefix' => 'appointments'], function($api){
            $api->get('/patients/{patientId}', 'App\Http\Controllers\VisitApi@patientappointmentsget');
            $api->post('/patients/{patientId}', 'App\Http\Controllers\VisitApi@patientappointmentspost');

            $api->get('/{appointmentsId}/patients/{patientId}', 'App\Http\Controllers\VisitApi@patientappointmentsByIdget');
            $api->put('/{appointmentsId}/patients/{patientId}', 'App\Http\Controllers\VisitApi@patientappointmentsput');
            $api->delete('/{appointmentsId}/patients/{patientId}', 'App\Http\Controllers\VisitApi@patientappointmentsdelete');

            // get current patient appointment
            $api->get('/patients/{patientId}/latest', 'App\Http\Controllers\PatientsApi@return_latest_appointment');
        });
        $api->group(['prefix' => 'visits'], function($api){
            $api->get('/patients/{patientId}', 'App\Http\Controllers\VisitApi@patientVisitsget');
            $api->post('/patients/{patientId}', 'App\Http\Controllers\VisitApi@patientVisitspost');

            $api->get('/{visitsId}/patients/{patientId}', 'App\Http\Controllers\VisitApi@patientVisitsByIdget');
            $api->put('/{visitsId}/patients/{patientId}', 'App\Http\Controllers\VisitApi@patientVisitsput');
            $api->delete('/{visitsId}/patients/{patientId}', 'App\Http\Controllers\VisitApi@patientVisitsdelete');
            // visit items by visit id
            $api->get('/{visitsId}/items', 'App\Http\Controllers\VisitApi@visitsItemget');
            $api->post('/{visitsId}/items', 'App\Http\Controllers\VisitApi@visitsItempost');

            $api->get('/{visitsId}/items/{itemId}', 'App\Http\Controllers\VisitApi@visitsItemByIdget');
            $api->put('/{visitsId}/items/{itemId}', 'App\Http\Controllers\VisitApi@visitsItemput');
            $api->delete('/{visitsId}/items/{itemId}', 'App\Http\Controllers\VisitApi@visitsItemdelete');

            // get first patient visit
            $api->get('/patients/{patientId}/first', 'App\Http\Controllers\PatientsApi@return_first_visit');
            //  get current patient visit
            $api->get('/patients/{patientId}/latest', 'App\Http\Controllers\PatientsApi@return_latest_visit');
        });
        $api->group(['prefix' => 'stocks'], function(){
            $api->get('/', 'App\Http\Controllers\StockApi@stockget');
            $api->post('/', 'App\Http\Controllers\StockApi@stockpost');

            $api->get('/{stockId}', 'App\Http\Controllers\StockApi@stockByIdget');
            $api->put('/{stockId}', 'App\Http\Controllers\StockApi@stockput');
            $api->delete('/{stockId}', 'App\Http\Controllers\StockApi@stockdelete');

            // stock items
            $api->get('/{stockId}/items', 'App\Http\Controllers\StockApi@stockItemget');
            $api->post('/{stockId}/items', 'App\Http\Controllers\StockApi@stockItempost');

            $api->get('/{stockId}/items/{itemId}', 'App\Http\Controllers\StockApi@stockItemByIdget');
            $api->put('/{stockId}/items/{itemId}', 'App\Http\Controllers\StockApi@stockItemput');
            $api->delete('/{stockId}/items/{itemId}', 'App\Http\Controllers\StockApi@stockItemdelete');

            // drug stock balance
            $api->get('/{stockId}/balances', 'App\Http\Controllers\StockApi@stockItemBalanceget');
            $api->post('/{stockId}/balances', 'App\Http\Controllers\StockApi@stockItempost');

            $api->get('/{stockId}/balances/{balanceId}', 'App\Http\Controllers\StockApi@stockItemBalanceByIdget');
            $api->put('/{stockId}/balances/{balanceId}', 'App\Http\Controllers\StockApi@stockItemBalanceput');
            $api->delete('/{stockId}/balances/{balanceId}', 'App\Http\Controllers\StockApi@stockItemBalancedelete');

            // stock store
            $api->get('/stock/store', 'App\Http\Controllers\StockApi@recordedStockItems');
            $api->get('/stock/store/{storeId}', 'App\Http\Controllers\StockApi@recordedStockItemsById');

            // bincard
            $api->get('/{drugid}/bin_cards', 'App\Http\Controllers\StockApi@stockBincardget');
            
            // transaction
            $api->get('/transactions', 'App\Http\Controllers\StockApi@stockTransactionpost');
        });
        $api->group(['prefix' => 'dispense'], function($api){
            // patient dispense
            $api->get('/patients/{patientId}', 'App\Http\Controllers\VisitApi@dispenseget');
            $api->post('/patients/{patientId}', 'App\Http\Controllers\VisitApi@dispensepost');
            // available drugs
            $api->get('/drug/{drugId}', 'App\Http\Controllers\VisitApi@dispenseGetDrug');
        });
        $api->group(['prefix' => 'drugs'], function($api){
            $api->get('/', 'App\Http\Controllers\DrugsApi@drugsget');
            $api->get('/{drugId}', 'App\Http\Controllers\DrugsApi@drugsByIdget');
            $api->post('/', 'App\Http\Controllers\DrugsApi@drugspost');
            $api->put('/{drugId}', 'App\Http\Controllers\DrugsApi@drugsput');
            $api->delete('/{drugId}', 'App\Http\Controllers\DrugsApi@drugsdelete');
            // drug dose
            $api->get('/{drugId}/dose', 'App\Http\Controllers\DrugsApi@drugsDrugIdDoseget');
            $api->post('/{drugId}/dose', 'App\Http\Controllers\DrugsApi@drugsDrugIdDosepost');
        });
        $api->group(['prefix' => 'regimens'],function($api){
            // regimen
            $api->get('/', 'App\Http\Controllers\DrugsApi@regimenget');
            $api->post('/', 'App\Http\Controllers\DrugsApi@regimenpost');

            $api->get('/{regimenId}', 'App\Http\Controllers\DrugsApi@regimenByIdget');
            $api->put('/{regimenId}', 'App\Http\Controllers\DrugsApi@regimenput');
            $api->delete('/{regimenId}', 'App\Http\Controllers\DrugsApi@regimendelete');
            // regimen drug
            $api->get('/{regimenId}/drugs', 'App\Http\Controllers\DrugsApi@regimenDrugget');
            $api->post('/{regimenId}/drugs', 'App\Http\Controllers\DrugsApi@regimenDrugpost');

            $api->get('/{regimenId}/drugs/{drugId}', 'App\Http\Controllers\DrugsApi@regimenDrugByIdget');
            $api->put('/{regimenId}/drugs/{drugId}', 'App\Http\Controllers\DrugsApi@regimenDrugput');
            $api->delete('/{regimenId}/drugs/{drugId}', 'App\Http\Controllers\DrugsApi@regimenDrugdelete');
        });
        $api->group(['prefix' => 'facilities'], function($api){
            $api->get('/', 'App\Http\Controllers\FacilityApi@facilityget');
            $api->get('/{facilityId}', 'App\Http\Controllers\FacilityApi@facilityByIdget');
            $api->post('/', 'App\Http\Controllers\FacilityApi@facilitypost');
            $api->put('/{facilityId}', 'App\Http\Controllers\FacilityApi@facilityput');
            $api->delete('/{facilityId}', 'App\Http\Controllers\FacilityApi@facilitydelete');
        });
        $api->group(['prefix' => 'lists'],function($api){
            // allergies
            $api->get('/allergies', 'App\Http\Controllers\ListsApi@listsAllergiesget');
            $api->post('/allergies', 'App\Http\Controllers\ListsApi@listsAllergiespost');

            $api->get('/allergies/{allergyId}', 'App\Http\Controllers\ListsApi@listsAllergiesByIdget');
            $api->put('/allergies/{allergyId}', 'App\Http\Controllers\ListsApi@listsAllergiesput');
            $api->delete('/allergies/{allergyId}', 'App\Http\Controllers\ListsApi@listsAllergiesdelete');
            // categories
            $api->get('/categories', 'App\Http\Controllers\ListsApi@listsCategoriesget');
            $api->post('/categories', 'App\Http\Controllers\ListsApi@listsCategoriespost');

            $api->get('/categories/{categoryId}', 'App\Http\Controllers\ListsApi@listsCategoriesByIdget');
            $api->put('/categories/{categoryId}', 'App\Http\Controllers\ListsApi@listsCategoriesput');
            $api->delete('/lists/categories/{categoryId}', 'App\Http\Controllers\ListsApi@listsCategoriesdelete');

            // counties
            $api->get('/counties', 'App\Http\Controllers\ListsApi@listsCountiesget');
            $api->post('/counties', 'App\Http\Controllers\ListsApi@listsCountiespost');
            $api->get('/counties/{countyId}', 'App\Http\Controllers\ListsApi@listsCountiesByIdget');
            $api->put('/counties/{countyId}', 'App\Http\Controllers\ListsApi@listsCountiesput');
            $api->delete('/counties/{countyId}', 'App\Http\Controllers\ListsApi@listsCountiesdelete');

            // SubCounties
            $api->get('/subcounties', 'App\Http\Controllers\ListsApi@listsSubcountiesget');
            $api->post('/subcounties', 'App\Http\Controllers\ListsApi@listsSubcountiespost');

            $api->get('/subcounties/{subcountyID}', 'App\Http\Controllers\ListsApi@listsSubcountiesByIdget');
            $api->put('/subcounties/{subcountyID}', 'App\Http\Controllers\ListsApi@listsSubcountiesput');
            $api->delete('/subcounties/{subcountyID}', 'App\Http\Controllers\ListsApi@listsSubcountiesdelete');
            
            // Family Planning
            $api->get('/familyplanning', 'App\Http\Controllers\ListsApi@listsFamilyplanningget');
            $api->post('/familyplanning', 'App\Http\Controllers\ListsApi@listsFamilyplanningpost');

            $api->get('/familyplanning/{familyplanningId}', 'App\Http\Controllers\ListsApi@listsFamilyplanningget');
            $api->put('/familyplanning/{familyplanningId}', 'App\Http\Controllers\ListsApi@listsFamilyplanningput');
            $api->delete('/familyplanning/{familyplanningId}', 'App\Http\Controllers\ListsApi@listsFamilyplanningdelete');
            // illnesses
            $api->get('/illnesses', 'App\Http\Controllers\ListsApi@listsIllnessesget');
            $api->post('/illnesses', 'App\Http\Controllers\ListsApi@listsIllnessespost');

            $api->get('/illnesses/{illnessId}', 'App\Http\Controllers\ListsApi@listsIllnessesByIdget');
            $api->put('/illnesses/{illnessId}', 'App\Http\Controllers\ListsApi@listsIllnessesput');
            $api->delete('/illnesses/{illnessId}', 'App\Http\Controllers\ListsApi@listsIllnessesdelete');
            // service
            $api->get('/services', 'App\Http\Controllers\ListsApi@listsServicesget');
            $api->post('/services', 'App\Http\Controllers\ListsApi@listsServicespost');

            $api->get('/services/{serviceId}', 'App\Http\Controllers\ListsApi@listsServicesByIdget');
            $api->put('/services/{serviceId}', 'App\Http\Controllers\ListsApi@listsServicesput');
            $api->delete('/services/{serviceId}', 'App\Http\Controllers\ListsApi@listsServicesdelete');
            // change reason
            $api->get('/changereason', 'App\Http\Controllers\ListsApi@listsChangereasonget');
            $api->POST('/changereason', 'App\Http\Controllers\ListsApi@listsChangereasonpost');

            $api->get('/changereason/{changereasonId}', 'App\Http\Controllers\ListsApi@listsChangereasonByIdget');
            $api->put('/changereason/{changereasonId}', 'App\Http\Controllers\ListsApi@listsChangereasonput');
            $api->delete('/changereason/{changereasonId}', 'App\Http\Controllers\ListsApi@listsChangereasondelete');
            // generic
            $api->get('/generic', 'App\Http\Controllers\ListsApi@listsGenericget');
            $api->post('/generic', 'App\Http\Controllers\ListsApi@listsgenericpost');

            $api->get('/generic/{genericId}', 'App\Http\Controllers\ListsApi@listsGenericgenericByIdget');
            $api->put('/generic/{genericId}', 'App\Http\Controllers\ListsApi@listsgenericGenericput');
            $api->delete('/generic/{genericId}', 'App\Http\Controllers\ListsApi@listsGenericdelete');
            // instruction
            $api->get('/instruction', 'App\Http\Controllers\ListsApi@listsInstructionget');
            $api->post('/instruction', 'App\Http\Controllers\ListsApi@listsInstructionpost');

            $api->get('/instruction/{instructionId}', 'App\Http\Controllers\ListsApi@listsInstructionByIdget');
            $api->put('/instruction/{instructionId}', 'App\Http\Controllers\ListsApi@listsInstructionput');
            $api->delete('/instruction/{instructionId}', 'App\Http\Controllers\ListsApi@listsInstructiondelete');
            // Non-aadherence reason
            $api->get('/nonaadherencereason', 'App\Http\Controllers\ListsApi@listsNonaadherencereasonget');
            $api->post('/nonaadherencereason', 'App\Http\Controllers\ListsApi@listsNonaadherencereasonpost');

            $api->get('/nonaadherencereason/{nonadherenceId}', 'App\Http\Controllers\ListsApi@listsNonadherencebyIdget');
            $api->put('/nonaadherencereason/{nonadherenceId}', 'App\Http\Controllers\ListsApi@listsNonadherenceput');
            $api->delete('/nonaadherencereason/{nonadherenceId}', 'App\Http\Controllers\ListsApi@listsNonadherencedelete');
            // patientsources
            $api->get('/patientsources', 'App\Http\Controllers\ListsApi@listsPatientsourcesget');
            $api->post('/patientsources', 'App\Http\Controllers\ListsApi@listsPatientsourcespost');

            $api->get('/patientsources/{patientsourcesId}', 'App\Http\Controllers\ListsApi@listsPatientsourcesByIdget');
            $api->put('/patientsources/{patientsourcesId}', 'App\Http\Controllers\ListsApi@listsPatientsourcesput');
            $api->delete('/patientsources/{patientsourcesId}', 'App\Http\Controllers\ListsApi@listsPatientsourcesdelete');
            // pepreason
            $api->get('/pepreason', 'App\Http\Controllers\ListsApi@listsPepreasonget');
            $api->post('/pepreason', 'App\Http\Controllers\ListsApi@listsPepreasonpost');

            $api->get('/pepreason/{pepreasonId}', 'App\Http\Controllers\ListsApi@listsPepreasonByIdget');
            $api->put('/pepreason/{pepreasonId}', 'App\Http\Controllers\ListsApi@listsPepreasonput');
            $api->delete('/pepreason/{pepreasonId}', 'App\Http\Controllers\ListsApi@listsPepreasondelete');
            // Prophylaxis
            $api->get('/prophylaxis', 'App\Http\Controllers\ListsApi@listsProphylaxisget');
            $api->post('/prophylaxis', 'App\Http\Controllers\ListsApi@listsProphylaxispost');

            $api->get('/prophylaxis/{prophylaxisId}', 'App\Http\Controllers\ListsApi@listsProphylaxisByIdget');
            $api->put('/prophylaxis/{prophylaxisId}', 'App\Http\Controllers\ListsApi@listsProphylaxisput');
            $api->delete('/prophylaxis/{prophylaxisId}', 'App\Http\Controllers\ListsApi@listsProphylaxisdelete');
            // purpose
            $api->get('/purpose', 'App\Http\Controllers\ListsApi@listsPurposeget');
            $api->post('/purpose', 'App\Http\Controllers\ListsApi@listsPurposepost');

            $api->get('/purpose/{purposeId}', 'App\Http\Controllers\ListsApi@listsPurposeByIdget');
            $api->put('/purpose/{purposeId}', 'App\Http\Controllers\ListsApi@listsPurposeput');
            $api->delete('/purpose/{purposeId}', 'App\Http\Controllers\ListsApi@listsPurposedelete');
            // whostage
            $api->get('/whostage', 'App\Http\Controllers\ListsApi@listsWhostageget');
            $api->post('/whostage', 'App\Http\Controllers\ListsApi@listsWhostagepost');

            $api->get('/whostage/{whostageId}', 'App\Http\Controllers\ListsApi@listsWhostageByIdget');
            $api->put('/whostage/{whostageId}', 'App\Http\Controllers\ListsApi@listsWhostageput');
            $api->delete('/whostage/{whostageId}', 'App\Http\Controllers\ListsApi@listsWhostagedelete');
            // supporter // do
            $api->get('/supporter', 'App\Http\Controllers\ListsApi@listsSupporterget');
            $api->post('/supporter', 'App\Http\Controllers\ListsApi@listsSupporterpost');

            $api->get('/supporter/{supporterId}', 'App\Http\Controllers\ListsApi@listsSupporterByIdget');
            $api->put('/supporter/{supporterId}', 'App\Http\Controllers\ListsApi@listsSupporterput');
            $api->delete('/supporter/{supporterId}', 'App\Http\Controllers\ListsApi@listsSupporterdelete');
            // classifications
            $api->get('/lists/classifications', 'App\Http\Controllers\ListsApi@listsClassificationsget');
            $api->post('/lists/classifications', 'App\Http\Controllers\ListsApi@listsClassificationspost');

            $api->get('/lists/classifications/{classificationId}', 'App\Http\Controllers\ListsApi@listsClassificationsByIdget');
            $api->put('/lists/classifications/{classificationId}', 'App\Http\Controllers\ListsApi@listsClassificationsput');
            $api->delete('/lists/classifications/{classificationId}', 'App\Http\Controllers\ListsApi@listsClassificationsdelete');
            // indications
            $api->get('/lists/indications', 'App\Http\Controllers\ListsApi@listsIndicationsget');
            $api->post('/lists/indications', 'App\Http\Controllers\ListsApi@listsIndicationspost');
            $api->get('/lists/indications/{indicationId}', 'App\Http\Controllers\ListsApi@listsIndicationsByIdget');
            $api->put('/lists/indications/{indicationId}', 'App\Http\Controllers\ListsApi@listsIndicationsput');
            $api->delete('/lists/indications/{indicationId}', 'App\Http\Controllers\ListsApi@listsIndicationsdelete');
            // access level
            $api->get('/lists/access_level', 'App\Http\Controllers\ListsApi@listsaccessLevelget');
            $api->post('/lists/access_level', 'App\Http\Controllers\ListsApi@listsaccessLevelpost');
            $api->get('/lists/access_level/{accessLevelId}', 'App\Http\Controllers\ListsApi@listsaccessLevelByIdget');
            $api->put('/lists/access_level/{accessLevelId}', 'App\Http\Controllers\ListsApi@listsaccessLevelput');
            $api->delete('/lists/access_level/{accessLevelId}', 'App\Http\Controllers\ListsApi@listsaccessLeveldelete');
            // facility type
            $api->get('/lists/facility_type', 'App\Http\Controllers\ListsApi@listsfacilityTypeget');
            $api->post('/lists/facility_type', 'App\Http\Controllers\ListsApi@listsfacilityTypepost');
            $api->get('/lists/facility_type/{facilityType}', 'App\Http\Controllers\ListsApi@listsfacilityTypeByIdget');
            $api->put('/lists/facility_type/{facilityType}', 'App\Http\Controllers\ListsApi@listsfacilityTypeput');
            $api->delete('/lists/facility_type/{facilityType}', 'App\Http\Controllers\ListsApi@listsfacilityTypedelete');
            // transaction type
            $api->get('/lists/transaction_type', 'App\Http\Controllers\ListsApi@transactionTypeget');
            $api->post('/lists/transaction_type', 'App\Http\Controllers\ListsApi@transactionTypepost');

            $api->get('/lists/transaction_type/{transactiontypeId}', 'App\Http\Controllers\ListsApi@transactionTypeByIdget');
            $api->put('/lists/transaction_type/{transactiontypeId}', 'App\Http\Controllers\ListsApi@transactionTypeput');
            $api->delete('/lists/transaction_type/{transactiontypeId}', 'App\Http\Controllers\ListsApi@transactionTypedelete');
            // dose 
            $api->get('/lists/dose', 'App\Http\Controllers\ListsApi@doseget');
            $api->post('/lists/dose', 'App\Http\Controllers\ListsApi@dosepost');

            $api->get('/lists/dose/{doseId}', 'App\Http\Controllers\ListsApi@doseByIdget');
            $api->put('/lists/dose/{doseId}', 'App\Http\Controllers\ListsApi@doseput');
            $api->delete('/lists/dose/{doseId}', 'App\Http\Controllers\ListsApi@dosedelete');
            // unit
            $api->get('/lists/units', 'App\Http\Controllers\ListsApi@unitget');
            $api->post('/lists/units', 'App\Http\Controllers\ListsApi@unitpost');

            $api->get('/lists/units/{unitId}', 'App\Http\Controllers\ListsApi@unitByIdget');
            $api->put('/lists/units/{unitId}', 'App\Http\Controllers\ListsApi@unitput');
            $api->delete('/lists/units/{unitId}', 'App\Http\Controllers\ListsApi@unitdelete');
            // status --temp 
            $api->get('/lists/status', 'App\Http\Controllers\ListsApi@listsstatusget');
            $api->post('/lists/status', 'App\Http\Controllers\ListsApi@listsstatuspost');
            $api->get('/lists/status/{statusId}', 'App\Http\Controllers\ListsApi@listsstatusByIdget');
            $api->put('/lists/status/{statusId}', 'App\Http\Controllers\ListsApi@listsstatusput');
            $api->delete('/lists/status/{statusId}', 'App\Http\Controllers\ListsApi@listsstatusdelete');
        });
        $api->group(['prefix'=> 'cdrr'], function($api){
            // cdrr logs
            $api->get('/{cdrrId}/log', 'App\Http\Controllers\cdrrApi@cdrrItemget');
            $api->post('/{cdrrId}/log', 'App\Http\Controllers\cdrrApi@cdrrItempost');

            $api->get('/{cdrrId}/log/{logId}', 'App\Http\Controllers\cdrrApi@cdrrItemByIdget');
            $api->put('/{cdrrId}/log/{logId}', 'App\Http\Controllers\cdrrApi@cdrrItemput');
            $api->delete('/{cdrrId}/log/{logId}', 'App\Http\Controllers\cdrrApi@cdrrItemdelete');
            // cdrr item
            $api->get('/{cdrrId}/item', 'App\Http\Controllers\cdrrApi@cdrrItemget');
            $api->post('/{cdrrId}/item', 'App\Http\Controllers\cdrrApi@cdrrItempost');

            $api->get('/{cdrrId}/item/{itemId}', 'App\Http\Controllers\cdrrApi@cdrrItemByIdget');
            $api->put('/{cdrrId}/item/{itemId}', 'App\Http\Controllers\cdrrApi@cdrrItemput');
            $api->delete('/{cdrrId}/item/{itemId}', 'App\Http\Controllers\cdrrApi@cdrrItemdelete');
            // cdrr
            $api->get('/', 'App\Http\Controllers\CdrrApi@cdrrget');
            $api->post('/', 'App\Http\Controllers\CdrrApi@cdrrpost');

            $api->get('/{cdrrId}', 'App\Http\Controllers\CdrrApi@cdrrByIdget');
            $api->put('/{cdrrId}', 'App\Http\Controllers\CdrrApi@cdrrput');
        });     
        $api->group(['prefix' => 'maps'], function($api){
            // maps log
            $api->get('/{mapId}/log', 'App\Http\Controllers\MapsApi@mapsLogget');
            $api->post('/{mapId}/log', 'App\Http\Controllers\MapsApi@mapsLogpost');

            $api->get('/{mapId}/log/{logId}', 'App\Http\Controllers\MapsApi@mapsLogByIdget');
            $api->put('/{mapId}/log/{logId}', 'App\Http\Controllers\MapsApi@mapsLogput');
            $api->delete('/{mapId}/log/{logId}', 'App\Http\Controllers\MapsApi@mapsLogsdelete');

            // maps
            $api->get('/', 'App\Http\Controllers\MapsApi@mapsget');
            $api->post('/', 'App\Http\Controllers\MapsApi@mapspost');

            $api->get('/{mapId}', 'App\Http\Controllers\MapsApi@mapsByIdget');
            $api->put('/{mapId}', 'App\Http\Controllers\MapsApi@mapsput');
            $api->delete('/{mapId}', 'App\Http\Controllers\MapsApi@mapsdelete');


            // maps items
            $api->get('/{mapId}/items', 'App\Http\Controllers\MapsApi@mapsItemsget');
            $api->post('/{mapId}/items', 'App\Http\Controllers\MapsApi@mapsItemspost');

            $api->get('/{mapId}/items/{itemsId}', 'App\Http\Controllers\MapsApi@mapsItemsByIdget');
            $api->put('/{mapId}/items/{itemsId}', 'App\Http\Controllers\MapsApi@mapsItemsput');
            $api->delete('/{mapId}/items/{itemsId}', 'App\Http\Controllers\MapsApi@mapsItemssdelete');
        });
        $api->group(['prefix' => 'stores'], function ($store) {
            $store->get('/', 'App\Http\Controllers\StockApi@storeget');
            $store->post('/', 'App\Http\Controllers\StockApi@storepost');

            $store->get('/{storeId}', 'App\Http\Controllers\StockApi@storeByIdget');
            $store->put('/{storeId}', 'App\Http\Controllers\StockApi@storeput');
            $store->delete('/{storeId}', 'App\Http\Controllers\StockApi@storesdelete');

            // store and stock
            $api->get('/{storeId}/stocks', 'App\Http\Controllers\StockApi@storeStockget');
            $api->post('/{storeId}/stocks', 'App\Http\Controllers\StockApi@storeStockpost');

            $api->get('/{storeId}/stocks/drugs', 'App\Http\Controllers\StockApi@recordedStockItemsDrug');
            $api->get('/{storeId}/stocks/drugs/{drugId}', 'App\Http\Controllers\StockApi@recordedStockItemsDrugById');
        });

    });
});
