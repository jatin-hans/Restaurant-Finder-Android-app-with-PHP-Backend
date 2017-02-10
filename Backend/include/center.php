<?php include'include/config.php'; ?>
<div class="page animsition">
    <div class="page-header">
        <h1 class="page-title">Add New Restaurant Detail</h1>
        <ol class="breadcrumb">
            <li><a href="master.php">Home</a></li>
            <li class="active">Add Restaurant</li>
        </ol>
    </div>
    <div class="page-content container-fluid">
        <div class="panel">
            <style>
                .boder{
                    border: solid darkgrey 1px;
                }
            </style>
            <div class="panel-body">
                <form id="exampleFullForm" method="post" autocomplete="off" enctype="multipart/form-data" action="include/addrestourant.php">
                    <div class="row row-lg">
                        <div class="col-lg-6 form-horizontal">
                            <div class="form-group">
                                <label class="col-lg-12 col-sm-3 control-label">Restaurant Name
                                    <span class="required">*</span>
                                </label>
                                <div class="col-lg-12 col-sm-9">
                                    <div class="input-group" >
                                        <span class="input-group-addon">
                                        <i class="icon wb-user" aria-hidden="true"></i>
                                        </span>
                                        <input type="text" class="form-control boder"   name="username" placeholder="" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 col-sm-3 control-label">Restaurant Type
                                    <span class="required">*</span>
                                </label>
                                <div>
                                    <div class="col-lg-4 col-sm-9">
                                        <div class="radio-custom radio-primary">
                                            <input type="radio" class="boder" id="inputAwesome" name="restype" value="Veg"  required="">
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
                                        <textarea class="form-control boder"   name="address" placeholder="Write Address" required=""></textarea>
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
                                        <input type="text" class="form-control boder"   name="zipcode" placeholder="" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 col-sm-3 control-label">Phone No.<span class="required">*</span></label>
                                <div class="col-lg-12 col-sm-9">
                                    <div class="input-group" >
                                        <span class="input-group-addon"><i class="icon wb-mobile" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control boder"   name="mobile" placeholder="" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 col-sm-3 control-label">Email<span class="required">*</span>
                                </label>
                                <div class="col-lg-12 col-sm-9">
                                    <div class="input-group" >
                                        <span class="input-group-addon">
                                            <i class="icon wb-envelope" aria-hidden="true"></i>
                                         </span>
                                        <input type="email" class="form-control boder"   name="email" placeholder="email@email.com"
                                               required="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 col-sm-9 control-label">Thumbnail image</label>
                                <div class="col-lg-12 col-sm-9">
                                    <input class="form-control boder" type="file" name="image" id="file" required="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 col-sm-9 control-label">Select Images</label>
                                <div class="col-lg-12 col-sm-9">
                                    <input class="form-control boder" type="file" name="photos[]" id="file" multiple="true" required="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 col-sm-9 control-label">Status
                                    <span class="required">*</span>
                                </label>
                                <div >
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
                                </div>
                            </div>
                        </div>


                        <script src="http://maps.google.com/maps/api/js?libraries=places&region=india&language=en&sensor=true"></script>
                        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>





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
                                <div class="form-group">
                                    <label class="col-lg-12 col-sm-3 control-label">Latitude
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-12 col-sm-9">
                                        <div class="input-group" >
                                        <span class="input-group-addon">
                                                <i class="icon wb-map" aria-hidden="true"></i>
                                        </span>
                                            <input type="text" id="MapLat" class="form-control boder MapLat"   name="latitude" placeholder="latitude" required="">
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
                                            <input type="text" id="MapLon"  class="form-control boder MapLon"   name="longitude" placeholder="Longitude" required="">
                                        </div>
                                    </div>
                                </div>
                            <div class="form-group">
                                <label class="col-lg-12 col-sm-3 control-label">Time
                                    <span class="required">*</span>
                                </label>
                                <div class="col-lg-6 col-sm-9">
                                    <div class="input-group " >
                                        <span class="input-group-addon">
                                                <i class="icon wb-time" aria-hidden="true"></i>
                                        </span>
                                        <input type="text" class="form-control boder" name="time" placeholder="Ex:08:30 AM" required="">
                                    </div>
                                </div>
                                <div class="col-lg-1 col-sm-9">TO</div>
                                <div class="col-lg-5 col-sm-9">
                                    <div class="input-group " >
                                        <input type="text" class="form-control boder" name="time2" placeholder="Ex:09:30 PM" required="">
                                    </div>
                                </div>
                            </div>
                                 <div class="form-inline padding-bottom-15">
                                <div class="row">
                                    <div class="col-lg-1 col-sm-9">
                                        <div class="form-group">
                                            <button class="btn btn-direction btn-down btn-primary"  onclick="addmenus()" data-target="#modelcat1" data-toggle="modal" type="button">
                                                <span class="btn-label">
                                                    <i aria-hidden="true" class="icon wb-plus"></i>
                                                </span>&nbsp;&nbsp;&nbsp;&nbsp;Add New Dish </button>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            <div class="form-group">
                             <label class="col-lg-12 col-sm-9 control-label">Food Type</label>
                                <div class="col-lg-12 col-sm-9">
                                    <select class="form-control boder" id="browsers" name="browsers[]" title="Please select at least one browser" size="5" multiple="multiple" required="">
                                        <?php $qury=mysqli_query($con,"select * from tbl_foodcategories");
                                        while($res=mysqli_fetch_array($qury)){ ?>
                                        <option value="<?php echo $res['name']; ?>"><?php echo $res['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                            <?php
                            $rit=$_SESSION['uname'];
                            $qur=mysqli_query($con,"select * from adminlogin WHERE Username='$rit'");
                            $user=mysqli_fetch_array($qur);
                            if($user['right'] == 1 ) { ?>
                                <div class="form-group col-lg-12 text-right padding-top-m">
                                    <button type="submit" class="btn btn-primary" id="validateButton1">Add Restourant</button>
                                </div>
                            <?php }  else { ?>
                                <div class="form-group col-lg-12 text-right padding-top-m">
                                    <button type="button" class="btn btn-primary" onclick="right()"  id="validateButton1">Add Restaurant</button>
                                </div>
                                <?php }  ?>
                    </div>
                        <div class="row row-lg">
              <div class="col-lg-4 col-md-6">
                <!-- Example Form Modal -->
                <div class="example-wrap">
                    <div class="example">
                        <!-- Modal -->
                        <div class="modal fade" id="modelcat1" aria-hidden="false" aria-labelledby="sadasd"
                             role="dialog" tabindex="-1">
                            <div class="modal-dialog">
                                <div id="addmenus"></div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    </div>
                </div>
                <!-- End Example Form Modal -->
            </div>    
                </form>
            </div>
        </div>
            
        </div>
    </div>
    <script>
        function right(){ alert("You Have Sample Admin ! Cannot Add Restaurant Detail !!! "); }
        $('form input').on('keypress', function(e) {
            return e.which !== 13;
        });
    </script>
</div>
</div>
</div>
<script>
    $(function () {
        var lat = 40.8516701,
            lng = -93.2599318,
            latlng = new google.maps.LatLng(lat, lng),
            image = 'http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png';
        //zoomControl: true,
        //zoomControlOptions: google.maps.ZoomControlStyle.LARGE,
        var mapOptions = {
                center: new google.maps.LatLng(lat, lng),
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                panControl: true,
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


