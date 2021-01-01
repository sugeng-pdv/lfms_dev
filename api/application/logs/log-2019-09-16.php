<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-09-16 04:08:54 --> Severity: Notice --> Undefined index: operational_activity/get_security /var/www/html/aset/api/application/libraries/Access_control.php 71
ERROR - 2019-09-16 04:08:54 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given /var/www/html/aset/api/application/libraries/Access_control.php 74
ERROR - 2019-09-16 04:08:54 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given /var/www/html/aset/api/application/libraries/Access_control.php 74
ERROR - 2019-09-16 06:59:01 --> 404 Page Not Found: Asset/update_activity_data
ERROR - 2019-09-16 07:41:05 --> Severity: Notice --> Undefined property: stdClass::$name /var/www/html/aset/api/application/controllers/Operational_activity.php 33
ERROR - 2019-09-16 07:41:05 --> Severity: Warning --> Creating default object from empty value /var/www/html/aset/api/application/controllers/Operational_activity.php 33
ERROR - 2019-09-16 07:41:55 --> Severity: Notice --> Undefined property: stdClass::$name /var/www/html/aset/api/application/controllers/Operational_activity.php 32
ERROR - 2019-09-16 07:41:55 --> Severity: Warning --> Creating default object from empty value /var/www/html/aset/api/application/controllers/Operational_activity.php 32
ERROR - 2019-09-16 07:42:13 --> Severity: Warning --> Creating default object from empty value /var/www/html/aset/api/application/controllers/Operational_activity.php 32
ERROR - 2019-09-16 07:43:28 --> Severity: Warning --> Creating default object from empty value /var/www/html/aset/api/application/controllers/Operational_activity.php 32
ERROR - 2019-09-16 10:10:09 --> 404 Page Not Found: Operational_activity/add_document23
ERROR - 2019-09-16 10:11:35 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`lman_asset_service`.`operational_activity_document`, CONSTRAINT `operational_activity_document_ibfk_1` FOREIGN KEY (`operational_activity_id`) REFERENCES `operational_activity` (`id`)) - Invalid query: INSERT INTO `operational_activity_document` (`operational_activity_id`, `doc_name`, `s3_bucket`, `s3_object`) VALUES ('23', 'Tes upload dokumen', 's3-lman', 'DOKUMEN-KEGIATAN/2019/09/16/hVo-mx.jpg')
ERROR - 2019-09-16 10:38:34 --> Severity: error --> Exception: Cannot use object of type stdClass as array /var/www/html/aset/api/application/controllers/Operational_activity.php 37
