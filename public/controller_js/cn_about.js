var base_url = $('#base_url').val();
$(function () {
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        
        ajax: base_url + "/admin/about/data-table",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'heading',
            name: 'heading'
        },
        {
            data: 'description',
            name: 'description'
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
    $('#aboutForm').validate({
        rules: {
            heading: {
                required: true,
                maxlength: 255
            },
            about_lcw: {
                required: true
            },
            our_vision: {
                required: true
            },
            our_mission: {
                required: true
            },
            image: {
                required: $('#old_image').val()?false:true,
                //filesize:1024
                //extension: "jpg|jpeg|png|gif"
            }
        },
        messages: {
            heading: {
                required: "Please enter the heading",
                maxlength: "Heading cannot exceed 255 characters"
            },
            about_lcw: "Please enter the About LCW text",
            our_vision: "Please enter the vision",
            our_mission: "Please enter the mission",
            image: {
                required: "Please upload an image",
                //extension: "Only image files (jpg, jpeg, png, gif) are allowed"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('text-danger');
            element.closest('.form-group, .mb-2').append(error);
        },
        submitHandler: function(form) {
            $("#btn-submit").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
            form.submit(); // Proceed with form submission
        }
    });

    // Custom method to check the file size
    $.validator.addMethod("filesize", function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, "File size must be less than 1MB.");

    $('#testimonialsForm').validate({
        ignore: [], // To validate summernote textarea
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            heading: {
                required: true,
                //maxlength: 255
            },
            description: {
                required: function() {
                    // Validate content of Summernote
                    return $('#description').summernote('isEmpty');
                }
            },
            star_rating: {
                required: true,
                maxlength: 1,
                minlength:1,
            },
        },
        messages: {
            name: {
                required: "Please enter a name",
                maxlength: "Name cannot exceed 255 characters"
            },
            heading: {
                required: "Please enter a heading",
                //maxlength: "Heading cannot exceed 255 characters"
            },
            description: {
                required: "Please enter the description"
            },
            star_rating: {
                required: "Please enter star ratint between 1 to 5"
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
       
        submitHandler: function(form) {
            $("#btn-submit-1").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
            form.submit(); // Proceed with form submission
        }
    });
});
