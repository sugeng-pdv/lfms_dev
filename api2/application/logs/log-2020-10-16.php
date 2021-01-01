<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-10-16 11:56:05 --> Severity: Warning --> Use of undefined constant COMPANI_ID - assumed 'COMPANI_ID' (this will throw an Error in a future version of PHP) /var/www/html/lfm/dev/api/application/controllers/Spp.php 47
ERROR - 2020-10-16 11:56:05 --> Severity: error --> Exception: Call to a member function insert_id() on bool /var/www/html/lfm/dev/api/application/controllers/Spp.php 53
ERROR - 2020-10-16 11:56:26 --> Severity: Warning --> Use of undefined constant COMPANI_ID - assumed 'COMPANI_ID' (this will throw an Error in a future version of PHP) /var/www/html/lfm/dev/api/application/controllers/Spp.php 47
ERROR - 2020-10-16 11:56:26 --> Severity: error --> Exception: Call to a member function insert_id() on bool /var/www/html/lfm/dev/api/application/controllers/Spp.php 53
ERROR - 2020-10-16 11:58:52 --> Severity: error --> Exception: Call to a member function insert_id() on bool /var/www/html/lfm/dev/api/application/controllers/Spp.php 53
ERROR - 2020-10-16 12:00:49 --> Severity: error --> Exception: Call to a member function insert() on int /var/www/html/lfm/dev/api/application/controllers/Spp.php 53
ERROR - 2020-10-16 12:01:39 --> Severity: error --> Exception: Call to a member function insert() on int /var/www/html/lfm/dev/api/application/controllers/Spp.php 53
ERROR - 2020-10-16 12:02:04 --> Query error: Unknown column 'spp' in 'field list' - Invalid query: INSERT INTO `spp` (`spp`) VALUES ('')
ERROR - 2020-10-16 12:03:03 --> Severity: error --> Exception: Call to a member function insert() on int /var/www/html/lfm/dev/api/application/controllers/Spp.php 53
ERROR - 2020-10-16 12:03:18 --> Severity: Notice --> Undefined property: CI_DB_mysqli_driver::$Spp_model /var/www/html/lfm/dev/api/application/controllers/Spp.php 53
ERROR - 2020-10-16 12:03:18 --> Severity: error --> Exception: Call to a member function insert_id() on null /var/www/html/lfm/dev/api/application/controllers/Spp.php 53
ERROR - 2020-10-16 12:05:57 --> Severity: error --> Exception: Call to a member function insert_id() on bool /var/www/html/lfm/dev/api/application/controllers/Spp.php 60
ERROR - 2020-10-16 12:09:14 --> Severity: error --> Exception: syntax error, unexpected ')' /var/www/html/lfm/dev/api/application/controllers/Spp.php 60
ERROR - 2020-10-16 12:09:35 --> Severity: error --> Exception: syntax error, unexpected ')' /var/www/html/lfm/dev/api/application/controllers/Spp.php 60
ERROR - 2020-10-16 12:20:46 --> Severity: Notice --> Undefined property: Spp::$ProcessSpp_model /var/www/html/lfm/dev/api/application/controllers/Spp.php 60
ERROR - 2020-10-16 12:20:46 --> Severity: error --> Exception: Call to a member function get_where() on null /var/www/html/lfm/dev/api/application/controllers/Spp.php 60
ERROR - 2020-10-16 12:21:43 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '21, `Input Dokumen` `SPP`' at line 2 - Invalid query: SELECT *
FROM 21, `Input Dokumen` `SPP`
ERROR - 2020-10-16 12:23:01 --> Severity: Notice --> Undefined property: CI_DB_mysqli_driver::$ProcessSpp_model /var/www/html/lfm/dev/api/application/controllers/Spp.php 61
ERROR - 2020-10-16 12:23:01 --> Severity: error --> Exception: Call to a member function get_where() on null /var/www/html/lfm/dev/api/application/controllers/Spp.php 61
ERROR - 2020-10-16 12:23:20 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '23, `Input Dokumen` `SPP`' at line 2 - Invalid query: SELECT *
FROM 23, `Input Dokumen` `SPP`
ERROR - 2020-10-16 14:15:25 --> Query error: Unknown column 'spp.name' in 'order clause' - Invalid query: SELECT `spp`.`id`, `spp`.`spp_num`, `spp`.`nominal`, `spp`.`total_field`, `spp`.`document_id`, `ref_psn_name`.`name` as `psn_name`
FROM `spp`, `ref_psn_sector`, `ref_psn_name`
WHERE `ref_psn_name`.`id` = 'spp.psn_id'
AND `ref_psn_sector`.`id` = 'ref_psn_name.psn_sector_id'
AND `spp`.`status` = 'ACTIVE'
AND `spp`.`company_id` = '2'
ORDER BY `spp`.`name` ASC
ERROR - 2020-10-16 14:15:57 --> Query error: Unknown column 'spp.name' in 'order clause' - Invalid query: SELECT `spp`.`id`, `spp`.`spp_num`, `spp`.`nominal`, `spp`.`total_field`, `spp`.`document_id`, `ref_psn_name`.`name` as `psn_name`
FROM `spp`, `ref_psn_sector`, `ref_psn_name`
WHERE `ref_psn_name`.`id` = 'spp.psn_id'
AND `ref_psn_sector`.`id` = 'ref_psn_name.psn_sector_id'
AND `spp`.`status` = 'ACTIVE'
AND `spp`.`company_id` = '2'
ORDER BY `spp`.`name` ASC
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:52:56 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/lfm/dev/api/system/core/Exceptions.php:271) /var/www/html/lfm/dev/api/system/core/Common.php 570
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Notice --> Undefined property: stdClass::$status_spp /var/www/html/lfm/dev/api/application/controllers/Spp.php 162
ERROR - 2020-10-16 14:53:28 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/lfm/dev/api/system/core/Exceptions.php:271) /var/www/html/lfm/dev/api/system/core/Common.php 570
