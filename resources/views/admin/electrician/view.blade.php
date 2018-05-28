@extends('admin.layouts.app')

@section('content')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{ asset('global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" rel="stylesheet" type="text/css" />        
<script src="{{ asset('global/scripts/datatable.min.js') }}" ></script>
<script src="{{ asset('global/plugins/datatables/datatables.min.js') }}" ></script>
<script src="{{ asset('global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" ></script>
<script src="{{ asset('global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" ></script>
<script src="{{ asset('pages/scripts/table-datatables-ajax.js') }}" ></script>
<script src="{{ asset('global/plugins/bootbox.min.js') }}" ></script>
<script src="{{ asset('pages/scripts/ui-bootbox.js') }}" ></script>
<!-- END PAGE LEVEL SCRIPTS -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="">Company Management</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="">
                   
                </div>
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">Electrician Management</span>
                        </div>
                        <div class="actions">
                            <a class="btn btn-sm green table-group-action-submit" href=""> Add New Electrician</a>
                            <a style="" class="btn red disabled btnMultiDelete btn-sm">Delete</a>
                            <div id="datatable_ajax_tools">
                            </div> 
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover table-checkable" id="electrician_table">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width=""><input type="checkbox" class="group-checkable2" id="gropu" data-set=".checkboxes2" /></th>
                                        <th width=""> Sr. </th>
                                        <th width=""> Name </th>
                                        <th width="">Father Name</th>
                                        <th width="">Contact</th>
                                        <th width="">Shop Name</th>
                                        <th width="">location</th>
                                        <th width="">Description</th>
                                        <th width="">Actions</th>
                                    </tr>
<!--                                    <tr role="row" class="filter">
                                        <td>
                                        </td>    
                                        <td>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="e_name"> </td>

                                        <td>
                                          <input type="text" class="form-control form-filter input-sm" name="e_father"> </td>

                                        </td>
                                        <td>
                                            <span class="table_button table_search_button filter-submit margin-bottom">
                                                <i class="fa fa-search"></i> </span>
                                            <span class="table_button table_refresh_button filter-cancel">
                                                <i class="fa fa-refresh"></i> </span>
                                        </td>
                                    </tr>-->
                                </thead>
                                <tbody> </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#electrician_table').find('.group-checkable2').change(function() {

            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function() {
                if (checked) {
                    $(this).prop("checked", true);
                    $(this).parents('tr').addClass("active");
                    $('.btnMultiDelete').removeClass('disabled');
                } else {
                    $(this).prop("checked", false);
                    $(this).parents('tr').removeClass("active");
                    $('.btnMultiDelete').addClass('disabled');
                }
            });
            jQuery.uniform.update(set);
        });
        $('#electrician_table').on('click', 'tr .checkboxes2', function() {

            if ($(this).is(':checked')) {

                $(this).parents('tr').addClass("active");
            } else {

                $(this).parents('tr').removeClass("active");
            }

            var checkedVals = $('.checkboxes2:checkbox:checked').map(function() {
                return this.value;
            }).get();

            if (checkedVals.length > 0 && $('#staffDatatable tbody tr').length == checkedVals.length) {

                $('.group-checkable2').prop("checked", true);
                $('.group-checkable2').parent().addClass('checked');
                $('.btnMultiDelete').removeClass('disabled');
            } else if (checkedVals.length > 0) {

                $('.btnMultiDelete').removeClass('disabled');
            } else {

                $('.group-checkable2').prop("checked", false);
                $('.group-checkable2').parent().removeClass('checked');
                $('.btnMultiDelete').addClass('disabled');
            }
        });

        $(document).ajaxComplete(function() {

            $('.group-checkable2').prop("checked", false);
            $('.group-checkable2').parent().removeClass('checked');
            $("input:checkbox").uniform();
        });

    });
    $('#dept_table').keypress(function(e) {
        var code = e.keyCode || e.which;

        if (code === 13) {
            e.preventDefault();
            $(".filter-submit").click();
        }
        ;
    });

    //Delete Multi
    $(document).on('click', '.btnMultiDelete', function() {
        bootbox.confirm("<h4>Confirmation!</h4>Are you sure to delete selected companies?", function(result) {
            if (result == true) {

                var checkedValues = $('input:checkbox:checked').map(function() {
                    return this.value;
                }).get();
                if (checkedValues != undefined && checkedValues != '')
                    $.post($('#base_url').val() + "admin/company/delete_company_multiple", {ids: checkedValues}, function(data) {
                        location.reload();
                    });
            }
        });
    });
</script>
@endsection