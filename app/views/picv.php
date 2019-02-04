<div class="pic" id="picblock">

		<div class="inner_pic" id="ablock">
			<img src=<?php echo $_GET['name'];?> class='inner_pic_prev' alt=''/>
			<div class="inner_input" >
				<button id="but" type="button"  value="send" onclick="setLikesjs()" class="gal_button">Like</button><p id="likeq"></p>
			</div>
		</div>
		<div class="inner_pic" id="bblock" rows="10" cols="60"> 
			<textarea disabled class="inner_text" id="inner_tid"></textarea>
				<input type="text" id='mas_in' value="">
				<button id="button" type="button"  value="send" onclick="setComent()" class="in_button">Submit</button>
		</div>
</div>
<div class="bdel">
	<button id="del_button" type="button"  value="send" onclick="delMyPic()" class="del_button" >Delete</button>
</div>
<script>
	loadIner();
</script>