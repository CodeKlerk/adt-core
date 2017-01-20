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
$app->group(['prefix' => 'ADT_CORE/v0.1'], function () use ($app) {

$app->get('/', function () use ($app) {
    return $app->version();
});

/**
 * GET listsServicesGet
 * Summary: Fetch Drug Allergies  (for select options)
 * Notes: Fetch Drug Allergies  (for select options)
 * Output-Formats: [application/json, application/xml]
 */
$app->GET('/lists/services', 'ListsServicesApi@listsServicesGet');

/**
 * POST addPatient
 * Summary: Add a new patient to the facility
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->POST('/patients', 'PatientsApi@addPatient');
/**
 * GET patientsGet
 * Summary: get&#39;s a list of patients
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->GET('/patients', 'PatientsApi@patientsGet');
/**
 * DELETE deletePatient
 * Summary: Deletes a patient
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->DELETE('/patients/{patientId}', 'PatientsApi@deletePatient');
/**
 * GET getPatientById
 * Summary: Find patient by patientId
 * Notes: Returns the patient with the specified patientId
 * Output-Formats: [application/json, application/xml]
 */
$app->GET('/patients/{patientId}', 'PatientsApi@getPatientById');
/**
 * PUT updatePatient
 * Summary: Update an existing patient
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->PUT('/patients/{patientId}', 'PatientsApi@updatePatient');
/**
 * POST addPatientAllergies
 * Summary: Add a new PatientDrugAllergy to a patient
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->POST('/patients/{patientId}/allergies/{allergieId}', 'PatientsApi@addPatientAllergies');
/**
 * DELETE deletePatientAllergies
 * Summary: Remove a patient PatientAllergies
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->DELETE('/patients/{patientId}/allergies/{allergieId}', 'PatientsApi@deletePatientAllergies');
/**
 * GET patientAllergies
 * Summary: Fetch a patient&#39;s allergies
 * Notes: Fetch allergies
 * Output-Formats: [application/json]
 */
$app->GET('/patients/{patientId}/allergies/{allergieId}', 'PatientsApi@patientAllergies');
/**
 * PUT updatePatientAllergies
 * Summary: Update an existing patient Allergies
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->PUT('/patients/{patientId}/allergies/{allergieId}', 'PatientsApi@updatePatientAllergies');
/**
 * POST addPatientAppointments
 * Summary: Add a new Appointments to a patient
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->POST('/patients/{patientId}/appointments/{appointmentId}', 'PatientsApi@addPatientAppointments');
/**
 * DELETE deletePatientAppointment
 * Summary: Remove a patient appointment
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->DELETE('/patients/{patientId}/appointments/{appointmentId}', 'PatientsApi@deletePatientAppointment');
/**
 * GET patientAppointments
 * Summary: Fetch the patient&#39;s appointments
 * Notes: Fetch appointments
 * Output-Formats: [application/json]
 */
$app->GET('/patients/{patientId}/appointments/{appointmentId}', 'PatientsApi@patientAppointments');
/**
 * PUT updatePatientAppointments
 * Summary: Update an existing patient appointment
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->PUT('/patients/{patientId}/appointments/{appointmentId}', 'PatientsApi@updatePatientAppointments');
/**
 * DELETE deletePatientDependants
 * Summary: Remove a patient Dependants
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->DELETE('/patients/{patientId}/dependants/{dependantId}', 'PatientsApi@deletePatientDependants');
/**
 * GET patientDependants
 * Summary: Fetch a patient&#39;s dependants
 * Notes: Fetch dependants
 * Output-Formats: [application/json]
 */
$app->GET('/patients/{patientId}/dependants/{dependantId}', 'PatientsApi@patientDependants');
/**
 * PUT updatePatientDependant
 * Summary: Update an existing patient dependants
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->PUT('/patients/{patientId}/dependants/{dependantId}', 'PatientsApi@updatePatientDependant');
/**
 * DELETE deletePatientProphylaxis
 * Summary: Remove a patient of a Prophylaxis
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->DELETE('/patients/{patientId}/prophylaxis/{prophylaxisId}', 'PatientsApi@deletePatientProphylaxis');
/**
 * GET patientProphylaxis
 * Summary: Fetch the prophylaxis patient is administered
 * Notes: Fetch prophylaxis
 * Output-Formats: [application/json]
 */
$app->GET('/patients/{patientId}/prophylaxis/{prophylaxisId}', 'PatientsApi@patientProphylaxis');
/**
 * PUT updatePatientProphylaxis
 * Summary: Update an existing patient prophylaxis
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->PUT('/patients/{patientId}/prophylaxis/{prophylaxisId}', 'PatientsApi@updatePatientProphylaxis');
/**
 * POST addPatientRegimen
 * Summary: Add a new regimen to a patient
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->POST('/patients/{patientId}/regimens/{regimenId}', 'PatientsApi@addPatientRegimen');
/**
 * DELETE deletePatientRegimens
 * Summary: Remove a patient of a regimen
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->DELETE('/patients/{patientId}/regimens/{regimenId}', 'PatientsApi@deletePatientRegimens');
/**
 * GET patientregimens
 * Summary: Fetch the regimens patient is administered
 * Notes: Fetch regimens
 * Output-Formats: [application/json]
 */
$app->GET('/patients/{patientId}/regimens/{regimenId}', 'PatientsApi@patientregimens');
/**
 * PUT updatePatientRegimens
 * Summary: Update an existing patient regimen
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->PUT('/patients/{patientId}/regimens/{regimenId}', 'PatientsApi@updatePatientRegimens');
/**
 * POST addPatientVisits
 * Summary: Add a new Visits to a patient
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->POST('/patients/{patientId}/visits/{visitId}', 'PatientsApi@addPatientVisits');
/**
 * DELETE deletePatientVisit
 * Summary: Remove a patient Visit
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->DELETE('/patients/{patientId}/visits/{visitId}', 'PatientsApi@deletePatientVisit');
/**
 * GET patientVisits
 * Summary: Fetch a patient&#39;s visit
 * Notes: Fetch visits
 * Output-Formats: [application/json]
 */
$app->GET('/patients/{patientId}/visits/{visitId}', 'PatientsApi@patientVisits');
/**
 * PUT updatePatientVisit
 * Summary: Update an existing patient appointment
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->PUT('/patients/{patientId}/visits/{visitId}', 'PatientsApi@updatePatientVisit');
/**
 * POST addService
 * Summary: Add a new service to the facility
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->POST('/services', 'PatientsApi@addService');
/**
 * GET servicesGet
 * Summary: fetches a list of services at a facility
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->GET('/services', 'ServicesApi@servicesGet');
/**
 * DELETE deleteService
 * Summary: Deletes a Service
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->DELETE('/services/{serviceId}', 'ServicesApi@deleteService');
/**
 * GET getServiceById
 * Summary: Find service by serviceId
 * Notes: Returns the service with the specified serviceId
 * Output-Formats: [application/json, application/xml]
 */
$app->GET('/services/{serviceId}', 'ServicesApi@getServiceById');
/**
 * PUT updateService
 * Summary: Update an existing patient
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->PUT('/services/{serviceId}', 'ServicesApi@updateService');

/**
 * GET drugsGet
 * Summary: fetches a list of services at a facility
 * Notes: 

 */
$app->GET('/drugs', 'DrugsApi@drugsGet');
/**
 * POST drugsPost
 * Summary: Add a new service to the facility
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->POST('/drugs', 'DrugsApi@drugsPost');
/**
 * DELETE drugsDrugIdDelete
 * Summary: Deletes the drug specified by drugId
 * Notes: 

 */
$app->DELETE('/drugs/{drugId}', 'DrugsApi@drugsDrugIdDelete');
/**
 * GET drugsDrugIdGet
 * Summary: Find drug by drugId
 * Notes: Returns the drug with the specified drugId

 */
$app->GET('/drugs/{drugId}', 'DrugsApi@drugsDrugIdGet');
/**
 * PUT drugsDrugIdPut
 * Summary: Update an existing drug specified by the drugId
 * Notes: 

 */
$app->PUT('/drugs/{drugId}', 'DrugsApi@drugsDrugIdPut');
/**
 * GET drugsDrugIdDoseGet
 * Summary: Find drug dose for drugId
 * Notes: Returns the dose for the drug  with the specified drugId
 * Output-Formats: [application/json]
 */
$app->GET('/drugs/{drugId}/dose', 'DrugsApi@drugsDrugIdDoseGet');
/**
 * POST drugsDrugIdDosePost
 * Summary: Add a dose for a particular drug with drugId
 * Notes: 

 */
$app->POST('/drugs/{drugId}/dose', 'DrugsApi@drugsDrugIdDosePost');

/**
 * GET usersGet
 * Summary: fetches a list of users at a facility
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->GET('/users', 'DefaultApi@usersGet');
/**
 * POST usersPost
 * Summary: Add a new user to the facility
 * Notes: 
 * Output-Formats: [application/json, application/xml]
 */
$app->POST('/users', 'DefaultApi@usersPost');
/**
 * DELETE usersUsersIdDelete
 * Summary: Deletes the drug specified by drugId
 * Notes: 

 */
$app->DELETE('/users/{usersId}', 'DefaultApi@usersUsersIdDelete');
/**
 * GET usersUsersIdGet
 * Summary: Find drug by drugId
 * Notes: Returns the drug with the specified drugId

 */
$app->GET('/users/{usersId}', 'DefaultApi@usersUsersIdGet');
/**
 * PUT usersUsersIdPut
 * Summary: Update an existing drug specified by the drugId
 * Notes: 

 */
$app->PUT('/users/{usersId}', 'DefaultApi@usersUsersIdPut');
/**
 * GET listsAllergiesGet
 * Summary: Fetch Allergy specified by allergyId
 * Notes: Fetch all Allergy 
 * Output-Formats: [application/json, application/xml]
 */
$app->GET('/lists/allergies', 'ListsApi@listsAllergiesGet');

/**
 * GET listsAllergiesAllergyIdGet
 * Summary: Fetch Allergy specified by allergyId
 * Notes: Fetch Allergy specified by allergyId
 * Output-Formats: [application/json, application/xml]
 */
$app->GET('/lists/allergies/{allergyId}', 'ListsApi@listsAllergiesByIdGet');
/**
 * POST listsAllergiesPost
 * Summary: create a Category
 * Notes: create a Category
 * Output-Formats: [application/json, application/xml]
 */
$app->POST('/lists/allergies', 'ListsApi@listsAllergiesPost');

/**
 * PUT listsAllergiesAllergyIdPut
 * Summary: Update an existing Category
 * Notes: 
 */
$app->PUT('/lists/allergies/{allergyId}', 'ListsApi@listsAllergiesPut');
/**
 * DELETE listsAllergiesAllergyIdDelete
 * Summary: Deletes a Allergy specified by serviceId
 * Notes: 
 */
$app->DELETE('/lists/allergies/{allergyId}', 'ListsApi@listsAllergiesDelete');

/**
 * GET listsCategoriesGet
 * Summary: Fetch Regimen Categories (for select options)
 * Notes: Fetch List of all categories for regimens (for select options)
 * Output-Formats: [application/json, application/xml]
 */
$app->GET('/lists/categories', 'ListsApi@listsCategoriesGet');
/**
 * GET listsCategoriesCategoryIdGet
 * Summary: Fetch Category specified by categoryId
 * Notes: Fetch Category specified by categoryId
 * Output-Formats: [application/json, application/xml]
 */
$app->GET('/lists/categories/{categoryId}', 'ListsApi@listsCategoriesGet');

/**
 * POST listsCategoriesPost
 * Summary: create a Category
 * Notes: create a Category
 * Output-Formats: [application/json, application/xml]
 */
$app->POST('/lists/categories', 'ListsApi@listsCategoriesPost');
/**
 * PUT listsCategoriesCategoryIdPut
 * Summary: Update an existing Category
 * Notes: 
 */
$app->PUT('/lists/categories/{categoryId}', 'ListsApi@listsCategoriesCategoryIdPut');
/**
 * DELETE listsCategoriesCategoryIdDelete
 * Summary: Deletes a Category specified by serviceId
 * Notes: 
 */
$app->DELETE('/lists/categories/{categoryId}', 'ListsApi@listsCategoriesDelete');


/**
 * GET listsCountiesGet
 * Summary: Fetch counties (for select options)
 * Notes: Fetch List of all counties for regimens (for select options)
 * Output-Formats: [application/json, application/xml]
 */
$app->GET('/lists/counties', 'ListsApi@listsCountiesGet');
/**
 * GET listsCountiesCountyIdGet
 * Summary: Fetch County specified by countyId
 * Notes: Fetch County specified by countyId
 * Output-Formats: [application/json, application/xml]
 */
$app->GET('/lists/counties/{countyId}', 'ListsApi@listsCountiesGet'); 

/**
 * POST listsCountiesPost
 * Summary: create a Category
 * Notes: create a Category
 * Output-Formats: [application/json, application/xml]
 */

$app->POST('/lists/counties', 'ListsApi@listsCountiesPost');
/**
 * PUT listsCountiesCountyIdPut
 * Summary: Update an existing County
 * Notes: 
 */
$app->PUT('/lists/counties/{countyId}', 'ListsApi@listsCountiesPut');
/**
 * DELETE listsCountiesCountyIdDelete
 * Summary: Deletes a County specified by countyId
 * Notes: 
 */
$app->DELETE('/lists/counties/{countyId}', 'ListsApi@listsCountiesDelete');

/**
 * GET listsCountiesCountyIdSubcountiesGet
 * Summary: Fetch counties (for select options)
 * Notes: Fetch List of all counties for regimens (for select options)
 * Output-Formats: [application/json, application/xml]
 */
$app->GET('/lists/counties/{countyId}/Subcounties', 'ListsApi@listsCountiesSubcountiesGet');
/**
 * GET listsCountiesCountyIdSubcountiesSubcountyIdGet
 * Summary: Fetch County specified by countyId
 * Notes: Fetch subCounty specified by subcountyId within County (countyId)
 * Output-Formats: [application/json, application/xml]
 */
$app->GET('/lists/counties/{countyId}/Subcounties/{subcountyId}', 'ListsApi@listsCountiesSubcountiesGet');
/**
 * POST listsCountiesCountyIdSubcountiesPost
 * Summary: create a Category
 * Notes: create a Category
 * Output-Formats: [application/json, application/xml]
 */
 
$app->POST('/lists/counties/{countyId}/Subcounties', 'ListsApi@listsCountiesSubcountiesPost');
/**
 * PUT listsCountiesCountyIdSubcountiesSubcountyIdPut
 * Summary: Update an existing SubCounty for a county (countyId)
 * Notes: 
 */
$app->PUT('/lists/counties/{countyId}/Subcounties/{subcountyId}', 'ListsApi@listsCountiesSubcountiesPut');
/**
 * DELETE listsCountiesCountyIdSubcountiesSubcountyIdDelete
 * Summary: Deletes a SubCounty specified by subcountyId in a County specified by countyId
 * Notes: 
 */
$app->DELETE('/lists/counties/{countyId}/Subcounties/{subcountyId}', 'ListsApi@listsCountiesSubcountiesDelete');


/**
 * GET listsFamilyplanningGet
 * Summary: Fetch list of Family Planning (for select options)
 * Notes: List of Family planning  items(for select options)
 * Output-Formats: [application/json, application/xml]
 */
$app->GET('/lists/familyplanning', 'ListsApi@listsFamilyplanningGet');
/**
 * GET listsFamilyplanningFamilyplanningIdGet
 * Summary: Fetch a FamilyPlanning item specified by familyplanningId
 * Notes: Fetch a FamilyPlanning item specified by familyplanningId
 * Output-Formats: [application/json, application/xml]
 */
$app->GET('/lists/familyplanning/{familyplanningId}', 'ListsApi@listsFamilyplanningGet');
/**
 * POST listsFamilyplanningPost
 * Summary: create a FamilyPlanning item
 * Notes: create a FamilyPlanning item
 * Output-Formats: [application/json, application/xml]
 */
$app->POST('/lists/familyplanning', 'ListsApi@listsFamilyplanningPost');
/**
 * PUT listsFamilyplanningFamilyplanningIdPut
 * Summary: Update an existing FamilyPlanning item
 * Notes: 

 */
$app->PUT('/lists/familyplanning/{familyplanningId}', 'ListsApi@listsFamilyplanningPut');
/**
 * DELETE listsFamilyplanningFamilyplanningIdDelete
 * Summary: Deletes a FamilyPlanning item specified by familyplanningId
 * Notes: 

 */
$app->DELETE('/lists/familyplanning/{familyplanningId}', 'ListsApi@listsFamilyplanningDelete');


/**
 * GET listsIllnessesGet
 * Summary: Fetch list of Illnessess(for select options)
 * Notes: List of Illnessess(for select options)

 */
$app->GET('/lists/illnesses', 'ListsApi@listsIllnessesGet');
/**
 * GET listsIllnessesIllnessIdGet
 * Summary: Fetch a Illness specified by illnessId
 * Notes: Fetch a Illness specified by illnessId
 * Output-Formats: [application/json]
 */
$app->GET('/lists/illnesses/{illnessId}', 'ListsApi@listsIllnessesGet');
/**
 * POST listsIllnessesPost
 * Summary: Add an illness
 * Notes: Add an illness

 */
$app->POST('/lists/illnesses', 'ListsApi@listsIllnessesPost');
/**
 * PUT listsIllnessesIllnessIdPut
 * Summary: Update an existing Illness specified by illnessId
 * Notes: 

 */
$app->PUT('/lists/illnesses/{illnessId}', 'ListsApi@listsIllnessesPut');
/**
 * DELETE listsIllnessesIllnessIdDelete
 * Summary: Deletes a FamilyPlanning item specified by familyplanningId
 * Notes: 

 */
$app->DELETE('/lists/illnesses/{illnessId}', 'ListsApi@listsIllnessesDelete');


/**
 * GET listsServicesGet
 * Summary: Fetch Drug Allergies  (for select options)
 * Notes: Fetch Drug Allergies  (for select options)
 * Output-Formats: [application/json, application/xml]
 */
$app->GET('/lists/services', 'ListsApi@listsServicesGet');
/**
 * GET listsServicesServiceIdGet
 * Summary: Fetch Service specified by serviceId
 * Notes: Fetch Service specified by serviceId
 * Output-Formats: [application/json, application/xml]
 */
$app->GET('/lists/services/{serviceId}', 'ListsApi@listsServicesGet');
/**
 * POST listsServicesPost
 * Summary: create a service
 * Notes: create a service
 * Output-Formats: [application/json, application/xml]
 */
$app->POST('/lists/services', 'ListsApi@listsServicesPost');
/**
 * PUT listsServicesServiceIdPut
 * Summary: Update an existing Service
 * Notes: 

 */
$app->PUT('/lists/services/{serviceId}', 'ListsApi@listsServicesPut');
/**
 * DELETE listsServicesServiceIdDelete
 * Summary: Deletes a service specified by serviceId
 * Notes: 

 */
$app->DELETE('/lists/services/{serviceId}', 'ListsApi@listsServicesDelete');

    // ///////////////////////
    // temp routes         //
    // //////////////////////

$app->GET('/lists/patientsources', 'ListsApi@patientSources');
$app->GET('/lists/whostage', 'ListsApi@whoStage'); 
$app->GET('/lists/prophylaxis', 'ListsApi@prophylaxis');
$app->GET('/lists/pep', 'ListsApi@pep');

});