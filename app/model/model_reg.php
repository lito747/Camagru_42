<?php

class registr {

	private function checkEmail($var) {
		$tmp = "Email='" . $var . "'";
		$var1 = ORM::getInstance()->getTabinfo("Users", $tmp);
		if (count($var1) == 0) {
			return true;
		}
		return false;
	}

	private function checkLogin($var) {
		$tmp = "Login='" . $var ."'";
		$var1 = ORM::getInstance()->getTabinfo("Users", $tmp);
		if (count($var1) == 0) {
			return true;
		}
		return false;
	}

	private function addToken($log) {
		$tmp = "Login='" . $log . "'";
		$res = ORM::getInstance()->getTabinfo('Users', $tmp);
		$token = hash('md5', $res[0]['ID']);
		$tmp = "Token='" .$token ."'";
		$tmp2 = "id='" . $res[0]['ID'] ."'";
		ORM::getInstance()->modData('Users', $tmp, $tmp2);
	}

	public function addUser($log, $pass, $email) {
		if ($this->checkEmail($email)) {
			if ($this->checkLogin($log)) {
				$he = hash('Whirlpool', $pass);
				$tmp = "'" . $log ."', " . "'" . $he ."', " . "'" . $email ."'";
				ORM::getInstance()->setData('Users', $tmp, "Login, Pass, Email");
				$this->addToken($log);
				$encoding = "utf-8";
				$subject_preferences = array(
					"input-charset" => $encoding,
					"output-charset" => $encoding,
					"line-length" => 76,
					"line-break-chars" => "\r\n"
					);
				$tmp = ORM::getInstance()->getTabinfo('Users', "Email='" . $email . "'");

				$ref = "http://localhost:8100/reg/activate?acc=" . $tmp[0]['Token'];
				$header = "Content-type: text/html; charset=".$encoding." \r\n";
				$header .= "From: ".$from_name." <".$from_mail."> \r\n";
				$header .= "MIME-Version: 1.0 \r\n";
				$header .= "Content-Transfer-Encoding: 8bit \r\n";
				$header .= "Date: ".date("r (T)")." \r\n";
				$header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);
				$mail_to = $tmp[0]['Email'];
				$mail_subject = "Camagru verification";
				$mail_message = "Push button <a href=" . $ref .">Piy Piy</a>";
				if (mail($mail_to, $mail_subject, $mail_message, $header)) {
					echo 0;
				} else {
					echo 1;
				}
				return true;
			} else {
				echo "Login alredy exist in DB!";
			}
		} else {
			echo "Email alredy exist in DB!";
		}
		return false;
	}

	public function passRestore() {
		$tmp2 = "Email='" . $_POST['resm'] . "'";
		if ($tmp = ORM::getInstance()->getTabinfo("Users", $tmp2)) {
			$encoding = "utf-8";
				$subject_preferences = array(
					"input-charset" => $encoding,
					"output-charset" => $encoding,
					"line-length" => 76,
					"line-break-chars" => "\r\n"
					);
				$ref = "http://localhost:8100/reg/restore?rest=" . $tmp[0]['Token'];
				$header = "Content-type: text/html; charset=".$encoding." \r\n";
				$header .= "From: ".$from_name." <".$from_mail."> \r\n";
				$header .= "MIME-Version: 1.0 \r\n";
				$header .= "Content-Transfer-Encoding: 8bit \r\n";
				$header .= "Date: ".date("r (T)")." \r\n";
				$header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);
				$mail_to = $tmp[0]['Email'];
				$mail_subject = "Camagru verification";
				$mail_message = "Push button to restore your password <a href=" . $ref .">Piy Piy</a>";
				mail($mail_to, $mail_subject, $mail_message, $header);
		}
		echo "Check your email.";
	}

	public function restfinn() {
		$text = "Token='" . $_POST['resetToken'] . "'";
		 if ($tmp = ORM::getInstance()->getTabinfo("Users", $text)) {
		 	$he = hash('Whirlpool', $_POST['pasn']);
		 	$val = "Pass='" . $he . "'";
		 	ORM::getInstance()->modData('Users', $val, $text);
			echo "<p>Password restored!</p>";
			return ;
		 } else {
			echo "<p>OOOps.....</p>";
		}
	}

	public function temptocom() {
		$text = "Token='" . $_GET['acc'] . "'";
		$val = "is_auto=" . '1';
		ORM::getInstance()->modData('Users',  $val, $text);
		unset($_GET['acc']);
		header('Location: http://localhost:8100/');
	}

	public function log_in() {
		if ($_POST['log'] && $_POST['pass'] ) {

			$xpass = hash('Whirlpool', $_POST['pass']);
			$tmp = "Login=" . "'" . $_POST['log'] . "' AND " . " Pass=" . "'" . $xpass . "'";
			$ret = ORM::getInstance()->getTabinfo('Users', $tmp);
			if (count($ret) == 1) {
				$_SESSION['login'] = $ret[0]['Login'];
				$_SESSION['is_auto'] = $ret[0]['is_auto'];
				echo 1;
				return ;
			}
			echo "No account in DB!";
		}
	}

	public function log_out() {
		if (isset($_SESSION['login'])) {
			unset($_SESSION['login']);
			unset($_SESSION['is_auto']);
			header('Location: http://localhost:8100/');
		}
	}
}
?>