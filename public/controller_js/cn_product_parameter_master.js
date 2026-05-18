var base_url = $('#base_url').val();
$(function () {
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        
        ajax: base_url + "/admin/product-parameter-master/data-table",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'product_parameter_name',
            name: 'product_parameter_name'
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
    };
});

$(document).ready(function() {
    
        // Initialize form validation
        $("#productparameterForm").validate({
            rules: {
                product_parameter_name: {
                    required: true,
                
                    remote: {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'get',
                            url: base_url + '/admin/product-parameter-master/check-product-parameter-exist',
                            data: {
                                product_parameter_name: function() {
                                    return $("#product_parameter_name").val(); // Get the value of product_parameter_name field
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
                product_parameter_name: {
                    required: "Please enter a parameter name.",
                    remote:'Parameter name already exists.'
                },
               
     
            },
            errorClass: "text-danger", // Adding a class to the error messages
            submitHandler: function(form) {
                $("#btn-submit").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
                form.submit(); // Proceed with form submission
            }
        });

});
