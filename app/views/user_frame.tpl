<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js msie ie6 lte9 lte8 lte7"  xmlns:fb="http://www.facebook.com/2008/fbml"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js msie ie7 lte9 lte8 lte7"  xmlns:fb="http://www.facebook.com/2008/fbml"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js msie ie8 lte9 lte8"  xmlns:fb="http://www.facebook.com/2008/fbml"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js msie ie9 lte9"  xmlns:fb="http://www.facebook.com/2008/fbml"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en" class="no-js" xmlns:fb="http://www.facebook.com/2008/fbml">
<!--<![endif]-->
<head>
<title>PHP Online Editor</title>
<meta charset="utf-8" />
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />


<meta name="keywords" content="PHP, editor, online, execute php online, run php online, test php online, save php files" />
<meta name="Description" content="This is an online editor for PHP, HTML, CSS, JS and a simple collaboration tool. Paste your code below, and we will run it and give you an URL you can use to share it in chat or email. You can login and save to your account to check later" />
<meta property="og:title" content="Awesome tool to execute php code online!" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://dev.riktamtech.com/phponline/public" />
<meta property="og:image" content="http://dev.riktamtech.com/phponline/public/images/logo.jpg" />
<meta property="og:site_name" content="PHP Online" />
<meta property="fb:admins" content="1274834235" />


<link rel="stylesheet" href="{{$public_path}}/css/all.css">
<script src="{{$public_path}}/js/all.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script>!window.jQuery && document.write(unescape('%3Cscript src="{{$public_path}}/js/lib/jquery-latest.min.js"%3E%3C/script%3E'))</script>
<script type="text/javascript">
	var publicPath = '{{$public_path}}';
</script>
</head>
<body>
<div id="wrapper">
  <header>
    <div class="fl">
      <h2><a href="{{$public_path}}">PHP Online editor</a></h2>
    </div>
    {{ if (isset($smarty.session.user.id)) }}
    <div align="center" class="fr"> <a href="#."> <img id="image" src="https://graph.facebook.com/{{$smarty.session.user.fb_id}}/picture?type=square"/> <span id="name">{{$smarty.session.user.name}}</span> </a>
    | <a href="#." onClick="fb_logout()">Logout</a>
    </div>
    {{ else }}
    <div class="fb-login-button fr">Login with Facebook</div>
    {{/if}}
    <hr class="clear" />
  </header>
  
  {{$errors}}
  
  {{if $err_msg== ""}}
  	{{include file=$template_name }}
  {{else}}
  	{{$err_msg}}
  {{/if}} </div>
<footer>
  <div id="fb-root"></div>
  <script>
window.fbAsyncInit = function() {
	FB.init({
		appId      : '{{$CONF.FB_APP_ID}}',
		status     : true, 
		cookie     : true,
		xfbml      : true,
		oauth      : true
	});
	
	FB.getLoginStatus(function (res) {
		if (!res || res.status !== "connected") {
			FB.Event.subscribe('auth.login', function(response) {
				window.location.reload();
			});
		}

		if (res.status === 'connected') {
			// the user is logged in and has authenticated your
			// app, and response.authResponse supplies
			// the user's ID, a valid access token, a signed
			// request, and the time the access token 
			// and signed request each expire
			var uid = res.authResponse.userID;
			var accessToken = res.authResponse.accessToken;
		} else if (res.status === 'not_authorized') {
			// the user is logged in to Facebook, 
			// but has not authenticated your app
		} else {
			// the user isn't logged in to Facebook.
		}
	});
 

	FB.Event.subscribe('auth.logout', function(response) {
	  window.location.href = publicPath + '/logout'
	});
};

function fb_login(){
	 FB.login(function(response) {  // handle the response
	 	window.location.reload();
	 });	
}

function fb_logout(){
	FB.logout(function(response) {
	  window.location.href = publicPath + '/logout'
	});	
}

(function(d){
   var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   d.getElementsByTagName('head')[0].appendChild(js);
 }(document));
</script>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-31225570-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

  <div style="float:right">Developed by <a target="_blank" href="http://venu-t.tumblr.com/">Venu</a> & Powered by <a target="_blank" href="http://riktamtech.com/">Riktam Technology Consulting</a>. © 2011-2012</div>
  <div><a href="https://github.com/venu/Php-Online">Github project page →</a></div>
</footer>
</body>
</html>
