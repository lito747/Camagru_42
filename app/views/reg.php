<div id="reg_form" class="reg_form">
	<div class="reg">
	<h3 class="reg_h3">Registrate:</h3>
		<form action='' method="POST" id='reg_form'>
			<p class="reg_p">Login:</p>
			<input class="in_fildr" type="text" name='log' id="log_in" value=""  required/>
			<p id="log_check"></p>
			<p class="reg_p">Password: </p>
			<input class="in_fildr" type="password" name='pass' id="pass_in" value=""  required/>
			<p id="pass_check"></p>
			<p class="reg_p">Email:</p>
			<input class="in_fildr" type="text" name='email' id="email_in" value="" required/>
			<p id="email_check"></p>
			<button id="12" type="button" onclick="myValidate()" value="send" class="rbut">Submit</button>
			<br/>
			<p id="lllll"><p/>
		</form>
	</div>
	<div class="border">
	</div>
	<div class="reg2">
		<h3 class="reg_h3">Log-in:</h3>
		<form action='' method="POST" id='reg_form1'>
			<p class="reg_p">Login:</p>
			<input class="in_fildr" type="text" name='log' id="log_in1" value=""  required/>
			<p id="log_check"></p>
			<p class="reg_p">Password: </p>
			<input class="in_fildr" type="password" name='pass' id="pass_in1" value=""  required/>
			<p id="pass_check"></p>
			<button id="13" type="button" onclick="myLogin()" value="send" class="rbut">Submit</button>
			<br/>
			<p id="fffff"><p/>
		</form>
		<button class="rbut" id="" type="button"  value="send" onclick="restoreJs()">Restore Pass</button>
	</div>
</div>
