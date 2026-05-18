var base_url = $('#base_url').val();
$(function () {
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        
        ajax: base_url + "/admin/faq/data-table",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'question',
            name: 'question'
        },
        {
            data: 'answer',
            name: 'answer'
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
$(document).ready(function () {
    $('#answer').summernote({
        height: 150
    });

    // jQuery Validate
    $('#faqForm').validate({
        ignore: [], // Important to validate summernote
        rules: {
            question: {
                required: true,
            },
            answer: {
                required: function () {
                    return $('#answer').summernote('isEmpty');
                }
            }
        },
        messages: {
            question: {
                required: "Please enter the question",
            },
            answer: {
                required: "Please enter the answer"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('text-danger');
            if (element.hasClass('summernote')) {
                element.next('.note-editor').after(error);
            } else {
                element.closest('.form-group, .mb-2').append(error);
            }
        },
        submitHandler: function (form) {
            // Optional: Disable the button to prevent double submit
            $('#btn-submit').prop('disabled', true).text('Please wait...');
            form.submit();
        }
       
    });
});
