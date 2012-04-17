{{if $err_msg== ""}}
    {{include file=$template_name }}
{{else}}
    {{$err_msg}}
{{/if}}	