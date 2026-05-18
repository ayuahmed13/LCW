var base_url = $('#base_url').val();
$(function () {
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        
        ajax: base_url + "/admin/gst-master/data-table",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'gst_value',
            name: 'gst_value'
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
        $("#gstForm").validate({
            rules: {
                gst_value: {
                    required: true,
                    min:1,
                    max:100,
                    remote: {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'get',
                            url: base_url + '/admin/gst-master/check-gst-exist',
                            data: {
                                gst_value: function() {
                                    return $("#gst_value").val(); // Get the value of country_name field
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
                gst_value: {
                    required: "Please enter value between 0 to 100.",
                    remote:'GST value already exists.'
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
