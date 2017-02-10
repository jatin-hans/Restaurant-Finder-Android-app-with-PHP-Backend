<?php include("include/config.php"); ?>
<div class="page animsition">
    <div class="page-header">
        <h1 class="page-title">User feedback</h1>
        <ol class="breadcrumb">
            <li><a href="master.php">Home</a></li>
            <li class="active">view feedback</li>
        </ol>
    </div>
    <div class="page-content">
        <div class="panel">
            <div class="panel-body">
                <table class="table table-bordered table-hover toggle-circle" id="exampleFootableFiltering">
                    <thead>
                    <tr>
                        <td data-toggle="true" style="pointer-events: none;"></td>
                    </tr>
                    </thead>
                    <div class="form-inline padding-bottom-15">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Status</label>
                                    <select id="filteringStatus" class="form-control">
                                        <option value="">Show all</option>
                                        <option value="active">Active</option>
                                        <option value="disabled">Disabled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 text-right">
                                <div class="form-group">
                                    <input id="filteringSearch" type="text" placeholder="Search" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <tbody>
                    <?php  $query=mysqli_query($con,"select * from tbl_userfeedback ORDER BY id DESC "); while($res=mysqli_fetch_array($query)){ ?>
                    <tr>
                        <td>
                            <div class="media-left"><?php  $first = $res['username']; $result = substr($first, 0, 1); $lateer=ucfirst($result); ?>
                                <div class="avatar avatar-off">
                                    <div style="height:50px ;width:50px ;border-radius:
                                             50px;background-color: #62A8EA;text-align: center;font-size: 30px;color: white;"><?php echo $lateer;  ?></div>
                                </div>
                            </div>
                            <div class="comment-body media-body">
                                <h4 class="media-heading"><?php echo $res['username'];  ?></h4>
                                <?php $q=mysqli_query($con,"select * from tbl_restourant WHERE id='".$res['res_id']."'"); $d=mysqli_fetch_array($q);?>
                                <h5 class="media-heading"><font color="#808080">For :</font><?php echo $d['name'];  ?></h5>
                                <?php if($res['ratting']== 1){ ?>
                                        <i class="text-like icon wb-star" style="color: orange;"></i>
                                        <i class="text-like icon wb-star" ></i>
                                        <i class="text-like icon wb-star"></i>
                                        <i class="text-like icon wb-star" ></i>
                                        <i class="text-like icon wb-star" ></i>
                                        <?php }
                                         elseif($res['ratting']== 2){ ?>
                                            <i class="text-like icon wb-star" style="color: orange;"></i>
                                            <i class="text-like icon wb-star" style="color: orange;"></i>
                                            <i class="text-like icon wb-star" ></i>
                                            <i class="text-like icon wb-star" ></i>
                                            <i class="text-like icon wb-star" ></i>
                                        <?php }
                                         elseif($res['ratting']== 3){ ?>
                                            <i class="text-like icon wb-star" style="color: orange;"></i>
                                            <i class="text-like icon wb-star" style="color: orange;"></i>
                                            <i class="text-like icon wb-star" style="color: orange;"></i>
                                            <i class="text-like icon wb-star" ></i>
                                            <i class="text-like icon wb-star" ></i>
                                        <?php }
                                        elseif($res['ratting']== 4){ ?>
                                            <i class="text-like icon wb-star" style="color: orange;"></i>
                                            <i class="text-like icon wb-star" style="color: orange;"></i>
                                            <i class="text-like icon wb-star" style="color: orange;"></i>
                                            <i class="text-like icon wb-star" style="color: orange;"></i>
                                            <i class="text-like icon wb-star" "></i>
                                        <?php }
                                         else{ ?>
                                            <i class="text-like icon wb-star" style="color: orange;"></i>
                                            <i class="text-like icon wb-star" style="color: orange;"></i>
                                            <i class="text-like icon wb-star" style="color: orange;"></i>
                                            <i class="text-like icon wb-star" style="color: orange;"></i>
                                            <i class="text-like icon wb-star" style="color: orange;"></i>
                                        <?php } ?>

                                <div class="comment-content">
                                    <p><?php echo $res['comment']; ?> :)</p>
                                </div>
                                <div class="comment-actions">
                                    <?php $rit=$_SESSION['uname'];$qur=mysqli_query($con,"select * from adminlogin WHERE Username='$rit'");$user=mysqli_fetch_array($qur);
                                    if($user['right'] == 1 ) { ?> <?php if($res['is_active'] == 1){ ?>
                                            <button disabled="" >Active</button>
                                            <button class="inactive" onclick="isactive(<?php echo $res['id']; ?>,<?php echo $res['is_active']; ?>)">Disabled</button>
                                   <?php  }  else { ?>
                                        <button class="inactive" onclick="isactive(<?php echo $res['id']; ?>,<?php echo $res['is_active']; ?>)">Active</button>
                                        <button disabled="disabled" >Disabled</button>
                                        <?php }  }  else { if($res['is_active'] == 1){ ?>
                                        <button disabled="" >Active</button>
                                        <button class="inactive" onclick="rightact()">Disabled</button>
                                    <?php  }  else { ?>
                                        <button class="inactive"  onclick="rightact()">Active</button>
                                        <button disabled="disabled" >Disabled</button>
                                        <?php } }?>
                                </div>
                            </div>
                        </td>
                        <script> function rightact(){ alert("You Have Sample Admin ! Cannot Active/Disabled User Feedback"); } </script>
                        <style>
                            button {
                                color: white;
                            }
                            button:first-child {
                                background-color:green;
                            }
                            button:last-child {
                                background-color:red;
                            }
                            button.inactive {
                                background-color:lightgray;
                            }
                        </style>
                    </tr>
                    <?php }  ?>
                    </tbody>
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
    </div>
</div>
<script src="js/jquerymin.js"></script>
<script>
    $('button').click(function() {
        if (!$(this).hasClass('inactive')) {
            return;
        }
        $(this).closest('div').children('button').toggleClass('inactive');
        $(this).prop('disabled', true);
        $(this).siblings('button').prop('disabled', false);
    });
</script>
<script>
    function isactive(data,is_active){
        var id=data;
        var act=is_active;
        $.ajax({
            type: "POST",
            url: "include/isactive.php",
            data: "id="+ id +"&act=" +act,
            cache: false,
            beforeSend: function(){ $("#login").val('Connecting...');},
            success: function(data){
                if(data == "disable")  { }  else  {
                    document.getElementById("error").innerHTML = " ";
                }
            }
        }); return false;
    }
</script>

