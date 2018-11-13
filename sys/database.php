<?php

namespace App\Sys;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database{
	public function __construct(){
		$this->capsule = new Capsule;

		$this->capsule->addConnection([
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'radarchido',
			'username'  => 'root',
			'password'  => '',
			'charset'   => 'utf8',
			'collation' => 'utf8_general_ci',
			'prefix'    => '',
		]);
		
		$this->capsule->setAsGlobal();
		$this->capsule->bootEloquent();
		
		return $this;
	}
}
