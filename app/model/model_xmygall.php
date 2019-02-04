<?php
class mygallmod {

	private function getUsrId() {
		$tmp = "Login='" . $_SESSION['login'] . "'";
		$ret = ORM::getInstance()->getTabinfo('Users', $tmp);
		return $ret[0]['ID'];
	}

	private function getPic() {
		$tm = 6;
		$lim = 'LIMIT ' . $_SESSION['lmygal'] . ', ' . $tm;
		$tmp = "picture ";
		$id  = $this->getUsrId();
		$where = "USR_ID=" . $id . ' ' . $lim;
		$res = ORM::getInstance()->getTabinfo($tmp, $where);
		if (count($res) >= 1) {
			return $res;
		}
		return false;
	}

	private function printGall($in) {
		$lim = count($in);
			$inner = '';
			for ($i = 0; isset($in[$i]) && $i < 6; $i += 3) {
			 	$inner .= '<div class=gal_pic >';
			 	for ($k = $i; isset($in[$k]['Pic_Path']) && $k < $i + 3; $k++) {
			 		if ($_SESSION['login']) {
			 			$inner .= "<a href='picv/action?name=" . $in[$k]['Pic_Path'] ."'>";
			 		} else {
			 			$inner .= "<a href='#' onclick='picReplace(" . $k . ")'>";
			 		}
			 		$inner .= "<img src=" . $in[$k]['Pic_Path'] . " alt='' id=". $k ." class=pic_prew > </a>";
			 	}
			 	$inner .= '</div>';
			}
		echo $inner;
	}

	public function depic() {
		$_SESSION['lmygal'] = 0;
		$tmp = $this->getPic();
		if ($tmp !== false) {
			$this->printGall($tmp);
		}
	}

	public function depicMore() {
		$where = 'USR_ID=' . $this->getUsrId();
		$tms = ORM::getInstance()->getTabinfo('picture', $where);
		$cou = count($tms);
		$check = $_SESSION['lmygal'] + 6;
		if ($check < $cou) {
			$_SESSION['lmygal'] += 6;
			$tmp = $this->getPic();
			$this->printGall($tmp);
		}
	}

	public function depicLes() {
			$tmp = $_SESSION['lmygal'] - 6;
			if ($tmp >= 0) {
				$_SESSION['lmygal'] -= 6;
			} else {
				$_SESSION['lmygal'] = 0;
			}
		$tmp = $this->getPic();
		$this->printGall($tmp);

	}
}
?>