<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('includes/header.php');
include('../config/database.php');
include('../functions/myfunctions.php');


?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php 
                if(isset($_GET["productid"]))
                {
                    $id = $_GET["productid"];

               
                    $product = getByID("products", "productid");
                    if(mysqli_num_rows($product)>0)
                    {
                       $data = mysqli_fetch_array($product);
                       
                       ?>
                        <div class="card">
                    <div class="card-header">
                        <h3>Edit Product</h3>   
                    </div>
                    <div class="card-body">
                        <form action="includes/code.php" method="POST" enctype="multipart/form-data"> 
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Description</label>
                                    <textarea row="3" name="description" value="<?=$data['description']; ?>" placeholder="Enter Product description" class="form-control" required></textarea>
                                </div>
                                    
                                <div class="col-md-6">
                                    <label for="">Price</label>
                                    <input type="text" name="price" value="<?=$data['price']; ?>" class="form-control" required>
                                </div>
                            
                            
                                <div class="col-md-6">
                                    <label for="">Discount</label>
                                    <input type="text" name="discount" value="<?=$data['discount']; ?>" class="form-control" required>
                                </div>
    
                                <div class="col-md-12">
                                    <label for="">Upload Image</label>
                                    <input type="file" name="image" value="<?=$data['image']; ?>" class="form-control" required>
                                </div>
                                    
                                <div class="col-md-6">
                                    <label for="">Stock</label>
                                    <input type="text" name="stock" value="<?=$data['stock']; ?>" class="form-control" required>
                                </div>
    
                                <div class="col-md-6">
                                    <label for="">Name</label>
                                    <input type="text" name="name" value="<?=$data['name']; ?>" class="form-control" required>
                                    </br>
                                </div>
                                
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" name="update_product_btn">Update</button>
                                </div>
                               
                        </div>
                    </div>
                </div>
                <?php    
                    }
                    else
                    {
                        echo "Product not found";
                    }
        }
            
            else
            {
                echo "ID missing from url";
            }
            ?>
        </div>      
    </div>
</div>
<?php
include('includes/footer.php');
?>