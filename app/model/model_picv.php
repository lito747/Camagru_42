<?php
class picmod {
	private function getPicId() {
		$tmp = "Pic_Path='" . $_SESSION['UserPicURl'] . "'";
		$ret = ORM::getInstance()->getTabinfo('picture', $tmp);
		return $ret[0]['ID'];
	}

	private function getOwner() {
		$tmp = "Pic_Path='" . $_SESSION['UserPicURl'] . "'";
		$ret = ORM::getInstance()->getTabinfo('picture', $tmp);
		return $ret[0]['USR_ID'];
	}

	private function getUsrId() {
		$tmp = "Login='" . $_SESSION['login'] . "'";
		$ret = ORM::getInstance()->getTabinfo('Users', $tmp);
		return $ret[0]['ID'];
	}

	private function getLikesq() {
		$tmp = "PIC_ID=" . $this->getPicId();
		$ret = ORM::getInstance()->getTabinfo('likes', $tmp);
		return $ret;
	}

	private function isLiked() {
		$tmp2 = "USR_ID=" . $this->getUsrId() . " AND PIC_ID=" . $this->getPicId();
		$check = ORM::getInstance()->getTabinfo('likes', $tmp2);
		if (count($check) >= 1) {
			return 1;
		}
		return 0;
	}

	private function isNotifible() {
		$tmp = "ID=" . $this->getOwner();
		$ret = ORM::getInstance()->getTabinfo('Users', $tmp);
		if ($ret[0]['is_notif'] == 1) {
			return 1;
		} else {
			return 0;
		}
	}

	public function addLike() {
		if ($this->isLiked() === 0) {
			$tmp = $this->getPicId() . ', ' . $this->getUsrId();
			ORM::getInstance()->setData('likes', $tmp, 'PIC_ID, USR_ID');
		}
	}

	public function confpic($toconf) {
		$tmp = "Pic_Path='" . $toconf . "'";
		$ret = ORM::getInstance()->getTabinfo('picture', $tmp);
		if (count($ret) == 1) {
			return 1;
		}
		return 0;
	}

	public function rmLike() {
		if ($this->isLiked() === 1) {
			$tmp = "PIC_ID=" . $this->getPicId() . " AND " . "USR_ID=" . $this->getUsrId();
			ORM::getInstance()->delData('likes', $tmp);
		}
	}

	public function sentComent() {
		if (!empty($_POST['msg']) && $_SESSION['is_auto'] == 1) {
			$tmp =  "'" . $_SESSION['login'] . "'" . ', '  . "'" . $_POST['msg'] . "'" . ', ' . $this->getUsrId() . ', ' . $this->getPicId();
			ORM::getInstance()->setData('chat', $tmp, 'USR_Login, USR_Masage, USR_ID, PIC_ID');

			if ($this->isNotifible() === 1) {
				$encoding = "utf-8";
				$subject_preferences = array(
					"input-charset" => $encoding,
					"output-charset" => $encoding,
					"line-length" => 76,
					"line-break-chars" => "\r\n"
					);
				$tmp = ORM::getInstance()->getTabinfo('Users', "ID='" . $this->getOwner() . "'");

				$ref = "http://localhost:8100/reg/activate?acc=" . $tmp[0]['Token'];
				$header = "Content-type: text/html; charset=".$encoding." \r\n";
				$header .= "From: ".$from_name." <".$from_mail."> \r\n";
				$header .= "MIME-Version: 1.0 \r\n";
				$header .= "Content-Transfer-Encoding: 8bit \r\n";
				$header .= "Date: ".date("r (T)")." \r\n";
				$header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);
				$mail_to = $tmp[0]['Email'];
				$mail_subject = "Camagru verification";
				$mail_message = "New coment:\r\n\t".$_POST['msg'];
				mail($mail_to, $mail_subject, $mail_message, $header);
			}
			unset($_POST['msg']);
		}
		echo json_encode($this->getComents());
	}

	public function getComents() {
		$tmp = "PIC_ID=" . $this->getPicId();
		$ret = ORM::getInstance()->getTabinfo('chat', $tmp);
		return $ret;
	}

	protected function isOwner() {
		$tmpuid = $this->getUsrId();
		$tmppicid = $this->getOwner();
		if ($tmpuid == $tmppicid) {
			return 1;
		}
		return 0;
	}

	public function delPic() {
		if ($this->isOwner()) {
			$where = "ID=" . $this->getPicId();
			ORM::getInstance()->delData('picture', $where);
		}
	}

	public function initOnload() {
		$tmp = [];
		if ($this->isLiked() === 1) {
			$tmp['is_act'] = 1;
		} else {
			$tmp['is_act'] = 0;
		}
		$tmp['likes'] = $this->getLikesM();
		$tmp['coments'] = $this->getComents();
		$tmp['isOwner'] = $this->isOwner();
		echo json_encode($tmp);
	}

	public function getLikesM() {
		$tmp = $this->getLikesq();
		$ret = count($tmp);
		return $ret;
	}

	public function toLike() {
		if ($_SESSION['is_auto'] == 1) {
			if ($this->isLiked() === 1) {
				$this->rmLike();
			} else {
				$this->addLike();
			}
			$tmp = [];
			$tmp['is_act'] = $this->isLiked();
			$tmp['qua'] = $this->getLikesM();
			echo json_encode($tmp);
		}
	}
}
?>