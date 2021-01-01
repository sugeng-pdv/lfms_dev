<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-10-09 16:38:34 --> Severity: Compile Error --> Cannot redeclare Spp::get_name_psn_post() /var/www/html/lfm/dev/api/application/controllers/Spp.php 86
ERROR - 2020-10-09 16:39:11 --> Severity: Compile Error --> Cannot redeclare Spp::get_name_psn_post() /var/www/html/lfm/dev/api/application/controllers/Spp.php 86
ERROR - 2020-10-09 16:40:36 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /var/www/html/lfm/dev/api/application/models/Sector_model.php 47
ERROR - 2020-10-09 17:22:46 --> Severity: Notice --> Undefined index: psn_name /var/www/html/lfm/dev/api/application/controllers/Spp.php 16
ERROR - 2020-10-09 17:22:46 --> Query error: Unknown column 'psn_id' in 'field list' - Invalid query: INSERT INTO `ref_psn_name` (`psn_id`, `spp_num`, `date`, `nominal`, `total_field`, `document_id`) VALUES (NULL, 'TN.123', '2020-10-16', '120000000', '12', '11')
ERROR - 2020-10-09 17:23:00 --> Severity: Notice --> Undefined index: psn_name /var/www/html/lfm/dev/api/application/controllers/Spp.php 16
ERROR - 2020-10-09 17:23:00 --> Query error: Unknown column 'psn_id' in 'field list' - Invalid query: INSERT INTO `ref_psn_name` (`psn_id`, `spp_num`, `date`, `nominal`, `total_field`, `document_id`) VALUES (NULL, 'TN.123', '2020-10-16', '120000000', '12', '11')
ERROR - 2020-10-09 17:45:36 --> Severity: Notice --> Undefined index: psn_name /var/www/html/lfm/dev/api/application/controllers/Spp.php 16
ERROR - 2020-10-09 17:45:36 --> Query error: Unknown column 'psn_id' in 'field list' - Invalid query: INSERT INTO `ref_psn_name` (`psn_id`, `spp_num`, `date`, `nominal`, `total_field`, `document_id`) VALUES (NULL, 'TN.123', '2020-10-09', '120000000', '120000', '12')
ERROR - 2020-10-09 17:46:59 --> Severity: Notice --> Undefined index: psn_name /var/www/html/lfm/dev/api/application/controllers/Spp.php 16
ERROR - 2020-10-09 17:46:59 --> Query error: Unknown column 'psn_id' in 'field list' - Invalid query: INSERT INTO `ref_psn_name` (`psn_id`, `spp_num`, `date`, `nominal`, `total_field`, `document_id`) VALUES (NULL, 'TN.123', '2020-10-09', '120000000', '120000', '12')
ERROR - 2020-10-09 17:47:27 --> Query error: Unknown column 'psn_id' in 'field list' - Invalid query: INSERT INTO `ref_psn_name` (`psn_id`, `spp_num`, `date`, `nominal`, `total_field`, `document_id`) VALUES ('3', 'TN.123', '2020-10-09', '120000000', '120000', '12')
ERROR - 2020-10-09 17:49:40 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`lman_lf_development`.`spp`, CONSTRAINT `spp_ibfk_1` FOREIGN KEY (`psn_id`) REFERENCES `psn` (`id`)) - Invalid query: INSERT INTO `spp` (`psn_id`, `spp_num`, `date`, `nominal`, `total_field`, `document_id`) VALUES ('3', 'TN.123', '2020-10-09', '120000000', '120000', '12')
