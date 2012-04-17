<?php /* Smarty version 2.6.14, created on 2011-11-26 05:56:40
         compiled from user_frame.tpl */ ?>
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

<link rel="stylesheet" href="<?php echo $this->_tpl_vars['public_path']; ?>
js/lib/CodeMirror/codemirror.css">
<script src="<?php echo $this->_tpl_vars['public_path']; ?>
js/lib/CodeMirror/codemirror.js"></script>
<script src="<?php echo $this->_tpl_vars['public_path']; ?>
js/lib/CodeMirror/mode/xml/xml.js"></script>
<script src="<?php echo $this->_tpl_vars['public_path']; ?>
js/lib/CodeMirror/mode/javascript/javascript.js"></script>
<script src="<?php echo $this->_tpl_vars['public_path']; ?>
js/lib/CodeMirror/mode/css/css.js"></script>
<script src="<?php echo $this->_tpl_vars['public_path']; ?>
js/lib/CodeMirror/mode/clike/clike.js"></script>
<script src="<?php echo $this->_tpl_vars['public_path']; ?>
js/lib/CodeMirror/mode/php/php.js"></script>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['public_path']; ?>
js/lib/CodeMirror/theme/default.css">
<style type="text/css">
.CodeMirror { border: 1px solid #cccccc;}
.activeline { background-color: #F0F0FF !important; }
body, .CodeMirror{font-family:calibri, arial;}
</style>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['public_path']; ?>
js/lib/CodeMirror/css/docs.css">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script> 
<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo $this->_tpl_vars['public_path']; ?>
/js/lib/jquery-latest.min.js"%3E%3C/script%3E'))</script> 
<script type="text/javascript">
	var publicPath = '<?php echo $this->_tpl_vars['public_path']; ?>
';
</script>
</head>
<body>
<h2><a href="<?php echo $this->_tpl_vars['public_path']; ?>
">PHP Online editor</a></h2>
<hr>

<?php if ($this->_tpl_vars['err_msg'] == ""): ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['template_name'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
    <?php echo $this->_tpl_vars['err_msg']; ?>

<?php endif; ?> 


</body>
</html>