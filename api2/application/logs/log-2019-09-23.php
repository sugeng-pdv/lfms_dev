<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-09-23 01:52:06 --> Severity: Notice --> Undefined property: Contract::$lman_contract /var/www/html/aset/api/application/controllers/Contract.php 8
ERROR - 2019-09-23 01:52:06 --> Severity: error --> Exception: Call to a member function validate_request_method() on null /var/www/html/aset/api/application/controllers/Contract.php 8
ERROR - 2019-09-23 01:53:42 --> Severity: Notice --> Undefined property: Contract::$Contract_model /var/www/html/aset/api/application/controllers/Contract.php 29
ERROR - 2019-09-23 01:53:42 --> Severity: error --> Exception: Call to a member function count() on null /var/www/html/aset/api/application/controllers/Contract.php 29
ERROR - 2019-09-23 01:54:09 --> Severity: error --> Exception: Call to undefined method Contract_model::count() /var/www/html/aset/api/application/controllers/Contract.php 31
ERROR - 2019-09-23 01:55:46 --> Severity: Notice --> Undefined variable: order_by /var/www/html/aset/api/application/models/Contract_model.php 47
ERROR - 2019-09-23 01:55:46 --> Severity: Notice --> Undefined variable: order_by /var/www/html/aset/api/application/models/Contract_model.php 50
ERROR - 2019-09-23 02:41:13 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`lman_asset_service`.`contract`, CONSTRAINT `contract_ibfk_1` FOREIGN KEY (`tenant_id`) REFERENCES `tenant` (`id`)) - Invalid query: INSERT INTO `contract` (`contract_number`, `contract_date`, `status`, `asset_id`, `space_id`, `tenant_id`, `utilization_scope`, `start_date`, `due_date`, `time_period`, `unit_of_time_period`, `contract_value`, `previous_contract`) VALUES ('Per-123/LMAN/2017', '2017-05-26', 'OPEN', '23', NULL, '1', 'Kantor', '2017-05-27', '2020-05-26', '3', 'YEAR', '6800000000', NULL)
ERROR - 2019-09-23 02:44:34 --> Severity: error --> Exception: Call to undefined method Asset_model::detail() /var/www/html/aset/api/application/controllers/Contract.php 44
ERROR - 2019-09-23 02:52:16 --> Severity: Notice --> Undefined index: contract/update_contract /var/www/html/aset/api/application/libraries/Access_control.php 71
ERROR - 2019-09-23 02:52:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given /var/www/html/aset/api/application/libraries/Access_control.php 74
ERROR - 2019-09-23 02:52:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given /var/www/html/aset/api/application/libraries/Access_control.php 74
ERROR - 2019-09-23 06:59:55 --> Severity: error --> Exception: Call to undefined function convert_date() /var/www/html/aset/api/application/controllers/Contract.php 43
ERROR - 2019-09-23 07:15:54 --> Severity: Notice --> Undefined property: Contract::$Asset_model /var/www/html/aset/api/application/controllers/Contract.php 49
ERROR - 2019-09-23 07:15:54 --> Severity: error --> Exception: Call to a member function asset_detail() on null /var/www/html/aset/api/application/controllers/Contract.php 49
ERROR - 2019-09-23 07:44:01 --> Severity: Notice --> Undefined variable: dayleft /var/www/html/aset/api/application/controllers/Contract.php 63
ERROR - 2019-09-23 08:49:23 --> Severity: Notice --> Undefined property: Contract::$Operational_activity_model /var/www/html/aset/api/application/controllers/Contract.php 57
ERROR - 2019-09-23 08:49:23 --> Severity: error --> Exception: Call to a member function get_document() on null /var/www/html/aset/api/application/controllers/Contract.php 57
