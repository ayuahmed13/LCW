var base_url = $('#base_url').val();
// $(function () {
//     var table = $('#data-table').DataTable({
//         processing: true,
//         serverSide: true,
        
//         ajax: base_url + "/admin/stock/data-table",
//         columns: [{
//             data: 'DT_RowIndex',
//             name: 'DT_RowIndex'
//         },
//         {
//             data: 'product_id',
//             name: 'product_id'
//         },
//         {
//             data: 'category_name',
//             name: 'category_name'
//         },
//         {
//             data: 'sub_category_name',
//             name: 'sub_category_name'
//         },
//         {
//             data: 'sub_sub_category_name',
//             name: 'sub_sub_category_name'
//         },
//         {
//             data: 'product_name',
//             name: 'product_name'
//         },
//         {
//             data: 'price',
//             name: 'price'
//         },
//         {
//             data: 'offer_price',
//             name: 'offer_price'
//         },
//         {
//             data: 'current_stock',
//             name: 'current_stock'
//         },
//         {
//             data: 'stock_remark',
//             name: 'stock_remark'
//         },
//         {
//             data: 'is_available',
//             name: 'is_available'
//         },
//         {
//             data: 'action',
//             name: 'action',
//             orderable: false,
//             searchable: false
//         }]
//     });

//     function reload_table() {
//         table.DataTable().ajax.reload(null, false);
//     }
// });


// Filter

var table = $('#data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: base_url + "/admin/stock/data-table",
        data: function (d) {
            d.category_id = $('#category_id').val();
            d.sub_category_id = $('#sub_category_id').val();
            d.sub_sub_category_id = $('#sub_sub_category_id').val();
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'product_id', name: 'product_id' },
        { data: 'category_name', name: 'category_name' },
        { data: 'sub_category_name', name: 'sub_category_name' },
        { data: 'sub_sub_category_name', name: 'sub_sub_category_name' },
        { data: 'product_name', name: 'product_name' },
        { data: 'price', name: 'price' },
        { data: 'offer_price', name: 'offer_price' },
        { data: 'current_stock', name: 'current_stock' },
        { data: 'stock_remark', name: 'stock_remark' },
        { data: 'is_available', name: 'is_available' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
});

$('#filterButton').on('click', function () {
    table.ajax.reload();
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

$(document).on('click', '.btn-edit-stock', function () { 
    //editPopup
    
    $('#product_id').html($(this).attr('data-product-id'));
    $('#product_name').html($(this).attr('data-product-name'));
    $('#category_name').html($(this).attr('data-category-name'));
    $('#sub_category_name').html($(this).attr('data-sub-category-name'));
    var tmp_img = $(this).attr('data-product-main-image');
    if(tmp_img!=''){
        $('#product_image').attr('src',$(this).attr('data-product-main-image'));
    }
    
    $('#id').val($(this).attr('data-id'));
    $('#is_available').val($(this).attr('data-is-available'));
    $('#current_stock').val($(this).attr('data-current-stock'));

    $('#editPopup').modal('show'); 
});


$(document).ready(function () {
    $('#stocktForm').validate({
        rules: {
            is_available: {
                required: true
            },
            current_stock: {
                required: true,
                number: true,
                min: 0
            },
            stock_remark: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            is_available: {
                required: "Please select availability status"
            },
            current_stock: {
                required: "Please enter the current stock",
                number: "Stock must be a number",
                min: "Stock cannot be negative"
            },
            stock_remark: {
                required: "Please enter a remark",
                minlength: "Remark must be at least 5 characters long"
            }
        },
        errorElement: 'div',
        errorClass: 'text-danger',
        submitHandler: function(form) {
            $("#btn-submit").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
            form.submit(); // Proceed with form submission
        }
        
    });
});
