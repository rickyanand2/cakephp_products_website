
<?php
/* Basic shell of model class - AppModel extends Model (core php class)
class Product extends AppModel {
}

CakePHP can automatically infer that this model will be used in the ProductsController, and will be tied to a database table called products

Validation rules are defined in the model.



*/
class Product extends AppModel {
/* 
The $validate array tells CakePHP how to validate your data when the save() method is called. 
Since we've used the FormHelper::input() method of the FormHelper to create our form elements, our validation error messages will be shown automatically. 
*/
 public $validate = array(
	'PR_NAME' => array('rule' => 'notEmpty'), 
	'CATEGORY' => array('rule' => 'notEmpty')
	);


}
