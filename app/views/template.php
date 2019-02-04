<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
   <title>Camagru</title>
   <link rel="stylesheet" href="../../CSS/style.css">
   <script src="../../js/regj.js"></script>
   <script src="../../js/cam_js.js"></script>
</head>
<body class="body">
	<div class="had-frame">
		<div class="meny">

				<a href="/main">
  					<img src="../../img/src/icons8-camera-50.png" alt="" style="width:42px;height:42px;border:0;">
				</a>
				<?php
					if (isset($_SESSION['login']) ) {
						if ($_SESSION['is_auto'] == 1) {
							echo "<a href='/cam'>
									<img src='../../img/src/icons8-selfy.png' alt='' style='width:42px;height:42px;border:0;'> 
								</a>";
						}
						echo "<a href='/dataswap'>
								<img src='../../img/src/profile.png' alt='' style='width:42px;height:42px;border:0;'> 
							</a>";
						echo "<a href='/reg/logout'>
								<img src='../../img/src/logout.png' alt='' style='width:42px;height:42px;border:0;'> 
							</a>";
						echo "<a href='/xmygall'><h3>" .$_SESSION['login']. "</h3></a>";
					} else {
						echo "<a href='/reg'>
  								<img src='../../img/src/registr.png' alt='' style='width:42px;height:42px;border:0;'>
							</a>";
					}
				?>
		</div>
	</div>
	<div class="inner">
		<?php include 'app/views/' . $content_view ?>
	</div>
</body>
<footer >
	<div class="foo">
<h4>mpytienk-2018</h4>
</div>
</footer>
</html>
