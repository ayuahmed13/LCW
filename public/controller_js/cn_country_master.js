
var base_url = $('#base_url').val();
$(function () {
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        
        ajax: base_url + "/admin/country-master/data-table",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'country_name',
            name: 'country_name'
        },
        {
            data: 'country_code',
            name: 'country_code'
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

$(document).ready(function() {
    $.validator.addMethod("countryCode", function (value, element) {
        return this.optional(element) || /^\+([1-9][0-9]{0,2})$/.test(value);
    }, "Please enter a number between +1 and +999");
        // Initialize form validation
        $("#countryForm").validate({
            rules: {
                country_name: {
                    required: true,
                    minlength: 2,
                    remote: {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'get',
                            url: base_url + '/admin/country-master/check-country-exist',
                            data: {
                                country_name: function() {
                                    return $("#country_name").val(); // Get the value of country_name field
                                },
                                id: function () {
                                    return $('#id').val()
                                }
                            },
                            dataType: 'json'
                        }
                    
                },
                country_code: {
                    required: true,
                    //minlength: 1,
                    countryCode : true,
                    remote: {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'get',
                            url: base_url + '/admin/country-master/check-country-code-exist',
                            data: {
                                country_code: function() {
                                    return $("#country_code").val(); // Get the value of country_name field
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
                country_name: {
                    required: "Please enter a country name.",
                    minlength: "Country name should be at least 2 characters long.",
                    remote:'Country name already exists.'
                },
                country_code: {
                    required: "Please enter a country code.",
                    minlength: "Country code should be at least 2 characters long.",
                    remote:'Country code already exists.'
                },
     
            },
            errorClass: "text-danger", // Adding a class to the error messages
            submitHandler: function(form) {
                $("#btn-submit").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
                form.submit(); // Proceed with form submission
            }
        });

        // Custom method to check the file size
        $.validator.addMethod("filesize", function(value, element, param) {
            return this.optional(element) || (element.files[0].size <= param);
        }, "File size must be less than 500KB.");
});
