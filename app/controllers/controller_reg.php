<?php
class reg extends Controller {

	public function __construct() {
			$this->model = new registr;
   }
	public function action() {
		if ($_SESSION['login']){
			header('Location: http://localhost:8100/');
		}
		parent::__construct();
		$this->view->generate("reg.php", "template.php");
	}

	public function reg_coll() {
		if ($_POST['log'] && $_POST['pass'] && $_POST['email']) {
			$this->model->addUser($_POST['log'], $_POST['pass'], $_POST['email']);
		} else {
			header('Location: http://localhost:8100/app/views/404.php');
		}
	}

	public function login() {
		if ($_SESSION['login']){
			header('Location: http://localhost:8100/');
		}
			$this->model->log_in();
	}
	
	public function logout() {
		if ($_SESSION['login']) {
			$this->model->log_out();
		} else {
			header('Location: http://localhost:8100/app/views/404.php');
		}
	}

	public function activate() {
		if ($_GET['acc']) {
		 	$this->model->temptocom();
		} else {
			header('Location: http://localhost:8100/app/views/404.php');
		}
	}

	public function restore() {
		if ($_SESSION['login']){
			header('Location: http://localhost:8100/');
		}
		if ($_GET['rest']) {
			$tmview = new View();
			$tmview->generate("restore.php", "template.php");
		} else {
			header('Location: http://localhost:8100/app/views/404.php');
		}
	}

	public function restorefin() {
		if ($_SESSION['login']){
			header('Location: http://localhost:8100/');
		}
		if ($_POST['pasn'] && $_POST['resetToken']) {
			$this->model->restfinn();
		} else {
			header('Location: http://localhost:8100/app/views/404.php');
		}
	}

	public function restorePass() {
		if ($_SESSION['login']){
			header('Location: http://localhost:8100/');
		}
		if ($_POST['resm']) {
			$this->model->passRestore();
		} else {
			header('Location: http://localhost:8100/app/views/404.php');
		}
	}
}
?>