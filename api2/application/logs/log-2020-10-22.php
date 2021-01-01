<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-10-22 08:35:50 --> Query error: Unknown column 'ref_kelurahan.status' in 'where clause' - Invalid query: SELECT *
FROM `ref_provinsi`
WHERE `ref_kelurahan`.`status` = 'ACTIVE'
ORDER BY `ref_provinsi`.`name` ASC
ERROR - 2020-10-22 08:36:01 --> Query error: Unknown column 'ref_kelurahan.status' in 'where clause' - Invalid query: SELECT *
FROM `ref_provinsi`
WHERE `ref_kelurahan`.`status` = 'ACTIVE'
ORDER BY `ref_provinsi`.`name` ASC
ERROR - 2020-10-22 16:03:34 --> Query error: Unknown column 'ref_kelurahan.kab_kota_id' in 'where clause' - Invalid query: SELECT *
FROM `ref_kecamatan`
WHERE `ref_kecamatan`.`status` = 'ACTIVE'
AND `ref_kelurahan`.`kab_kota_id` = '2'
ORDER BY `ref_kecamatan`.`name` ASC
ERROR - 2020-10-22 16:35:46 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ' `name_owner`, `jns_bidang_id`, `nik`, `id_master_field`, `province`, `district`' at line 1 - Invalid query: INSERT INTO `field` (`spp_id`, , `name_owner`, `jns_bidang_id`, `nik`, `id_master_field`, `province`, `district`, `sub_district`, `village`, `proof_owner`, `area`, `nominal`, `nik_doc_id`, `poo_doc_id`, `result_doc_id`, `letter_doc_id`, `sptjm_doc_id`, `total_field`, `document_id`, `company_id`) VALUES ('34', 'TN.1234552', 'Sugeng Riyadi', '11', '3232323', '2323232323', '1', '2', '14', '331', 'sertifikat', '4242', '343434', '39', '40', '41', '42', '43', '', NULL, '2')
ERROR - 2020-10-22 16:36:21 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ' `name_owner`, `jns_bidang_id`, `nik`, `id_master_field`, `province`, `district`' at line 1 - Invalid query: INSERT INTO `field` (`spp_id`, , `name_owner`, `jns_bidang_id`, `nik`, `id_master_field`, `province`, `district`, `sub_district`, `village`, `proof_owner`, `area`, `nominal`, `nik_doc_id`, `poo_doc_id`, `result_doc_id`, `letter_doc_id`, `sptjm_doc_id`, `total_field`, `document_id`, `company_id`) VALUES ('34', 'TN.1234552', 'Sugeng Riyadi', '11', '3232323', '2323232323', '1', '2', '14', '331', 'sertifikat', '4242', '343434', '39', '40', '41', '42', '43', '', NULL, '2')
ERROR - 2020-10-22 16:37:12 --> Query error: Unknown column 'nik' in 'field list' - Invalid query: INSERT INTO `field` (`spp_id`, `name_owner`, `jns_bidang_id`, `nik`, `id_master_field`, `province`, `district`, `sub_district`, `village`, `proof_owner`, `area`, `nominal`, `nik_doc_id`, `poo_doc_id`, `result_doc_id`, `letter_doc_id`, `sptjm_doc_id`, `total_field`, `document_id`, `company_id`) VALUES ('34', 'Sugeng Riyadi', '11', '3232323', '2323232323', '1', '2', '14', '331', 'sertifikat', '4242', '343434', '39', '40', '41', '42', '43', '', NULL, '2')
ERROR - 2020-10-22 16:38:14 --> Query error: Unknown column 'total_field' in 'field list' - Invalid query: INSERT INTO `field` (`spp_id`, `name_owner`, `jns_bidang_id`, `nik`, `id_master_field`, `province`, `district`, `sub_district`, `village`, `proof_owner`, `area`, `nominal`, `nik_doc_id`, `poo_doc_id`, `result_doc_id`, `letter_doc_id`, `sptjm_doc_id`, `total_field`, `document_id`, `company_id`) VALUES ('34', 'Sugeng Riyadi', '11', '3232323', '2323232323', '1', '2', '14', '331', 'sertifikat', '4242', '343434', '39', '40', '41', '42', '43', '', NULL, '2')
ERROR - 2020-10-22 16:47:37 --> Query error: Unknown column 'total_field' in 'field list' - Invalid query: INSERT INTO `field` (`spp_id`, `name_owner`, `jns_bidang_id`, `nik`, `id_master_field`, `province`, `district`, `sub_district`, `village`, `proof_owner`, `area`, `nominal`, `nik_doc_id`, `poo_doc_id`, `result_doc_id`, `letter_doc_id`, `sptjm_doc_id`, `total_field`, `document_id`, `company_id`) VALUES ('34', 'Sugeng Riyadi', '11', '3232323', '2323232323', '1', '2', '14', '331', 'sertifikat', '4242', '343434', '39', '40', '41', '42', '43', '', NULL, '2')
ERROR - 2020-10-22 16:52:43 --> Severity: Notice --> Undefined property: stdClass::$spp_num /var/www/html/lfm/dev/api/application/controllers/Bidang.php 31
ERROR - 2020-10-22 16:52:43 --> Severity: Notice --> Undefined property: stdClass::$psn_name /var/www/html/lfm/dev/api/application/controllers/Bidang.php 32
ERROR - 2020-10-22 16:52:43 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Bidang.php 34
ERROR - 2020-10-22 16:53:43 --> Severity: Notice --> Undefined property: stdClass::$spp_num /var/www/html/lfm/dev/api/application/controllers/Bidang.php 31
ERROR - 2020-10-22 16:53:43 --> Severity: Notice --> Undefined property: stdClass::$psn_name /var/www/html/lfm/dev/api/application/controllers/Bidang.php 32
ERROR - 2020-10-22 16:53:43 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Bidang.php 34
ERROR - 2020-10-22 16:54:26 --> Severity: Notice --> Undefined property: stdClass::$psn_name /var/www/html/lfm/dev/api/application/controllers/Bidang.php 32
ERROR - 2020-10-22 16:54:26 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Bidang.php 34
ERROR - 2020-10-22 17:22:47 --> Severity: Notice --> Undefined property: stdClass::$psn_name /var/www/html/lfm/dev/api/application/controllers/Bidang.php 32
ERROR - 2020-10-22 17:22:47 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Bidang.php 34
ERROR - 2020-10-22 17:22:47 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Bidang.php 35
ERROR - 2020-10-22 17:22:47 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Bidang.php 36
ERROR - 2020-10-22 17:22:47 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Bidang.php 37
ERROR - 2020-10-22 17:22:47 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Bidang.php 38
ERROR - 2020-10-22 17:22:47 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Bidang.php 39
ERROR - 2020-10-22 17:22:47 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Bidang.php 40
ERROR - 2020-10-22 17:22:47 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Bidang.php 41
ERROR - 2020-10-22 17:22:47 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/lfm/dev/api/system/core/Exceptions.php:271) /var/www/html/lfm/dev/api/system/core/Common.php 570
ERROR - 2020-10-22 20:17:52 --> Severity: Notice --> Undefined property: stdClass::$psn_name /var/www/html/lfm/dev/api/application/controllers/Bidang.php 32
ERROR - 2020-10-22 20:17:52 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Bidang.php 34
ERROR - 2020-10-22 20:17:52 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Bidang.php 35
ERROR - 2020-10-22 20:17:52 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Bidang.php 36
ERROR - 2020-10-22 20:17:52 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Bidang.php 37
ERROR - 2020-10-22 20:17:52 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Bidang.php 38
ERROR - 2020-10-22 20:17:52 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Bidang.php 39
ERROR - 2020-10-22 20:17:52 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Bidang.php 40
ERROR - 2020-10-22 20:17:52 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Bidang.php 41
ERROR - 2020-10-22 20:17:52 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/lfm/dev/api/system/core/Exceptions.php:271) /var/www/html/lfm/dev/api/system/core/Common.php 570
