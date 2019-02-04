<?php

class datasw {
	public function checkPass($var) {
		$tmp = "Pass='" . $var . "'";
		$var1 = ORM::getInstance()->getTabinfo("Users", $tmp);
		
		if ($var1[0]['Pass'] === $var) {
			if (count($var1) == 1) {
				return true;
			}
		}
		return false;
	}

	public function logChange($log) {
		$tmp = [];
		if (preg_match("#^[a-zA-Z0-9]*$#", $log)) {
			$val = "Login=" . "'" . $log . "'";
			$data = "Login=" . "'" . $_SESSION['login'] . "'";
			ORM::getInstance()->modData('Users',  $val, $data);
			$_SESSION['login'] = $log;
			$tmp[0] = 0;
		return $tmp;
		}
		$tmp[0] = 'logChange';
		$tmp[1]= 'Minimum six characters, at least one uppercase letter, one lowercase letter and one number';
		return $tmp;
	}

	public function passChange($old, $new) {
		$t1 = hash('Whirlpool', $old);
		$t2 = hash('Whirlpool', $new);
		$tmp = [];
		
		if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$#', $new)) {
			if ($this->checkPass($t1)) {
				$val = "Pass=" . "'" . $t2 . "'";
				$data = "Login=" . "'" . $_SESSION['login'] . "'";
				ORM::getInstance()->modData('Users',  $val, $data);
				$tmp[0] = 0;
				return $tmp;
			} else {
				$tmp[0] = 'passChange';
				$tmp[1] = 'Incorect pasword';
				return $tmp;
			}
		}
		$tmp[0] = 'passChange';
		$tmp[1] = 'Minimum six characters, at least one uppercase letter, one lowercase letter and one number';
		return $tmp;
	}

	public function emailChange($mail) {
		$tmp = [];
		if (preg_match('#(.+?)\@([a-z0-9-_]+)\.(aero|arpa|asia|biz|cat|ua|tv|ru|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])#i', $mail)) {
			$val = "Email=" . "'" . $mail . "'";
			$data = "Login=" . "'" . $_SESSION['login'] . "'";
			ORM::getInstance()->modData('Users',  $val, $data);
			$tmp[0] = 0;
			return $tmp;
		} else {
			$tmp[0] = 'emailChange';
			$tmp[1] = 'Invalid mail format';
			$tmp[3] = $mail;
		}
		return $tmp;
	}

	public function changeNotification($data) {
		$tmp = "Login=" . "'" . $_SESSION['login'] . "'";
		if ($data == 'true') {
			$val = "is_notif=" .  '1';
		} else {
			$val = "is_notif=" . '0';
		}
		ORM::getInstance()->modData('Users',  $val, $tmp);
	}
}
?>
