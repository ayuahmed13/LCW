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

$('#sub_category_id').change(function (e) { 
    var sub_category_id = $('#sub_category_id').val();
    if(sub_category_id!=''){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type: "post",
            url: base_url + "/admin/sub-sub-category-master/get-sub-sub-category-by-sub-category-id",
            data: {sub_category_id:sub_category_id},
            dataType: "html",
            beforeSend: function () {
                $('#sub_sub_category_id').html('<option>Loading...</option>');
            },
            success: function (response) {
                $('#sub_sub_category_id').html(response);
            }
        });
    }
});
var base_url = $('#base_url').val();
function generateSlug(text) {
    return text
        .toString()
        .toLowerCase()
        .trim()
        .replace(/\s+/g, '-')       // Replace spaces with -
        .replace(/[^\w\-]+/g, '')   // Remove all non-word chars
        .replace(/\-\-+/g, '-');    // Replace multiple - with single -
}

$('#product_name').on('change keyup paste', function() {
    let title = $(this).val();
    let slug = generateSlug(title);
    $('#slug_url').val(slug);
});


    $(document).ready(function () {
         jQuery.validator.addMethod("is_decimal", function(value, element) {
    return this.optional(element) || /^(\d+|\d+\.\d+)$/.test(value);
  }, "Please enter a valid number (integer or decimal).");

   $.validator.addMethod("lessThanPrice", function(value, element) {
        let price = parseFloat($("#price").val());
        let offerPrice = parseFloat(value);

        // Check if both values are valid numbers
        if (isNaN(price) || isNaN(offerPrice)) return true;

        return offerPrice < price;
    }, "Offer price must be less than the original price");

        $('#productForm').validate({
            rules: {
                category_id: { required: true },
                //sub_category_id: { required: true },
                //sub_sub_category_id: { required: true },
                brand_id: { required: true },
                product_name: { required: true },
                slug_url: { 
                    required: true,
                    remote: {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'get',
                            url: base_url + '/admin/product/check-slug-exist',
                            data: {
                                slug_url: function() {
                                    return $("#slug_url").val(); // Get the value of country_name field
                                },
                                id: function () {
                                    return $('#id').val();
                                }
                            },
                            dataType: 'json'
                        }
                },
                sku: { required: true },
                price: {
                    required: true,
                    is_decimal: true,
                    maxlength:10
                },
                offer_price: {
                    is_decimal: true,
                    maxlength:10,
                    lessThanPrice:true
                },
                // is_gst: { required: true },
                // gst_id: {
                //     required: function () {
                //         return $('#gstCheckbox').is(':checked');
                //     }
                // },
                short_description: { required: true },
                
                //description: { required: true },
                //specification: { required: true },
                // meta_title: { required: true },
                // meta_keywords: { required: true },
                // meta_description: { required: true },
                product_main_image: {
                   required: $('#old_product_main_image').val()?false:true
                },
                download_file: {
                    required:false
                    //extension: "pdf"
                },
                description_image: {
                    required:false
                    //extension: "jpg|jpeg|png|webp"
                }
            },
            messages: {
                category_id: "Please select a category",
                sub_category_id: "Please select a sub category",
                sub_sub_category_id: "Please select a sub sub category",
                brand_id: "Please select a brand",
                product_name: "Enter product name",
                slug_url: {
                    required: "Enter slug url",
                    remote: "Slug url already exists"
                },
                sku: "Enter SKU",
                price: {
                    required: "Enter the price",
                    number: "Enter a valid number"
                },
                offer_price: {
                    required: "Enter the offer price",
                    number: "Enter a valid number"
                },
                gst_id: "Please select GST percentage",
                description: "Please enter description",
                specification: "Please enter specifications",
                meta_title: "Please enter meta title",
                meta_keywords: "Please enter meta keywords",
                meta_description: "Please enter meta description",
                product_main_image: {
                    required: "Please upload a product image",
                    extension: "Only image files are allowed (jpg, jpeg, png, webp)"
                },
                download_file: {
                    extension: "Only PDF files are allowed"
                },
                description_image: {
                    extension: "Only image files are allowed (jpg, jpeg, png, webp)"
                }
            },
            errorElement: 'label',
            errorClass: 'text-danger',
            
            submitHandler: function (form) {
                // Optional: Disable the button to prevent double submit
                $('#btn-submit').prop('disabled', true).text('Please wait...');
                form.submit();
            }
        });
    });

    $('#category_a').change(function (e) { 
        var category_id = $('#category_a').val();
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
                    $('#sub_category_a').html('<option>Loading...</option>');
                },
                success: function (response) {
                    $('#sub_category_a').html(response);
                }
            });
        }
    });
    
    $('#sub_category_a').change(function (e) { 
        var sub_category_id = $('#sub_category_a').val();
        if(sub_category_id!=''){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: "post",
                url: base_url + "/admin/sub-sub-category-master/get-sub-sub-category-by-sub-category-id",
                data: {sub_category_id:sub_category_id},
                dataType: "html",
                beforeSend: function () {
                    $('#sub_sub_category_a').html('<option>Loading...</option>');
                },
                success: function (response) {
                    $('#sub_sub_category_a').html(response);
                }
            });
        }
    });

    var base_url = $('#base_url').val();
    var table;
    
    $(function () {
        // Initialize the DataTable without AJAX at first
        table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: base_url + "/admin/product/data-table-extra-tab",
                data: function (d) {
                    d.category_id = $('#category_a').val();
                    d.sub_category_id = $('#sub_category_a').val();
                    d.sub_sub_category_id = $('#sub_sub_category_a').val();
                },
                // Prevent auto loading
                dataSrc: function (json) {
                    if (!$('#filterButton').data('clicked')) {
                        return []; // Return empty data on initial load
                    }
                    return json.data;
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
                { data: 'pid', name: 'pid',orderable: false, searchable: false },
                { data: 'product_id', name: 'product_id' },
                { data: 'product_name', name: 'product_name' },
                { data: 'sku', name: 'sku' },
                { data: 'price', name: 'price' },
                { data: 'offer_price', name: 'offer_price' },
            ]
        });
    
        // On filter button click, flag it and reload
        $('#filterButton').on('click', function () {
            $(this).data('clicked', true);
            table.ajax.reload();
        });
    });
    
    $('#selectAll').click(function (e) {
        if ($(this).is(':checked')) {
            $('.row_checkbox').prop('checked', true);
        } else {
            $('.row_checkbox').prop('checked', false);
        }
    });

    $('body').on('.row_checkbox','click', function () {
        // If any checkbox is unchecked, uncheck "Select All"
        if (!$(this).is(':checked')) {
            $('#selectAll').prop('checked', false);
        } else {
            // If all checkboxes are checked, check "Select All"
            if ($('.row_checkbox:checked').length === $('.row_checkbox').length) {
                $('#selectAll').prop('checked', true);
            }
        }
    });

    $('#filterButton').click(function (e) { 
        var category_id = $('#category_a').val();
        var sub_category_id = $('#sub_category_a').val();
        var sub_sub_category_id = $('#sub_sub_category_a').val();
        var controller_product_ids = $('#controller_product_ids').val();;
        if(category_id!=''){
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "get",
                url: base_url + "/admin/product/data-table-extra-tab",
                data: {
                    category_id:category_id,
                    sub_category_id:sub_category_id,
                    sub_sub_category_id:sub_sub_category_id,
                    controller_product_ids:controller_product_ids
                },
                dataType: "json",
                success: function (response) {
                   $('#tbody').html(response.data) 
                }
            });
        }else{
            toastr.error('Please select category to apply filter');
        }
        
    });