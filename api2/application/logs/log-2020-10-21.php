<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-10-21 23:31:33 --> Query error: Unknown table 'lman_lf_development.ref_kelurahan' - Invalid query: SELECT `ref_kelurahan`.*, `ref_kecamatan`.`name` as `name_kec`
FROM `ref_kecamatan`
WHERE `ref_kelurahan`.`status` = 'ACTIVE'
AND `ref_kecamatan`.`id` = `ref_kelurahan`.`kecamatan_id`
ORDER BY `ref_kecamatan`.`name` ASC, `ref_kelurahan`.`name` ASC
ERROR - 2020-10-21 23:34:21 --> Query error: Unknown column 'ref_kecamatan.name_kec' in 'order clause' - Invalid query: SELECT `ref_kelurahan`.*, `ref_kecamatan`.`name` as `name_kec`
FROM `ref_kecamatan`, `ref_kelurahan`
WHERE `ref_kelurahan`.`status` = 'ACTIVE'
AND `ref_kecamatan`.`id` = `ref_kelurahan`.`kecamatan_id`
ORDER BY `ref_kecamatan`.`name_kec` ASC
ERROR - 2020-10-21 23:34:45 --> Query error: Unknown column 'ref_kecamatan.name_kec' in 'order clause' - Invalid query: SELECT `ref_kelurahan`.*, `ref_kecamatan`.`name` as `name_kec`
FROM `ref_kecamatan`, `ref_kelurahan`
WHERE `ref_kelurahan`.`status` = 'ACTIVE'
AND `ref_kecamatan`.`id` = `ref_kelurahan`.`kecamatan_id`
ORDER BY `ref_kecamatan`.`name_kec` ASC
ERROR - 2020-10-21 23:43:36 --> Query error: Unknown table 'lman_lf_development.ref_kelurahans' - Invalid query: SELECT `ref_kelurahans`.*, `ref_kecamatan`.`name` as `name_kec`
FROM `ref_kecamatan`, `ref_kelurahan`
WHERE `ref_kelurahan`.`status` = 'ACTIVE'
AND `ref_kecamatan`.`id` = `ref_kelurahan`.`kecamatan_id`
ORDER BY `ref_kecamatan`.`name` ASC
ERROR - 2020-10-21 23:45:00 --> Query error: Unknown table 'lman_lf_development.ref_kelurahans' - Invalid query: SELECT `ref_kelurahans`.*, `ref_kecamatan`.`name` as `name_kec`
FROM `ref_kelurahan`, `ref_kecamatan`
WHERE `ref_kelurahan`.`status` = 'ACTIVE'
AND `ref_kelurahan`.`kecamatan_id` = `ref_kecamatan`.`id`
ORDER BY `ref_kecamatan`.`name` ASC
