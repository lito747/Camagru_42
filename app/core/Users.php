<?php
class Users {
	private static $usr_data = null;

	public static function addUser($usrLog) {
		if (is_array($usrLog)) {
			self::$usr_data = $usrLog;
		}
	}

	public static function getUsr() {
		if (self::$usr_data) {
			return self::$usr_data;
		}
		return null;
	}

	public static function uptUsr($fild, $in) {
		if (!is_null(self::$usr_data)) {
			self::$usr_data[0][$fild] = $in;
		}
	}

	public static function getUsrData($in) {
			return self::$usr_data[$in];

	}

	public static function rmUsr($in) {
		if (isset(self::$usr_data[0][$in])) {
			 self::$usr_data = null;
		}
	}
}
?>