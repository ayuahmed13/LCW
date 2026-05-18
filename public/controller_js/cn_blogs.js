var base_url = $('#base_url').val();
$(function () {
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        
        ajax: base_url + "/admin/blogs/data-table",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'blog_image',
            name: 'blog_image'
        },
        {
            data: 'heading',
            name: 'heading'
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
