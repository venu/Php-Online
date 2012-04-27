<!doctype html>
<html>
<head>
<title>PHP Online</title>
<link rel="stylesheet" href="CodeMirror/lib/codemirror.css">
<script type="application/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="CodeMirror/lib/codemirror.js"></script>
<script src="CodeMirror/mode/xml/xml.js"></script>
<script src="CodeMirror/mode/javascript/javascript.js"></script>
<script src="CodeMirror/mode/css/css.js"></script>
<script src="CodeMirror/mode/clike/clike.js"></script>
<script src="CodeMirror/mode/php/php.js"></script>
<link rel="stylesheet" href="CodeMirror/theme/default.css">
<style type="text/css">
.CodeMirror { border: 1px solid #cccccc;}
.activeline { background-color: #F0F0FF !important; }
</style>
<link rel="stylesheet" href="CodeMirror/css/docs.css">
</head>
<body>
	
<form  id="code_form" action="" method="post" enctype="application/x-www-form-urlencoded">	
  <textarea id="code" name="code">
<?php
function hello($who) {
	return "Hello " . $who;
}
?>
<p>The program says <?= hello("World") ?>.</p>
<script>
	alert("And here is some JS code"); // also colored
</script>
</textarea>
<div class="Actions">
	<input class="action" id="" type="submit" name="run" value="Run" title="Run">
</div>
</form>
<script>
jQuery(function() {
	var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
		mode: "application/x-httpd-php",
		lineNumbers: true,
		tabMode: "classic",
		indentUnit: 8,
		indentWithTabs: true,
		electricChars: false,
		enterMode: "keep",//"shift",
		matchBrackets: true,
		onCursorActivity: function() {
		editor.setLineClass(hlLine, null);
			hlLine = editor.setLineClass(editor.getCursor().line, "activeline");
		}
	});
	var hlLine = editor.setLineClass(0, "activeline");
});
</script>
</body>
</html>
