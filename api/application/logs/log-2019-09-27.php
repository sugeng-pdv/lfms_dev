<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-09-27 06:47:09 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`lman_asset_service`.`contract_document`, CONSTRAINT `contract_document_ibfk_1` FOREIGN KEY (`contract_id`) REFERENCES `contract` (`id`)) - Invalid query: INSERT INTO `contract_document` (`contract_id`, `doc_name`, `s3_bucket`, `s3_object`) VALUES ('undefined', 'Tes Dokumen Perjanjian', 's3-lman', 'DOKUMEN-KONTRAK/2019/09/27/1OP-mx.jpg')
ERROR - 2019-09-27 07:56:19 --> Severity: Notice --> Undefined index: contract/search_tenant /var/www/html/aset/api/application/libraries/Access_control.php 71
ERROR - 2019-09-27 07:56:19 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given /var/www/html/aset/api/application/libraries/Access_control.php 74
ERROR - 2019-09-27 07:56:19 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given /var/www/html/aset/api/application/libraries/Access_control.php 74
ERROR - 2019-09-27 07:56:47 --> Severity: Notice --> Undefined property: Contract::$Tenant_model /var/www/html/aset/api/application/controllers/Contract.php 700
ERROR - 2019-09-27 07:56:47 --> Severity: error --> Exception: Call to a member function search() on null /var/www/html/aset/api/application/controllers/Contract.php 700
