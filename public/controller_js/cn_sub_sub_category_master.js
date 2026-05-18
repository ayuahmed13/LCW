var base_url = $('#base_url').val();
$(function () {
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        
        ajax: base_url + "/admin/sub-sub-category-master/data-table",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'category_name',
            name: 'category_name'
        },
        {
            data: 'sub_category_name',
            name: 'sub_category_name'
        },
        {
            data: 'sub_sub_category_name',
            name: 'sub_sub_category_name'
        },
        {
            data: 'sub_sub_category_image',
            name: 'sub_sub_category_image'
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
        $("#subsubcategoryForm").validate({
            rules: {
                category_id: {
                    required: true,
                },
                sub_category_id: {
                    required: true,
                },
                sub_sub_category_name: {
                    required: true,
                    remote: {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'get',
                            url: base_url + '/admin/sub-sub-category-master/check-sub-sub-category-exist',
                            data: {
                                sub_category_name: function() {
                                    return $("#sub_category_name").val(); // Get the value of country_name field
                                },
                                category_id: function () {
                                    return $('#category_id').val()
                                },
                                sub_category_id: function () {
                                    return $('#sub_category_id').val()
                                },
                                id: function () {
                                    return $('#id').val()
                                }
                            },
                            dataType: 'json'
                        }
                    
                },
                sub_sub_category_image: {
                    required: $('#old_image').val()?false:true,
                },
            },
            messages: {
                category_id: {
                    required: "Please select category.",
                   
                },
                sub_category_id: {
                    required: "Please select sub category.",
                   
                },
                sub_sub_category_name: {
                    required: "Please enter a sub sub category name.",
                    remote:'Sub category name already exists.'
                },
                sub_sub_category_image: {
                    required: "Please select File.",
                   
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

$('#category_id').change(function (e) { 
    var category_id = $('#category_id').val();
    if(category_id!=''){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type: "post",
            url: base_url + "/admin/sub-sub-category-master/get-sub-category-by-category-id",
            data: {category_id:category_id},
            dataType: "html",
            beforeSend: function () {
                $('#sub_category_id').html('<option>Loading...</option>');
            },
            success: function (response) {
                $('#sub_category_id').html(response);
            }
        });
    }
});