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

$app->get('/', function () use ($app) {
    return $app->version();
});

/**
 * GET drugAllergies
 * Summary: Fetch Drug Allergies  (for select options)
 * Notes: Fetch Drug Allergies  (for select options)
 * Output-Formats: [application/json]
 */
$app->GET('/lists/allergies', 'AllergiesApi@drugAllergies');
/**
 * GET patientSources
 * Summary: Fetch Drug Allergies  (for select options)
 * Notes: Fetch Drug Allergies  (for select options)
 * Output-Formats: [application/json]
 */
$app->GET('/lists/patientsources', 'AllergiesApi@patientSources');
/**
 * GET drugAllergies
 * Summary: Fetch Drug Allergies  (for select options)
 * Notes: Fetch Drug Allergies  (for select options)
 * Output-Formats: [application/json]
 */
$app->GET('/lists/allergies', 'ListsApi@drugAllergies');
/**
 * GET chronicIllnesses
 * Summary: Fetch Chronic Illnesses (for select options)
 * Notes: Fetch Chronic Illnesses (for select options)
 * Output-Formats: [application/json]
 */
$app->GET('/lists/illnesses', 'ListsApi@chronicIllnesses');
/**
 * GET patientSources
 * Summary: Fetch Drug Allergies  (for select options)
 * Notes: Fetch Drug Allergies  (for select options)
 * Output-Formats: [application/json]
 */
$app->GET('/lists/patientsources', 'ListsApi@patientSources');
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

