<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-12-17 11:53:07 --> Query error: Unknown column 'ref_kecamatan.name' in 'field list' - Invalid query: SELECT `field`.*, `spp`.`spp_num` as `spp_no`, `spp`.`document_id` as `doc_spp_id`, `spp`.`doc_sptjm_id` as `doc_sptjm_id`, `spp`.`doc_letter_id` as `doc_letter_id`, `spp`.`doc_bpn_id` as `doc_bpn_id`, `spp`.`status_process` as `statusSpp`, `ref_kelurahan`.`name` as `village_name`, `ref_kecamatan`.`name` as `sub_district_name`, `ref_kab_kota`.`name` as `district_name`, `ref_provinsi`.`name` as `province_name`, `ref_jns_bidang`.`name` as `fieldtype_name`
FROM `field`, `spp`, `ref_kelurahan`, `ref_jns_bidang`
WHERE `spp`.`id` = `field`.`spp_id_subm`
AND `ref_kelurahan`.`id` = `field`.`village`
AND `ref_jns_bidang`.`id` = `field`.`jns_bidang_id`
AND `field`.`status` = 'ACTIVE'
AND `field`.`spp_id_subm` = '90'
ORDER BY `field`.`id` ASC
ERROR - 2020-12-17 12:39:18 --> Severity: Error --> Allowed memory size of 134217728 bytes exhausted (tried to allocate 16384 bytes) /var/www/html/lfm/dev/api/system/database/drivers/mysqli/mysqli_driver.php 307
ERROR - 2020-12-17 12:39:18 --> Severity: Error --> Allowed memory size of 134217728 bytes exhausted (tried to allocate 16384 bytes) /var/www/html/lfm/dev/api/system/database/drivers/mysqli/mysqli_driver.php 307
