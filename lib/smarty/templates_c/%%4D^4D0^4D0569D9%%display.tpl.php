<?php /* Smarty version 2.6.14, created on 2012-04-18 08:01:59
         compiled from user/display.tpl */ ?>
<iframe src="<?php echo $this->_tpl_vars['public_path']; ?>
/view/<?php echo $_GET['file']; ?>
" name="test" id="test" width="960" height="380"></iframe>
<form  id="code_form" action="" method="post" enctype="application/x-www-form-urlencoded">	
  <textarea id="code" name="code">
<?php echo '<?php'; ?>

function hello($who) {
	return "Hello " . $who;
}
<?php echo '?>'; ?>

<p>The program says <?php echo '<?='; ?>
 hello("World") <?php echo '?>'; ?>
.</p>
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