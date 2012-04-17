<?php /* Smarty version 2.6.14, created on 2012-04-16 05:01:16
         compiled from user/editor.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'user/editor.tpl', 5, false),)), $this); ?>
<div>Output</div>
<iframe style="border:1px solid #ccc;width:100%" src="<?php echo $this->_tpl_vars['public_path']; ?>
/view/<?php echo $_GET['file']; ?>
" name="test" id="test"  height="380"></iframe>
<div>Input</div>
<form  id="code_form" action="" method="post" enctype="application/x-www-form-urlencoded">	
  <textarea id="code" name="code"><?php echo ((is_array($_tmp=$this->_tpl_vars['code'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
</textarea>
<div class="Actions">
	<input class="action" id="" type="submit" name="action" value="Run" title="Run">
    <input class="action" id="" type="submit" name="action" value="Download" title="Download">
    <input class="action" id="" type="submit" onclick="return confirm('Are you sure?')" name="action" value="Delete" title="Delete">
    <input class="action" id="" type="button" onclick="alert('comming soon!')" name="action" value="Save" title="Save">
    
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