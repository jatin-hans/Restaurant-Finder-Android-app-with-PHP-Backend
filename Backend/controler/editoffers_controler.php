<script> function rightaddofr() { alert("You Have Sample Admin ! Cannot Add Restaurant Offer image !!"); }
    function righteditofr(){ alert("You Have Sample Admin ! Cannot Update Restaurant Offer image !!"); } </script>
<?php  if(isset($_POST['addoffer'])){
    $id=$_POST['offname'];
    $check=mysqli_query($con,"select * from tbl_offers WHERE restaurant_id='$id'");
    $res=mysqli_fetch_array($check);
    if($res){ ?><script> document.getElementById("error").innerHTML = "!!! allready set offers image !!! Please edit ! ";</script><?php } else {
        $qury=mysqli_query($con,"select name from tbl_restourant WHERE id='$id'");
        $off=mysqli_fetch_array($qury);
        $name=$off['name'];
        $tmpFilePath = $_FILES['offimage']['tmp_name'];
        $id=uniqid();
        $newFilePath = "uploads/offers/" .$id. $_FILES['offimage']['name'];
        $imagepath= $id.$_FILES['offimage']['name'];
        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
            $id=$_POST['offname'];
            $qury1=mysqli_query($con,"insert into tbl_offers (restaurant_id,title,image) VALUE ('$id','$name','$imagepath')");
            if($qury1){
                ?><script> document.getElementById("demo").innerHTML = "!!! Offers Add Successfuly !!! ";</script><?php
            }
            else{
                echo "not";
            }
        }
    }
} ?>
</div>
</div>

</div>
</div>
<?php
if(isset($_POST['remove'])){
    $id=$_POST['offname'];
    $qdata=mysqli_query($con,"select * from tbl_offers WHERE restaurant_id='$id' ");
    $da=mysqli_fetch_array($qdata);
    unlink("uploads/offers/".$da['image']);
    $dataq=mysqli_query($con,"delete from tbl_offers WHERE restaurant_id='$id'");
    if($dataq){
        ?><script> document.getElementById("demo").innerHTML = "!!! Offers Remove Successfuly !!! ";</script><?php
    }
    else{

    }

}
?>
<script>
    function editoffers(sel){
        var id = $("#name").val();
        $.ajax({
            type: "POST",
            url: "include/viewoffers.php",
            data: "id="+ id ,
            cache: false,
            beforeSend: function(){ $("#login").val('Connecting...');},
            success: function(data){
                if(data)
                {
                    $('#showresults').replaceWith($('#showresults').html(data));
                    $('#submit').attr('disabled',false);
                    $('#image').attr('disabled',false);
                    $('#demo').hide();
                }
                else
                {
                    //alert("not");
                    document.getElementById("showresults").innerHTML = "No Record Founds !!! ";
                    $('#submit').attr('disabled',true);
                    $('#image').attr('disabled',true);
                    $('#demo').hide();

                }
            }
        });
        return false;
    }
    function removeffers(){
        var id = $("#offname").val();
        //alert(id);
        $.ajax({
            type: "POST",
            url: "include/viewoffers.php",
            data: "id="+ id ,
            cache: false,
            beforeSend: function(){ $("#login").val('Connecting...');},
            success: function(data){
                if(data)
                {
                    $('#remove').replaceWith($('#remove').html(data));
                    $('#submit').attr('disabled',false);
                    $('#image').attr('disabled',false);
                    $('#demo').hide();
                }
                else
                {
                    //alert("not");


                }
            }
        });
        return false;
    }
</script>
