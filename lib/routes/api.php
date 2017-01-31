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
        $api->get('brian', function(){ return "brian"; });
        // 
        /*
        *   Patient routes
        */
        $api->get('/patients', 'App\Http\Controllers\PatientsApi@patientsget');
        $api->get('/patients/{patientId}', 'App\Http\Controllers\PatientsApi@getPatientById');
        $api->post('/patients', 'App\Http\Controllers\PatientsApi@addPatient');
        $api->put('/patients/{patientId}', 'App\Http\Controllers\PatientsApi@updatePatient');
        $api->delete('/patients/{patientId}', 'App\Http\Controllers\PatientsApi@deletePatient');

        /*
        *   Patient additions routes
        */
        // allergies
        $api->get('/patients/{patientId}/allergies/{allergieId}', 'App\Http\Controllers\PatientsApi@patientAllergies');
        $api->post('/patients/{patientId}/allergies/{allergieId}', 'App\Http\Controllers\PatientsApi@addPatientAllergies');
        $api->put('/patients/{patientId}/allergies/{allergieId}', 'App\Http\Controllers\PatientsApi@updatePatientAllergies');
        $api->delete('/patients/{patientId}/allergies/{allergieId}', 'App\Http\Controllers\PatientsApi@deletePatientAllergies');
        // apiointment
        $api->get('/patients/{patientId}/apiointments/{apiointmentId}', 'App\Http\Controllers\PatientsApi@patientapiointments');
        $api->post('/patients/{patientId}/apiointments/{apiointmentId}', 'App\Http\Controllers\PatientsApi@addPatientapiointments');
        $api->put('/patients/{patientId}/apiointments/{apiointmentId}', 'App\Http\Controllers\PatientsApi@updatePatientapiointments');
        $api->delete('/patients/{patientId}/apiointments/{apiointmentId}', 'App\Http\Controllers\PatientsApi@deletePatientapiointment');
        // dependants
        $api->get('/patients/{patientId}/dependants/{dependantId}', 'App\Http\Controllers\PatientsApi@patientDependants');
        $api->put('/patients/{patientId}/dependants/{dependantId}', 'App\Http\Controllers\PatientsApi@updatePatientDependant');
        $api->delete('/patients/{patientId}/dependants/{dependantId}', 'App\Http\Controllers\PatientsApi@deletePatientDependants');
        // prophylaxis
        $api->get('/patients/{patientId}/prophylaxis/{prophylaxisId}', 'App\Http\Controllers\PatientsApi@patientProphylaxis');
        $api->put('/patients/{patientId}/prophylaxis/{prophylaxisId}', 'App\Http\Controllers\PatientsApi@updatePatientProphylaxis');
        $api->delete('/patients/{patientId}/prophylaxis/{prophylaxisId}', 'App\Http\Controllers\PatientsApi@deletePatientProphylaxis');
        // regimen
        $api->get('/patients/{patientId}/regimens/{regimenId}', 'App\Http\Controllers\PatientsApi@patientregimens');
        $api->post('/patients/{patientId}/regimens/{regimenId}', 'App\Http\Controllers\PatientsApi@addPatientRegimen');
        $api->put('/patients/{patientId}/regimens/{regimenId}', 'App\Http\Controllers\PatientsApi@updatePatientRegimens');
        $api->delete('/patients/{patientId}/regimens/{regimenId}', 'App\Http\Controllers\PatientsApi@deletePatientRegimens');
        // visit
        $api->get('/patients/{patientId}/visits/{visitId}', 'App\Http\Controllers\PatientsApi@patientVisits');
        $api->post('/patients/{patientId}/visits/{visitId}', 'App\Http\Controllers\PatientsApi@addPatientVisits');
        $api->put('/patients/{patientId}/visits/{visitId}', 'App\Http\Controllers\PatientsApi@updatePatientVisit');
        $api->delete('/patients/{patientId}/visits/{visitId}', 'App\Http\Controllers\PatientsApi@deletePatientVisit');
        
        /*
        *   Dispense routes
        */
        // $api->get('/patients/{patientId}/dispense', 'App\Http\Controllers\DispenseApi@dispenseDrugs'); // different route in doc
        $api->post('/patients/{patientId}/dispense', 'App\Http\Controllers\DispenseApi@dispensepost'); // different route in doc
        
        /*
        *   Drugs routes
        */
        $api->get('/drugs', 'App\Http\Controllers\DrugsApi@drugsget');
        $api->get('/drugs/{drugId}', 'App\Http\Controllers\DrugsApi@drugsDrugIdget');
        $api->post('/drugs', 'App\Http\Controllers\DrugsApi@drugspost');
        $api->put('/drugs/{drugId}', 'App\Http\Controllers\DrugsApi@drugsDrugIdput');
        $api->delete('/drugs/{drugId}', 'App\Http\Controllers\DrugsApi@drugsDrugIddelete');
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
        $api->get('/lists/counties/{countyId}', 'App\Http\Controllers\ListsApi@listsCountiesget'); 
        // SubCounties

        $api->get('/lists/counties/{countyId}/Subcounties', 'App\Http\Controllers\ListsApi@listsCountiesSubcountiesget');

        $api->get('/lists/counties/{countyId}/Subcounties/{subcountyId}', 'App\Http\Controllers\ListsApi@listsCountiesSubcountiesget');
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

        /*
        *   Temp routes
        */
        $api->get('/lists/type', 'App\Http\Controllers\ListsApi@type');
        $api->get('/lists/sub_county', 'App\Http\Controllers\ListsApi@sub_county');
    });
});
