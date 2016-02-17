Jelly form based on model fields


**Requirements**


* `3.2/develop` and `3.2/master` branches: Kohana 3.2+ (https://github.com/kohana/core)
* `Jelly` branches: Kohana 3.2+(https://github.com/creatoro/jelly)
* `Smarty` branches: Kohana 3.2+(https://github.com/MrAnchovy/Kohana_Smarty3)


USAGE
========

**Model**:

* In initialize method


```$meta->form = (new Jelly_Form($meta))->fields(array('name', 'time', 'date', 'file', 'icon', 'text', 'enum', 'country'));```


**Controller**:

```$this->template->content = View::factory('core/backend/empty/add.tpl')
                ->bind('errors', $errors)
                ->bind('form', $form);



        $form = $this->_mod_model->meta()->form->set_view($this->template->content);```



**View**

* Base usege

```{foreach $form->fields() as $key => $field}
        {$field->get_label()}
        {$field->get_field()}
        {$field->get_error()}
    {/foreach}
```


* Bootstrap decorator

```{foreach $form->fields() as $key => $field}
        {$field->bootstrap_form_group()}
    {/foreach}```

