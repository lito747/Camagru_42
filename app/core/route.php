<?php

class Route {
	static function start() {
		$control_name = "main";
		$action_name = "action";

		$routes = explode('/', $_SERVER['REQUEST_URI']);
		if (!empty($routes[1])) {
			$control_name = strtolower($routes[1]);
		}
		$rout2 = explode('?', $routes[2]);
		if (!empty($rout2[0])) {
			$action_name = strtolower($rout2[0]);
		}
		$model_path = 'app/model/model_' . $control_name . '.php';
		$control_path = 'app/controllers/controller_' . $control_name . '.php';
		if (file_exists($model_path)) {
			include $model_path;
		}
		if (file_exists($control_path)) {

			include $control_path;
		} else {
			header('Location: http://localhost:8100/app/views/404.php');
		}
		$controller = new $control_name;
		if (method_exists($controller, $action_name)) {
				$controller->$action_name();
		} else {
			header('Location: http://localhost:8100/app/views/404.php');
		}
	}
}
?>