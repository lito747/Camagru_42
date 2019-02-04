<?php
class cam extends Controller {

	public function __construct() {
		$this->model = new cammod;
    }
	
	public function action() {
		if ($_SESSION['login']) {
			parent::__construct();
			$this->view->generate("cam.php", "template.php");
		} else {
			header('Location: http://localhost:8100/app/views/404.php');
		}
	}

	public function campick() {
		if ($_POST['picdest'] && $_POST['pica']) {
			$this->model->savePicFromCam();
		} else {
			header('Location: http://localhost:8100/app/views/404.php');
		}
	}
}
?>