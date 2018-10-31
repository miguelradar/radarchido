<?php

	namespace App\Sys;
	
	class Debug{
		static public function parar($variable = ''){
			echo "<pre>";
			die(var_dump($variable));
		}
		
		static public function seguir($variable = ''){
			echo "<pre>";
			var_dump($variable);
			echo "</pre>";
		}
	}