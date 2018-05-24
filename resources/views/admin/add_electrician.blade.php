@extends('admin.layouts.app')

@section('content')
<script> var a_count = 1;</script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{ asset('global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" rel="stylesheet" type="text/css" />        
<link href="{{ asset('global/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('global/css/components-rounded.min.css" rel="stylesheet') }}" type="text/css" />
<link href="{{ asset('global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/bootstrap-markdown/lib/markdown.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/bootstrap-markdown/js/bootstrap-markdown.js') }}" type="text/javascript"></script>        
<script src="{{ asset('global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages/scripts/form-validation.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<style>
   .locations_div label{visibility: hidden;}
    #location_container .locations_div:nth-child(-n+2) label{visibility: visible;}
    .error{margin-top: 8px; display: block;}
</style>
<script>

    // This example displays an address form, using the autocomplete feature
    // of the Google Places API to help users fill in the information.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    var placeSearch, autocomplete;
    var componentForm = {
        route: 'long_name',
        sublocality_level_1: 'short_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {
        var acInputs = document.getElementsByClassName("org_location");

        for (var i = 0; i < acInputs.length; i++) {

            var autocomplete = new google.maps.places.Autocomplete(acInputs[i]);
            autocomplete.inputId = acInputs[i].id;

            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                console.log(this.inputId);
                fillInAddress(this);
            });
        }
     
    }

    function fillInAddress(obj) {
        var id = obj.inputId.split('_')[1];
        //console.log(location);
        // Get the place details from the autocomplete object.
        
        var place = obj.getPlace();
        if (place && place.address_components) {
            var name = place.name;
            var full_address = place.formatted_address;
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();

            var string = 'name:' + name + '!!full_address:' + full_address + '!!latitude:' + latitude + '!!longitude:' + longitude;
            
            // Get each component of the address from the place details
            // and fill the corresponding field on the form.
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];

                    if (addressType == 'sublocality_level_1') {
                        addressType = 'town';
                    } else if (addressType == 'locality') {
                        addressType = 'city';
                    } else if (addressType == 'administrative_area_level_1') {
                        addressType = 'state';
                    }
                    else if (addressType == 'postal_code') {
                        addressType = 'zip_code';
                    }

                    string = string + '!!' + addressType + ':' + val;
                }
            }
            console.log(string);
            $('#location_input_'+id).val(string);
            //console.log(string);
        }
    }

    /*function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }*/

    function add_location_row() {
        //console.log('elem count: '+$('.locations_div').length);
        if ($('#location_container .locations_div').length == 1) {
            a_count = 1;
        }
        a_pre_count = a_count;
        a_count = a_count + 1;
        console.log($('#location_container').html());
        var last_element_id = $('#location_container > .locations_div:last-child > div').attr('id').split('_')[2];
        //console.log('Last: '+last_element_id);
        //console.log('Prev: '+a_pre_count);
        var html = '<div class="locations_div"><div id="location_group_' + a_count + '" class="form-group"><label class="control-label col-md-3">Other Office Location(s)<span class="required"> * </span></label><div class="col-md-4"><div class="input-icon right"><i class="fa"></i><input type="text" id="location_' + a_count + '" class="form-control org_location"  name="location['+a_pre_count+']" placeholder="Enter a location" onFocus=""/><input type="hidden" class="org_location_input" name="location_name['+a_pre_count+']" id="location_input_'+a_count+'" /><span class="error"></span></div></div></div><div id="add_group_button_' + a_count + '" class="form-group"><div class="col-md-offset-3 col-md-4"><a herf="javascript:void(0);" class="btn-add-location" onclick="add_location_row();" title="Add More Office Location"><i class="fa fa-plus-circle" style="font-size: 130%; color: #36c6d3;"></i> Add More</a> <a href="javascript:void(0);" onclick="remove_location_row(' + a_count + ');" title="Remove Locationstates"><i class="fa fa-minus-circle" style="font-size: 130%; color: #e73d4a;"></i> Remove</a></div></div></div>';
        $('#add_group_button_' + last_element_id).parent().after(html);
        if(last_element_id == 1){
            $('#add_group_button_' + a_pre_count).hide();
        }
        else{
            $('#add_group_button_' + last_element_id + ' .btn-add-location').hide();
        }
        //console.log('count: '+a_count);
        //console.log('pre_count: '+a_pre_count);
        initAutocomplete();
        
    }

    function remove_location_row(id) {
        //console.log('elem count: '+$('.locations_div').length);
        //console.log('curr Id: '+id);
        var div_count = $('.locations_div').length;
        var prev_id = id - 1;
        //console.log('prev id: '+prev_id);
        $('#location_group_' + id).parent().remove();
        var last_element_id = $('#location_container > .locations_div:last-child > div').attr('id').split('_')[2];
        $('#add_group_button_' + last_element_id+' .btn-add-location').show();
        if(last_element_id == 1){
            $('#add_group_button_1').show();
        }
        //console.log('Last elem id '+$('#location_container > .locations_div:last-child > div').attr('id'));
        //console.log('previous id'+ prev_id);
    }

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA09LJ1dcs9THrpsWuTtl143UD9pq0cIdA&libraries=places&callback=initAutocomplete"
async defer></script>
<style>
    .input-icon ~ .error{margin-top: 0px !important;}
</style>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="">Electrician Management</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Add New Electrician</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->

        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN VALIDATION STATES-->
        <!-- BEGIN FORM-->
        
        <form action="" id="org_form" enctype="multipart/form-data" class="form-horizontal" method="post">
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-building font-green"></i>
                        <span class="caption-subject font-green bold uppercase">Add New Electrician</span>
                    </div>
                </div>
              
                <div class="portlet-body">
                    <div class="form-body">
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                        <div class="form-group  margin-top-20">
                            <label class="control-label col-md-3">Electrician Name
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" class="form-control" name="org_name" value="" /> </div>
                               
                            </div>
                        </div>
                        <div class="form-group  margin-top-20">
                            <label class="control-label col-md-3">Father Name
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" class="form-control" name="org_name" value="" /> </div>
                               
                            </div>
                        </div>
                         <div class="form-group  margin-top-20">
                            <label class="control-label col-md-3">Mobile 1
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" class="form-control" name="org_name" value="" /> </div>
                               
                            </div>
                        </div>
                        <div class="form-group  margin-top-20">
                            <label class="control-label col-md-3">Mobile 2
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" class="form-control" name="org_name" value="" /> </div>
                               
                            </div>
                        </div>
                        <div class="form-group  margin-top-20">
                            <label class="control-label col-md-3">Shop Name
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" class="form-control" name="org_name" value="" /> </div>
                               
                            </div>
                        </div>
                        <div id="location_container">
                            <?php
                              //  $locations = $this->input->post('location');
                              //  $location_name = $this->input->post('location_name');
                            ?>
                            
                            <div class="locations_div">
                                <div class="form-group" id="location_group_1">
                                    <label class="control-label col-md-3">Location
                                        <span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <div class="input-icon right">
                                        <i class="fa"></i>
                                        <input type="text" id="location_1" name="location[0]" value="<?php //echo $locations[0]; ?>" class="form-control org_location" placeholder="Enter a location" onFocus=""/>
                                        <input type="hidden" class="org_location_input" name="location_name[0]" value="<?php// echo $location_name[0]; ?>" id="location_input_1" />
                                        <span class="error"></span>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <?php
                               // if($locations){
                                    //echo '<script>alert(a_count);initAutocomplete();</script>';
                                   // $count = count($locations);
                                  //  for($k = 1; $k < $count; $k++){
                            ?>
                           <?php
                                 //   echo '<script>a_count = '.($k+1).';</script>';
                                //    echo '<script> initAutocomplete();</script>';
                                  //  }
                                    
                               // } 
                                    
                            ?>
                                
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Description
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <textarea name="org_description" class="form-control" rows="5" data-error-container="#editor_error"><?php //echo set_value('org_description'); ?></textarea>
                               
                                <div id="editor_error"> </div>
                            </div>
                        </div>




                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button id="btn_save" type="submit" name="save" value="" class="btn green">Save</button>
                                <button id="btn_save_more" type="button" class="btn green">Save and Add More</button>
                                <a href="" ><button type="button" class="btn default">Cancel</button></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- END FORM-->
        <!-- END VALIDATION STATES-->

        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->
    <!-- END QUICK SIDEBAR -->
</div>
<script>
    $(document).ready(function(){
        $('#add_group_button_1').hide();
        $('.btn-add-location').hide();
        var div_count = $('.locations_div').length;
        //alert(div_count);
        if( div_count == 1){
            $('#add_group_button_1').show();
        }
        else{
            $('#add_group_button_'+div_count+' .btn-add-location').show();
        }
       
        $(document).on('keyup', '.org_location', function(){
            var id = $(this).attr('id');
            var loc_id_arr = id.split('_');
            var loc_id = loc_id_arr[loc_id_arr.length-1];
            $('#location_input_'+loc_id).val('');
        });
        
        $(document).on('change', '.form-group .org_location_input', function(){
            
        });
        
        $('#org_form').on('submit', function(e){
            e.preventDefault();
            var is_valid = validate_organization_location();
            return is_valid;
            
        });
        
        
        
        $("#a_pass").on({
            keydown: function (e) {
                if (e.which === 32)
                    return false;
            },
            change: function () {
                this.value = this.value.replace(/\s/g, "");
            }
        });
        
    });
                    
</script>
<script>
        $(document).ready(function () {
            var base_url = "";
            $('#org_logo').on('change', function () {
                var reader = new FileReader();

                reader.onload = function (e) {
                    // get loaded data and render thumbnail.
                    document.getElementById("org_logo_view").src = e.target.result;
                };

                // read the image file as a data URL.
                reader.readAsDataURL(this.files[0]);
                
                $('#default_logo').val('');
            });
           
            $('#remove_picture').on('click', function(e){
                $('#org_logo_view').attr('src', base_url+'assets/uploads/organization_logos/default_logo.png');
                $('#org_logo').val('');
                $('#default_logo').val('default_logo.png');
            });
            
            $('#btn_save_more').on('click', function(){
                $('#btn_save').val(1);
                $('#btn_save').click();
            });
            
    });
    </script>
    
    @endsection