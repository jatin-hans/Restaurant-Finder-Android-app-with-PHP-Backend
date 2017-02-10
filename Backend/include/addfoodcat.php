<div class="page animsition">
    <div class="page-header">
        <h1 class="page-title">Add New Dish</h1>
        <ol class="breadcrumb">
            <li><a href="master.php">Home</a></li>
            <li class="active">Add Dish</li>
        </ol>
    </div>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!-- Panel Filtering -->
                <div class="panel">
                    <div class="panel-body">
                        <table class="table table-bordered table-hover toggle-circle" id="exampleFootableFiltering">
                            <thead>
                            <tr>
                                <th style="pointer-events: none;">Image</th>
                                <th style="pointer-events: none;">Dish Name</th>
                                <th style="pointer-events: none;">Price</th>
                                  <th style="pointer-events: none;">Action</th>
                            </tr>
                            </thead>
                            <div class="form-inline padding-bottom-15">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <button class="btn btn-direction btn-down btn-primary" onclick="addcategory()" data-target="#modelcat" data-toggle="modal" type="button">
                                                <span class="btn-label">
                                                    <i aria-hidden="true" class="icon wb-plus"></i>
                                                </span>&nbsp;&nbsp;&nbsp;&nbsp;Add New Dish </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <tbody>
                            <?php
                            $query=mysqli_query($con,"select * from tbl_foodcategories ORDER BY id DESC ");while($row=mysqli_fetch_array($query)){
                            ?>
                            <tr>
                                <td><img height="60" width="80" src="uploads/category/<?php echo $row['image']; ?>"/> </td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['Price']; ?></td>
                                
                                <td>
                                    <button type="button" class="btn btn-outline btn-warning"
                                            data-target="#exampleFormModal" data-toggle="modal" onclick="editfun(<?php echo $row["id"]; ?>)" title="Update Record">Edit</button>
                                    <?php
                                    $rit=$_SESSION['uname'];
                                    $qur=mysqli_query($con,"select * from adminlogin WHERE Username='$rit'");
                                    $user=mysqli_fetch_array($qur);
                                    if($user['right'] == 1 ) {
                                    ?>
                                    <button type="button" class="btn btn-outline btn-danger" onClick="deletefun(<?php echo $row["id"]; ?>)"
                                            title="Delete">delete</button>
                                    <?php }
                                    else{
                                        ?>
                                        <button type="button" class="btn btn-outline btn-danger" onClick="rightdelcat()"
                                                title="Delete">delete</button>
                                        <?php
                                    }?>
                                </td>
                            </tr>
                            </tbody>
                            <?php
                            }
                            ?>
                            <tfoot>
                            <tr>
                                <td colspan="5">
                                    <div class="text-right">
                                        <ul class="pagination"></ul>
                                    </div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- End Panel Filtering -->
            </div>
        </div>
        <div class="row row-lg">
            <div class="col-lg-4 col-md-6">
                <!-- Example Form Modal -->
                <div class="example-wrap">
                    <div class="example">
                        <!-- Modal -->
                        <div class="modal fade" id="exampleFormModal" aria-hidden="false" aria-labelledby="exampleFormModalLabel"
                             role="dialog" tabindex="-1">
                            <div class="modal-dialog">
                                <div id="showresults"></div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    </div>
                </div>
                <!-- End Example Form Modal -->
            </div>
        </div>
        <div class="row row-lg">
            <div class="col-lg-4 col-md-6">
                <!-- Example Form Modal -->
                <div class="example-wrap">
                    <div class="example">
                        <!-- Modal -->
                        <div class="modal fade" id="modelcat" aria-hidden="false" aria-labelledby="sadasd"
                             role="dialog" tabindex="-1">
                            <div class="modal-dialog">
                                <div id="addcategory"></div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    </div>
                </div>
                <!-- End Example Form Modal -->
            </div>
        </div>
    </div>
</div>


