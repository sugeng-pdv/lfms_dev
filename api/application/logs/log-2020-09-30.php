<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-09-30 06:31:19 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`lman_lf_development`.`acl_authority`, CONSTRAINT `acl_authority_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `acl_role` (`id`)) - Invalid query: INSERT INTO `acl_authority` (`role_id`, `menu_id`, `authority`) VALUES ('', '', '')
