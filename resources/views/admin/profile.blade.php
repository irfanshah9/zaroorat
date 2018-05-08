@extends('admin.layouts.app')

@section('content')
 <link href="{{ asset('global/css/components-rounded.min.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages/scripts/form-validation.js') }}" type="text/javascript"></script>
 <div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="#">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Profile</span>
                </li>
            </ul>
        </div>
        <h3 class="page-title">
            Profile
        </h3>
        <div class="portlet light portlet-fit portlet-form bordered">
            <div class="portlet-body">
                @if ($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
@endif
                <form action="{{route('profile.update',$user)}}" id="form_change_password"  class="form-horizontal" method="post" autocomplete="off">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
                    <div class="form-body">
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                        <div class="form-group  margin-top-20">
                            <label class="control-label col-md-3">Name
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"> </div>
                            </div>
                        </div>
                        <div class="form-group  margin-top-20">
                            <label class="control-label col-md-3">Email
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" /> </div>
                            </div>
                        </div>
                        <div class="form-group  margin-top-20">
                            <label class="control-label col-md-3">Password
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="password" id="password" class="form-control" name="password" value="" /> </div>
                            </div>
                        </div>
                        <div class="form-group  margin-top-20">
                            <label class="control-label col-md-3">Confirm Password
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="password" class="form-control" name="confirm_password" value="" /> </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">Update</button>
                                <a href="{{ URL::route('dashboard') }}" ><button type="button" class="btn default">Cancel</button></a>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection