<div>This is an online editor for PHP, HTML, CSS, JS and a simple collaboration tool.
Paste your code below, and we will run it and give you an URL you can use to share it in chat or email.</div>
<form  id="code_form" action="" method="post" enctype="application/x-www-form-urlencoded">	
  <textarea id="code" name="code">
<?php
function hello($who) {
	return "Hello " . $who;
}
?>
<p>The program says <?= hello("World") ?>.</p>
<script>
	alert("And here is some JS code");
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