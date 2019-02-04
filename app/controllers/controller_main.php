<?php
class main extends Controller {

	public function action() {
		parent::__construct();
		$this->view->generate("gallery.php", "template.php");
	}
	
	function ongall() {
	if (isset($_POST['ld']))
		{
			$this->model = new gallery;
			if ($_POST['ld'] == '-') {
				$this->model->depicLes();
			} else if ($_POST['ld'] == '2') {
				$this->model->depicMore();
			} else {
				$this->model->depic();
			}
		} else {
			header('Location: http://localhost:8100/app/views/404.php');
		}
	}
}
?>