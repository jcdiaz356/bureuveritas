SELECT
  `services`.`id`,
  `services`.`code_ops`,
  `services`.`calidad`,
  `services`.`customer_id` AS `cliente_id`,
  `customers`.`fullname` AS `nombre_cliente`,
  `services`.`operation_id`,
  `operacion`.`name` AS `nombre_operacion`,
  `services`.`operation_sub_type_id` AS `sub_operacion_nombre`,
  `sub_operacion`.`name` AS `nombre_sub_operacion`,
  `warehouses`.`name` AS `Deposito`,
  `services`.`statu_id`,
  `status`.`name` AS `nombre_estado`,
  `services`.`concentrate_id`,
  `concentrates`.`name` AS `concentrado`,
  `services`.`tonnage` AS `tonelage`,
  `services`.`staff_amount` AS `cantidad_personal`,
  `services`.`date_start` AS `fecha_creacion`,
  `services`.`date_start_operation` AS `fecha_inicio_operacion`,
  `services`.`observations` AS `observacion`,
  `users`.`name` AS `usuario_registro_servicio`,
  `status1`.`name` as estado_detail,
  `status_details`.`date_register`  as fecha_registro,
  `users1`.`name` as nobre_registro_estado
FROM
  `services`
  LEFT OUTER JOIN `customers` ON (`services`.`customer_id` = `customers`.`id`)
  LEFT OUTER JOIN `operations` `operacion` ON (`services`.`operation_id` = `operacion`.`id`)
  LEFT OUTER JOIN `operations` `sub_operacion` ON (`services`.`operation_sub_type_id` = `sub_operacion`.`id`)
  LEFT OUTER JOIN `status` ON (`services`.`statu_id` = `status`.`id`)
  LEFT OUTER JOIN `concentrates` ON (`services`.`concentrate_id` = `concentrates`.`id`)
  LEFT OUTER JOIN `users` ON (`services`.`user_id` = `users`.`id`)
  LEFT OUTER JOIN `warehouses` ON (`services`.`warehouse_id` = `warehouses`.`id`)
  LEFT OUTER JOIN `status_details` ON (`services`.`id` = `status_details`.`service_id`)
  INNER JOIN `status` `status1` ON (`status_details`.`statu_id` = `status1`.`id`)
  INNER JOIN `users` `users1` ON (`status_details`.`user_id` = `users1`.`id`)
