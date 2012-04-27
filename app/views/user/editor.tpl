<div>
  <div class="fl" style="margin-right: 10px;min-width:84%">
    <div>Output</div>
    <iframe style="border:1px solid #ccc;width:100%" src="{{$public_path}}/view/{{$smarty.get.file}}" name="test" id="test"  height="280"></iframe>
    <div>Input</div>
    <form  id="code_form" action="" method="post" enctype="application/x-www-form-urlencoded">
      <textarea id="code" name="code">{{$code|trim}}</textarea>
      <div class="Actions">
        <input class="action" id="" type="submit" name="action" value="Run" title="Run">
        <input class="action" id="" type="submit" name="action" value="Download" title="Download">
        {{ if (isset($smarty.session.user.id)) }}
        <input class="action" id="" type="submit" name="action" value="Save" title="Save">
        {{else}}
        <input class="action" id="" type="button" onclick="fb_login()" name="action" value="Save" title="Save">
        {{/if}}
        <input class="action" id="" type="button" onclick="window.location.href = '{{$public_path}}';" name="action" value="New" title="New">
      </div>
    </form>
  </div>
  <div class="fr"><div>Saved Files</div>
  <div style="border: 1px solid #CCC;width:140px;max-height:600px;overflow-y:auto">
{{foreach from=$files item=file}}
    <div><a href="{{$public_path}}/editor/{{$file.filename}}/{{$file.revision}}">{{$file.filename}}</a></div>
{{/foreach}}
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