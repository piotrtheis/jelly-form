<div class="control-group {if $form->has_error()}has-error{/if}">
    <label class="control-label" for="{$field->name}">{lang}{$field->label}{/lang}</label>
    <div class="clearfix"></div>
    <div>
        <div class="fileinput fileinput-{if $smarty.post[$post_helper]|default:""}exists{else}new{/if} input-group" data-provides="fileinput">
            <input type="hidden" name="{$post_helper}" value="{$smarty.post[$post_helper]|default:""}">
            {*<span class="btn btn-default btn-file">
            <span class="fileinput-new">{lang}Select file{/lang}</span>
            <span class="fileinput-exists">{lang}Change{/lang}</span>
            <input type="file" name="{$field->name}" accept="{$accept}">
            <span class="fileinput-filename"></span>
            <a href="#" class="close fileinput-{if $smarty.post[$post_helper]|default:""}exists{else}new{/if}" data-dismiss="fileinput" style="float: none">&times;</a>*}

            <div class="form-control" data-trigger="fileinput">
                <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                <span class="fileinput-filename">
                    {*TODO replace field path*}
                    {$smarty.post[$post_helper]|replace:$path:''|default:""}
                </span>
            </div>
            <span class="input-group-addon btn btn-default btn-file">
                <span class="fileinput-new">{lang}Select file{/lang}</span>
                <span class="fileinput-exists">{lang}Change{/lang}</span>
                <input type="file" name="{$field->name}" accept="{$accept}">
            </span>
            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">{lang}Remove{/lang}</a>
        </div>
    </div>
    <span class="help-block">{$form->get_error()}</span>
</div>
