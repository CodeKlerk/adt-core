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
    $api->post('/auth/login', [
        'as' => 'api.auth.login',
        'uses' => 'App\Http\Controllers\Auth\AuthController@postLogin',
        ]);

    $api->group([
        // 'middleware' => 'api.auth',
        ], function ($api) {
        // Auth
            $api->get('/', [
                'uses' => 'App\Http\Controllers\APIController@getIndex',
                'as' => 'api.index'
                ]);
            $api->get('/auth/user', [
                'uses' => 'App\Http\Controllers\Auth\AuthController@getUser',
                'as' => 'api.auth.user'
                ]);
            $api->patch('/auth/refresh', [
                'uses' => 'App\Http\Controllers\Auth\AuthController@patchRefresh',
                'as' => 'api.auth.refresh'
                ]);
            $api->delete('/auth/invalidate', [
                'uses' => 'App\Http\Controllers\Auth\AuthController@deleteInvalidate',
                'as' => 'api.auth.invalidate'
                ]);
            $api->get('test', 'App\Http\Controllers\TestController@get_test');
            $api->get('test/{id}', 'App\Http\Controllers\TestController@get_test_with_id');
        // 
        /*
        *   User routes
        */
        $api->get('/users', 'App\Http\Controllers\UserApi@usersget');
        $api->get('/users/{usersId}', 'App\Http\Controllers\UserApi@usersByIdget');
        $api->post('/users', 'App\Http\Controllers\UserApi@userspost');
        $api->put('/users/{usersId}', 'App\Http\Controllers\UserApi@usersput');
        $api->delete('/users/{usersId}', 'App\Http\Controllers\UserApi@usersdelete');
        /*
        *   Patient routes
        */
        $api->get('/patients', 'App\Http\Controllers\PatientsApi@patientsget');
        $api->get('/patients/{patientId}', 'App\Http\Controllers\PatientsApi@getPatientById');
        $api->post('/patients', 'App\Http\Controllers\PatientsApi@addPatient');
        $api->put('/patients/{patientId}', 'App\Http\Controllers\PatientsApi@updatePatient');
        $api->delete('/patients/{patientId}', 'App\Http\Controllers\PatientsApi@deletePatient');

        // check ccc_number
        $api->get('/patients/ccc_number/{ccc_number}', 'App\Http\Controllers\PatientsApi@check_ccc_number');

        /*
        *   Patient additions routes
        */
        // allergies
        $api->get('/patients/{patientId}/allergies', 'App\Http\Controllers\PatientsApi@patientAllergiesget');
        $api->post('/patients/{patientId}/allergies/{allergieId}', 'App\Http\Controllers\PatientsApi@patientAllergiespost');

        $api->get('/patients/{patientId}/allergies/{allergieId}', 'App\Http\Controllers\PatientsApi@patientAllergiesbyIdget');
        $api->put('/patients/{patientId}/allergies/{allergieId}', 'App\Http\Controllers\PatientsApi@patientAllergiesput');
        $api->delete('/patients/{patientId}/allergies/{allergieId}', 'App\Http\Controllers\PatientsApi@patientAllergiesdelete');
        // apiointment
        $api->get('/patients/{patientId}/appointments/{apiointmentId}', 'App\Http\Controllers\PatientsApi@patientappointments');
        $api->post('/patients/{patientId}/appointments/{apiointmentId}', 'App\Http\Controllers\PatientsApi@addPatientappointments');
        $api->put('/patients/{patientId}/appointments/{apiointmentId}', 'App\Http\Controllers\PatientsApi@updatePatientappointments');
        $api->delete('/patients/{patientId}/appointments/{apiointmentId}', 'App\Http\Controllers\PatientsApi@deletePatientapiointment');
        // dependants
        $api->get('/patients/{patientId}/dependants', 'App\Http\Controllers\PatientsApi@patientDependantsget');
        $api->post('/patients/{patientId}/dependants', 'App\Http\Controllers\PatientsApi@patientDependantspost');

        $api->get('/patients/{patientId}/dependants/{dependantId}', 'App\Http\Controllers\PatientsApi@patientDependantsbyIdget');
        $api->put('/patients/{patientId}/dependants/{dependantId}', 'App\Http\Controllers\PatientsApi@patientDependantput');
        $api->delete('/patients/{patientId}/dependants/{dependantId}', 'App\Http\Controllers\PatientsApi@patientDependantsdelete');
        // other allergies
        $api->get('/patients/{patientId}/otherallergies', 'App\Http\Controllers\PatientsApi@patientOtherAllergiesget');
        $api->post('/patients/{patientId}/otherallergies', 'App\Http\Controllers\PatientsApi@patientOtherAllergiespost');

        $api->get('/patients/{patientId}/otherallergies/{otherallergieId}', 'App\Http\Controllers\PatientsApi@patientOtherAllergiesbyIdget');
        $api->put('/patients/{patientId}/otherallergies/{otherallergieId}', 'App\Http\Controllers\PatientsApi@patientOtherAllergiesput');
        $api->delete('/patients/{patientId}/otherallergies/{otherallergieId}', 'App\Http\Controllers\PatientsApi@patientOtherAllergiesdelete');
        // familyplanning
        $api->get('/patients/{patientId}/familyplanning', 'App\Http\Controllers\PatientsApi@patientFamilyPlanningget');
        $api->post('/patients/{patientId}/familyplanning', 'App\Http\Controllers\PatientsApi@patientFamilyPlanningpost');

        $api->get('/patients/{patientId}/familyplanning/{familyplanId}', 'App\Http\Controllers\PatientsApi@patientFamilyPlanningbyIdget');
        $api->put('/patients/{patientId}/familyplanning/{familyplanId}', 'App\Http\Controllers\PatientsApi@patientFamilyPlanningput');
        $api->delete('/patients/{patientId}/familyplanning/{familyplanId}', 'App\Http\Controllers\PatientsApi@patientFamilyPlanningdelete');
        // prophylaxis
        $api->get('/patients/{patientId}/prophylaxis', 'App\Http\Controllers\PatientsApi@patientProphylaxisget');
        $api->post('/patients/{patientId}/prophylaxis', 'App\Http\Controllers\PatientsApi@patientProphylaxispost');

        $api->get('/patients/{patientId}/prophylaxis/{prophylaxisId}', 'App\Http\Controllers\PatientsApi@patientProphylaxisByIdget');
        $api->put('/patients/{patientId}/prophylaxis/{prophylaxisId}', 'App\Http\Controllers\PatientsApi@patientProphylaxisput');
        $api->delete('/patients/{patientId}/prophylaxis/{prophylaxisId}', 'App\Http\Controllers\PatientsApi@patientProphylaxisdelete');

        // visit
        $api->get('/patients/{patientId}/visits', 'App\Http\Controllers\PatientsApi@patientVisits');
        $api->post('/patients/{patientId}/visits', 'App\Http\Controllers\PatientsApi@addPatientVisits');
        $api->put('/patients/{patientId}/visits/{visitId}', 'App\Http\Controllers\PatientsApi@updatePatientVisit');
        $api->delete('/patients/{patientId}/visits/{visitId}', 'App\Http\Controllers\PatientsApi@deletePatientVisit');
        // temp routes for patients 

        // illnesses
        $api->get('/patients/{patientId}/illnesses', 'App\Http\Controllers\PatientsApi@patientIllnessget');
        $api->get('/patients/{patientId}/illnesses/{illnessId}', 'App\Http\Controllers\PatientsApi@patientIllnessByIdget');
        $api->post('/patients/{patientId}/illnesses', 'App\Http\Controllers\PatientsApi@patientIllnesspost');
        $api->put('/patients/{patientId}/illnesses/{illnessId}', 'App\Http\Controllers\PatientsApi@patientIllnessput');
        $api->delete('/patients/{patientId}/illnesses/{illnessId}', 'App\Http\Controllers\PatientsApi@patientIllnessdelete');

        // illnesses other
        $api->get('/patients/{patientId}/illnessesother', 'App\Http\Controllers\PatientsApi@getpatientOtherIllness');
        $api->get('/patients/{patientId}/illnessesother/{illnessId}', 'App\Http\Controllers\PatientsApi@getpatientOtherIllnessbyId');
        $api->post('/patients/{patientId}/illnessesother', 'App\Http\Controllers\PatientsApi@addPatientOtherIllness');
        $api->put('/patients/{patientId}/illnessesother/{illnessId}', 'App\Http\Controllers\PatientsApi@updatePatientOtherIllness');
        $api->delete('/patients/{patientId}/illnessesother/{illnessId}', 'App\Http\Controllers\PatientsApi@deletePatientOtherIllness');


        // partner
        $api->get('/patients/{patientId}/partner', 'App\Http\Controllers\PatientsApi@patientPartnerget');
        $api->post('/patients/{patientId}/partner', 'App\Http\Controllers\PatientsApi@patientPartnerpost');

        $api->get('/patients/{patientId}/partner/{partnerId}', 'App\Http\Controllers\PatientsApi@patientPartnerByIdget');
        $api->put('/patients/{patientId}/partner/{partnerId}', 'App\Http\Controllers\PatientsApi@patientPartnerput');
        $api->delete('/patients/{patientId}/partner/{partnerId}', 'App\Http\Controllers\PatientsApi@patientPartnerdelete');

        // status
        $api->get('/patients/{patientId}/status', 'App\Http\Controllers\PatientsApi@patientStatusget');
        $api->post('/patients/{patientId}/status', 'App\Http\Controllers\PatientsApi@patientStatuspost');

        $api->get('/patients/{patientId}/status/{statusId}', 'App\Http\Controllers\PatientsApi@patientStatusByIdget');
        $api->put('/patients/{patientId}/status/{statusId}', 'App\Http\Controllers\PatientsApi@patientStatusput');
        $api->delete('/patients/{patientId}/status/{statusId}', 'App\Http\Controllers\PatientsApi@patientStatusdelete');
        //  viralload

        $api->get('/patients/{patientId}/viralload', 'App\Http\Controllers\PatientsApi@patientviralload');
        $api->post('/patients/{patientId}/viralload', 'App\Http\Controllers\PatientsApi@addPatientviralload');
        $api->put('/patients/{patientId}/viralload/{viralloadId}', 'App\Http\Controllers\PatientsApi@updatePatientviralload');
        $api->delete('/patients/{patientId}/viralload/{viralloadId}', 'App\Http\Controllers\PatientsApi@deletePatientviralload');
        // return latest
        $api->get('/patients/{patientId}/appointment/latest', 'App\Http\Controllers\PatientsApi@return_latest_appointment');
        $api->get('/patients/{patientId}/visit/latest', 'App\Http\Controllers\PatientsApi@return_latest_visit');
        // return first
        $api->get('/patients/{patientId}/visit/first', 'App\Http\Controllers\PatientsApi@return_first_visit');
        
        // //////////////////////////
        /*
        *   Stock routes
        */
        $api->get('/stock', 'App\Http\Controllers\StockApi@stockget');
        $api->post('/stock', 'App\Http\Controllers\StockApi@stockpost');
        $api->get('/stock/{drugid}/bincard', 'App\Http\Controllers\StockApi@stockBincardget');

        /*
        *   Dispense routes
        */
        $api->get('/patients/{patientId}/dispense', 'App\Http\Controllers\DispenseApi@dispenseget'); // different route in doc
        $api->post('/patients/{patientId}/dispense', 'App\Http\Controllers\DispenseApi@dispensepost'); // different route in doc
        
        /*
        *   Drugs routes
        */  
        $api->get('/drugs', 'App\Http\Controllers\DrugsApi@drugsget');
        $api->get('/drugs/{drugId}', 'App\Http\Controllers\DrugsApi@drugsByIdget');
        $api->post('/drugs', 'App\Http\Controllers\DrugsApi@drugspost');
        $api->put('/drugs/{drugId}', 'App\Http\Controllers\DrugsApi@drugsput');
        $api->delete('/drugs/{drugId}', 'App\Http\Controllers\DrugsApi@drugsdelete');
        // drug dose
        $api->get('/drugs/{drugId}/dose', 'App\Http\Controllers\DrugsApi@drugsDrugIdDoseget');
        $api->post('/drugs/{drugId}/dose', 'App\Http\Controllers\DrugsApi@drugsDrugIdDosepost');

        /* 
        *   Facility routes
        */
        $api->get('/facility', 'App\Http\Controllers\FacilityApi@facilityget');
        $api->get('/facility/{facilityId}', 'App\Http\Controllers\FacilityApi@facilityByIdget');
        $api->post('facility', 'App\Http\Controllers\FacilityApi@facilitypost');
        $api->put('/facility/{facilityId}', 'App\Http\Controllers\FacilityApi@facilityput');
        $api->delete('/facility/{facilityId}', 'App\Http\Controllers\FacilityApi@facilitydelete');
        /*
        *   List routes
        */
        // allergies
        $api->get('/lists/allergies', 'App\Http\Controllers\ListsApi@listsAllergiesget');
        $api->post('/lists/allergies', 'App\Http\Controllers\ListsApi@listsAllergiespost');

        $api->get('/lists/allergies/{allergyId}', 'App\Http\Controllers\ListsApi@listsAllergiesByIdget');
        $api->put('/lists/allergies/{allergyId}', 'App\Http\Controllers\ListsApi@listsAllergiesput');
        $api->delete('/lists/allergies/{allergyId}', 'App\Http\Controllers\ListsApi@listsAllergiesdelete');
        // categories
        $api->get('/lists/categories', 'App\Http\Controllers\ListsApi@listsCategoriesget');
        $api->post('/lists/categories', 'App\Http\Controllers\ListsApi@listsCategoriespost');

        $api->get('/lists/categories/{categoryId}', 'App\Http\Controllers\ListsApi@listsCategoriesByIdget');
        $api->put('/lists/categories/{categoryId}', 'App\Http\Controllers\ListsApi@listsCategoriesput');
        $api->delete('/lists/categories/{categoryId}', 'App\Http\Controllers\ListsApi@listsCategoriesdelete');

        // counties
        $api->get('/lists/counties', 'App\Http\Controllers\ListsApi@listsCountiesget');
        $api->post('/lists/counties', 'App\Http\Controllers\ListsApi@listsCountiespost');
        $api->get('/lists/counties/{countyId}', 'App\Http\Controllers\ListsApi@listsCountiesByIdget');
        $api->put('/lists/counties/{countyId}', 'App\Http\Controllers\ListsApi@listsCountiesput');
        $api->delete('/lists/counties/{countyId}', 'App\Http\Controllers\ListsApi@listsCountiesdelete');

        // SubCounties
        $api->get('/lists/subcounties', 'App\Http\Controllers\ListsApi@listsSubcountiesget');
        $api->post('/lists/subcounties', 'App\Http\Controllers\ListsApi@listsSubcountiespost');

        $api->get('/lists/subcounties/{subcountyID}', 'App\Http\Controllers\ListsApi@listsSubcountiesByIdget');
        $api->put('/lists/subcounties/{subcountyID}', 'App\Http\Controllers\ListsApi@listsSubcountiesput');
        $api->delete('/lists/subcounties/{subcountyID}', 'App\Http\Controllers\ListsApi@listsSubcountiesdelete');
        
        // Family Planning
        $api->get('/lists/familyplanning', 'App\Http\Controllers\ListsApi@listsFamilyplanningget');
        $api->post('/lists/familyplanning', 'App\Http\Controllers\ListsApi@listsFamilyplanningpost');

        $api->get('/lists/familyplanning/{familyplanningId}', 'App\Http\Controllers\ListsApi@listsFamilyplanningget');
        $api->put('/lists/familyplanning/{familyplanningId}', 'App\Http\Controllers\ListsApi@listsFamilyplanningput');
        $api->delete('/lists/familyplanning/{familyplanningId}', 'App\Http\Controllers\ListsApi@listsFamilyplanningdelete');
        // illnesses
        $api->get('/lists/illnesses', 'App\Http\Controllers\ListsApi@listsIllnessesget');
        $api->post('/lists/illnesses', 'App\Http\Controllers\ListsApi@listsIllnessespost');

        $api->get('/lists/illnesses/{illnessId}', 'App\Http\Controllers\ListsApi@listsIllnessesByIdget');
        $api->put('/lists/illnesses/{illnessId}', 'App\Http\Controllers\ListsApi@listsIllnessesput');
        $api->delete('/lists/illnesses/{illnessId}', 'App\Http\Controllers\ListsApi@listsIllnessesdelete');
        // service
        $api->get('/lists/services', 'App\Http\Controllers\ListsApi@listsServicesget');
        $api->post('/lists/services', 'App\Http\Controllers\ListsApi@listsServicespost');

        $api->get('/lists/services/{serviceId}', 'App\Http\Controllers\ListsApi@listsServicesByIdget');
        $api->put('/lists/services/{serviceId}', 'App\Http\Controllers\ListsApi@listsServicesput');
        $api->delete('/lists/services/{serviceId}', 'App\Http\Controllers\ListsApi@listsServicesdelete');
        // change reason
        $api->get('/lists/changereason', 'App\Http\Controllers\ListsApi@listsChangereasonget');
        $api->POST('/lists/changereason', 'App\Http\Controllers\ListsApi@listsChangereasonpost');

        $api->get('/lists/changereason/{changereasonId}', 'App\Http\Controllers\ListsApi@listsChangereasonByIdget');
        $api->put('/lists/changereason/{changereasonId}', 'App\Http\Controllers\ListsApi@listsChangereasonput');
        $api->delete('/lists/changereason/{changereasonId}', 'App\Http\Controllers\ListsApi@listsChangereasondelete');
        // generic
        $api->get('/lists/generic', 'App\Http\Controllers\ListsApi@listsGenericget');
        $api->post('/lists/generic', 'App\Http\Controllers\ListsApi@listsgenericpost');

        $api->get('/lists/generic/{genericId}', 'App\Http\Controllers\ListsApi@listsGenericgenericByIdget');
        $api->put('/lists/generic/{genericId}', 'App\Http\Controllers\ListsApi@listsgenericGenericput');
        $api->delete('/lists/generic/{genericId}', 'App\Http\Controllers\ListsApi@listsGenericdelete');
        // instruction
        $api->get('/lists/instruction', 'App\Http\Controllers\ListsApi@listsInstructionget');
        $api->post('/lists/instruction', 'App\Http\Controllers\ListsApi@listsInstructionpost');

        $api->get('/lists/instruction/{instructionId}', 'App\Http\Controllers\ListsApi@listsInstructionByIdget');
        $api->put('/lists/instruction/{instructionId}', 'App\Http\Controllers\ListsApi@listsInstructionput');
        $api->delete('/lists/instruction/{instructionId}', 'App\Http\Controllers\ListsApi@listsInstructiondelete');
        // Non-aadherence reason
        $api->get('/lists/nonaadherencereason', 'App\Http\Controllers\ListsApi@listsNonaadherencereasonget');
        $api->post('/lists/nonaadherencereason', 'App\Http\Controllers\ListsApi@listsNonaadherencereasonpost');

        $api->get('/lists/nonaadherencereason/{nonadherenceId}', 'App\Http\Controllers\ListsApi@listsNonadherencebyIdget');
        $api->put('/lists/nonaadherencereason/{nonadherenceId}', 'App\Http\Controllers\ListsApi@listsNonadherenceput');
        $api->delete('/lists/nonaadherencereason/{nonadherenceId}', 'App\Http\Controllers\ListsApi@listsNonadherencedelete');
        // patientsources
        $api->get('/lists/patientsources', 'App\Http\Controllers\ListsApi@listsPatientsourcesget');
        $api->post('/lists/patientsources', 'App\Http\Controllers\ListsApi@listsPatientsourcespost');

        $api->get('/lists/patientsources/{patientsourcesId}', 'App\Http\Controllers\ListsApi@listsPatientsourcesByIdget');
        $api->put('/lists/patientsources/{patientsourcesId}', 'App\Http\Controllers\ListsApi@listsPatientsourcesput');
        $api->delete('/lists/patientsources/{patientsourcesId}', 'App\Http\Controllers\ListsApi@listsPatientsourcesdelete');
        // pepreason
        $api->get('/lists/pepreason', 'App\Http\Controllers\ListsApi@listsPepreasonget');
        $api->post('/lists/pepreason', 'App\Http\Controllers\ListsApi@listsPepreasonpost');

        $api->get('/lists/pepreason/{pepreasonId}', 'App\Http\Controllers\ListsApi@listsPepreasonByIdget');
        $api->put('/lists/pepreason/{pepreasonId}', 'App\Http\Controllers\ListsApi@listsPepreasonput');
        $api->delete('/lists/pepreason/{pepreasonId}', 'App\Http\Controllers\ListsApi@listsPepreasondelete');
        // Prophylaxis
        $api->get('/lists/prophylaxis', 'App\Http\Controllers\ListsApi@listsProphylaxisget');
        $api->post('/lists/prophylaxis', 'App\Http\Controllers\ListsApi@listsProphylaxispost');

        $api->get('/lists/prophylaxis/{prophylaxisId}', 'App\Http\Controllers\ListsApi@listsProphylaxisByIdget');
        $api->put('/lists/prophylaxis/{prophylaxisId}', 'App\Http\Controllers\ListsApi@listsProphylaxisput');
        $api->delete('/lists/prophylaxis/{prophylaxisId}', 'App\Http\Controllers\ListsApi@listsProphylaxisdelete');
        // purpose
        $api->get('/lists/purpose', 'App\Http\Controllers\ListsApi@listsPurposeget');
        $api->post('/lists/purpose', 'App\Http\Controllers\ListsApi@listsPurposepost');

        $api->get('/lists/purpose/{purposeId}', 'App\Http\Controllers\ListsApi@listsPurposeByIdget');
        $api->put('/lists/purpose/{purposeId}', 'App\Http\Controllers\ListsApi@listsPurposeput');
        $api->delete('/lists/purpose/{purposeId}', 'App\Http\Controllers\ListsApi@listsPurposedelete');
        // whostage
        $api->get('/lists/whostage', 'App\Http\Controllers\ListsApi@listsWhostageget');
        $api->post('/lists/whostage', 'App\Http\Controllers\ListsApi@listsWhostagepost');

        $api->get('/lists/whostage/{whostageId}', 'App\Http\Controllers\ListsApi@listsWhostageByIdget');
        $api->put('/lists/whostage/{whostageId}', 'App\Http\Controllers\ListsApi@listsWhostageput');
        $api->delete('/lists/whostage/{whostageId}', 'App\Http\Controllers\ListsApi@listsWhostagedelete');
        // supporter // do
        $api->get('/lists/supporter', 'App\Http\Controllers\ListsApi@listsSupporterget');
        $api->post('/lists/supporter', 'App\Http\Controllers\ListsApi@listsSupporterpost');

        $api->get('/lists/supporter/{supporterId}', 'App\Http\Controllers\ListsApi@listsSupporterByIdget');
        $api->put('/lists/supporter/{supporterId}', 'App\Http\Controllers\ListsApi@listsSupporterput');
        $api->delete('/lists/supporter/{supporterId}', 'App\Http\Controllers\ListsApi@listsSupporterdelete');
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
        // status --temp 
        $api->get('/lists/status', 'App\Http\Controllers\ListsApi@listsstatusget');
        $api->post('/lists/status', 'App\Http\Controllers\ListsApi@listsstatuspost');
        $api->get('/lists/status/{statusId}', 'App\Http\Controllers\ListsApi@listsstatusByIdget');
        $api->put('/lists/status/{statusId}', 'App\Http\Controllers\ListsApi@listsstatusput');
        $api->delete('/lists/status/{statusId}', 'App\Http\Controllers\ListsApi@listsstatusdelete');

        /*
        *   cdrr routes
        */
        // cdrr logs
        $api->get('/cdrr/{cdrrId}/log', 'App\Http\Controllers\cdrrApi@cdrrItemget');
        $api->post('/cdrr/{cdrrId}/log', 'App\Http\Controllers\cdrrApi@cdrrItempost');

        $api->get('/cdrr/{cdrrId}/log/{logId}', 'App\Http\Controllers\cdrrApi@cdrrItemByIdget');
        $api->put('/cdrr/{cdrrId}/log/{logId}', 'App\Http\Controllers\cdrrApi@cdrrItemput');
        $api->delete('/cdrr/{cdrrId}/log/{logId}', 'App\Http\Controllers\cdrrApi@cdrrItemdelete');
        // cdrr item
        $api->get('/cdrr/{cdrrId}/item', 'App\Http\Controllers\cdrrApi@cdrrItemget');
        $api->post('/cdrr/{cdrrId}/item', 'App\Http\Controllers\cdrrApi@cdrrItempost');

        $api->get('/cdrr/{cdrrId}/item/{itemId}', 'App\Http\Controllers\cdrrApi@cdrrItemByIdget');
        $api->put('/cdrr/{cdrrId}/item/{itemId}', 'App\Http\Controllers\cdrrApi@cdrrItemput');
        $api->delete('/cdrr/{cdrrId}/item/{itemId}', 'App\Http\Controllers\cdrrApi@cdrrItemdelete');
        // cdrr
        $api->get('/cdrr', 'App\Http\Controllers\CdrrApi@cdrrget');
        $api->post('/cdrr', 'App\Http\Controllers\CdrrApi@cdrrpost');

        $api->get('/cdrr/{cdrrId}', 'App\Http\Controllers\CdrrApi@cdrrByIdget');
        $api->put('/cdrr/{cdrrId}', 'App\Http\Controllers\CdrrApi@cdrrput');

        /*
        * Maps routes
        */        
        // maps log
        $api->get('/maps/{mapId}/log', 'App\Http\Controllers\MapsApi@mapsLogget');
        $api->post('/maps/{mapId}/log', 'App\Http\Controllers\MapsApi@mapsLogpost');

        $api->get('/maps/{mapId}/log/{logId}', 'App\Http\Controllers\MapsApi@mapsLogByIdget');
        $api->put('/maps/{mapId}/log/{logId}', 'App\Http\Controllers\MapsApi@mapsLogput');
        $api->delete('/maps/{mapId}/log/{logId}', 'App\Http\Controllers\MapsApi@mapsLogsdelete');

        // maps
        $api->get('/maps', 'App\Http\Controllers\MapsApi@mapsget');
        $api->post('/maps', 'App\Http\Controllers\MapsApi@mapspost');

        $api->get('/maps/{mapId}', 'App\Http\Controllers\MapsApi@mapsByIdget');
        $api->put('/maps/{mapId}', 'App\Http\Controllers\MapsApi@mapsput');
        $api->delete('/maps/{mapId}', 'App\Http\Controllers\MapsApi@mapsdelete');


  // maps items
        $api->get('/maps/{mapId}/items', 'App\Http\Controllers\MapsApi@mapsItemsget');
        $api->post('/maps/{mapId}/items', 'App\Http\Controllers\MapsApi@mapsItemspost');

        $api->get('/maps/{mapId}/items/{itemsId}', 'App\Http\Controllers\MapsApi@mapsItemsByIdget');
        $api->put('/maps/{mapId}/items/{itemsId}', 'App\Http\Controllers\MapsApi@mapsItemsput');
        $api->delete('/maps/{mapId}/items/{itemsId}', 'App\Http\Controllers\MapsApi@mapsItemssdelete');


        /*
        *   Temp routes
        */
        $api->get('/lists/type', 'App\Http\Controllers\ListsApi@type');
        $api->get('/lists/subcounty', 'App\Http\Controllers\ListsApi@sub_county');

        /*
        * store 
        */
        $api->get('/stores', 'App\Http\Controllers\StockApi@storeget');
        $api->post('/stores', 'App\Http\Controllers\StockApi@storepost');

        $api->get('/stores/{storeId}', 'App\Http\Controllers\StockApi@storeByIdget');
        $api->put('/stores/{storeId}', 'App\Http\Controllers\StockApi@storeput');
        $api->delete('/stores/{storeId}', 'App\Http\Controllers\StockApi@storesdelete');

    });
});
