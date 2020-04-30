<?php

return [
	
	'user-management' => [
		'title' => 'Administración de usuarios',
		'created_at' => 'Tiempo',
		'fields' => [
		],
	],
	
	'permissions' => [
		'title' => 'Permisos',
		'created_at' => 'Tiempo',
		'fields' => [
			'name' => 'Nombre',
		],
	],
	
	'roles' => [
		'title' => 'Roles',
		'created_at' => 'Tiempo',
		'fields' => [
			'name' => 'Nombre',
			'permission' => 'Permisos',
		],
	],
	
	'users' => [
		'title' => 'Usuarios',
		'created_at' => 'Tiempo',
		'fields' => [
			'name' => 'Nombre',
			'email' => 'Email',
			'password' => 'Contraseña',
			'roles' => 'Roles',
			'remember-token' => 'Recuerdame',
		],
	],
	'global_title' => 'MC',
];