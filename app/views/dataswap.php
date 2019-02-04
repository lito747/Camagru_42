
<div class="dats">
	<h3>Change user data:</h3>
	<form action='' method="POST" id='reg_form'>
		<p>New Login:</p>
		<input type="text" name='log' id="log_swap" value=""  required/>
		<p id="log_check"></p>
		<p>New Password:</p>
		<input type="text" name='npass' id="pass_new" value=""  required/>
		<p id="pass_check"></p>
		<p>Old Password:</p>
		<input type="text" name='pass' id="pass_old" value=""  required/>
		<p id="old_check"></p>
		<p>Email:</p>
		<input type="text" name='email' id="email_swap" value="" required/>
		<p id="email_check"></p>
		Notification:<input type="checkbox" id="isset" name="notif" value="yes" checked/>
		</br>
		<button id="button" type="button" onclick="mySwap()" value="send" class="">Submit</button>
		<p id="d"></p>
	</form>
</div>