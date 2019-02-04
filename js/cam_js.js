var x,y;

document.onmousemove = function(e){
    e = e || window.event;
    x = e.clientX;
    y = e.clientY;
};

function sendImage() {
	var xp = document.getElementById('photo');
  var xpcan = xp.getContext('2d');
	var arr = document.getElementsByName("my_appic");

	if (xp !== null && arr !== null) {
		var resultArr = [];
		var dest = xp.toDataURL("image/jpg");
		for (var i = 0; i < arr.length; i++) {
			resultArr[i] = [];
			if (arr[i].getAttribute('flag') !== "0") {
				resultArr[i][0] = arr[i].toDataURL("image/png");
				resultArr[i][0] = resultArr[i][0].split(',')[1];
				resultArr[i][1] = parseInt(arr[i].style.left) - parseInt(arr[i].getAttribute('tx'));
				resultArr[i][2] = parseInt(arr[i].style.top) - parseInt(arr[i].getAttribute('ty'));
			} else {
				resultArr[i][0] = arr[i].toDataURL("image/png");
				resultArr[i][0] = resultArr[i][0].split(',')[1];
				resultArr[i][1] = 0;
				resultArr[i][2] = 0;
			}
		}
		for (var i = arr.length - 1; i >= 0; i--) {
			arr[i].parentNode.removeChild(arr[i]);
		}
    xpcan.clearRect(0, 0, 640, 480);
    window.location.replace("/cam");
		var picArr = 'picdest=' + dest + '&pica=' + JSON.stringify(resultArr);
		var xhttp = new XMLHttpRequest();
  	xhttp.open("POST", "/cam/campick", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(picArr);
	}
}

function getCoords(elem) {  
  			var box = elem.getBoundingClientRect();
  			return {
   				top: box.top + pageYOffset,
    			left: box.left + pageXOffset
  				};
		}


function mousepos() {
	var ob = document.elementFromPoint(x, y);
	var tmp = ob.getAttribute('name');
	if (ob !== null && tmp === 'my_appic') {
		ob.onmousedown = function(e) {

  		var coords = getCoords(ob);
  		var shiftX = e.pageX - coords.left;
  		var shiftY = e.pageY - coords.top;

  		ob.style.position = 'absolute';
  		document.body.appendChild(ob);
  		ob.style.zIndex = 1000;
  		moveAt(e);

  		function moveAt(e) {
  			if (ob.getAttribute("flag") === '0') {
  				ob.setAttribute('tx', e.pageX - shiftX);
  				ob.setAttribute('ty', e.pageY - shiftY);
  				ob.setAttribute('lx', (e.pageX - shiftX) + document.getElementById('photo').width);
  				ob.setAttribute('ly', (e.pageY - shiftY) + document.getElementById('photo').height);
  				ob.setAttribute("flag", '1');
  			}
  			var tempX = e.pageX - shiftX;
  			var tempY = e.pageY - shiftY;
  			if (tempX > parseInt(ob.getAttribute('tx')) && tempX < (parseInt(ob.getAttribute('lx')) - 120)) {
    			ob.style.left = tempX + 'px';
  			}
  			if (tempY > parseInt(ob.getAttribute('ty')) && tempY < (parseInt(ob.getAttribute('ly')) - 120)) {
  		    	ob.style.top = tempY + 'px';
  			}
  		}

  		document.onmousemove = function(e) {
    		moveAt(e);
  		};

  		ob.onmouseup = function() {
    		document.onmousemove = null;
    		ob.onmouseup = null;
  		};

		}
		ob.ondragstart = function() {
  			return false;
		};
	}
}