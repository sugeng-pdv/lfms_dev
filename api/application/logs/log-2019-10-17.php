<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-10-17 06:51:39 --> Severity: Notice --> Undefined variable: result /var/www/html/aset/api/application/controllers/Employee.php 38
ERROR - 2019-10-17 07:26:58 --> Severity: Notice --> Undefined property: Lman_security::$instance /var/www/html/aset/api/application/libraries/Lman_security.php 24
ERROR - 2019-10-17 07:26:58 --> Severity: Notice --> Trying to get property 'input' of non-object /var/www/html/aset/api/application/libraries/Lman_security.php 24
ERROR - 2019-10-17 07:26:58 --> Severity: error --> Exception: Call to a member function post() on null /var/www/html/aset/api/application/libraries/Lman_security.php 24
ERROR - 2019-10-17 07:28:13 --> Query error: Table 'lman_asset_service.employee' doesn't exist - Invalid query: INSERT INTO `employee` (`email`, `nip_npp`, `pwd`, `salt`, `version`, `name`) VALUES ('developer@lman.site', '000000000000000000', '$2y$12$poxrN8Sz2Y/Iy3T433QWFeOXaAL8RZfL7g6dVdgsHYllXYd/R3CoK', 'eWMzL3jkuNThcr9SJORpf71K2Bgstwo', '1', 'User Developer')
