SELECT
  `services`.`id`,
  `services`.`code_ops`,
  `services`.`calidad`,
  `services`.`customer_id` as cliente_id,
  `customers`.`fullname` as nombre_cliente,
  `op1`.`name` AS `nombre_operacion`,
  `sub_operacion`.`name` AS `nombre_sub_operacion`,
  `warehouses`.`name` as Deposito,
  `services`.`statu_id`,
  `status`.`name` as nombre_estado,
  `services`.`concentrate_id`,
  `concentrates`.`name` as concentrado,
  `services`.`tonnage` as tonelage,
  `tonnages_details`.`tonnange` as avance_tonelage,
  `tonnages_details`.`date_register` as fecha_registro_tonelage,
  `users1`.`name` as usuario_registro_tonelage,
  `services`.`staff_amount` as cantidad_personal,
  `services`.`date_start` as fecha_creacion,
  `services`.`date_start_operation` as fecha_inicio_operacion,
  `services`.`observations` as observacion,
  `users`.`name` as usuario_registro_servicio
FROM
  `services`
  LEFT OUTER JOIN `customers` ON (`services`.`customer_id` = `customers`.`id`)
  LEFT OUTER JOIN `operations` `op1` ON (`services`.`operation_id` = `op1`.`id`)
  LEFT OUTER JOIN `tonnages_details` ON (`services`.`id` = `tonnages_details`.`service_id`)
  LEFT OUTER JOIN `operations` sub_operacion ON (`services`.`operation_sub_type_id` = `sub_operacion`.`id`)
  LEFT OUTER JOIN `status` ON (`services`.`statu_id` = `status`.`id`)
  LEFT OUTER JOIN `concentrates` ON (`services`.`concentrate_id` = `concentrates`.`id`)
  LEFT OUTER JOIN `users` ON (`services`.`user_id` = `users`.`id`)
  LEFT OUTER JOIN `warehouses` ON (`services`.`warehouse_id` = `warehouses`.`id`)
  LEFT OUTER JOIN `users` `users1` ON (`tonnages_details`.`user_id` = `users1`.`id`)

