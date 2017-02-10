<?php include'include/config.php'; ?>
<script src="http://maps.google.com/maps/api/js?libraries=places&region=india&language=en&sensor=true"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<div class="page animsition">
    <div class="page-header">
        <h1 class="page-title">Update Restaurant Detail</h1>
        <ol class="breadcrumb">
            <li><a href="master.php">Home</a></li>
            <li class="active">Update Restaurant</li>
        </ol>
    </div>
    <div class="page-content container-fluid">
        <div class="panel">
            <style> .boder{  border: solid darkgrey 1px; </style>
            <div class="panel-body" id="exampleFullForm">
                <form   method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="row row-lg">
                        <div class="col-lg-6 form-horizontal">
                            <div class="form-group">
                                <label class="col-lg-12 col-sm-3 control-label">Restaurant Name
                                    <span class="required">*</span>
                                </label>
                                <div class="col-lg-12 col-sm-9">
                                    <div class="input-group" >
                                        <span class="input-group-addon"><i class="icon wb-user" aria-hidden="true"></i></span>
                                        <input value="<?php  echo $res['name'];?>" type="text" class="form-control boder"   name="resname" placeholder="" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 col-sm-3 control-label">Restaurant Type
                                    <span class="required">*</span>
                                </label>
                                <div >
                                    <?php if($res['Vegtype'] == "Veg"){ ?>
                                    <div class="col-lg-4 col-sm-9">
                                        <div class="radio-custom radio-primary">
                                            <input type="radio" checked class="boder" id="inputAwesome" name="restype" value="Veg"  required="">
                                            <label for="inputAwesome">Veg</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-9">
                                        <div class="radio-custom radio-primary">
                                            <input type="radio"  class="boder" id="inputVeryAwesome" name="restype" value="Nonveg">
                                            <label for="inputVeryAwesome">Nonveg</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-9">
                                        <div class="radio-custom radio-primary">
                                            <input type="radio"  class="boder" id="inputVeryAwesome" name="restype" value="Both">
                                            <label for="inputVeryAwesome">Both</label>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php if($res['Vegtype'] == "Nonveg"){ ?>
                                        <div class="col-lg-4 col-sm-9">
                                            <div class="radio-custom radio-primary">
                                                <input type="radio"  class="boder" id="inputAwesome" name="restype" value="Veg"  required="">
                                                <label for="inputAwesome">Veg</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-9">
                                            <div class="radio-custom radio-primary">
                                                <input type="radio" checked  class="boder" id="inputVeryAwesome" name="restype" value="Nonveg">
                                                <label for="inputVeryAwesome">Nonveg</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-9">
                                            <div class="radio-custom radio-primary">
                                                <input type="radio"  class="boder" id="inputVeryAwesome" name="restype" value="Both">
                                                <label for="inputVeryAwesome">Both</label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if($res['Vegtype'] == "Both"){ ?>
                                        <div class="col-lg-4 col-sm-9">
                                            <div class="radio-custom radio-primary">
                                                <input type="radio"  class="boder" id="inputAwesome" name="restype" value="Veg"  required="">
                                                <label for="inputAwesome">Veg</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-9">
                                            <div class="radio-custom radio-primary">
                                                <input type="radio"   class="boder" id="inputVeryAwesome" name="restype" value="Nonveg">
                                                <label for="inputVeryAwesome">Nonveg</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-9">
                                            <div class="radio-custom radio-primary">
                                                <input type="radio" checked class="boder" id="inputVeryAwesome" name="restype" value="Both">
                                                <label for="inputVeryAwesome">Both</label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 col-sm-3 control-label">Address
                                    <span class="required">*</span>
                                </label>
                                <div class="col-lg-12 col-sm-9">
                                    <div class="input-group" >
                                        <span class="input-group-addon">
                                            <i class="icon wb-briefcase" aria-hidden="true"></i>
                                         </span>
                                        <textarea class="form-control boder"   name="address" placeholder="Write Address" required=""><?php echo $res['address'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 col-sm-3 control-label">Zipcode
                                    <span class="required">*</span>
                                </label>
                                <div class="col-lg-12 col-sm-9">
                                    <div class="input-group" >
                                        <span class="input-group-addon">
                                                <i class="icon wb-list-numbered" aria-hidden="true"></i>
                                        </span>
                                        <input value="<?php echo $res['zipcode']; ?>" type="text" class="form-control boder"   name="zipcode" placeholder="" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 col-sm-3 control-label">Phone No.
                                    <span class="required">*</span>
                                </label>
                                <div class="col-lg-12 col-sm-9">
                                    <div class="input-group" >
                                        <span class="input-group-addon"><i class="icon wb-mobile" aria-hidden="true"></i></span>
                                        <input value="<?php echo $res['phone_no']; ?>" type="text" class="form-control boder"   name="mobile" placeholder="" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 col-sm-3 control-label">Email<span class="required">*</span></label>
                                <div class="col-lg-12 col-sm-9">
                                    <div class="input-group" >
                                        <span class="input-group-addon">
                                            <i class="icon wb-envelope" aria-hidden="true"></i>
                                         </span>
                                        <input type="email" value="<?php echo $res['email']; ?>" class="form-control boder"   name="email" placeholder="email@email.com" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 col-sm-9 control-label">Change Thumbnail image</label>
                                <div class="col-lg-6 col-sm-9">
                                    <input class=" " type="file" name="image" />
                                </div>
                                <div class="col-lg-6 col-sm-9">
                                    <img src="uploads/<?php echo $res['thumimage']; ?>" height="100" width="150"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 col-sm-9 control-label">Status
                                    <span class="required">*</span>
                                </label>
                                <div >
                                    <?php if($res['is_active'] == 1){ ?>
                                    <div class="col-lg-6 col-sm-9">
                                        <div class="radio-custom radio-primary">
                                            <input type="radio" class="boder" id="inputAwesome" name="status" value="1" checked required="">
                                            <label for="inputAwesome">Active</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-9">
                                        <div class="radio-custom radio-primary">
                                            <input type="radio"  class="boder" id="inputVeryAwesome" name="status" value="0">
                                            <label for="inputVeryAwesome">Deactive</label>
                                        </div>
                                    </div>
                                    <?php }
                                    else {
                                        ?>
                                            <div class="col-lg-6 col-sm-9">
                                                <div class="radio-custom radio-primary">
                                                    <input type="radio" class="boder" id="inputAwesome" name="status" value="1"  required="">
                                                    <label for="inputAwesome">Active</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-9">
                                                <div class="radio-custom radio-primary">
                                                    <input type="radio"  class="boder" id="inputVeryAwesome" checked name="status" value="0">
                                                    <label for="inputVeryAwesome">Deactive</label>
                                                </div>
                                            </div>
                                        <?php
                                    }?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 form-horizontal">
                            <div class="form-group">
                                <div class="col-lg-12 col-sm-9">
                                    <div class="form-group">
                                        <label class="col-lg-12 col-sm-3 control-label">Search Address
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-lg-12 col-sm-9">
                                            <div class="input-group" >
                                        <span class="input-group-addon">
                                                <i class="icon wb-map" aria-hidden="true"></i>
                                        </span>
                                                <input id="searchTextField" type="text" size="50" class="form-control boder" style="direction: ltr;">  </div>
                                        </div>
                                    </div>
                                    <div id="map_canvas" style="height: 250px;width: 450px;margin: 0.6em;"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-12 col-sm-3 control-label">Latitude<span class="required">*</span></label>
                                    <div class="col-lg-12 col-sm-9">
                                        <div class="input-group" >
                                            <span class="input-group-addon"><i class="icon wb-map" aria-hidden="true"></i></span>
                                            <input  type="text" id="latitude" class="form-control boder MapLat" value="<?php echo $res['latitude']; ?>"   name="latitude" placeholder="latitude" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-12 col-sm-3 control-label">Longitude<span class="required">*</span></label>
                                    <div class="col-lg-12 col-sm-9">
                                        <div class="input-group" >
                                        <span class="input-group-addon">
                                                <i class="icon wb-map" aria-hidden="true"></i>
                                        </span>
                                            <input type="text"  id="longitude"  class="form-control boder MapLon"   name="longitude" placeholder="Longitude"
                                                   required="" value="<?php echo $res['longitude']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-12 col-sm-3 control-label">Time
                                        <span class="required">*</span>
                                    </label>
                                    <?php $r = strcspn($res['time'],"To");$result = substr($res['time'],0,$r); ?>
                                    <?php $r1 = strcspn($res['time'],"To");$a=$r1-0;$result1 = substr($res['time'],-$a); ?>
                                    <div class="col-lg-6 col-sm-9">
                                        <div class="input-group " >
                                            <span class="input-group-addon"><i class="icon wb-time" aria-hidden="true"></i></span>
                                            <input type="text" value="<?php echo $result; ?>" class="form-control boder" name="time" placeholder="Ex:08:30 AM" required="">
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-sm-9">TO</div>
                                    <div class="col-lg-5 col-sm-9">
                                        <div class="input-group " >
                                            <input type="text" value="<?php echo $result1; ?>" class="form-control boder" name="totime" placeholder="Ex:09:30 PM" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-12 col-sm-9 control-label">Menu</label>
                                    <div class="col-lg-12 col-sm-9">
                                        <select class="form-control boder" id="browsers" name="foodcat[]" title="Please select at least one Category"
                                                size="5" multiple="multiple" required="">
                                            <?php $qury=mysqli_query($con,"select * from tbl_foodcategories");
                                            while($re=mysqli_fetch_array($qury)){
                                                $ry=mysqli_query($con,"select * from tbl_food WHERE food_id='$dataid' && food_type='".$re['name']."'&&Price='".$re['Price']."'  ");
                                                $ddt=mysqli_fetch_array($ry);
                                                if($ddt) {?><option  value="<?php echo $re['name']; ?>" value="<?php echo $re['Price']; ?>" selected><?php echo $re['name']; ?>  value="<?php echo $re['Price']; ?>" </option><?php }  else {
                                                    ?><option  value="<?php echo $re['name']; ?>"  value="<?php echo $re['Price']; ?>"  ><?php echo $re['name']; ?>  <?php echo $re['Price']; ?> </option><?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <?php  $rit=$_SESSION['uname']; $qur=mysqli_query($con,"select * from adminlogin WHERE Username='$rit'"); $user=mysqli_fetch_array($qur);
                            if($user['right'] == 1 ) { ?>
                                <div class="form-group col-lg-12 text-right padding-top-m">
                                    <input type="submit" name="updaterestaurant" class="btn btn-primary" value="Update Restourant" />
                                </div>
                                <?php }  else { ?>
                                <div class="form-group col-lg-12 text-right padding-top-m">
                                    <button type="button" class="btn btn-primary" onclick="right()"  id="validateButton1">Update Restaurant</button>
                                </div>
                                <?php }  ?>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function right()
        { alert("You Have Sample Admin ! Cannot Add Restaurant Detail !!! "); }
        $('form input').on('keypress', function(e) {
            return e.which !== 13;
        });
    </script>
</div>
</div>
<?php require_once'controler/updateres_controler.php';  ?>


<?php
$lat = $res['latitude'];
$lon = $res['longitude'];
?>
<script>
    $(function () {
        var lat = <?php echo $lat; ?>,
            lng = <?php echo $lon; ?>,
            latlng = new google.maps.LatLng(lat, lng),
            image = 'http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png';
        //zoomControl: true,
        //zoomControlOptions: google.maps.ZoomControlStyle.LARGE,
        var mapOptions = {
                center: new google.maps.LatLng(lat, lng),
                zoom: 18,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                panControl: false,
                panControlOptions: {
                    position: google.maps.ControlPosition.TOP_RIGHT
                },
                zoomControl: true,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.LARGE,
                    position: google.maps.ControlPosition.TOP_left
                }
            },
            map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions),
            marker = new google.maps.Marker({
                position: latlng,
                map: map,
                icon: image
            });
        var input = document.getElementById('searchTextField');
        var autocomplete = new google.maps.places.Autocomplete(input, {
            types: ["geocode"]
        });
        autocomplete.bindTo('bounds', map);
        var infowindow = new google.maps.InfoWindow();
        google.maps.event.addListener(autocomplete, 'place_changed', function (event) {
            infowindow.close();
            var place = autocomplete.getPlace();
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            moveMarker(place.name, place.geometry.location);
            $('.MapLat').val(place.geometry.location.lat());
            $('.MapLon').val(place.geometry.location.lng());
        });
        google.maps.event.addListener(map, 'click', function (event) {
            $('.MapLat').val(event.latLng.lat());
            $('.MapLon').val(event.latLng.lng());
            infowindow.close();
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                "latLng":event.latLng
            }, function (results, status) {
                console.log(results, status);
                if (status == google.maps.GeocoderStatus.OK) {
                    console.log(results);
                    var lat = results[0].geometry.location.lat(),
                        lng = results[0].geometry.location.lng(),
                        placeName = results[0].address_components[0].long_name,
                        latlng = new google.maps.LatLng(lat, lng);
                    moveMarker(placeName, latlng);
                    $("#searchTextField").val(results[0].formatted_address);
                }
            });
        });

        function moveMarker(placeName, latlng) {
            marker.setIcon(image);
            marker.setPosition(latlng);
            infowindow.setContent(placeName);
            //infowindow.open(map, marker);
        }
    });
</script>
