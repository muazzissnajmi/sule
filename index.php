<?php
//error_reporting(E_ALL);
session_start();

//cek login
// if(isset($_COOKIE['submit']))
// {
//   if ($_COOKIE['submit'] == $_SESSION['username'])
//   {
//       //jika valid, set session login
//       $_SESSION['submit'] = TRUE;
 
//       header('location: panel/');
//       exit();
//   }
// }



function xss_filter($val) {
$val = htmlentities($val);
$val = strip_tags($val);
$val = filter_var($val, FILTER_SANITIZE_STRING);
return $val;
}
?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SULE -  Sistem Unit Layanan Elektronik</title>
	<link href="img/logo_.png" rel='shortcut icon'>
	<link href="css_/bootstrap.min.css" rel="stylesheet">
	<link href="css_/datepicker3.css" rel="stylesheet">
	<link href="css_/styles.css" rel="stylesheet">
	<link href="css_/bootstrap.min.css" rel="stylesheet">
	<link href="css_/font-awesome.min.css" rel="stylesheet">
	<link href="css_/datepicker3.css" rel="stylesheet">
	<link href="css_/styles.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	<!-- LOADING PAGE -->
	<script src="js/preload/jquery-2.2.1.min.js"></script>
	<style type="text/css">
	.preloader {
	  position: fixed;
	  top: 0;
	  left: 0;
	  width: 100%;
	  height: 100%;
	  z-index: 9999;
	  background-color: #fff;
	}
	.preloader .loading {
	  position: absolute;
	  left: 50%;
	  top: 50%;
	  transform: translate(-50%,-50%);
	  font: 14px arial;
	}
	
	</style>

	<script>
	$(document).ready(function(){
	$(".preloader").fadeIn().delay(500).fadeOut(); /* .fadeIn(1000).delay(1000).fadeOut() time 1000=1dtk*/
	})
	</script>
	<!-- END LOADING PAGE -->

</head>
<body>
	<div class="preloader">
  		<div class="loading">
    		<img src="img/loading.gif" width="80">
    		
  		</div>
	</div>
<br><br><br>
	<div class="">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">			
			<div class="login-panel panel panel-default">	
			<center><a href="index.php"><img src="img/logo_login.png" width="90%"></a></center>			
				
				<div class="panel-body">
					<form role="form" method="post" name="submit" action="aunt.php">
						<fieldset>
							
							<?php
                            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
                            
                            if ($msg == 1) {
                            ?>
                            <div class="alert bg-danger" role="alert">Silahkan Login Yang Benar !!</div>
                            <?php } else if ($msg == 2) {?>
                            <div class="alert bg-info" role="alert"><center>Username / Password Salah !!</center></div>						
                            <?php } else if ($msg == 3) {?>
                            <div class="alert bg-danger" role="alert"><center>Akun Anda Sudah Di NonAktifkan<br>Silahkan Hubungi Pihak Terkait</center></div>						
                            <?php } 
                            ?>

							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="text" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="" required>
								<input type="checkbox" name="remember" value="TRUE" checked  hidden />
							</div>
							<div class="form-group">
								<center>
								<input type="submit" name="submit" class="btn btn-primary" value="Login">
								<a href="index.php" class="btn btn-danger">Cancel</a>
								</center>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
			<center><font color="grey" >SULE Versi 2.3 &copy; 2023 <a href="https://bireuenkab.go.id/" target="_blank">Pemerintahan Kabupaten Bireuen</a></center>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
<script type='text/javascript'>

shortcut={all_shortcuts:{},add:function(a,b,c){var d={type:"keydown",propagate:!1,disable_in_input:!1,target:document,keycode:!1};if(c)for(var e in d)"undefined"==typeof c[e]&&(c[e]=d[e]);else c=d;d=c.target,"string"==typeof c.target&&(d=document.getElementById(c.target)),a=a.toLowerCase(),e=function(d){d=d||window.event;if(c.disable_in_input){var e;d.target?e=d.target:d.srcElement&&(e=d.srcElement),3==e.nodeType&&(e=e.parentNode);if("INPUT"==e.tagName||"TEXTAREA"==e.tagName)return}d.keyCode?code=d.keyCode:d.which&&(code=d.which),e=String.fromCharCode(code).toLowerCase(),188==code&&(e=","),190==code&&(e=".");var f=a.split("+"),g=0,h={"`":"~",1:"!",2:"@",3:"#",4:"$",5:"%",6:"^",7:"&",8:"*",9:"(",0:")","-":"_","=":"+",";":":","'":'"',",":"<",".":">","/":"?","\\":"|"},i={esc:27,escape:27,tab:9,space:32,"return":13,enter:13,backspace:8,scrolllock:145,scroll_lock:145,scroll:145,capslock:20,caps_lock:20,caps:20,numlock:144,num_lock:144,num:144,pause:19,"break":19,insert:45,home:36,"delete":46,end:35,pageup:33,page_up:33,pu:33,pagedown:34,page_down:34,pd:34,left:37,up:38,right:39,down:40,f1:112,f2:113,f3:114,f4:115,f5:116,f6:117,f7:118,f8:119,f9:120,f10:121,f11:122,f12:123},j=!1,l=!1,m=!1,n=!1,o=!1,p=!1,q=!1,r=!1;d.ctrlKey&&(n=!0),d.shiftKey&&(l=!0),d.altKey&&(p=!0),d.metaKey&&(r=!0);for(var s=0;k=f[s],s<f.length;s++)"ctrl"==k||"control"==k?(g++,m=!0):"shift"==k?(g++,j=!0):"alt"==k?(g++,o=!0):"meta"==k?(g++,q=!0):1<k.length?i[k]==code&&g++:c.keycode?c.keycode==code&&g++:e==k?g++:h[e]&&d.shiftKey&&(e=h[e],e==k&&g++);if(g==f.length&&n==m&&l==j&&p==o&&r==q&&(b(d),!c.propagate))return d.cancelBubble=!0,d.returnValue=!1,d.stopPropagation&&(d.stopPropagation(),d.preventDefault()),!1},this.all_shortcuts[a]={callback:e,target:d,event:c.type},d.addEventListener?d.addEventListener(c.type,e,!1):d.attachEvent?d.attachEvent("on"+c.type,e):d["on"+c.type]=e},remove:function(a){var a=a.toLowerCase(),b=this.all_shortcuts[a];delete this.all_shortcuts[a];if(b){var a=b.event,c=b.target,b=b.callback;c.detachEvent?c.detachEvent("on"+a,b):c.removeEventListener?c.removeEventListener(a,b,!1):c["on"+a]=!1}}},shortcut.add("Ctrl+U",function(){top.location.href="index.php"});

</script>
</html>
