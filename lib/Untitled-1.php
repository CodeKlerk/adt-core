<?

/*
*   Patient routes
*/
$app->GET('/patients', 'PatientsApi@patientsGet');
$app->GET('/patients/{patientId}', 'PatientsApi@getPatientById');
$app->POST('/patients', 'PatientsApi@addPatient');
$app->PUT('/patients/{patientId}', 'PatientsApi@updatePatient');
$app->DELETE('/patients/{patientId}', 'PatientsApi@deletePatient');

/*
*   Patient additions routes
*/
// allergies
$app->GET('/patients/{patientId}/allergies/{allergieId}', 'PatientsApi@patientAllergies');
$app->POST('/patients/{patientId}/allergies/{allergieId}', 'PatientsApi@addPatientAllergies');
$app->PUT('/patients/{patientId}/allergies/{allergieId}', 'PatientsApi@updatePatientAllergies');
$app->DELETE('/patients/{patientId}/allergies/{allergieId}', 'PatientsApi@deletePatientAllergies');
// appointment
$app->GET('/patients/{patientId}/appointments/{appointmentId}', 'PatientsApi@patientAppointments');
$app->POST('/patients/{patientId}/appointments/{appointmentId}', 'PatientsApi@addPatientAppointments');
$app->PUT('/patients/{patientId}/appointments/{appointmentId}', 'PatientsApi@updatePatientAppointments');
$app->DELETE('/patients/{patientId}/appointments/{appointmentId}', 'PatientsApi@deletePatientAppointment');
// dependants
$app->GET('/patients/{patientId}/dependants/{dependantId}', 'PatientsApi@patientDependants');
$app->PUT('/patients/{patientId}/dependants/{dependantId}', 'PatientsApi@updatePatientDependant');
$app->DELETE('/patients/{patientId}/dependants/{dependantId}', 'PatientsApi@deletePatientDependants');
// prophylaxis
$app->GET('/patients/{patientId}/prophylaxis/{prophylaxisId}', 'PatientsApi@patientProphylaxis');
$app->PUT('/patients/{patientId}/prophylaxis/{prophylaxisId}', 'PatientsApi@updatePatientProphylaxis');
$app->DELETE('/patients/{patientId}/prophylaxis/{prophylaxisId}', 'PatientsApi@deletePatientProphylaxis');
// regimen
$app->GET('/patients/{patientId}/regimens/{regimenId}', 'PatientsApi@patientregimens');
$app->POST('/patients/{patientId}/regimens/{regimenId}', 'PatientsApi@addPatientRegimen');
$app->PUT('/patients/{patientId}/regimens/{regimenId}', 'PatientsApi@updatePatientRegimens');
$app->DELETE('/patients/{patientId}/regimens/{regimenId}', 'PatientsApi@deletePatientRegimens');
// visit
$app->GET('/patients/{patientId}/visits/{visitId}', 'PatientsApi@patientVisits');
$app->POST('/patients/{patientId}/visits/{visitId}', 'PatientsApi@addPatientVisits');
$app->PUT('/patients/{patientId}/visits/{visitId}', 'PatientsApi@updatePatientVisit');
$app->DELETE('/patients/{patientId}/visits/{visitId}', 'PatientsApi@deletePatientVisit');

/*
*   Drugs routes
*/
$app->GET('/drugs', 'DrugsApi@drugsGet');
$app->GET('/drugs/{drugId}', 'DrugsApi@drugsDrugIdGet');
$app->POST('/drugs', 'DrugsApi@drugsPost');
$app->PUT('/drugs/{drugId}', 'DrugsApi@drugsDrugIdPut');
$app->DELETE('/drugs/{drugId}', 'DrugsApi@drugsDrugIdDelete');
// drug dose
$app->GET('/drugs/{drugId}/dose', 'DrugsApi@drugsDrugIdDoseGet');
$app->POST('/drugs/{drugId}/dose', 'DrugsApi@drugsDrugIdDosePost');

/*
*   List routes
*/
// allergies
$app->GET('/lists/allergies', 'ListsApi@listsAllergiesGet');
$app->POST('/lists/allergies', 'ListsApi@listsAllergiesPost');

$app->GET('/lists/allergies/{allergyId}', 'ListsApi@listsAllergiesByIdGet');
$app->PUT('/lists/allergies/{allergyId}', 'ListsApi@listsAllergiesPut');
$app->DELETE('/lists/allergies/{allergyId}', 'ListsApi@listsAllergiesDelete');
// categories
$app->GET('/lists/categories', 'ListsApi@listsCategoriesGet');
$app->POST('/lists/categories', 'ListsApi@listsCategoriesPost');

$app->GET('/lists/categories/{categoryId}', 'ListsApi@listsCategoriesByIdGet');
$app->PUT('/lists/categories/{categoryId}', 'ListsApi@listsCategoriesPut');
$app->DELETE('/lists/categories/{categoryId}', 'ListsApi@listsCategoriesDelete');

// counties
$app->GET('/lists/counties', 'ListsApi@listsCountiesGet');
$app->GET('/lists/counties/{countyId}', 'ListsApi@listsCountiesGet'); 
// SubCounties

$app->GET('/lists/counties/{countyId}/Subcounties', 'ListsApi@listsCountiesSubcountiesGet');

$app->GET('/lists/counties/{countyId}/Subcounties/{subcountyId}', 'ListsApi@listsCountiesSubcountiesGet');
// Family Planning
$app->GET('/lists/familyplanning', 'ListsApi@listsFamilyplanningGet');
$app->POST('/lists/familyplanning', 'ListsApi@listsFamilyplanningPost');

$app->GET('/lists/familyplanning/{familyplanningId}', 'ListsApi@listsFamilyplanningGet');
$app->PUT('/lists/familyplanning/{familyplanningId}', 'ListsApi@listsFamilyplanningPut');
$app->DELETE('/lists/familyplanning/{familyplanningId}', 'ListsApi@listsFamilyplanningDelete');


$app->GET('/lists/illnesses', 'ListsApi@listsIllnessesGet');

$app->GET('/lists/illnesses/{illnessId}', 'ListsApi@listsIllnessesByIdGet');

$app->POST('/lists/illnesses', 'ListsApi@listsIllnessesPost');

$app->PUT('/lists/illnesses/{illnessId}', 'ListsApi@listsIllnessesPut');

$app->DELETE('/lists/illnesses/{illnessId}', 'ListsApi@listsIllnessesDelete');


$app->GET('/lists/services', 'ListsApi@listsServicesGet');

$app->GET('/lists/services/{serviceId}', 'ListsApi@listsServicesByIdGet');

$app->POST('/lists/services', 'ListsApi@listsServicesPost');

$app->PUT('/lists/services/{serviceId}', 'ListsApi@listsServicesPut');

$app->DELETE('/lists/services/{serviceId}', 'ListsApi@listsServicesDelete');
