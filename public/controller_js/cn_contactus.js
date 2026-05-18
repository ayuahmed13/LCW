var base_url = $('#base_url').val();

var table = $('#data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: base_url + "/admin/contact/data-table",
        data: function (d) {
            d.from_date = $('#from_date').val();
            d.to_date = $('#to_date').val();
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'created_at', name: 'created_at' },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'mobile', name: 'mobile' },
        { data: 'subject', name: 'subject' },
        { data: 'message', name: 'price' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
});

$('#filterButton').on('click', function () {
    table.ajax.reload();
});