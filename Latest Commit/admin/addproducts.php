<?php 
include('includes/header.php');
//include();

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add New Product</h3>   
                </div>
                <div class="card-body">
                    <form action="includes/code.php" method="POST" enctype="multipart/form-data"> 
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Description</label>
                                <textarea row="3" name="description" placeholder="Enter Product description" class="form-control" required></textarea>
                            </div>
                                
                            <div class="col-md-6">
                                <label for="">Price</label>
                                <input type="text" name="price" class="form-control" required>
                            </div>
                        
                        
                            <div class="col-md-6">
                                <label for="">Discount</label>
                                <input type="text" name="discount" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label for="">Upload Image</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>
                                
                            <div class="col-md-6">
                                <label for="">Stock</label>
                                <input type="text" name="stock" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" required>
                                </br>
                            </div>
                            
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary" name="addproduct_btn">
                            </div>
                           
                    </div>
                </div>
            </div>
        </div>      
    </div>
</div>