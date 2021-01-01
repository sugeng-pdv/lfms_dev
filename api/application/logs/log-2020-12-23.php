<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-12-23 04:34:17 --> Severity: Notice --> Undefined property: stdClass::$message_rejected /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi_ppk.php 34
ERROR - 2020-12-23 04:34:17 --> Severity: Notice --> Undefined property: stdClass::$message_rejected /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi_ppk.php 34
ERROR - 2020-12-23 04:42:13 --> Severity: Notice --> Undefined property: Penelitian_administrasi::$ProcessSpp_model /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-23 04:42:13 --> Severity: Notice --> Trying to get property 'db' of non-object /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-23 04:42:13 --> Severity: error --> Exception: Call to a member function get_where() on null /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-23 05:06:52 --> Severity: Notice --> Undefined property: Penelitian_administrasi::$ProcessSpp_model /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-23 05:06:52 --> Severity: Notice --> Trying to get property 'db' of non-object /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-23 05:06:52 --> Severity: error --> Exception: Call to a member function get_where() on null /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-23 05:07:34 --> Severity: Notice --> Undefined property: Penelitian_administrasi::$ProcessSpp_model /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-23 05:07:34 --> Severity: Notice --> Trying to get property 'db' of non-object /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-23 05:07:34 --> Severity: error --> Exception: Call to a member function get_where() on null /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-23 05:09:19 --> Severity: Notice --> Undefined property: Penelitian_administrasi::$ProcessSpp_model /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-23 05:09:19 --> Severity: Notice --> Trying to get property 'db' of non-object /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-23 05:09:19 --> Severity: error --> Exception: Call to a member function get_where() on null /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-23 05:10:45 --> Severity: Notice --> Undefined variable: requestCode /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 247
ERROR - 2020-12-23 05:16:31 --> Query error: Unknown column 'statuss' in 'where clause' - Invalid query: SELECT *
FROM `spp`
WHERE `id` = '94'
AND 0 = '(status_process = \"Dalam Proses Penelitian\" or (status_spp = \"Tertolak\" and status_process=\"Sudah Diteliti\"))'
AND `statuss` = 'ACTIVEh'
ERROR - 2020-12-23 05:17:51 --> Query error: Unknown column 'statuss' in 'where clause' - Invalid query: SELECT *
FROM `spp`
WHERE `id` = '94'
AND 0 = '(`status_process` = \"Dalam Proses Penelitian\" or (`status_spp` = \"Tertolak\" and `status_process` = \"Sudah Diteliti\"))'
AND `statuss` = 'ACTIVEh'
ERROR - 2020-12-23 05:21:35 --> Severity: error --> Exception: Function name must be a string /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi_ppk.php 361
ERROR - 2020-12-23 05:26:04 --> Query error: Unknown column 'statuss' in 'where clause' - Invalid query: SELECT *
FROM `spp`
WHERE `id` = '94'
AND 0 = '(\'status_process\' => \'Dalam Proses Penelitian\' or \'status_spp\' => \'Tertolak\')'
AND `statuss` = 'ACTIVE'
ERROR - 2020-12-23 05:26:49 --> Query error: Unknown column 'statuss' in 'where clause' - Invalid query: SELECT *
FROM `spp`
WHERE `id` = '94'
AND 0 = '(\'status_process\' = \'Dalam Proses Penelitian\' or \'status_spp\' = \'Tertolak\')'
AND `statuss` = 'ACTIVE'
ERROR - 2020-12-23 05:27:39 --> Severity: error --> Exception: Object of class Lman_security could not be converted to string /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi_ppk.php 360
ERROR - 2020-12-23 05:39:07 --> Query error: Unknown column 'statuss' in 'where clause' - Invalid query: SELECT *
FROM `spp`
WHERE (`status_process` = "Dalam Proses Penelitian" or `status_spp` = "Tertolak")
AND `statuss` = 'ACTIVE'
AND `id` = '94'
ERROR - 2020-12-23 07:25:13 --> Query error: Unknown column 'doc_bt_idd' in 'field list' - Invalid query: UPDATE `spp` SET `transfer_date` = '2020-12-23', `doc_si_id` = '202', `receipt_number` = 'KKKwwwssss', `doc_bt_idd` = '201'
WHERE 0 = 'id'
AND 1 = '96'
ERROR - 2020-12-23 07:49:14 --> Query error: Unknown column 'ref_bank.name' in 'field list' - Invalid query: SELECT `spp`.*, `ref_psn_name`.`name` as `psn_name`, `ref_psn_sector`.`name` as `sector_name`, `ref_bank`.`name` as `bank_name`
FROM `spp`, `ref_psn_sector`, `ref_psn_name`
WHERE `ref_psn_name`.`id` = `spp`.`psn_id`
AND `ref_psn_sector`.`id` = `ref_psn_name`.`psn_sector_id`
AND `ref_bank`.`id` = `spp`.`rek_bank_id`
AND `spp`.`status` = 'ACTIVE'
AND (`spp`.`status_spp` = "Menunggu Pembayaran" or `spp`.`status_spp` = "Terbayar" or `spp`.`status_spp` = "Menunggu Approval")
AND `spp`.`status_process` = 'Nota Dinas sudah dikirim ke Direktur'
AND `spp`.`id` = '96'
ORDER BY `spp`.`id` DESC
ERROR - 2020-12-23 08:36:04 --> Severity: Notice --> Undefined property: stdClass::$bank_name /var/www/html/lfm/dev/api/application/controllers/Spp_approved.php 50
ERROR - 2020-12-23 08:45:27 --> Severity: Notice --> Trying to get property 'name' of non-object /var/www/html/lfm/dev/api/application/controllers/Spp_approved.php 34
ERROR - 2020-12-23 08:45:40 --> Severity: Notice --> Undefined index: name /var/www/html/lfm/dev/api/application/controllers/Spp_approved.php 34
ERROR - 2020-12-23 08:47:19 --> Severity: Notice --> Undefined property: stdClass::$bank_name /var/www/html/lfm/dev/api/application/controllers/Spp_approved.php 53
ERROR - 2020-12-23 08:47:29 --> Severity: Notice --> Undefined property: stdClass::$bank_name /var/www/html/lfm/dev/api/application/controllers/Spp_approved.php 53
ERROR - 2020-12-23 10:15:50 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Spp_approved.php 33
ERROR - 2020-12-23 10:15:54 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Spp_approved.php 33
ERROR - 2020-12-23 10:16:57 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Spp_approved.php 33
ERROR - 2020-12-23 11:31:24 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Spp_approved.php 33
ERROR - 2020-12-23 14:01:35 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Spp_approved.php 33
