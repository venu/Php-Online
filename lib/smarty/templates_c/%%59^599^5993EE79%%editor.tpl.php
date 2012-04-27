<?php /* Smarty version 2.6.14, created on 2012-04-27 14:06:57
         compiled from user/editor.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'user/editor.tpl', 7, false),)), $this); ?>
<div>
  <div class="fl" style="margin-right: 10px;min-width:84%">
    <div>Output</div>
    <iframe style="border:1px solid #ccc;width:100%" src="<?php echo $this->_tpl_vars['public_path']; ?>
/view/<?php echo $_GET['file']; ?>
" name="test" id="test"  height="280"></iframe>
    <div>Input</div>
    <form  id="code_form" action="" method="post" enctype="application/x-www-form-urlencoded">
      <textarea id="code" name="code"><?php echo ((is_array($_tmp=$this->_tpl_vars['code'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
</textarea>
      <div class="Actions">
        <input class="action" id="" type="submit" name="action" value="Run" title="Run">
        <input class="action" id="" type="submit" name="action" value="Download" title="Download">
        <?php if (( isset ( $_SESSION['user']['id'] ) )): ?>
        <input class="action" id="" type="submit" name="action" value="Save" title="Save">
        <?php else: ?>
        <input class="action" id="" type="button" onclick="fb_login()" name="action" value="Save" title="Save">
        <?php endif; ?>
        <input class="action" id="" type="button" onclick="window.location.href = '<?php echo $this->_tpl_vars['public_path']; ?>
';" name="action" value="New" title="New">
      </div>
    </form>
  </div>
  <div class="fr"><div>Saved Files</div>
  <div style="border: 1px solid #CCC;width:140px;max-height:600px;overflow-y:auto">
<?php $_from = $this->_tpl_vars['files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['file']):
?>
    <div><a href="<?php echo $this->_tpl_vars['public_path']; ?>
/editor/<?php echo $this->_tpl_vars['file']['filename']; ?>
/<?php echo $this->_tpl_vars['file']['revision']; ?>
"><?php echo $this->_tpl_vars['file']['filename']; ?>
</a></div>
<?php endforeach; endif; unset($_from); ?>
</div></div>
  <br class="clear"/>
</div>
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