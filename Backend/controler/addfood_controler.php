<?php
if(isset($_POST['submit'])){
    if($_FILES['image']['name'])
    {
        $tmpFilePath = $_FILES['image']['tmp_name'];
        $r1 = chr(rand(ord('a'), ord('z')));
        $r2 = chr(rand(ord('a'), ord('z')));
        $r3 = chr(rand(ord('a'), ord('z')));
        $id=$r1.$r2.$r3;
        //Setup our new file path
        $newFilePath = "uploads/category/" . $id . preg_replace('/\s+/','',$_FILES['image']['name']);
        $imagepath = $id . preg_replace('/\s+/','',$_FILES['image']['name']);
        //Upload the file into the temp dir
        move_uploaded_file($tmpFilePath, $newFilePath);
        $sql=mysqli_query($con,"select * from tbl_foodcategories where id='" . $_POST['id'] ."'");
        $dataq=mysqli_fetch_array($sql);
        $i=$dataq['image'];
        unlink("uploads/category/".$i);
        $qry = mysqli_query($con, "update tbl_foodcategories set name='" . $_POST['cat'] . "',Price='" . $_POST['cat1'] . "',image='$imagepath' where id='" . $_POST['id'] . "' ");
        if ($qry) {
            ?>
            <script>alert("Category Update Successfuly !!!!");
                window.location = 'addfoodcategori.php';</script><?php
        } else {
            ?>
            <script>alert("Category Not Update Please Try Agains  !!");
            </script><?php
        }
    }
    else{
        $qry = mysqli_query($con, "update tbl_foodcategories set  name='" . $_POST['cat'] . "', Price='". $_POST['cat1'] ."' where id='" . $_POST['id'] . "' ");

        if ($qry) {
            ?>
            <script>alert("Category Update Successfuly !!!");
                window.location = 'addfoodcategori.php';</script><?php
        } else {
            ?>
            <script>alert("Category Not Update Please Try Agains  !!");
            </script><?php
        }
    }
}
if(isset($_POST['addcat'])){
    $tmpFilePath = $_FILES['image']['tmp_name'];
    $r1 = chr(rand(ord('a'), ord('z')));
    $r2 = chr(rand(ord('a'), ord('z')));
    $r3 = chr(rand(ord('a'), ord('z')));
    $id=$r1.$r2.$r3;
    //Setup our new file path
    $newFilePath = "uploads/category/" .$id. preg_replace('/\s+/','',$_FILES['image']['name']);
    $imagepath= $id.preg_replace('/\s+/','',$_FILES['image']['name']);
    //Upload the file into the temp dir
    move_uploaded_file($tmpFilePath, $newFilePath);
    
    
    $qry=mysqli_query($con,"insert into tbl_foodcategories (`name`,`image`,`Price`) VALUES ('".$_POST['cat']."','$imagepath','".$_POST['cat1']."') ");
    
   
    if($qry){
        ?><script>alert("Category Add Successfuly !!");
            window.location='addfoodcategori.php';</script><?php
    }
    else{
        ?><script>alert("Category Not Add Please Try Agains !!");
            window.location='addfoodcategori.php';</script><?php
    }
    
   
}

if(isset($_POST['addmenu'])){
    $tmpFilePath = $_FILES['image1']['tmp_name'];
    $r1 = chr(rand(ord('a'), ord('z')));
    $r2 = chr(rand(ord('a'), ord('z')));
    $r3 = chr(rand(ord('a'), ord('z')));
    $id=$r1.$r2.$r3;
    //Setup our new file path
    $newFilePath = "uploads/category/" .$id. preg_replace('/\s+/','',$_FILES['image1']['name']);
    $imagepath= $id.preg_replace('/\s+/','',$_FILES['image1']['name']);
    //Upload the file into the temp dir
    move_uploaded_file($tmpFilePath, $newFilePath);
    $qry=mysqli_query($con,"insert into tbl_foodtype(`foodtype`,`img`,`price`) VALUES ('".$_POST['menu']."','$imagepath','".$_POST['menu1']."') ");
    
   
    if($qry){
        ?><script>alert("Menu Add Successfuly !!");
            </script><?php
    }
    else{
        ?><script>alert("Menu Not Add Please Try Agains !!");
            window.location='../addrestourant.php';</script><?php
    }
    
   
}

?>
        
      
<script>
    function rightdelcat(){
        alert("You Have Sample Admin ! Cannot Delete Food Category");
    }
</script>
<script>
    function deletefun(data){
        var del=confirm("Are you sure you want to delete this category?");
        if(del == true) {
            var id = data;
            //alert(id);
            //alert(id);
            $.ajax({
                type: "POST",
                url: "include/deletecatagory.php",
                data: "id=" + id,
                cache: false,
                beforeSend: function () {
                    $("#login").val('Connecting...');
                },
                success: function (data) {
                    if (data == "delete") {
                        alert("Category Delete Successfuly !! ");
                        window.location='addfoodcategori.php';
                    }
                    else {
                        alert("Error!!!");
                    }
                }
            });
        }
        else{

        }
    }
    function editfun(data){
        var id = data;
        // alert(id);
        $.ajax({
            type: "POST",
            url: "include/editcategory.php",
            data: "id=" + id,
            cache: false,
            beforeSend: function () {
                $("#login").val('Connecting...');
            },
            success: function (data) {
                if (data) {
                    $('#showresults').replaceWith($('#showresults').html(data));
                }
                else {
                }
            }
        });
    }
    function addcategory(){
        var id = 002;
        // alert(id);
        $.ajax({
            type: "POST",
            url: "include/addcategory.php",
            data: "id=" + id,
            cache: false,
            beforeSend: function () {
                $("#login").val('Connecting...');
            },
            success: function (data) {
                if (data) {
                    $('#addcategory').replaceWith($('#addcategory').html(data));
                }
                else {


                }
            }
        });

    }
</script>