var TableDatatablesAjax = function() {

    var initPickers = function() {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleRecords = function() {
        var grid = new Datatable();

        grid.init({
            src: $("#datatable_ajax"),
            onSuccess: function(grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
            },
            onError: function(grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: {// here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                "language": {
                    "emptyTable": "No record found"
                },
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": $('#base_url').val() + "admin/organization/get_organizations_data", // ajax source
                },
                "order": [
                    [4, "desc"]
                ], // set first column as a default sort by asc
                "aoColumnDefs": [
                    {'sName': 'checkbox', 'bSortable': false, 'aTargets': [0]},
                    {'sName': 'S.No', 'bSortable': false, 'aTargets': [1]},
                    {'sName': 'Logo + Organization Name', 'bSortable': true, 'aTargets': [2]},
                    {'sName': 'Organization Admin', 'bSortable': true, 'aTargets': [3]},
                    {'sName': 'Date', 'bSortable': true, 'aTargets': [4]},
                    {'sName': 'Edit/Delete', 'bSortable': false, 'aTargets': [5]}
                ]
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function(e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        grid.setAjaxParam("customActionType", "group_action");
        grid.getDataTable().ajax.reload();
        grid.clearAjaxParams();
    }

     var handleElectricianRecords = function() {
        var grid = new Datatable();

        grid.init({
            src: $("#electrician_table"),
            onSuccess: function(grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
            },
            onError: function(grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: {// here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                "language": {
                    "emptyTable": "No record found"
                },
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": "../get_electrician_data", // ajax source
                },
                "order": [
                    [4, "desc"]
                ], // set first column as a default sort by asc
                "aoColumnDefs": [
                    {'sName': 'checkbox', 'bSortable': false, 'aTargets': [0]},
                    {'sName': 'S.No', 'bSortable': false, 'aTargets': [1]},
                    {'sName': 'Name', 'bSortable': true, 'aTargets': [2]},
                    {'sName': 'Father Name', 'bSortable': true, 'aTargets': [3]},
                    {'sName': 'Contact', 'bSortable': true, 'aTargets': [4]},
                    {'sName': 'Shop', 'bSortable': true, 'aTargets': [5]},
                    {'sName': 'location', 'bSortable': true, 'aTargets': [6]},
                    {'sName': 'Descriptiom', 'bSortable': true, 'aTargets': [7]},
                    {'sName': 'Edit/Delete', 'bSortable': false, 'aTargets': [8]}
                ]
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function(e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        grid.setAjaxParam("customActionType", "group_action");
        grid.getDataTable().ajax.reload();
        grid.clearAjaxParams();
    }
     var handlePlumberRecords = function() {
        var grid = new Datatable();

        grid.init({
            src: $("#plumber_table"),
            onSuccess: function(grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
            },
            onError: function(grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: {// here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                "language": {
                    "emptyTable": "No record found"
                },
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": "../get_plumber_data", // ajax source
                },
                "order": [
                    [4, "desc"]
                ], // set first column as a default sort by asc
                "aoColumnDefs": [
                    {'sName': 'checkbox', 'bSortable': false, 'aTargets': [0]},
                    {'sName': 'S.No', 'bSortable': false, 'aTargets': [1]},
                    {'sName': 'Name', 'bSortable': true, 'aTargets': [2]},
                    {'sName': 'Father Name', 'bSortable': true, 'aTargets': [3]},
                    {'sName': 'Contact', 'bSortable': true, 'aTargets': [4]},
                    {'sName': 'Shop', 'bSortable': true, 'aTargets': [5]},
                    {'sName': 'location', 'bSortable': true, 'aTargets': [6]},
                    {'sName': 'Descriptiom', 'bSortable': true, 'aTargets': [7]},
                    {'sName': 'Edit/Delete', 'bSortable': false, 'aTargets': [8]}
                ]
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function(e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        grid.setAjaxParam("customActionType", "group_action");
        grid.getDataTable().ajax.reload();
        grid.clearAjaxParams();
    }
     var handlePainterRecords = function() {
        var grid = new Datatable();

        grid.init({
            src: $("#painter_table"),
            onSuccess: function(grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
            },
            onError: function(grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: {// here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                "language": {
                    "emptyTable": "No record found"
                },
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": "../get_painter_data", // ajax source
                },
                "order": [
                    [4, "desc"]
                ], // set first column as a default sort by asc
                "aoColumnDefs": [
                    {'sName': 'checkbox', 'bSortable': false, 'aTargets': [0]},
                    {'sName': 'S.No', 'bSortable': false, 'aTargets': [1]},
                    {'sName': 'Name', 'bSortable': true, 'aTargets': [2]},
                    {'sName': 'Father Name', 'bSortable': true, 'aTargets': [3]},
                    {'sName': 'Contact', 'bSortable': true, 'aTargets': [4]},
                    {'sName': 'Shop', 'bSortable': true, 'aTargets': [5]},
                    {'sName': 'location', 'bSortable': true, 'aTargets': [6]},
                    {'sName': 'Descriptiom', 'bSortable': true, 'aTargets': [7]},
                    {'sName': 'Edit/Delete', 'bSortable': false, 'aTargets': [8]}
                ]
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function(e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        grid.setAjaxParam("customActionType", "group_action");
        grid.getDataTable().ajax.reload();
        grid.clearAjaxParams();
    }
     var handleCarPainterRecords = function() {
        var grid = new Datatable();

        grid.init({
            src: $("#carpainter_table"),
            onSuccess: function(grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
            },
            onError: function(grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: {// here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                "language": {
                    "emptyTable": "No record found"
                },
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": "../get_carpainter_data", // ajax source
                },
                "order": [
                    [4, "desc"]
                ], // set first column as a default sort by asc
                "aoColumnDefs": [
                    {'sName': 'checkbox', 'bSortable': false, 'aTargets': [0]},
                    {'sName': 'S.No', 'bSortable': false, 'aTargets': [1]},
                    {'sName': 'Name', 'bSortable': true, 'aTargets': [2]},
                    {'sName': 'Father Name', 'bSortable': true, 'aTargets': [3]},
                    {'sName': 'Contact', 'bSortable': true, 'aTargets': [4]},
                    {'sName': 'Shop', 'bSortable': true, 'aTargets': [5]},
                    {'sName': 'location', 'bSortable': true, 'aTargets': [6]},
                    {'sName': 'Descriptiom', 'bSortable': true, 'aTargets': [7]},
                    {'sName': 'Edit/Delete', 'bSortable': false, 'aTargets': [8]}
                ]
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function(e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        grid.setAjaxParam("customActionType", "group_action");
        grid.getDataTable().ajax.reload();
        grid.clearAjaxParams();
    }
     var handleMasonsRecords = function() {
        var grid = new Datatable();

        grid.init({
            src: $("#mason_table"),
            onSuccess: function(grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
            },
            onError: function(grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: {// here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                "language": {
                    "emptyTable": "No record found"
                },
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": "../get_mason_data", // ajax source
                },
                "order": [
                    [4, "desc"]
                ], // set first column as a default sort by asc
                "aoColumnDefs": [
                    {'sName': 'checkbox', 'bSortable': false, 'aTargets': [0]},
                    {'sName': 'S.No', 'bSortable': false, 'aTargets': [1]},
                    {'sName': 'Name', 'bSortable': true, 'aTargets': [2]},
                    {'sName': 'Father Name', 'bSortable': true, 'aTargets': [3]},
                    {'sName': 'Contact', 'bSortable': true, 'aTargets': [4]},
                    {'sName': 'location', 'bSortable': true, 'aTargets': [5]},
                    {'sName': 'address', 'bSortable': true, 'aTargets': [6]},
                    {'sName': 'Descriptiom', 'bSortable': true, 'aTargets': [7]},
                    {'sName': 'Edit/Delete', 'bSortable': false, 'aTargets': [8]}
                ]
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function(e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        grid.setAjaxParam("customActionType", "group_action");
        grid.getDataTable().ajax.reload();
        grid.clearAjaxParams();
    }
    var handleLabourRecords = function() {
        var grid = new Datatable();

        grid.init({
            src: $("#labour_table"),
            onSuccess: function(grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
            },
            onError: function(grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: {// here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                "language": {
                    "emptyTable": "No record found"
                },
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": "../get_labour_data", // ajax source
                },
                "order": [
                    [4, "desc"]
                ], // set first column as a default sort by asc
                "aoColumnDefs": [
                    {'sName': 'checkbox', 'bSortable': false, 'aTargets': [0]},
                    {'sName': 'S.No', 'bSortable': false, 'aTargets': [1]},
                    {'sName': 'Name', 'bSortable': true, 'aTargets': [2]},
                    {'sName': 'Father Name', 'bSortable': true, 'aTargets': [3]},
                    {'sName': 'Contact', 'bSortable': true, 'aTargets': [4]},
                    {'sName': 'location', 'bSortable': true, 'aTargets': [5]},
                    {'sName': 'address', 'bSortable': true, 'aTargets': [6]},
                    {'sName': 'Descriptiom', 'bSortable': true, 'aTargets': [7]},
                    {'sName': 'Edit/Delete', 'bSortable': false, 'aTargets': [8]}
                ]
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function(e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        grid.setAjaxParam("customActionType", "group_action");
        grid.getDataTable().ajax.reload();
        grid.clearAjaxParams();
    }
    var handleAcMechanicRecords = function() {
        var grid = new Datatable();

        grid.init({
            src: $("#ac_mechanic_table"),
            onSuccess: function(grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
            },
            onError: function(grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: {// here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                "language": {
                    "emptyTable": "No record found"
                },
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": "../get_ac_mechanic_data", // ajax source
                },
                "order": [
                    [4, "desc"]
                ], // set first column as a default sort by asc
                "aoColumnDefs": [
                    {'sName': 'checkbox', 'bSortable': false, 'aTargets': [0]},
                    {'sName': 'S.No', 'bSortable': false, 'aTargets': [1]},
                    {'sName': 'Name', 'bSortable': true, 'aTargets': [2]},
                    {'sName': 'Father Name', 'bSortable': true, 'aTargets': [3]},
                    {'sName': 'Contact', 'bSortable': true, 'aTargets': [4]},
                    {'sName': 'location', 'bSortable': true, 'aTargets': [5]},
                    {'sName': 'address', 'bSortable': true, 'aTargets': [6]},
                    {'sName': 'Descriptiom', 'bSortable': true, 'aTargets': [7]},
                    {'sName': 'Edit/Delete', 'bSortable': false, 'aTargets': [8]}
                ]
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function(e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        grid.setAjaxParam("customActionType", "group_action");
        grid.getDataTable().ajax.reload();
        grid.clearAjaxParams();
    }

    return {
        //main function to initiate the module
        init: function() {

            initPickers();
            handleElectricianRecords();
            handlePlumberRecords();
            handlePainterRecords();
            handleCarPainterRecords();
            handleMasonsRecords();
            handleLabourRecords();
            handleAcMechanicRecords();
        }
};
}();

jQuery(document).ready(function() {
    TableDatatablesAjax.init();
});