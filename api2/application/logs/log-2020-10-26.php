<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-10-26 08:28:24 --> Severity: error --> Exception: syntax error, unexpected 'foreach' (T_FOREACH) /var/www/html/lfm/dev/api/application/controllers/Bidang.php 326
ERROR - 2020-10-26 08:33:13 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/lfm/dev/api/application/controllers/Bidang.php 326
ERROR - 2020-10-26 08:33:42 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/lfm/dev/api/application/controllers/Bidang.php 326
ERROR - 2020-10-26 08:42:03 --> Severity: Warning --> strip_tags() expects parameter 1 to be string, array given /var/www/html/lfm/dev/api/application/libraries/Lman_security.php 69
ERROR - 2020-10-26 08:43:04 --> Severity: Warning --> strip_tags() expects parameter 1 to be string, array given /var/www/html/lfm/dev/api/application/libraries/Lman_security.php 69
ERROR - 2020-10-26 08:44:17 --> Severity: Warning --> strip_tags() expects parameter 1 to be string, array given /var/www/html/lfm/dev/api/application/libraries/Lman_security.php 69
ERROR - 2020-10-26 08:46:37 --> Severity: Warning --> array_map(): Expected parameter 2 to be an array, string given /var/www/html/lfm/dev/api/application/libraries/Lman_security.php 62
ERROR - 2020-10-26 09:18:00 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/lfm/dev/api/application/controllers/Bidang.php 260
ERROR - 2020-10-26 09:23:04 --> Query error: Unknown column 'field.spp_id_subm,' in 'where clause' - Invalid query: SELECT `field`.*, `spp`.`spp_num` as `spp_no`, `ref_kelurahan`.`name` as `village_name`, `ref_jns_bidang`.`name` as `fieldtype_name`
FROM `field`, `spp`, `ref_kelurahan`, `ref_jns_bidang`
WHERE `spp`.`id` = `field`.`spp_id_subm`
AND `ref_kelurahan`.`id` = `field`.`village`
AND `ref_jns_bidang`.`id` = `field`.`jns_bidang_id`
AND `field`.`status` = 'ACTIVE'
AND `field`.`spp_id_subm,` = '39'
ORDER BY `field`.`id` ASC
ERROR - 2020-10-26 09:23:35 --> Query error: Unknown column 'field.spp_id_subm,' in 'where clause' - Invalid query: SELECT `field`.*, `spp`.`spp_num` as `spp_no`, `ref_kelurahan`.`name` as `village_name`, `ref_jns_bidang`.`name` as `fieldtype_name`
FROM `field`, `spp`, `ref_kelurahan`, `ref_jns_bidang`
WHERE `spp`.`id` = `field`.`spp_id_subm`
AND `ref_kelurahan`.`id` = `field`.`village`
AND `ref_jns_bidang`.`id` = `field`.`jns_bidang_id`
AND `field`.`status` = 'ACTIVE'
AND `field`.`spp_id_subm,` = '39'
ORDER BY `field`.`id` ASC
ERROR - 2020-10-26 09:23:51 --> Query error: Unknown column 'field.spp_id_subm,' in 'where clause' - Invalid query: SELECT `field`.*, `spp`.`spp_num` as `spp_no`, `ref_kelurahan`.`name` as `village_name`, `ref_jns_bidang`.`name` as `fieldtype_name`
FROM `field`, `spp`, `ref_kelurahan`, `ref_jns_bidang`
WHERE `spp`.`id` = `field`.`spp_id_subm`
AND `ref_kelurahan`.`id` = `field`.`village`
AND `ref_jns_bidang`.`id` = `field`.`jns_bidang_id`
AND `field`.`status` = 'ACTIVE'
AND `field`.`spp_id_subm,` = '39'
ORDER BY `field`.`id` ASC
ERROR - 2020-10-26 09:25:19 --> Query error: Unknown column 'field.spp_id_subm,' in 'where clause' - Invalid query: SELECT `field`.*, `spp`.`spp_num` as `spp_no`, `ref_kelurahan`.`name` as `village_name`, `ref_jns_bidang`.`name` as `fieldtype_name`
FROM `field`, `spp`, `ref_kelurahan`, `ref_jns_bidang`
WHERE `spp`.`id` = `field`.`spp_id_subm`
AND `ref_kelurahan`.`id` = `field`.`village`
AND `ref_jns_bidang`.`id` = `field`.`jns_bidang_id`
AND `field`.`status` = 'ACTIVE'
AND `field`.`spp_id_subm,` = '39'
ORDER BY `field`.`id` ASC
ERROR - 2020-10-26 09:26:42 --> Query error: Unknown column 'field.spp_id_subm,' in 'where clause' - Invalid query: SELECT `field`.*, `spp`.`spp_num` as `spp_no`, `ref_kelurahan`.`name` as `village_name`, `ref_jns_bidang`.`name` as `fieldtype_name`
FROM `field`, `spp`, `ref_kelurahan`, `ref_jns_bidang`
WHERE `spp`.`id` = `field`.`spp_id_subm`
AND `ref_kelurahan`.`id` = `field`.`village`
AND `ref_jns_bidang`.`id` = `field`.`jns_bidang_id`
AND `field`.`status` = 'ACTIVE'
AND `field`.`spp_id_subm,` = '39'
ORDER BY `field`.`id` ASC
ERROR - 2020-10-26 09:29:00 --> Query error: Unknown column 'field.spp_id_subm,' in 'where clause' - Invalid query: SELECT `field`.*, `spp`.`spp_num` as `spp_no`, `ref_kelurahan`.`name` as `village_name`, `ref_jns_bidang`.`name` as `fieldtype_name`
FROM `field`, `spp`, `ref_kelurahan`, `ref_jns_bidang`
WHERE `spp`.`id` = `field`.`spp_id_subm`
AND `ref_kelurahan`.`id` = `field`.`village`
AND `ref_jns_bidang`.`id` = `field`.`jns_bidang_id`
AND `field`.`status` = 'ACTIVE'
AND `field`.`spp_id_subm,` = '39'
ORDER BY `field`.`id` ASC
ERROR - 2020-10-26 09:29:20 --> Query error: Unknown column 'field.spp' in 'where clause' - Invalid query: SELECT `field`.*, `spp`.`spp_num` as `spp_no`, `ref_kelurahan`.`name` as `village_name`, `ref_jns_bidang`.`name` as `fieldtype_name`
FROM `field`, `spp`, `ref_kelurahan`, `ref_jns_bidang`
WHERE `spp`.`id` = `field`.`spp`
AND `ref_kelurahan`.`id` = `field`.`village`
AND `ref_jns_bidang`.`id` = `field`.`jns_bidang_id`
AND `field`.`status` = 'ACTIVE'
AND `field`.`status_process` = 'Tertolak'
AND `field`.`payment_type` = 'Langsung'
AND `field`.`payment_to` = 'Warga'
AND `field`.`company_id` = '2'
ORDER BY `field`.`id` ASC
ERROR - 2020-10-26 09:29:38 --> Query error: Unknown column 'field.spp' in 'where clause' - Invalid query: SELECT `field`.*, `spp`.`spp_num` as `spp_no`, `ref_kelurahan`.`name` as `village_name`, `ref_jns_bidang`.`name` as `fieldtype_name`
FROM `field`, `spp`, `ref_kelurahan`, `ref_jns_bidang`
WHERE `spp`.`id` = `field`.`spp`
AND `ref_kelurahan`.`id` = `field`.`village`
AND `ref_jns_bidang`.`id` = `field`.`jns_bidang_id`
AND `field`.`status` = 'ACTIVE'
AND `field`.`status_process` = 'Tertolak'
AND `field`.`payment_type` = 'Langsung'
AND `field`.`payment_to` = 'Warga'
AND `field`.`company_id` = '2'
ORDER BY `field`.`id` ASC
ERROR - 2020-10-26 09:30:29 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/lfm/dev/api/application/controllers/Bidang.php 260
ERROR - 2020-10-26 09:31:04 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/lfm/dev/api/application/controllers/Bidang.php 260
ERROR - 2020-10-26 09:34:05 --> Query error: Unknown column 'field.spp_id_subm,' in 'where clause' - Invalid query: SELECT `field`.*, `spp`.`spp_num` as `spp_no`, `ref_kelurahan`.`name` as `village_name`, `ref_jns_bidang`.`name` as `fieldtype_name`
FROM `field`, `spp`, `ref_kelurahan`, `ref_jns_bidang`
WHERE `spp`.`id` = `field`.`spp_id_subm`
AND `ref_kelurahan`.`id` = `field`.`village`
AND `ref_jns_bidang`.`id` = `field`.`jns_bidang_id`
AND `field`.`status` = 'ACTIVE'
AND `field`.`spp_id_subm,` = '39'
ORDER BY `field`.`id` ASC
ERROR - 2020-10-26 09:34:24 --> Query error: Unknown column 'field.spp_id_subm,' in 'where clause' - Invalid query: SELECT `field`.*, `spp`.`spp_num` as `spp_no`, `ref_kelurahan`.`name` as `village_name`, `ref_jns_bidang`.`name` as `fieldtype_name`
FROM `field`, `spp`, `ref_kelurahan`, `ref_jns_bidang`
WHERE `spp`.`id` = `field`.`spp_id_subm`
AND `ref_kelurahan`.`id` = `field`.`village`
AND `ref_jns_bidang`.`id` = `field`.`jns_bidang_id`
AND `field`.`status` = 'ACTIVE'
AND `field`.`spp_id_subm,` = '39'
ORDER BY `field`.`id` ASC
ERROR - 2020-10-26 09:42:59 --> Query error: Unknown column 'field.spp_id_subm,' in 'where clause' - Invalid query: SELECT `field`.*, `spp`.`spp_num` as `spp_no`
FROM `field`, `spp`
WHERE `spp`.`id` = `field`.`spp_id_subm`
AND `field`.`spp_id_subm,` = '39'
ORDER BY `field`.`id` ASC
