<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-11-06 09:52:21 --> Severity: error --> Exception: Too few arguments to function Monitoring_model::getDataMonitoringSpp(), 0 passed in /var/www/html/lfm/dev/api/application/controllers/Monitoring.php on line 26 and exactly 1 expected /var/www/html/lfm/dev/api/application/models/Monitoring_model.php 11
ERROR - 2020-11-06 09:56:55 --> Severity: error --> Exception: Too few arguments to function Monitoring_model::getDataMonitoringSpp(), 0 passed in /var/www/html/lfm/dev/api/application/controllers/Monitoring.php on line 26 and exactly 1 expected /var/www/html/lfm/dev/api/application/models/Monitoring_model.php 11
ERROR - 2020-11-06 09:57:25 --> Severity: error --> Exception: Too few arguments to function Monitoring_model::getDataMonitoringSpp(), 0 passed in /var/www/html/lfm/dev/api/application/controllers/Monitoring.php on line 26 and exactly 1 expected /var/www/html/lfm/dev/api/application/models/Monitoring_model.php 11
ERROR - 2020-11-06 09:57:38 --> Severity: error --> Exception: Too few arguments to function Monitoring_model::getDataMonitoringSpp(), 0 passed in /var/www/html/lfm/dev/api/application/controllers/Monitoring.php on line 26 and exactly 1 expected /var/www/html/lfm/dev/api/application/models/Monitoring_model.php 11
ERROR - 2020-11-06 10:23:00 --> Severity: Compile Error --> Cannot redeclare Monitoring_model::getDataMonitoringSpp() /var/www/html/lfm/dev/api/application/models/Monitoring_model.php 54
ERROR - 2020-11-06 10:23:13 --> Severity: Compile Error --> Cannot redeclare Monitoring_model::getDataMonitoringSpp() /var/www/html/lfm/dev/api/application/models/Monitoring_model.php 54
ERROR - 2020-11-06 10:27:16 --> Severity: Compile Error --> Cannot redeclare Monitoring_model::getDataMonitoringSpp() /var/www/html/lfm/dev/api/application/models/Monitoring_model.php 53
ERROR - 2020-11-06 10:31:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '"Belum Kirim
AND `spp`.`company_id` = '2'
ORDER BY `spp`.`id` DESC' at line 3 - Invalid query: SELECT `spp`.*
FROM `spp`
WHERE `spp`.`status_spp` != "Belum Kirim
AND `spp`.`company_id` = '2'
ORDER BY `spp`.`id` DESC
ERROR - 2020-11-06 10:37:53 --> Query error: Unknown column 'ref_psn_name.name' in 'field list' - Invalid query: SELECT `spp`.*, `ref_psn_name`.`name` as `name_psn`
FROM `spp`
WHERE `ref_psn_name`.`id` = `spp`.`psn_id`
AND `spp`.`status_spp` != "Belum Kirim"
AND `spp`.`company_id` = '2'
ORDER BY `spp`.`id` DESC
