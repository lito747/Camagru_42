function myValidate() {

	event.preventDefault()
	var log = logCheck();
	var pass = passCheck();
	var email = emailCheck();
	 if (log && pass && email) {
	 	var xlog = document.getElementById('log_in').value;
	 	var xpass = document.getElementById('pass_in').value;
	 	var xemail = document.getElementById('email_in').value;
	 	loadDoc(xlog, xpass, xemail);
	 }
}

async function onloadCam() {
	const video = document.getElementById('monitor');
  	var canvas = document.getElementById('photo');
  	const shutter = document.getElementById('shutter');
  	
  try {
    video.srcObject = await navigator.mediaDevices.getUserMedia({video: true});

    await new Promise((resolve) => video.onloadedmetadata = resolve);
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    document.getElementById('splash').hidden = true;
    document.getElementById('app').hidden = false;
    shutter.onclick = () => canvas.getContext('2d').drawImage(video, 0, 0);
  } catch (err) {
    console.error(err);
  }
}


function previewFile() {
	var file    = document.querySelector('input[type=file]').files[0];
	var myCanv  = document.getElementById('photo');
	var xcan	= myCanv.getContext('2d');
	var ximg 	= new Image;
  	var reader  = new FileReader();

  	reader.onloadend = function () {
    	ximg.src = reader.result;
  	}
  	ximg.onload = function () {
  		xcan.clearRect(0, 0, 640, 480);
  		xcan.drawImage(ximg, 0, 0, 640, 480);
  	}
  	if (file) {
    	reader.readAsDataURL(file);
    }
}

function restoreJs() {
	var xdiv = document.getElementById("reg_form");
	var tmp = '<div>';
	tmp += '<p class="reg_p">Enter your email:</p>';
	tmp += '<input class="in_fildr" type="text" name="email" id="res_form" value="" required/></br>';
	tmp += '<button id="" type="button" onclick="startRest()" value="send" class="rbut">Submit</button>';
	tmp += '<p class="reg_p" id="resresp"></p>';
	tmp += '</div>';
	xdiv.innerHTML = tmp;
}

function startRest() {
	var xdiv = document.getElementById('reg_form');
	var xform = document.getElementById('res_form');
	if (xdiv !== null && xform !== null && xform.value != '') {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
				 document.getElementById('resresp').innerHTML = this.responseText;
    		}
  		};
  		var tmp = "resm=" + xform.value;
  		xhttp.open("POST", "reg/restorePass", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(tmp);
	}
}

function resetp() {
	var in1 = document.getElementById('pass_in').value;
	var in2 = document.getElementById('pass_2in').value;
	var rToken = document.getElementById('transmitor').innerHTML;

	if (in1 == in2) {
		document.getElementById('pass_check').innerHTML = '';
		var pass = passCheck();

		if (pass) {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
				 	document.getElementById('reg_form').innerHTML = this.responseText;
    			}
  			};
  			var tmp = "pasn=" + in1 + "&resetToken=" + rToken;
  			xhttp.open("POST", "/reg/restorefin", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send(tmp);
		}
	} else {
		document.getElementById('pass_check').innerHTML = 'Pass1 does not match Pass2!';
	}
}

function apendPic(tmp) {
	var cont = document.getElementById('inner_canv');
	var addElem = document.createElement('canvas');
	document.getElementById('lod').hidden = false;
	var base_image = new Image();
	var ctx = addElem.getContext('2d');
	base_image.src = tmp;
	ctx.drawImage(base_image, 0, 0, 200, 150);
	addElem.setAttribute('name', 'my_appic');
	addElem.setAttribute('flag', 0);
	addElem.style.position = 'absolute';
	addElem.style.height = "150px";
	addElem.style.width = "200px";
	addElem.addEventListener('mousemove', mousepos);
	addElem.style.zIndex = 1000;
	cont.appendChild(addElem);
}

function loadIner() {
	var xp = document.getElementById('likeq');
	var xdiv = document.getElementById('inner_tid');
	if (xp !== null && xdiv !== null) {
		xdiv.innerHTML = '';
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
    			var xbutton = document.getElementById('but');
    			var ob = JSON.parse(this.responseText);
				xp.innerHTML = ob['likes'];
				var tmp = '';
				ob['coments'].forEach(function(element) {
					tmp += element['USR_Login'] + ': ' + element['USR_Masage'] + '\n';
				});
				xdiv.innerHTML = tmp;
				if (ob['is_act'] === 1) {
					xbutton.style.backgroundColor = "red";
				} else {
					xbutton.style.backgroundColor = "green";
				}
				if (ob['isOwner'] === 1) {
					document.getElementById('del_button').style.visibility = "visible";
				}
    		}
  		};
  		var tll = 'ccc=ccc';
  		xhttp.open("POST", "/picv/inonl", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(tll);
	}
}

function setLikesjs() {
	var xp = document.getElementById('likeq');
	if (xp !== null) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
    		var xbutton = document.getElementById('but');
			var ob = JSON.parse(this.responseText);
			xp.innerHTML = ob['qua'];
			if (ob['is_act'] === 1) {
				xbutton.style.backgroundColor = "red";
			} else {
				xbutton.style.backgroundColor = "green";
			}
    	}
  	};
  	var tll = 'jjj=ccc';
  	xhttp.open("POST", "/picv/setLikes", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(tll);
	}
}

function setComent() {
	var xp = document.getElementById('mas_in');
	var xdiv = document.getElementById('inner_tid');
	if (xp !== null && xdiv !== null) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
    			xp.value = '';
    			var ob = JSON.parse(this.responseText);
				var tmp = '';
				ob.forEach(function(element) {
					tmp += element['USR_Login'] + ': ' + element['USR_Masage'] + '\n';
				});
				xdiv.innerHTML = tmp;
    		}
  		};
  		var msg = 'msg=' + xp.value;
  		xhttp.open("POST", "/picv/comment", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(msg);
	}
}

function picReplace(inn) {
	var tmp = document.getElementById(inn);
	var atr = tmp.getAttribute('src');

	tmp.setAttribute('src', "/img/src/mem.png");
	setTimeout(function() {
		tmp.setAttribute('src', atr);
	}, 500);
}

function galleryMain() {
 	var xdiv = document.getElementById('gal_id');
	if (xdiv !== null) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
				 xdiv.innerHTML = this.responseText;
    		}
  		};
  		var tmp = 'ld=13';
  		xhttp.open("POST", "main/ongall", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(tmp);
	}
}

function myGalNext() {
 	var xdiv = document.getElementById('gal_id');
	if (xdiv !== null) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
    			if (this.responseText !== '') {
				 	xdiv.innerHTML = this.responseText;
    			}
    		}
  		};
  		var tmp = 'ld=2';

  		xhttp.open("POST", "main/ongall", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(tmp);
	}
}

function myGalPrev() {
 	var xdiv = document.getElementById('gal_id');
	if (xdiv !== null) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
				 xdiv.innerHTML = this.responseText;
    		}
  		};
  		var tmp = 'ld=-';

  		xhttp.open("POST", "main/ongall", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(tmp);
	}
}

function delMyPic() {
		var xhttp = new XMLHttpRequest();
  		var tmp2 = 'unset=dd';
  		xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
				 window.location.replace("/main");
    		}
  		};
  		xhttp.open("POST", "/picv/mypicdel", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(tmp2);
}

function galleryMain1() {
 	var xdiv = document.getElementById('gal_id');
 	
	if (xdiv !== null) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
				 xdiv.innerHTML = this.responseText;
    		}
  		};

  		var tmp = 'lda=22';
  		xhttp.open("POST", "xmygall/ong", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(tmp);
	}
}

function myGalNext1() {
 	var xdiv = document.getElementById('gal_id');
	if (xdiv !== null) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
    			if (this.responseText !== '') {
				 	xdiv.innerHTML = this.responseText;
    			}
    		}
  		};
  		var tmp = 'lda=2';

  		xhttp.open("POST", "xmygall/ong", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(tmp);
	}
}

function myGalPrev1() {
 	var xdiv = document.getElementById('gal_id');
	if (xdiv !== null) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
				 xdiv.innerHTML = this.responseText;
    		}
  		};
  		var tmp = 'lda=-';

  		xhttp.open("POST", "xmygall/ong", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(tmp);
	}
}

function mySwap() {
	var xhttp = new XMLHttpRequest();
	var xlog = document.getElementById('log_swap').value;
	var xpass = document.getElementById('pass_new').value;
	var xopass = document.getElementById('pass_old').value;
	var xemail = document.getElementById('email_swap').value;
	var xswap = document.getElementById('isset').checked;
  	xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
			var ob = JSON.parse(this.responseText);
    		var flag = 1;
    		console.log( ob );

     		if(ob['log'] != 0)  {
    			if(ob['log'][0] != 0) {
    				document.getElementById('log_check').innerHTML = ob['log'][1];
    				flag += 0;
    			}
			}
			if(ob['passq'] != 0)  {
    			if(ob['passq'][0] != 0) {
    				document.getElementById('old_check').innerHTML = ob['passq'][1];
    				flag += 0;
    			}
			}
			if(ob['email'] != 0)  {
    			if(ob['email'][0] != 0) {
    				document.getElementById('email_check').value = ob['email'][1];
    				flag += 0;
    			}
			}
			if (flag == 0) {
				window.location.replace("/main");
			}
    	}
  	};
  	var tmp = '';
  	if (xlog != '') {
  		tmp += 'log=' + xlog;
  	}
  	if (xpass != '' && xopass != '') {
  		if (tmp != '') {
  			tmp += '&';
  		}
  		tmp += 'npass=' + xpass + '&pass=' + xopass;
  	}
  	if (xemail != '') {
  		if (tmp != '') {
  			tmp += '&';
  		}
  		tmp += 'email=' + xemail;
  	}
  	if (tmp != '') {
  		tmp += '&';
  	}
  	tmp += "notif=" + xswap;
	xhttp.open("POST", "dataswap/swap_info", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(tmp);
}


function myLogin() {
	var xlog = document.getElementById('log_in1').value;
	var xpass = document.getElementById('pass_in1').value;
	var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
    		var rr = this.responseText;
    		if(rr == 1) {
    			window.location.replace("main");
    		} else {
				document.getElementById("fffff").innerHTML = this.responseText;
    		}
    	}
  	};
  	var tmp = "log=" + xlog + "&pass=" + xpass;
	xhttp.open("POST", "reg/login", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(tmp);
}

function logCheck() {
	var ragexp = /^[a-zA-Z0-9]*$/;
	var value = document.getElementById('log_in').value;
	if (!ragexp.test(value)) {
		document.getElementById('log_check').innerHTML = "No whitespace characters or spec-simbols are allowed!";
		return false;
	} else if (value.length < 6) {
		document.getElementById('log_check').innerHTML = "Login is too short, 6 chars or more!";
		return false;
	}
	document.getElementById('log_check').innerHTML = "";
	return true;
}

function passCheck() {
	var ragexp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/;
	var reg2 = /^[a-zA-Z0-9]*$/;
	var value = document.getElementById('pass_in').value;
	if (!reg2.test(value)) {
		document.getElementById('pass_check').innerHTML = "No whitespace characters are allowed!";
				return false;
	} else if (!ragexp.test(value)) {
		document.getElementById('pass_check').innerHTML = "Minimum six characters, at least one uppercase letter, one lowercase letter and one number";
		return false;
	}
	document.getElementById('pass_check').innerHTML = "";
	return true;
}

function emailCheck() {
	var reg  = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var value = document.getElementById('email_in').value;
	if (!reg.test(value)) {
		document.getElementById('email_check').innerHTML = "Invalid mail format";
		return false;
	}
	document.getElementById('email_check').innerHTML = "";
	return true;
}

function loadDoc(log, pass, email) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    	var rr = this.responseText;
    	if(rr == 0) {
    		window.location.replace("main");
    	} else {
			document.getElementById("lllll").innerHTML = this.responseText;
    	}
    }
  };
  var tmp = "log=" + log + "&pass=" + pass + "&email=" + email;
	xhttp.open("POST", "reg/reg_coll", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(tmp);
}