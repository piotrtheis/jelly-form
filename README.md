Jelly form based on model fields


**Requirements**


* `3.2/develop` and `3.2/master` branches: Kohana 3.2+



USAGE
========

**Model**:

* In initialize method


```$meta->form = (new Jelly_Form($meta))->fields(array('name', 'time', 'date', 'file', 'icon', 'text', 'enum', 'country'));```


**Controller**: