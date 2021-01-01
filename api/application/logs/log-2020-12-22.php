<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-12-22 03:33:19 --> Severity: Notice --> Undefined property: Penelitian_administrasi::$ProcessSpp_model /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-22 03:33:19 --> Severity: Notice --> Trying to get property 'db' of non-object /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-22 03:33:19 --> Severity: error --> Exception: Call to a member function get_where() on null /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-22 03:40:56 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`Kirim`
ORDER BY `spp`.`id` DESC' at line 6 - Invalid query: SELECT `spp`.`id`, `spp`.`spp_num`, `spp`.`payment_type`, `spp`.`payment_to`, `spp`.`nominal`, `spp`.`total_field`, `spp`.`document_id`, `spp`.`status_spp`, `spp`.`status_process`, `ref_psn_name`.`name` as `psn_name`
FROM `spp`, `ref_psn_sector`, `ref_psn_name`
WHERE `ref_psn_name`.`id` = `spp`.`psn_id`
AND `ref_psn_sector`.`id` = `ref_psn_name`.`psn_sector_id`
AND `spp`.`status` = 'ACTIVE'
AND `spp`.`status_spp` != `Belum` `Kirim`
ORDER BY `spp`.`id` DESC
ERROR - 2020-12-22 14:10:06 --> Severity: Notice --> Undefined property: Penelitian_administrasi::$ProcessSpp_model /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-22 14:10:06 --> Severity: Notice --> Trying to get property 'db' of non-object /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-22 14:10:06 --> Severity: error --> Exception: Call to a member function get_where() on null /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-22 14:11:58 --> Severity: Notice --> Undefined property: Penelitian_administrasi::$ProcessSpp_model /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-22 14:11:58 --> Severity: Notice --> Trying to get property 'db' of non-object /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-22 14:11:58 --> Severity: error --> Exception: Call to a member function get_where() on null /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-22 14:41:08 --> Severity: Notice --> Trying to get property 'status_process' of non-object /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:50:17 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:50:17 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:50:18 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:50:18 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:07 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:07 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:11 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:11 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:14 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:14 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:17 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:17 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:18 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:18 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:19 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:19 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:20 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:20 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:20 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:20 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:20 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:20 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:21 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:21 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:24 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:24 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:25 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:25 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:26 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:26 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:27 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:27 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:27 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:27 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:27 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:27 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:28 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:28 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:28 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:28 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:28 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:28 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:29 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:29 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:29 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:29 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:29 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:29 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:29 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:29 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:30 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:30 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:30 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:30 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:31 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:31 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:31 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:31 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:31 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:31 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:31 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:31 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:32 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:32 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:33 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:33 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:33 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:33 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:34 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:34 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:35 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:35 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:38 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:38 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:51:59 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:51:59 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:55:04 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:55:04 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:55:08 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:55:08 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:55:09 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:55:09 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:55:09 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:55:09 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:55:09 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:55:09 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:55:10 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:55:10 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:55:23 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:55:23 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:55:25 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:55:25 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:55:25 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:55:25 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:55:26 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:55:26 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:55:28 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:55:28 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:55:29 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:55:29 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:56:16 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:56:16 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:56:17 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:56:17 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:56:17 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:56:17 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:56:17 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:56:17 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:56:17 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:56:17 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:56:18 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:56:18 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:56:18 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:56:18 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:56:18 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:56:18 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:56:18 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:56:18 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:56:19 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:56:19 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:56:19 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:56:19 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:56:19 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:56:19 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:56:19 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 14:56:19 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 14:58:39 --> Severity: Notice --> Undefined property: Penelitian_administrasi::$ProcessSpp_model /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-22 14:58:39 --> Severity: Notice --> Trying to get property 'db' of non-object /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-22 14:58:39 --> Severity: error --> Exception: Call to a member function get_where() on null /var/www/html/lfm/dev/api/application/controllers/Penelitian_administrasi.php 232
ERROR - 2020-12-22 15:00:58 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 15:00:58 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 15:00:58 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 15:00:58 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 15:00:58 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 15:00:58 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 15:00:58 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 15:00:58 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 15:00:59 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 15:00:59 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 15:01:00 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 15:01:00 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 15:01:00 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 15:01:00 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 15:01:00 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 15:01:00 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 15:01:01 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 15:01:01 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 15:01:01 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 15:01:01 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 15:01:02 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 15:01:02 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
ERROR - 2020-12-22 15:01:02 --> Severity: Notice --> Undefined offset: 0 /var/www/html/lfm/dev/api/application/controllers/Bidang.php 391
ERROR - 2020-12-22 15:01:02 --> Severity: Notice --> Trying to access array offset on value of type null /var/www/html/lfm/dev/api/application/controllers/Bidang.php 393
