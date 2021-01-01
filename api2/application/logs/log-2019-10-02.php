<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-10-02 02:48:38 --> 404 Page Not Found: Paymenr/delete
ERROR - 2019-10-02 03:31:47 --> Severity: Notice --> Undefined variable: asset /var/www/html/aset/api/application/controllers/Payment.php 115
ERROR - 2019-10-02 04:19:37 --> Query error: Unknown column 'billed_amount' in 'field list' - Invalid query: SELECT `billed_amount`, `currency`
FROM `payment`
WHERE `status` = 'ISSUED'
AND `invoice_date` >= '2019-09-01'
AND `invoice_date` <= '2019-09-30'
ERROR - 2019-10-02 04:20:06 --> Severity: Notice --> Undefined property: stdClass::$amount /var/www/html/aset/api/application/models/Invoice_model.php 89
ERROR - 2019-10-02 06:52:46 --> Severity: Notice --> Undefined index: duty/add_duty /var/www/html/aset/api/application/libraries/Access_control.php 71
ERROR - 2019-10-02 06:52:46 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given /var/www/html/aset/api/application/libraries/Access_control.php 74
ERROR - 2019-10-02 06:52:46 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given /var/www/html/aset/api/application/libraries/Access_control.php 74
ERROR - 2019-10-02 06:55:12 --> Query error: Column 'asset_id' cannot be null - Invalid query: INSERT INTO `duty` (`asset_id`, `duty_type`, `value`, `status`, `period`, `cycle`, `due_date`, `paid_date`) VALUES (NULL, '1', '21888500', 'UNPAID', '2018', 'ANNUAL', NULL, NULL)
ERROR - 2019-10-02 06:59:43 --> Severity: Notice --> Undefined index: duty/update_duty /var/www/html/aset/api/application/libraries/Access_control.php 71
ERROR - 2019-10-02 06:59:43 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given /var/www/html/aset/api/application/libraries/Access_control.php 74
ERROR - 2019-10-02 06:59:43 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given /var/www/html/aset/api/application/libraries/Access_control.php 74
ERROR - 2019-10-02 07:11:00 --> Query error: Unknown column 'date' in 'order clause' - Invalid query: SELECT *
FROM `duty`
WHERE `asset_id` = '23'
ORDER BY `date` DESC
