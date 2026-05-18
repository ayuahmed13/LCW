var base_url = $('#base_url').val();
$(function () {
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        
        ajax: base_url + "/admin/brands-master/data-table",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'brand_name',
            name: 'brand_name'
        },
        {
            data: 'brand_image',
            name: 'brand_image'
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
        $("#brandForm").validate({
            rules: {
                brand_name: {
                    required: true,
                    remote: {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'get',
                            url: base_url + '/admin/brands-master/check-brands-exist',
                            data: {
                                brand_name: function() {
                                    return $("#brand_name").val(); // Get the value of country_name field
                                },
                                id: function () {
                                    return $('#id').val()
                                }
                            },
                            dataType: 'json'
                        }
                    
                },
                brand_image: {
                    required: $('#old_image').val()?false:true,
                },
            },
            messages: {
                brand_name: {
                    required: "Please enter a brand name.",
                    remote:'Brand name already exists.'
                },
                brand_image: {
                    required: "Please select file.",
                   
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
