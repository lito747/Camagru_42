<?php
class picv extends Controller {

	function __construct() {
		$this->model = new picmod;
    }

	public function action() {
		if ($_GET['name'] && $this->model->confpic($_GET['name'])) {
			$_SESSION['UserPicURl'] = $_GET['name'];
			parent::__construct();
			$this->view->generate("picv.php", "template.php");
		} else {
			header('Location: http://localhost:8100/app/views/404.php');
		}
	}

	public function inonl() {
		if ($_POST['ccc']) {
			$this->model->initOnload();
		} else {
			header('Location: http://localhost:8100/app/views/404.php');
		}
	}

	public function setLikes() {
		if ($_POST['jjj']) {
			$this->model->toLike();
		} else {
			header('Location: http://localhost:8100/app/views/404.php');
		}
	}

	public function mypicdel() {
		if ($_POST['unset']) {
			$this->model->delPic();
		} else {
			header('Location: http://localhost:8100/app/views/404.php');
		}
	}

	public function comment() {
		if ($_POST['msg']) {
			$this->model->sentComent();
		} else {
			header('Location: http://localhost:8100/app/views/404.php');
		}
	}
}
?>