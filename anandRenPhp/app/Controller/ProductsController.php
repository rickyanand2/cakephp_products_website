<?php
/*
All the business logic resides here

Basic:

class ProductsController extends AppController {
    public $helpers = array('Html', 'Form');
}

*/

class ProductsController extends AppController {
    
	public $helpers = array('Html', 'Form', 'Session');
	public $components =  array('Session');
	//Including the session component and session helper to add posts
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
		
	/*
	Actions often represent a single function or interface in an application. For example, when users request www.example.com/Products/index
	By defining function index() in our ProductsController, users can now access the logic there by requesting www.example.com/Products/index.
	
	The single instruction in the action uses set() to pass data from the controller to the view.
	The line sets the view variable called 'products' equal to the return value of the find('all') method of the Product model. 
	Our Product model is automatically available at $this->Product because we've followed Cake's naming conventions.

	set('products' <1st argument is the variable>, $this->Product <This is taken from Post model which has the Products table avaialble to it> ->find('all') <gets all results>

	*/
	
	public function index() {
		$this->set('products', $this->Product->find('all'));
    }	
	
	/* EXAMPLE OF WHAT GETS PASSED TO THE VIEW 


	// print_r($products) output:

	Array
	(
		[0] => Array
			(
				[Product] => Array
					(
						[ID] => 1
						[CATEGORY] => Body Product
						[PACKAGING] => 70ml
						[PR_NAME] => Body lotion
						[DESCRIPTION] => good for body
						[QUANTITY] => 10
						[PRICE] => 50
						[CREATED] => now()
						[MODIFIED] => null
					)
			)
	
		[1] => Array
			(
				[Product] => Array
					(
					(
						[ID] => 2
						[CATEGORY] => Hair Product
						[PACKAGING] => 70ml
						[PR_NAME] => Body lotion
						[DESCRIPTION] => good for body
						[QUANTITY] => 10
						[PRICE] => 50
						[CREATED] => now()
						[MODIFIED] => null
					)                )
			)
	
	)
	
	*/
	
	/*
	
	
	The set() call should look familiar. Notice we're using findById() rather than find('all') because we only really want a single post's information.
	Notice that our view action takes a parameter: the ID of the post we'd like to see. This parameter is handed to the action through the requested URL. 
	If a user requests /posts/view/3, then the value ‘3' is passed as $id.
	
	We also do a bit of error checking to ensure a user is actually accessing a record. If a user requests /posts/view, we will throw a NotFoundException 
	and let the CakePHP ErrorHandler take over. We also perform a similar check to make sure the user has accessed a record that exists.
	
	*/

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Product'));
        }

        $product = $this->Product->findById($id);
        
		if (!$product) {
            throw new NotFoundException(__('Invalid Product'));
        }
        
		$this->set('product', $product);
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	/* Function to Add Products
	
	Every CakePHP request includes a CakeRequest object which is accessible using $this->request. The request object contains useful information regarding 
	the request that was just received, and can be used to control the flow of your application. In this case, we use the CakeRequest::is() method to check that 
	the request is a HTTP POST request. When a user uses a form to POST data to your application, that information is available in $this->request->data. You can 
	use the pr() or debug() functions to print it out if you want to see what it looks like.

	*/

	public function add() {
	/* If the HTTP method of the request was POST, try to save the data using the Post model. If for some reason it doesn't save, just render the view. */	
	if ($this->request->is('post')) {
		$this->Product->create();

		
		/* Calling the save() method will check for validation errors and abort the save if any occur. */		
		if ($this->Product->save($this->request->data)) {
		
			/* We use the SessionComponent's SessionComponent::setFlash() method to set a message to a session variable to be displayed on the page after 
			redirection. In the layout we have SessionHelper::flash which displays the message and clears the corresponding session variable. */
			$this->Session->setFlash('Your post has been saved.');
			
			/* The controller's Controller::redirect function redirects to another URL. The param array('action' => 'index') translates to 
			 URL /posts i.e the index action of posts controller. 
				
			Refer to Router::url() function on the API (http://api20.cakephp.org) to see the formats in which you can specify a URL for various Cake functions. */
			$this->redirect(array('action' => 'index'));
		} 
		else {
			$this->Session->setFlash('Unable to add your post.');
		}
	}
	}	


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/*
	Edit action to edit products
	*/

	public function edit($id = null) {

	/* 
	Ensures that the user has tried to access an existing record. If they haven’t passed in a passed in an $id parameter, or the post does not exist, 
	we throw a NotFoundException for the CakePHP ErrorHandler to take care of.    
	*/
	if (!$id) {
			throw new NotFoundException(__('Invalid product'));
		}

		$product = $this->Product->findById($id);
		
		if (!$product) {
			throw new NotFoundException(__('Invalid product'));
		}

		/*
		Next the action checks that the request is a POST request. If it is, then we use the POST data to update our Post record, or kick back and show 
		the user validation errors. If there is no data set to $this->request->data, we simply set it to the previously retrieved post.
		*/
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Product->id = $id;
			
			if ($this->Product->save($this->request->data)) {
					$this->Session->setFlash('Your Product has been updated.');
					$this->redirect(array('action' => 'index'));
			} 
			
			else {
					$this->Session->setFlash('Unable to update your product.');
			}
		}

		if (!$this->request->data) {
			$this->request->data = $product;
		}
	}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/*
	Delete products 
	
	This logic deletes the post specified by $id, and uses $this->Session->setFlash() to show the user a confirmation message after redirecting them on 
	to /products. If the user attempts to do a delete using a GET request, we throw an Exception. Uncaught exceptions are captured by CakePHP’s exception 
	handler, and a nice error page is displayed. There are many built-in Exceptions that can be used to indicate the various HTTP errors your application 
	might need to generate. Because we’re just executing some logic and redirecting, this action has no view.
	
	*/
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Product->delete($id)) {
			$this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
			$this->redirect(array('action' => 'index'));
		}
	}
	
	
	
}

