var base_url = $('#base_url').val();

function getQueryParam(param) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

$(function () {
    var order_status = getQueryParam('order_status'); // Get from URL

    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + "/admin/orders/data-table",
            type: 'GET',
            data: function (d) {
                d.order_status = order_status;
                d.from_date = $('#from_date').val();
                d.to_date = $('#to_date').val();
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'order_id', name: 'order_id' },
            { data: 'created_at', name: 'created_at' },
            { data: 'full_name', name: 'full_name' },
            { data: 'phone_no', name: 'phone_no' },
            { data: 'total_amount', name: 'total_amount' },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });

    // 🔍 Filter button click
    $('#filterButton').on('click', function () {
        table.ajax.reload();
    });

    // Optional: Manual reload function
    function reload_table() {
        table.ajax.reload(null, false);
    }
});

$('#to_date').change(function () { 
    let from_date = $('#from_date').val();
    let to_date = $('#to_date').val();

    if (from_date === '') {
        $('#from_date').val(to_date);
    }
});

// $('#from_date').change(function () { 
//     let from_date = $('#from_date').val();
    
//     if (from_date !== '') {
//         $('#to_date').attr('min', from_date);
//     }
// });
