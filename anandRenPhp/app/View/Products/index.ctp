<!-- File: /app/View/Posts/index.ctp -->

<h1>All Products</h1>
<!-- include a new “Add Post” link -->
<?php
 echo $this->Html->link('Add Post', array('controller' => 'products', 'action' => 'add')); 
?>
<table>
    <tr>
        <th>Id</th>
        <th>Product</th>
		<!-- Edit/Delete -->
		<th>Action </th>
        <th>Created</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info 	
	$product is from the ProductsController.php
	-->

    <?php foreach ($products as $product): ?>
    <tr>
        <td><?php echo $product['Product']['ID']; ?></td>
        <td>
		
		<!--

			$this->Html is an instance of the CakePHP HtmlHelper class. 
			CakePHP comes with a set of view helpers that make things like linking, form output, JavaScript and Ajax a snap. 
			The link() method will generate an HTML link with the given title (the first parameter) and URL (the second parameter).

			When specifying URLs in Cake, it is recommended that you use the array format.  Using the array format for URLs allows you to take advantage of 
			CakePHP's reverse routing capabilities. You can also specify URLs relative to the base of the application in the form of 
			/controller/action/param1/param2.
			
			
		-->
            <?php echo $this->Html->link($product['Product']['PR_NAME'],  array('controller' => 'products', 'action' => 'view', $product['Product']['ID']) ); 
			?>
        </td>
		
		<!-- 
			
			Add the Edit Link
			Add the Delete Link	
		-->
		
		<td>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $product['Product']['ID'])); ?>
		<!-- 
			Using postLink() will create a link that uses Javascript to do a POST request deleting our post. Allowing content to be deleted using GET 
			requests is dangerous, as web crawlers could accidentally delete all your content. 
			This view code also uses the FormHelper to prompt the user with a JavaScript confirmation dialog before they attempt to delete a post.
		-->	
			<?php echo $this->Form->postLink('Delete',array('action' => 'delete', $product['Product']['ID']), array('confirm' => 'Are you sure?'));  ?>
        </td>
        
		<td><?php echo $product['Product']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($product); ?>
</table>