<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-10-19 10:08:25 --> Query error: Unknown column 'spp.num' in 'field list' - Invalid query: SELECT `field`.*, `spp`.`num` as `spp_no`
FROM `field`, `spp`
WHERE `spp`.`id` = `field`.`spp_id`
AND `field`.`status` = 'ACTIVE'
AND `field`.`spp_id` IS NULL
ORDER BY `field`.`id` ASC
