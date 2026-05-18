var base_url = $('#base_url').val();
$(function () {
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        
        ajax: base_url + "/admin/customers/data-table",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'created_at',
            name: 'created_at'
        },
        {
            data: 'customer_id',
            name: 'customer_id'
        },
        {
            data: 'full_name',
            name: 'full_name',
            
        },
        {
            data: 'email',
            name: 'email',
           
        },
        {
            data: 'phone_no',
            name: 'phone_no',
          
        },
        {
            data: 'country_name',
            name: 'country_name',
            
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

$(document).on('click', '.btn-view-customer', function () { 
    //editPopup

    $('#modalName').html($(this).attr('data-name'));
    $('#modalMobile').html($(this).attr('data-phone'));
    $('#modalEmail').html($(this).attr('data-email'));
    $('#modalCustomerId').html($(this).attr('data-customer-id'));
    $('#modalRegDate').html($(this).attr('data-created-at'));
    $('#modalImage').attr('src',$(this).attr('data-profile-image'));
    $('#totalOrders').html($(this).attr('data-order-count'));

    $('#editPopup').modal('show'); 
});