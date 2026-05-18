var base_url = $('#base_url').val();
$(function () {
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        
        ajax: base_url + "/admin/category-master/data-table",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'category_name',
            name: 'category_name'
        },
        {
            data: 'category_image',
            name: 'category_image'
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
   
        // Initialize form validation
        $("#categoryForm").validate({
            rules: {
                category_name: {
                    required: true,
                    remote: {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'get',
                            url: base_url + '/admin/category-master/check-category-exist',
                            data: {
                                category_name: function() {
                                    return $("#category_name").val(); // Get the value of country_name field
                                },
                                id: function () {
                                    return $('#id').val()
                                }
                            },
                            dataType: 'json'
                        }
                    
                },
                category_image: {
                    required: $('#old_image').val()?false:true,
                },
            },
            messages: {
                category_name: {
                    required: "Please enter a category name.",
                    remote:'category name already exists.'
                },
                category_image: {
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

        $.validator.addMethod("filetype", function(value, element, param) {
            if (this.optional(element)) return true;
            const allowedTypes = param.split(','); // e.g., "jpg,png,pdf"
            const fileType = element.files[0].name.split('.').pop().toLowerCase();
            return allowedTypes.includes(fileType);
        }, "Invalid file type.");
});
