<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-12-14 20:27:27 --> Query error: Unknown column 'ref_psn_name.id' in 'where clause' - Invalid query: SELECT sum(field.nominal) as realization
FROM `field`, `spp`
WHERE `spp`.`id` = `field`.`spp_id_subm`
AND `ref_psn_name`.`id` = `spp`.`psn_id`
AND `spp`.`status_spp` = 'Terbayar'
AND `field`.`status` = 'ACTIVE'
AND `ref_psn_name`.`id` = '29'
