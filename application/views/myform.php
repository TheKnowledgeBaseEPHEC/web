<?php
print form_open('/submit');
echo validation_errors('');
echo form_label ("Username", "username");
$data = array(
    'name' => 'username',
    'id' => 'username',
    'placeholder' => 'Nom',
    'maxlength' => '100',
    'size' => '50',
    'style' => 'width:50%',
    'class' => 'form-control',
);
echo form_input ($data);
$button = array(
    'name' => 'submit',
    'value' => 'Valider',
    'class' => 'btn btn-default',
);
// print form_input($data);
echo form_submit($button);
echo form_close();