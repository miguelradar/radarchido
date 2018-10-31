<?php

	namespace App\Sys;
	
	use \mysqli;
	use App\Sys\Debug;
	
	class Conexion extends mysqli{
		public function __construct(){
			parent::__construct('127.0.0.1', 'root', '', 'pruebas');
			
			if($this->connect_errno){
				Debug::parar($this->connect_error);
			}
		}
	}