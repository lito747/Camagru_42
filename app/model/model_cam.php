<?php
class cammod {

		private function getUsrId() {
		$tmp = "Login='" . $_SESSION['login'] . "'";
		$ret = ORM::getInstance()->getTabinfo('Users', $tmp);
		return $ret[0]['ID'];
	}
	public function savePicFromCam() {
		$json_temp = json_decode($_POST['pica']);
		$dest = str_replace('data:image/png;base64,', '', $_POST['picdest']);
		$dest = str_replace(' ', '+', $dest);
		$dest = base64_decode($dest);
		$dest_image = imagecreatetruecolor(640, 480);
		$trans_background = imagecolorallocatealpha($dest_image, 0, 0, 0, 127);
		imagefill($dest_image, 0, 0, $trans_background);
		$im_dest = imagecreatefromstring($dest);
		imagealphablending($im_dest, true);
		$dest = imagecreatefromstring($dest);
		imagecopy($dest_image, $dest, 0, 0, 0, 0, 640, 480);
		$temp = count($json_temp);
		for ($i = 0; $i < $temp; $i++) {
			$temp_src = str_replace('data:image/png;base64,', '', $json_temp[$i][0]);
			$temp_src = str_replace(' ', '+', $temp_src);
			$temp_src = base64_decode($temp_src);
			$im_src = imagecreatefromstring($temp_src);
			imagealphablending($im_src, true);
			imagecopy($dest_image, $im_src, $json_temp[$i][1], $json_temp[$i][2], 0, 0, 200, 150);
			imagedestroy($im_src);
		}
		$rote = "img/user_pic/" . uniqid() . ".jpeg";
		imagejpeg($dest_image, $rote);
		$rote = "'/" . $rote . "'";
		$tmp =  $rote . ', ' . $this->getUsrId();
		ORM::getInstance()->setData('picture', $tmp, 'Pic_Path, USR_ID');
		imagedestroy($dest_image);
	}
}