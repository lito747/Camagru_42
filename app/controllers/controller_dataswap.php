<?php
class dataswap extends Controller {
	
	public function action() {
		 parent::__construct();
		$this->view->generate("dataswap.php", "template.php");
	}

	public function swap_info() {
		$tmp = [];
		$this->model = new datasw();
		if ($_POST['log'] && isset($_SESSION['login'])) {
			$tmp['log'] = $this->model->logChange($_POST['log']);
		} else {
			$tmp['log'] = 0;
		}
		if ($_POST['npass'] && $_POST['pass'] && isset($_SESSION['login'])) {
			$tmp['passq'] = $this->model->passChange($_POST['pass'], $_POST['npass']);
		} else {
			$tmp['passq'] = 0;
		}
		if ($_POST['email'] && isset($_SESSION['login'])) {
			$tmp['email'] = $this->model->emailChange($_POST['email']);
		} else {
			$tmp['email'] = 0;
		}
		if ($_POST['notif'] && isset($_SESSION['login'])) {
			$this->model->changeNotification($_POST['notif']);
		}
		echo json_encode($tmp);
	}
}
?>