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

<link rel="stylesheet" href="{{$public_path}}js/lib/CodeMirror/codemirror.css">
<script src="{{$public_path}}js/lib/CodeMirror/codemirror.js"></script>
<script src="{{$public_path}}js/lib/CodeMirror/mode/xml/xml.js"></script>
<script src="{{$public_path}}js/lib/CodeMirror/mode/javascript/javascript.js"></script>
<script src="{{$public_path}}js/lib/CodeMirror/mode/css/css.js"></script>
<script src="{{$public_path}}js/lib/CodeMirror/mode/clike/clike.js"></script>
<script src="{{$public_path}}js/lib/CodeMirror/mode/php/php.js"></script>
<link rel="stylesheet" href="{{$public_path}}js/lib/CodeMirror/theme/default.css">
<style type="text/css">
.CodeMirror { border: 1px solid #cccccc;}
.activeline { background-color: #F0F0FF !important; }
body, .CodeMirror{font-family:calibri, arial;}
</style>
<link rel="stylesheet" href="{{$public_path}}js/lib/CodeMirror/css/docs.css">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script> 
<script>!window.jQuery && document.write(unescape('%3Cscript src="{{$public_path}}/js/lib/jquery-latest.min.js"%3E%3C/script%3E'))</script> 
<script type="text/javascript">
	var publicPath = '{{$public_path}}';
</script>
</head>
<body>
<h2><a href="{{$public_path}}">PHP Online editor</a></h2>
<hr>

{{if $err_msg== ""}}
    {{include file=$template_name }}
{{else}}
    {{$err_msg}}
{{/if}} 

<footer>
<div>Devloped by <a target="_blank" href="http://venu-t.tumblr.com/">Venu</a> & Powered by <a target="_blank" href="http://riktamtech.com/">Riktam Technologies Consulting</a>. © 2011-2012</div>
</footer>
</body>
</html>
