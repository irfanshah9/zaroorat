@extends('admin.layouts.app')

@section('content')
<script> var a_count = 1;</script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!--<link href="{{ asset('global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />-->
<link href="{{ asset('global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" rel="stylesheet" type="text/css" />        
<!--<link href="{{ asset('global/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />-->
<link href="{{ asset('global/css/components-rounded.min.css" rel="stylesheet') }}" type="text/css" />
<!--<link href="{{ asset('global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />-->
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/bootstrap-markdown/lib/markdown.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/bootstrap-markdown/js/bootstrap-markdown.js') }}" type="text/javascript"></script>        
<!--<script src="{{ asset('global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>-->
<script src="{{ asset('pages/scripts/form-validation.js') }}" type="text/javascript"></script>
<!--<script src="{{ asset('global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>-->
<!-- END PAGE LEVEL SCRIPTS -->
<style>
/*   .locations_div label{visibility: hidden;}
    #location_container .locations_div:nth-child(-n+2) label{visibility: visible;}
    .error{margin-top: 8px; display: block;}*/
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
        var acInputs = document.getElementsByClassName("E_location");

        for (var i = 0; i < acInputs.length; i++) {

            var autocomplete = new google.maps.places.Autocomplete(acInputs[i]);
            autocomplete.inputId = acInputs[i].id;

            google.maps.event.addListener(autocomplete, 'place_changed', function () {
             //   console.log(this.inputId);
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
           // console.log(string);
            $('#location_input').val(string);
            $('#latitude_input').val(latitude);
            $('#longitude_input').val(longitude);
            
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
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA09LJ1dcs9THrpsWuTtl143UD9pq0cIdA&libraries=places&callback=initAutocomplete"
async defer></script>
<style>
    .input-icon ~ .error{margin-top: 0px !important;}
</style>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
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
                    <span>@if(isset($edit)) Edit Electrician @else Add New Electricain @endif</span>
                </li>
            </ul>
        </div>
        @if(isset($edit))
        <form action="{{url('admin/electrician/')}}/{{isset($electrician) ? $electrician->id : ''}}" id="electrician_form" class="form-horizontal" method="post">
         {!! method_field('patch') !!}
        @else
         <form action="{{url('admin/electrician')}}" id="electrician_form" class="form-horizontal" method="post">
         @endif
         {{ csrf_field() }}
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-building font-green"></i>
                        <span class="caption-subject font-green bold uppercase">@if(isset($edit)) Edit Electrician @else Add New Electricain @endif</span>
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
                                    <input type="text" class="form-control" name="e_name" value="{{ isset($electrician) ? $electrician->e_name : old('e_name') }}" autocomplete="e_name" /> </div>
                               @if ($errors->has('e_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('e_name') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group  margin-top-20">
                            <label class="control-label col-md-3">Father Name
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" class="form-control" name="e_f_name" autocomplete="ef_name" value="{{ isset($electrician) ? $electrician->e_f_name : old('e_f_name') }}" /> </div>
                            </div>
                        </div>
                         <div class="form-group  margin-top-20">
                            <label class="control-label col-md-3">Phone 1
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" class="form-control" name="e_phone_1" autocomplete="e_phone_1"  value="{{ isset($electrician) ? $electrician->e_phone_1 : old('e_phone_1') }}" /> </div>
                               @if ($errors->has('e_phone_1'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('e_phone_1') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group  margin-top-20">
                            <label class="control-label col-md-3">Phone 2
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" class="form-control" name="e_phone_2" autocomplete="e_phone_2" value="{{ isset($electrician) ? $electrician->e_phone_2 : old('e_phone_2') }}" /> </div>
                             </div>
                        </div>
                        <div class="form-group  margin-top-20">
                            <label class="control-label col-md-3">Shop Name
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" class="form-control" name="e_shop" autocomplete="e_shop" value="{{ isset($electrician) ? $electrician->e_shop : old('e_shop') }}" /> </div>
                             </div>
                        </div>
                        <div id="location_container">
                             <div class="locations_div">
                                <div class="form-group" id="location_group_1">
                                    <label class="control-label col-md-3">Location
                                        <span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <div class="input-icon right">
                                        <i class="fa"></i>
                                        <input type="text" id="location" name="e_location" value="{{ isset($electrician) ? $electrician->e_location : old('e_location') }}" class="form-control E_location" placeholder="Enter a location" onFocus=""/>
                                        <input type="hidden" class="location_input" name="e_latitude" value="{{ isset($electrician) ? $electrician->e_latitude : old('e_latitude') }}" id="latitude_input" />
                                        <input type="hidden" class="location_input" name="e_longitude" value="{{ isset($electrician) ? $electrician->e_longitude : old('e_longitude') }}" id="longitude_input" />
                                        @if ($errors->has('e_location'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('e_location') }}</strong>
                                </span>
                            @endif
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                       </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Description
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <textarea name="e_description" class="form-control" rows="5" data-error-container="#editor_error">{{ isset($electrician) ? $electrician->e_description : old('e_description') }}</textarea>
                               @if ($errors->has('e_description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('e_description') }}</strong>
                                </span>
                            @endif
                                <div id="editor_error"> </div>
                            </div>
                        </div>
                     </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button  type="submit" name="save" class="btn green">Save</button>
                                <a href="" ><button type="button" class="btn default">Cancel</button></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
</div>
<script>
    $(document).ready(function(){
    $(document).on('keyup','.E_location', function(){
           var l_val = $('#location').val();
            if(l_val == ''){
            $('#location_input').val('');
            }
        });
      });
</script>
    
@endsection