<?php
class View {
	public function __construct() {}
	public function generate($content_view, $template_view, $data = null) {
					 include 'app/views/'. $template_view;
	}
}
?>