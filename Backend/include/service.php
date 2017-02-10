<div class="page animsition">
    <div class="page-header">
        <h1 class="page-title">Web Services</h1>
        <div class="page-header-actions">
            <ol class="breadcrumb">
                <li><a href="master.php">Home</a></li>
                <li class="active">Web Services</li>
            </ol>
        </div>
    </div>
<div class="col-md-12">
    <div class="example-wrap">
        <div class="example table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Description</th>
                    <th>Json Url</th>
                </tr>
                </thead>
                <tbody>
                <?php  include'include/config.php'; $query=mysqli_query($con,"select * from webservice"); while($res=mysqli_fetch_array($query)){ ?>
                <tr>
                    <td><?php echo $res['id']; ?></td>
                    <td><?php echo $res['desc']; ?></td>
                    <td><a href="<?php echo $res['url']; ?>"><?php echo $res['url']; ?></a></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
