<?php 
include('includes/header.php');
include('../config/database.php');
include('../functions/myfunctions.php');

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Products</h3>   
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Image</th>
                                <th>Stock</th>
                                <th>Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $products = getAll("products");

                                if(mysqli_num_rows($products) > 0)
                                {
                                    foreach($products as $item)
                                    {
                                        ?>
                                        <tr>
                                            <td> <?= $item['productid']; ?></td>
                                            <td> <?= $item['description']; ?></td>
                                            <td> <?= $item['price']; ?></td>
                                            <td> <?= $item['discount']; ?></td>
                                            <td><img src="uploads/<?= $item['coffeeshop_img'];?>" alt="" width="25px"></td>
                                            <td> <?= $item['stock']; ?></td>
                                            <td> <?= $item['name']; ?></td>
                                            
                                            <td><a href="edit-product.php?<?=$item['productid']; ?>" class ="btn btn-primary">Edit</a>
                                               
                                            </td>
                                            <td>
                                                <form action="includes/code.php" method="GET">
                                                    <button type="submit" class ="btn btn-danger" name="delete_product_btn">Delete</button>
                                                </form>
                                            </td>
                                        </tr> 
                                        <?php              
                                    }
                                }
                            else
                            {
                                echo "<p style='color:red;'>No Products Found!</p>";
                            }
                            
                            ?>




                            
                        </tbody>
                    </table>
                                
                            
                        
                        
                            

                            
                                
                           

                            
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary" name="addproduct_btn">
                            </div>
                        </div>
                </div>
            </div>
        </div>      
    </div>
</div>