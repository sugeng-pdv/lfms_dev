<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-09-19 03:48:29 --> 404 Page Not Found: Asset/delete_facility
ERROR - 2019-09-19 03:48:34 --> 404 Page Not Found: Asset/delete_facility
ERROR - 2019-09-19 06:54:34 --> 404 Page Not Found: Asset/get_publicFacility_type
ERROR - 2019-09-19 07:34:10 --> Severity: Compile Error --> Cannot redeclare Asset::add_public_facility() /var/www/html/aset/api/application/controllers/Asset.php 1700
ERROR - 2019-09-19 07:48:36 --> Query error: Unknown column 'value' in 'field list' - Invalid query: INSERT INTO `public_facility` (`asset_id`, `type`, `value`, `unit`) VALUES ('23', 5, NULL, NULL)
ERROR - 2019-09-19 08:04:42 --> Severity: Notice --> Undefined index: asset/get_public_facility /var/www/html/aset/api/application/libraries/Access_control.php 71
ERROR - 2019-09-19 08:04:42 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given /var/www/html/aset/api/application/libraries/Access_control.php 74
ERROR - 2019-09-19 08:04:42 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given /var/www/html/aset/api/application/libraries/Access_control.php 74
ERROR - 2019-09-19 08:05:26 --> Severity: error --> Exception: Call to undefined method Facility_model::public_facility_type_detail() /var/www/html/aset/api/application/controllers/Asset.php 1639
ERROR - 2019-09-19 08:19:25 --> Severity: error --> Exception: Call to undefined method Facility_model::delete_public_facility() /var/www/html/aset/api/application/controllers/Asset.php 1844
ERROR - 2019-09-19 08:19:32 --> Severity: error --> Exception: Call to undefined method Facility_model::delete_public_facility() /var/www/html/aset/api/application/controllers/Asset.php 1844
