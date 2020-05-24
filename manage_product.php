<?php
require('top.inc.php');
$categories_id='';
$name='';
$mrp='';
$price='';
$qty='';
$short_desc='';
$description='';
$meta_title='';
$meta_description='';
$meta_keyword='';

$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){	
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from product where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
	      $row=mysqli_fetch_assoc($res);
	      $categories=$row['categories'];
	} else {
		header('location:product.php');
		die();
	}	
}

if(isset($_POST['submit'])){
	$categories=get_safe_value($con,$_POST['categories']);
	
	$res=mysqli_query($con,"select * from product where name='$categories'");
	$check=mysqli_num_rows($res);
	if($check>0) {
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
				
			} else {
				$msg="Categories already exist";
			} 		
		
	} else {
		$msg="Categories already exist";
	}	
}	
if($msg==''){		
	if(isset($_GET['id']) && $_GET['id']!=''){
	mysqli_query($con,"update categories set categories='$categories' where id='$id'");
} else {
	mysqli_query($con,"insert into categories(categories,status) values('$categories','1')");
	
}
	header('location:categories.php');
    die();
	}
}

?> 
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Product</strong><small> Form</small></div>
                        <form method="post">
						<div class="card-body card-block">
                           <div class="form-group">
						   <label for="categories" class="form-control-label">Categories</label>
						   <select class="form-control" name="categories_id">
						   <option>Select Category</option>
						   <?php
						   $res=mysqli_query($con,"select id,categories from categories order by categories asc");
						   while($row=mysqli_fetch_assoc($res)){
							   echo "<option value=".$row['id'].">".$row['categories']."</option>";
						   }
						   ?>
						   </select>
						   </div>
						   
						   <div class="form-group">
						   <label for="categories" class="form-control-label">Product Name</label>
						   <input type="text" name="name" placeholder="Enter product name" class="form-control" required value="<?php echo $name?>">
						   </div>
						   
						   <div class="form-group">
						   <label for="categories" class="form-control-label">MRP</label>
						   <input type="text" name="mrp" placeholder="Enter product mrp" class="form-control" required value="<?php echo $mrp?>">
						   </div>
						   
						   <div class="form-group">
						   <label for="categories" class="form-control-label">Price</label>
						   <input type="text" name="price" placeholder="Enter product price" class="form-control" required value="<?php echo $price?>">
						   </div>
						   
						   <div class="form-group">
						   <label for="categories" class="form-control-label">Qty</label>
						   <input type="text" name="qty" placeholder="Enter qty" class="form-control" required value="<?php echo $qty?>">
						   </div>
						   
						   <div class="form-group">
						   <label for="categories" class="form-control-label">Image</label>
						   <input type="file" name="image" class="form-control" required>
						   </div>
						   
						   <div class="form-group">
						   <label for="categories" class="form-control-label">Short Description</label>
						   <textarea name="short_desc" placeholder="Enter product short description" class="form-control" required><?php echo $short_desc?></textarea>
						   </div>
						   
						   <div class="form-group">
						   <label for="categories" class="form-control-label">Description</label>
						   <textarea name="description" placeholder="Enter product description" class="form-control" required><?php echo $description?></textarea>
						   </div>
						   
						   <div class="form-group">
						   <label for="categories" class="form-control-label">Meta Title</label>
						   <textarea name="meta_title" placeholder="Enter product meta title" class="form-control" ><?php echo $meta_title?></textarea>
						   </div>
						   
						   <div class="form-group">
						   <label for="categories" class="form-control-label">Meta Description</label>
						   <textarea name="meta_description" placeholder="Enter product meta description" class="form-control"><?php echo $meta_description?></textarea>
						   </div>
						   
						   <div class="form-group">
						   <label for="categories" class="form-control-label">Meta Keyword</label>
						   <textarea name="meta_keyword" placeholder="Enter product meta keyword" class="form-control" required><?php echo $meta_keyword?></textarea>
						   </div>
						   
						   
						   
						   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                           <span id="payment-button-amount">Submit</span>
                           </button>
						   <div class="field_error"><?php echo $msg?></div>
                        </div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         

<?php
require('footer.inc.php');
?>