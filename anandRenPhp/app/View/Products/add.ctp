<h1> Add Post </h1>
<!--  
 To take advantage of the validation features, you'll need to use Cake's FormHelper in your views. The FormHelper is available by default to all views at 
 $this->Form.
-->

 
<?php
/*

  FormHelper generate the opening tag for an HTML form:
  $this->Form->create() generates: <form id="ProductAddForm" method="post" action="/posts/add"> 
  
  
 If create() is called with no parameters supplied, it assumes you are building a form that submits to the current controller's add() action 
 (or edit() action when id is included in the form data), via POST. 
  
  */
echo $this->Form->create('Product');

/*

  The $this->Form->input() method is used to create form elements of the same name. 
 The first parameter tells CakePHP which field they correspond to, and the second parameter allows you to specify a wide array of options - 
 in this case, the number of rows for the textarea. There's a bit of introspection and automagic here: input() will output different form elements 
 based on the model field specified.
 
 */
echo $this->Form->input('PR_NAME');
echo $this->Form->input('CATEGORY');
echo $this->Form->input('PACKAGING');
echo $this->Form->input('QUANTITY');
echo $this->Form->input('PRICE');
echo $this->Form->input('DESCRIPTION', array('rows' => '3'));

/*

The $this->Form->end() call generates a submit button and ends the form. If a string is supplied as the first parameter to end(), the FormHelper outputs 
 a submit button named accordingly along with the closing form tag. Again, refer to Helpers for more on helpers. Now let's go back and update our 
 /app/View/Posts/index.ctp view to include a new “Add Post” link. Before the <table>, add the following line:
<h1>Add Post</h1>

*/

echo $this->Form->end('Save Post');
?>
 


