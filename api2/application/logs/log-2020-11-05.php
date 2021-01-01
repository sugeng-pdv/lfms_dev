<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-11-05 07:58:43 --> Severity: error --> Exception: Too few arguments to function Monitoring_model::getDataMonitoringSpp(), 0 passed in /var/www/html/lfm/dev/api/application/controllers/Monitoring.php on line 27 and exactly 1 expected /var/www/html/lfm/dev/api/application/models/Monitoring_model.php 11
ERROR - 2020-11-05 08:03:00 --> Severity: error --> Exception: Too few arguments to function Monitoring_model::getDataMonitoringSpp(), 0 passed in /var/www/html/lfm/dev/api/application/controllers/Monitoring.php on line 28 and exactly 1 expected /var/www/html/lfm/dev/api/application/models/Monitoring_model.php 11
ERROR - 2020-11-05 08:03:21 --> Query error: Unknown column 'ref_timeline.description' in 'field list' - Invalid query: SELECT `timeline_spp`.*, `ref_timeline`.`description` as `desc`
FROM `timeline_spp`
WHERE `ref_timeline`.`id` = `timeline_spp`.`timeline_id`
AND `timeline_spp`.`spp_id` IS NULL
ORDER BY `timeline_spp`.`timeline_id` ASC
ERROR - 2020-11-05 08:04:32 --> Query error: Unknown column 'ref_timeline.description' in 'field list' - Invalid query: SELECT `timeline_spp`.*, `ref_timeline`.`description` as `desc`
FROM `timeline_spp`
WHERE `ref_timeline`.`id` = `timeline_spp`.`timeline_id`
AND `timeline_spp`.`spp_id` IS NULL
ORDER BY `timeline_spp`.`timeline_id` ASC
ERROR - 2020-11-05 08:34:56 --> Query error: Unknown column 'timeline_spp' in 'field list' - Invalid query: SELECT max(timeline_spp) as lastProcess
FROM `timeline_spp`
WHERE `spp_id` = '43'
ERROR - 2020-11-05 08:35:37 --> Severity: error --> Exception: Call to undefined method stdClass::result() /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 29
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Undefined property: mysqli::$description /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 34
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Undefined property: mysqli::$id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Undefined property: mysqli::$timeline_id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Undefined property: mysqli::$id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 45
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Undefined property: mysqli_result::$description /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 34
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Undefined property: mysqli_result::$id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Undefined property: mysqli_result::$timeline_id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Undefined property: mysqli_result::$id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 45
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'description' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 34
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 45
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'description' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 34
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 45
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'description' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 34
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 45
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'description' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 34
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 45
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'description' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 34
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 45
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'description' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 34
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:06:29 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 45
ERROR - 2020-11-05 09:06:29 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/lfm/dev/api/system/core/Exceptions.php:271) /var/www/html/lfm/dev/api/system/core/Common.php 570
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Undefined property: mysqli::$description /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Undefined property: mysqli::$id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Undefined property: mysqli::$timeline_id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Undefined property: mysqli::$id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 46
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Undefined property: mysqli_result::$description /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Undefined property: mysqli_result::$id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Undefined property: mysqli_result::$timeline_id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Undefined property: mysqli_result::$id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 46
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'description' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 46
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'description' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 46
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'description' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 46
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'description' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 46
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'description' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 46
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'description' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:09:31 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 46
ERROR - 2020-11-05 09:09:31 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/lfm/dev/api/system/core/Exceptions.php:271) /var/www/html/lfm/dev/api/system/core/Common.php 570
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Undefined property: mysqli::$description /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Undefined property: mysqli::$id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Undefined property: mysqli::$timeline_id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Undefined property: mysqli::$id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 46
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Undefined property: mysqli_result::$description /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Undefined property: mysqli_result::$id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Undefined property: mysqli_result::$timeline_id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Undefined property: mysqli_result::$id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 46
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'description' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 46
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'description' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 46
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'description' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 46
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'description' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 46
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'description' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 46
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'description' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 35
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:09:46 --> Severity: Notice --> Trying to get property 'id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 46
ERROR - 2020-11-05 09:09:46 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/lfm/dev/api/system/core/Exceptions.php:271) /var/www/html/lfm/dev/api/system/core/Common.php 570
ERROR - 2020-11-05 09:10:41 --> Severity: Notice --> Undefined property: stdClass::$timeline_id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:10:41 --> Severity: Notice --> Undefined property: stdClass::$timeline_id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:10:41 --> Severity: Notice --> Undefined property: stdClass::$timeline_id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:10:41 --> Severity: Notice --> Undefined property: stdClass::$timeline_id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:10:41 --> Severity: Notice --> Undefined property: stdClass::$timeline_id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:10:41 --> Severity: Notice --> Undefined property: stdClass::$timeline_id /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:10:41 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/lfm/dev/api/system/core/Exceptions.php:271) /var/www/html/lfm/dev/api/system/core/Common.php 570
ERROR - 2020-11-05 09:11:10 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:11:10 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:11:10 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:12:23 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:12:23 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:12:23 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:13:00 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:13:00 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:13:00 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:13:36 --> Severity: Notice --> A non well formed numeric value encountered /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:14:15 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:14:15 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:14:15 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:14:33 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:14:33 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:14:33 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:15:41 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:15:41 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:15:41 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:18:04 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:18:04 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:18:04 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:18:53 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:18:53 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:18:53 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:19:13 --> Severity: error --> Exception: syntax error, unexpected ')' /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 41
ERROR - 2020-11-05 09:19:24 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:19:24 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:19:24 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 36
ERROR - 2020-11-05 09:46:12 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:46:12 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 09:46:12 --> Severity: Notice --> Trying to get property 'timeline_id' of non-object /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 37
ERROR - 2020-11-05 14:37:55 --> Severity: error --> Exception: Call to a member function format() on string /var/www/html/lfm/dev/api/application/controllers/Monitoring.php 82
