<?php /* Smarty version 2.6.14, created on 2011-11-26 11:59:45
         compiled from aj_frame.tpl */ ?>
<?php if ($this->_tpl_vars['err_msg'] == ""): ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['template_name'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
    <?php echo $this->_tpl_vars['err_msg']; ?>

<?php endif; ?>	