<div class="control-group {if $form->has_error()}has-error{/if}">
    <label class="control-label" for="{$field->name}">{lang}{$field->label}{/lang}</label>
    <div class="clearfix"></div>
    <div>
        <div class="fileinput fileinput-{if $smarty.post[$post_helper]|default:""}exists{else}new{/if}" data-provides="fileinput">
            <input type="hidden" name="{$post_helper}" value="{$smarty.post[$post_helper]|default:""}">
            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                <img src="{$smarty.post[$post_helper]|default:"https://upload.wikimedia.org/wikipedia/commons/d/d5/Blank_-_Spacer.png"}">
            </div>
            <div>
                <span class="btn btn-default btn-file">
                    <span class="fileinput-exists">{lang}Change{/lang}</span>
                    <span class="fileinput-new">{lang}Select file{/lang}</span> 
                    <input type="file" name="{$field->name}" accept="{$accept}">
                </span>
                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">{lang}Delete{/lang}</a>
            </div>
        </div>
    </div>
    <span class="help-block">{$form->get_error()}</span>
</div>