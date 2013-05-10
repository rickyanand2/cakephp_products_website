
<h1> Edit Post </h1>
<?php

echo $this->Form->create('Product');

echo $this->Form->input('PR_NAME');
echo $this->Form->input('CATEGORY');
echo $this->Form->input('PACKAGING');
echo $this->Form->input('QUANTITY');
echo $this->Form->input('PRICE');
echo $this->Form->input('DESCRIPTION', array('rows' => '3'));

echo $this->Form->input('ID', array('type' => 'hidden'));
/*
CakePHP will assume that you are editing a model if the ‘id’ field is present in the data array. If no ‘id’ is present (look back at add view), 
Cake will assume that you are inserting a new model when save() is called.
*/


echo $this->Form->end('Save Post');
?>
 


