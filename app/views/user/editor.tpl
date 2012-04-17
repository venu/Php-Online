<div>Output</div>
<iframe style="border:1px solid #ccc;width:100%" src="{{$public_path}}/view/{{$smarty.get.file}}" name="test" id="test"  height="380"></iframe>
<div>Input</div>
<form  id="code_form" action="" method="post" enctype="application/x-www-form-urlencoded">	
  <textarea id="code" name="code">{{$code|trim}}</textarea>
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