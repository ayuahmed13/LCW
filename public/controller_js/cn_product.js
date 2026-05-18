var base_url = $('#base_url').val();
$(function () {
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + "/admin/product/data-table",
            data: function (d) {
                d.category_id = $('#category_id').val();
                d.sub_category_id = $('#sub_category_id').val();
                d.sub_sub_category_id = $('#sub_sub_category_id').val();
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'category_name', name: 'category_name' },
            { data: 'product_id', name: 'product_id' },
            { data: 'product_name', name: 'product_name' },
            { data: 'price', name: 'price' },
            { data: 'brand_name', name: 'brand_name' },
            { data: 'sku', name: 'sku' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // Reload table when filters change
    $('#filterButton').on('click', function () {
        table.ajax.reload();
    });
});

$('.delete').click(function (e) { 
    let data_id = $(this).attr('data-id');
    let data_table = $(this).attr('data-table');
    if(data_id!=''){
        $.ajax({
            type: "post",
            url: "admin/delete-product-from-cart",
            data: {
                    id:data_id,
                    table:data_table
                },
            dataType: "json",
            success: function (response) {
                
            }
        });
    }
    
});
// var base_url = $('#base_url').val();
// $(function () {
//     var table = $('#data-table').DataTable({
//         processing: true,
//         serverSide: true,
        
//         ajax: base_url + "/admin/product/data-table",
//         columns: [{
//             data: 'DT_RowIndex',
//             name: 'DT_RowIndex'
//         },
//         {
//             data: 'category_name',
//             name: 'category_name'
//         },
//         {
//             data: 'product_id',
//             name: 'product_id'
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
//             data: 'brand_name',
//             name: 'brand_name'
//         },
//         {
//             data: 'sku',
//             name: 'sku'
//         },
//         // {
//         //     data: 'product_main_image',
//         //     name: 'product_main_image'
//         // },
//         {
//             data: 'status',
//             name: 'status',
//             orderable: false,
//             searchable: false
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


