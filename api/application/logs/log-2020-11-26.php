<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-11-26 07:17:25 --> Severity: Notice --> Undefined property: Control_budget::$Spp_model /var/www/html/lfm/dev/api/application/controllers/Control_budget.php 87
ERROR - 2020-11-26 07:17:25 --> Severity: Notice --> Trying to get property 'db' of non-object /var/www/html/lfm/dev/api/application/controllers/Control_budget.php 87
ERROR - 2020-11-26 07:17:25 --> Severity: error --> Exception: Call to a member function get_where() on null /var/www/html/lfm/dev/api/application/controllers/Control_budget.php 87
ERROR - 2020-11-26 07:18:00 --> Severity: Notice --> Undefined property: Control_budget::$Spp_model /var/www/html/lfm/dev/api/application/controllers/Control_budget.php 87
ERROR - 2020-11-26 07:18:00 --> Severity: Notice --> Trying to get property 'db' of non-object /var/www/html/lfm/dev/api/application/controllers/Control_budget.php 87
ERROR - 2020-11-26 07:18:00 --> Severity: error --> Exception: Call to a member function get_where() on null /var/www/html/lfm/dev/api/application/controllers/Control_budget.php 87
ERROR - 2020-11-26 08:01:27 --> Query error: Unknown column 'ref_psn_sector.name' in 'field list' - Invalid query: SELECT `ref_psn_name`.*, `ref_psn_sector`.`name` as `sector_psn`, `ref_institution`.`name` as `institution_name`
FROM `ref_psn_name`
WHERE `ref_psn_sector`.`id` = `ref_psn_name`.`psn_sector_id`
AND `ref_institution`.`id` = `ref_psn_name`.`institution_id`
AND `ref_psn_name`.`status` = 'ACTIVE'
ORDER BY `ref_psn_name`.`fiscal_year` ASC
 LIMIT 0
ERROR - 2020-11-26 08:01:43 --> Query error: Unknown column 'ref_psn_sector.name' in 'field list' - Invalid query: SELECT `ref_psn_name`.*, `ref_psn_sector`.`name` as `sector_psn`, `ref_institution`.`name` as `institution_name`
FROM `ref_psn_name`
WHERE `ref_psn_sector`.`id` = `ref_psn_name`.`psn_sector_id`
AND `ref_institution`.`id` = `ref_psn_name`.`institution_id`
AND `ref_psn_name`.`status` = 'ACTIVE'
ORDER BY `ref_psn_name`.`fiscal_year` ASC
 LIMIT 0
ERROR - 2020-11-26 08:03:32 --> Query error: Unknown column 'ref_psn_sector.name' in 'field list' - Invalid query: SELECT `ref_psn_name`.*, `ref_psn_sector`.`name` as `sector_psn`, `ref_institution`.`name` as `institution_name`
FROM `ref_psn_name`
WHERE `ref_psn_sector`.`id` = `ref_psn_name`.`psn_sector_id`
AND `ref_institution`.`id` = `ref_psn_name`.`institution_id`
AND `ref_psn_name`.`status` = 'ACTIVE'
ORDER BY `ref_psn_name`.`fiscal_year` ASC
 LIMIT 0
ERROR - 2020-11-26 08:06:40 --> Query error: Unknown table 'lman_lf_development.ref_psn_nameee' - Invalid query: SELECT `ref_psn_nameee`.*, `ref_psn_sector`.`name` as `sector_psn`, `ref_institution`.`name` as `institution_name`
FROM `ref_psn_name`
WHERE `ref_psn_sector`.`id` = `ref_psn_name`.`psn_sector_id`
AND `ref_institution`.`id` = `ref_psn_name`.`institution_id`
AND `ref_psn_name`.`status` = 'ACTIVE'
ORDER BY `ref_psn_name`.`fiscal_year` ASC
 LIMIT 0
ERROR - 2020-11-26 08:07:13 --> Query error: Unknown column 'ref_psn_sector.name' in 'field list' - Invalid query: SELECT `ref_psn_name`.*, `ref_psn_sector`.`name` as `sector_psn`, `ref_institution`.`name` as `institution_name`
FROM `ref_psn_name`
WHERE `ref_psn_sector`.`id` = `ref_psn_name`.`psn_sector_id`
AND `ref_institution`.`id` = `ref_psn_name`.`institution_id`
AND `ref_psn_name`.`status` = 'ACTIVE'
ORDER BY `ref_psn_name`.`fiscal_year` ASC
 LIMIT 0
ERROR - 2020-11-26 08:38:04 --> Severity: error --> Exception: syntax error, unexpected ';', expecting ')' /var/www/html/lfm/dev/api/application/controllers/Control_budget.php 136
ERROR - 2020-11-26 12:05:15 --> Severity: Compile Error --> Cannot redeclare Spp_approved::get_data_spp_post() /var/www/html/lfm/dev/api/application/controllers/Spp_approved.php 137
ERROR - 2020-11-26 12:06:34 --> Severity: Notice --> Undefined index: id_spp /var/www/html/lfm/dev/api/application/models/Spp_model.php 103
ERROR - 2020-11-26 12:08:04 --> Severity: Notice --> Undefined index: id_spp /var/www/html/lfm/dev/api/application/models/Spp_model.php 103
ERROR - 2020-11-26 12:08:33 --> Severity: Notice --> Undefined index: id_spp /var/www/html/lfm/dev/api/application/models/Spp_model.php 103
ERROR - 2020-11-26 12:08:55 --> Severity: Notice --> Undefined index: id_spp /var/www/html/lfm/dev/api/application/models/Spp_model.php 103
ERROR - 2020-11-26 12:12:49 --> Severity: error --> Exception: Call to undefined method CI_DB_mysqli_driver::or_xwhere() /var/www/html/lfm/dev/api/application/models/Spp_model.php 111
ERROR - 2020-11-26 12:13:53 --> Query error: Unknown column 'spp.idd' in 'order clause' - Invalid query: SELECT `spp`.*, `ref_psn_name`.`name` as `psn_name`, `ref_psn_sector`.`name` as `sector_name`
FROM `spp`, `ref_psn_sector`, `ref_psn_name`
WHERE `ref_psn_name`.`id` = `spp`.`psn_id`
AND `ref_psn_sector`.`id` = `ref_psn_name`.`psn_sector_id`
AND `spp`.`status` = 'ACTIVE'
AND `spp`.`status_spp` = 'Menunggu Pembayaran'
OR `spp`.`status_spp` = 'Terbayar'
AND `spp`.`status_process` = 'Nota Dinas sudah dikirim ke Direktur'
ORDER BY `spp`.`idd` DESC
ERROR - 2020-11-26 12:16:56 --> Query error: Unknown column 'spp.idd' in 'order clause' - Invalid query: SELECT `spp`.*, `ref_psn_name`.`name` as `psn_name`, `ref_psn_sector`.`name` as `sector_name`
FROM `spp`, `ref_psn_sector`, `ref_psn_name`
WHERE `ref_psn_name`.`id` = `spp`.`psn_id`
AND `ref_psn_sector`.`id` = `ref_psn_name`.`psn_sector_id`
AND `spp`.`status` = 'ACTIVE'
AND `spp`.`status_spp` = 'Menunggu Pembayaran'
OR `spp`.`status_spp` = 'Terbayar'
AND `spp`.`status_process` = 'Nota Dinas sudah dikirim ke Direktur'
ORDER BY `spp`.`idd` DESC
ERROR - 2020-11-26 12:17:08 --> Query error: Unknown column 'spp.idd' in 'order clause' - Invalid query: SELECT `spp`.*, `ref_psn_name`.`name` as `psn_name`, `ref_psn_sector`.`name` as `sector_name`
FROM `spp`, `ref_psn_sector`, `ref_psn_name`
WHERE `ref_psn_name`.`id` = `spp`.`psn_id`
AND `ref_psn_sector`.`id` = `ref_psn_name`.`psn_sector_id`
AND `spp`.`status` = 'ACTIVE'
AND `spp`.`status_spp` = 'Menunggu Pembayaran'
OR `spp`.`status_spp` = 'Terbayar'
AND `spp`.`status_process` = 'Nota Dinas sudah dikirim ke Direktur'
ORDER BY `spp`.`idd` DESC
ERROR - 2020-11-26 12:17:11 --> Query error: Unknown column 'spp.idd' in 'order clause' - Invalid query: SELECT `spp`.*, `ref_psn_name`.`name` as `psn_name`, `ref_psn_sector`.`name` as `sector_name`
FROM `spp`, `ref_psn_sector`, `ref_psn_name`
WHERE `ref_psn_name`.`id` = `spp`.`psn_id`
AND `ref_psn_sector`.`id` = `ref_psn_name`.`psn_sector_id`
AND `spp`.`status` = 'ACTIVE'
AND `spp`.`status_spp` = 'Menunggu Pembayaran'
OR `spp`.`status_spp` = 'Terbayar'
AND `spp`.`status_process` = 'Nota Dinas sudah dikirim ke Direktur'
ORDER BY `spp`.`idd` DESC
ERROR - 2020-11-26 14:07:22 --> Severity: Notice --> Undefined property: Spp_approved::$iddate_helper /var/www/html/lfm/dev/api/application/controllers/Spp_approved.php 101
ERROR - 2020-11-26 14:07:22 --> Severity: error --> Exception: Call to a member function convert_date() on null /var/www/html/lfm/dev/api/application/controllers/Spp_approved.php 101
ERROR - 2020-11-26 14:09:48 --> Severity: Notice --> Undefined property: Spp_approved::$iddate_helper /var/www/html/lfm/dev/api/application/controllers/Spp_approved.php 101
ERROR - 2020-11-26 14:09:48 --> Severity: error --> Exception: Call to a member function convert_date() on null /var/www/html/lfm/dev/api/application/controllers/Spp_approved.php 101
ERROR - 2020-11-26 17:27:37 --> Severity: Notice --> Undefined property: Spp_approved::$iddate_helper /var/www/html/lfm/dev/api/application/controllers/Spp_approved.php 101
ERROR - 2020-11-26 17:27:37 --> Severity: error --> Exception: Call to a member function convert_date() on null /var/www/html/lfm/dev/api/application/controllers/Spp_approved.php 101
ERROR - 2020-11-26 21:37:47 --> Severity: Notice --> Undefined property: Spp_approved::$iddate_helper /var/www/html/lfm/dev/api/application/controllers/Spp_approved.php 101
ERROR - 2020-11-26 21:37:47 --> Severity: error --> Exception: Call to a member function convert_date() on null /var/www/html/lfm/dev/api/application/controllers/Spp_approved.php 101
