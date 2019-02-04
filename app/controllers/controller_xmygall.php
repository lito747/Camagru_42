<?php
class xmygall extends Controller {
	public function action() {
		if ($_SESSION['login']) {
			parent::__construct();
			$this->view->generate("gallery1.php", "template.php");
		} else {
			header('Location: http://localhost:8100/app/views/404.php');
		}

	}
	
	public function ong() {
		if (isset($_POST['lda']))
		{
			$this->model = new mygallmod;
			if ($_POST['lda'] == '-') {
				$this->model->depicLes();
			} else if ($_POST['lda'] == '2') {
				$this->model->depicMore();
			} else {
				$this->model->depic();
			}
		}
		else {
			header('Location: http://localhost:8100/app/views/404.php');
		}
	}
}
?>