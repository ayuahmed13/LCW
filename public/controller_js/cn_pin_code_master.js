var base_url = $('#base_url').val();
$(function () {
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        
        ajax: base_url + "/admin/pin-code-master/data-table",
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
            data: 'city_name',
            name: 'city_name'
        },
        {
            data: 'pin_codes',
            name: 'pin_codes'
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
});
$('#country_id').change(function (e) { 
    var country_id = $('#country_id').val();
    if(country_id!=''){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type: "post",
            url: base_url + "/admin/city-master/get-state-by-country-id",
            data: {country_id:country_id},
            dataType: "html",
            beforeSend: function () {
                $('#state_id').html('<option>Loading...</option>');
            },
            success: function (response) {
                $('#state_id').html(response);
            }
        });
    }
});

$(document).ready(function() {
    // Initialize form validation
    $("#pincodeForm").validate({
        rules: {
            country_id: {
                required: true,
            },
            state_id: {
                required: true,
            },
            city_id: {
                required: true,
                remote: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'get',
                        url: base_url + '/admin/pin-code-master/check-city-pin-codes-exist',
                        data: {
                            city_id: function() {
                                return $("#city_id").val(); // Get the value of state_name field
                            },
                            country_id: function() {
                                return $("#country_id").val(); // Get the value of state_name field
                            },
                            state_id: function() {
                                return $("#state_id").val(); // Get the value of state_name field
                            },
                            id: function () {
                                return $('#id').val()
                            }
                        },
                        dataType: 'json'
                    }
                
            },
            pin_codes: {
                required: true,
            },
        },
        messages: {
            pin_codes: {
                required: "Please enter a pincodes (eg. 123456,654321,...).",
            },
            country_id: {
                required: "Please select country.",
            },
            state_id: {
                required: "Please select state.",
            },
            city_id: {
                required: "Please select city.",
                remote:"City Pin Codes  Already Exists"
            },
 
        },
        errorClass: "text-danger", // Adding a class to the error messages
        submitHandler: function(form) {
            $("#btn-submit").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
            form.submit(); // Proceed with form submission
        }
    });

});

$('#country_id').change(function (e) { 
    var country_id = $('#country_id').val();
    if(country_id!=''){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type: "post",
            url: base_url + "/admin/city-master/get-state-by-country-id",
            data: {country_id:country_id},
            dataType: "html",
            beforeSend: function () {
                $('#state_id').html('<option>Loading...</option>');
            },
            success: function (response) {
                $('#state_id').html(response);
            }
        });
    }
});

$('#state_id').change(function (e) { 
    var state_id = $('#state_id').val();
    if(state_id!=''){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type: "post",
            url: base_url + "/admin/pin-code-master/get-city-by-state-id",
            data: {state_id:state_id},
            dataType: "html",
            beforeSend: function () {
                $('#city_id').html('<option>Loading...</option>');
            },
            success: function (response) {
                $('#city_id').html(response);
            }
        });
    }
});