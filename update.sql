
ALTER TABLE `tbl_regimen_drug`
CHANGE `regimen` `regimen_id` bigint NOT NULL AFTER `id`,
CHANGE `drugcode` `drug_id` int NOT NULL AFTER `regimen_id`,
DROP `source`,
DROP `active`;



CREATE TABLE `tbl_patient_viralload` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `patient_id` bigint NOT NULL,
  `test_date` date NOT NULL,
  `result` text NOT NULL,
  `justification` text NOT NULL
);

ALTER TABLE `tbl_patient_viralload`
ADD `deleted_at` timestamp NOT NULL;

ALTER TABLE `tbl_patient_viralload`
ADD `updated_at` timestamp NOT NULL;


 