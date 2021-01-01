<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-09-17 03:24:50 --> Severity: Notice --> Undefined property: Operational_activity::$lman_construction /var/www/html/aset/api/application/controllers/Operational_activity.php 201
ERROR - 2019-09-17 03:24:50 --> Severity: error --> Exception: Call to a member function validate_request_method() on null /var/www/html/aset/api/application/controllers/Operational_activity.php 201
ERROR - 2019-09-17 03:24:59 --> Severity: Notice --> Undefined property: Operational_activity::$lman_construction /var/www/html/aset/api/application/controllers/Operational_activity.php 201
ERROR - 2019-09-17 03:24:59 --> Severity: error --> Exception: Call to a member function validate_request_method() on null /var/www/html/aset/api/application/controllers/Operational_activity.php 201
ERROR - 2019-09-17 03:25:50 --> Severity: Notice --> Undefined index: operational_activity/get_construction /var/www/html/aset/api/application/libraries/Access_control.php 71
ERROR - 2019-09-17 03:25:50 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given /var/www/html/aset/api/application/libraries/Access_control.php 74
ERROR - 2019-09-17 03:25:50 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given /var/www/html/aset/api/application/libraries/Access_control.php 74
ERROR - 2019-09-17 03:34:23 --> Severity: Notice --> Undefined property: Operational_activity::$lman_maintenance /var/www/html/aset/api/application/controllers/Operational_activity.php 393
ERROR - 2019-09-17 03:34:23 --> Severity: error --> Exception: Call to a member function validate_request_method() on null /var/www/html/aset/api/application/controllers/Operational_activity.php 393
ERROR - 2019-09-17 03:34:32 --> Severity: Notice --> Undefined property: Operational_activity::$lman_maintenance /var/www/html/aset/api/application/controllers/Operational_activity.php 393
ERROR - 2019-09-17 03:34:32 --> Severity: error --> Exception: Call to a member function validate_request_method() on null /var/www/html/aset/api/application/controllers/Operational_activity.php 393
ERROR - 2019-09-17 06:59:18 --> 404 Page Not Found: Operational_activity/add_business_case
ERROR - 2019-09-17 07:25:12 --> Query error: Unknown column 'business_case_id' in 'where clause' - Invalid query: SELECT *
FROM `operational_activity_document`
WHERE `business_case_id` = '2'
ORDER BY `id` DESC
