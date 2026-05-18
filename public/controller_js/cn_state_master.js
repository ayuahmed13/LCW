var base_url = $('#base_url').val();
$(function () {
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        
        ajax: base_url + "/admin/state-master/data-table",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'country_name',
            name: 'country_name'
        },
        {
            data: 'state_name',
            name: 'state_name'
        },
        {
            data: 'status',
            name: 'status',
            orderable: false,
            searchable: false
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        }]
    });

    function reload_table() {
        table.DataTable().ajax.reload(null, false);
    }
})

$(document).ready(function() {
        // Initialize form validation
        $("#stateForm").validate({
            rules: {
                country_id: {
                    required: true,
                },
                state_name: {
                    required: true,
                    minlength: 2,
                    remote: {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'get',
                            url: base_url + '/admin/state-master/check-state-exist',
                            data: {
                                state_name: function() {
                                    return $("#state_name").val(); // Get the value of state_name field
                                },
                                country_id: function() {
                                    return $("#country_id").val(); // Get the value of state_name field
                                },
                                id: function () {
                                    return $('#id').val()
                                }
                            },
                            dataType: 'json'
                        }
                    
                },
               
     
            },
            messages: {
                state_name: {
                    required: "Please enter a State name.",
                    minlength: "State name should be at least 2 characters long.",
                    remote:'State name already exists.'
                },
                country_id: {
                    required: "Please select country.",
                },
     
            },
            errorClass: "text-danger", // Adding a class to the error messages
            submitHandler: function(form) {
                $("#btn-submit").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
                form.submit(); // Proceed with form submission
            }
        });

});
