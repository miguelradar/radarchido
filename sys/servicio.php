<?php

	namespace App\Sys;
	
	class Servicio{
		public $link;
		
		public function __construct(){
			$this->link = '/curso/';
		}
		
		static public function encode($valor){
			return base64_encode(json_encode([$valor]));
		}
		
		static public function decode($valor){
			$valor = json_decode(base64_decode($valor));
			return is_array($valor) ? $valor[0] : $valor;
		}
	}
	
