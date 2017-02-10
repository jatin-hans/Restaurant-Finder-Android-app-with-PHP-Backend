<?php include'include/config.php'; ?>
<body class="app-documents">
<div class="page animsition">
    <div class="page-header">
        <h1 class="page-title margin-bottom-10">Add Restaurant images</h1>
        <ol class="breadcrumb">
            <li><a href="master.php">Home</a></li>
            <li class="active">Add images</li>
        </ol>
    </div>
    <div class="page-content">
        <div class="form-group">
            <form name="frm" id="frm" enctype="multipart/form-data" method="post">
                <div id="success" style="color: green;"></div>
                <div class="documents-wrap categories">
                    <ul class="blocks-md-3"  data-plugin="matchHeight">
                    <li>
                        <div class="input-group">
                            <?php $qury=mysqli_query($con,"select id,name from tbl_restourant"); ?>
                                <select id="check" name="check" data-plugin="selectpicker"   onchange="resimages()" >
                                    <option value="" selected>Select Restaurant</option>
                                    <?php while($res=mysqli_fetch_array($qury)){  ?>
                                        <option value="<?php echo $res['id']; ?>"><?php echo $res['name']; ?></option>
                                    <?php } ?>
                                </select>
                        </div>
                    </li>
                        <li>
                            <input class="form-control boder" type="file" name="photos[]"  multiple="true" required="required" />
                        </li>
                        <li><?php
                            $rit=$_SESSION['uname'];
                            $qur=mysqli_query($con,"select * from adminlogin WHERE Username='$rit'");
                            $user=mysqli_fetch_array($qur);
                            if($user['right'] == 1 ) { ?>
                                <div class="input-group">
                                    <input  type="submit" class="btn btn-primary" id="submit"  name="submit" value="Add Images" />
                                </div>
                            <?php } else { ?>
                                <div class="input-group">
                                    <input  type="submit" class="btn btn-primary"  onclick="rightimg()"  value="Add Images" />
                                </div>
                                <?php }  ?>
                        </li>
                    </ul>
                </div>
                <script>
                    function rightimg(){ alert("You Have Sample Admin ! Cannot Add Restaurant Images !!!"); }
                </script>
                </form>
                <?php
                if(isset($_POST['submit'])){ $id=$_POST['check'];
                    if($id == "") {?><script>alert("Please Select Restaurant Name");</script><?php } else {
                        for($im=0; $im<count($_FILES['photos']['name']); $im++)
                        {
                            $tmpFilePath = $_FILES['photos']['tmp_name'][$im];
                             if ($tmpFilePath != "") {
                                $r1 = chr(rand(ord('a'), ord('z')));
                                $r2 = chr(rand(ord('a'), ord('z')));
                                $r3 = chr(rand(ord('a'), ord('z')));
                                $rno=$r1.$r2.$r3;
                                 $newFilePath = "uploads/" .$rno. $_FILES['photos']['name'][$im];
                                $imagepath= $rno.$_FILES['photos']['name'][$im];
                                //Upload the file into the temp dir
                                if(move_uploaded_file($tmpFilePath,$newFilePath)) {
                                    $qry=mysqli_query($con,"insert into tbl_images (image_id,img_url) VALUES ('$id','$imagepath')"); }
                            }
                        }
                        ?><script>document.getElementById("success").innerHTML="!! Images Add Successfuly !!";</script><?php
                    }
                }
                ?>
        </div>
        <div class="documents-wrap categories">
            <ul class="blocks blocks-100 blocks-xlg-4 blocks-md-3 blocks-xs-2" id="imagedata" data-plugin="matchHeight">
            </ul>
        </div>
    </div>
</div>
</div>
</div>
<script>
    function resimages(){
        var id = $("#check").val();
        $.ajax({
            type: "POST",
            url: "include/viewresimage.php",
            data: "id="+ id ,
            cache: false,
            beforeSend: function(){ $("#login").val('Connecting...');},
            success: function(data)
            {
                if(data) { $('#imagedata').replaceWith($('#imagedata').html(data)); }
                else { document.getElementById("imagedata").innerHTML = "No Record Founds !!! "; }
            }
        });
    }
    function deleteimage(data,data1){
        var id  = data;
        var id1 = data1;
         $.ajax({
            type: "POST",
            url: "include/deleteimage.php",
            data: "id="+ id  + "&id1="+ id1,
            cache: false,
            beforeSend: function(){ $("#login").val('Connecting...');},
            success: function(sel){
                if(sel)
                { var id = sel;
                    $.ajax({
                        type: "POST",
                        url: "include/viewresimage.php",
                        data: "id="+ id ,
                        cache: false,
                        beforeSend: function(){ $("#login").val('Connecting...');},
                        success: function(data)
                        {
                            if(data) { $('#imagedata').replaceWith($('#imagedata').html(data)); }
                            else { document.getElementById("imagedata").innerHTML = "No Record Founds !!! "; }
                        }
                    });
                } else { alert("not"); } }
        });
    }
</script>
</body>