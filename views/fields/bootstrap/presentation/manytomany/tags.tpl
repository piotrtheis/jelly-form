<div class="control-group nopadding {if $form->has_error()}has-error{/if}">
    <label class="control-label" for="{$field->name}">{lang}{$field->label}{/lang}</label>
    <div class="controls">
        <input type="text" name="{$field->name}" value="{$value|default:''}" class="tagsinput">
        <span class="help-block">{$form->get_error()}</span>
    </div>
</div>