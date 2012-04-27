<?php /* Smarty version 2.6.14, created on 2012-04-27 13:36:55
         compiled from user/home.tpl */ ?>
<div>
  <div class="fl" style="width:85%;">
      <div>This is an online editor for PHP, HTML, CSS, JS and a simple collaboration tool.
    Paste your code below, and we will run it and give you an URL you can use to share it in chat or email.</div>
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
   </div>
   <?php if ($this->_tpl_vars['files']): ?>
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
</div>
  </div>
  <?php endif; ?>
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