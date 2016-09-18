<?php
namespace app\db;
class users{

	static $tb = 'users';

	static function get(){
			return db(self::$tb)->find();
	}


}