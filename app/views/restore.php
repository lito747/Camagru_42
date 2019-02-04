<div id="reg_form" class="reg_form">
	<div>
		<p class="reg_p">Enter new password:</p>
		<input class="in_fildr" type="password" name='pass' id="pass_in" value=""  required/>
		<p class="reg_p">Repeat new password:</p>
		<input class="in_fildr" type="password" name='pass' id="pass_2in" value=""  required/></br>
		<button id="12" type="button" onclick="resetp()" value="send" class="rbut">Submit</button>
		<p id="transmitor" style="display: none;"><?php echo $_GET['rest']?></p>
	</div>
</div>
<p id="pass_check" style="text-align: center;"></p>