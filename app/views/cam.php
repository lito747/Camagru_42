<div class="maincam">
<div id="splash">
  <p id="errorMessage">Loading...</p>
</div>
<div align="center">
	<button type="button" onclick="apendPic('../../img/src/cam_png/StylzzZ3.png')"><img src="../../img/src/cam_png/StylzzZ3.png" alt="Pic Loading..." height="75px" width="75px"/></button>
	<button type="button" onclick="apendPic('../../img/src/cam_png/StylzzZ2.png')"><img src="../../img/src/cam_png/StylzzZ2.png" alt="Pic Loading..." height="75px" width="75px"/></button>
	<button type="button" onclick="apendPic('../../img/src/cam_png/StylzzZ.png')"><img src="../../img/src/cam_png/StylzzZ.png" alt="Pic Loading..." height="75px" width="75px"/></button>
	<button type="button" onclick="apendPic('../../img/src/cam_png/kr.png')"><img src="../../img/src/cam_png/kr.png" alt="Pic Loading..." height="75px" width="75px"/></button>
	<button type="button" onclick="apendPic('../../img/src/cam_png/cat.png')"><img src="../../img/src/cam_png/cat.png" alt="Pic Loading..." height="75px" width="75px"/></button>
	<button type="button" onclick="apendPic('../../img/src/cam_png/panda.png')"><img src="../../img/src/cam_png/panda.png" alt="Pic Loading..." height="75px" width="75px"/></button>
</div>

<div id="app" class="canwcam"  hidden>
  	<video id="monitor"  width="640" height="480" autoplay></video>
  	<div id="inner_canv">
  		<canvas id="photo" style="position:absolute;" width="640" height="480"></canvas>
	</div>
</div>
	<button id="shutter">&#x1F4F7;</button>
  	<button id="lod" onclick="sendImage()" hidden>Take pic</button>
  	<input type="file" onchange="previewFile()" accept="image/jpg, image/jpeg">
</div>
<script>
	onloadCam();
</script>