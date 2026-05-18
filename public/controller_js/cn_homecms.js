$(document).ready(function () {

    $.validator.addMethod("filesize", function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, "File size must be less than too large.");

    $.validator.addMethod("filetype", function(value, element, param) {
        if (this.optional(element)) return true;
        const allowedTypes = param.split(','); // e.g., "jpg,png,pdf"
        const fileType = element.files[0].name.split('.').pop().toLowerCase();
        return allowedTypes.includes(fileType);
    }, "Invalid file type.");

    $("#homeForm1").validate({
        rules: {
            section1_heading1: {
                required: true,
                maxlength: 255
            },
            section1_sub_heading1: {
                required: true,
                maxlength: 500
            },
            section1_button_name1: {
                required: true,
                maxlength: 100
            },
            section1_button_url1: {
                required: true,
                url: true
            },
            // section1_image1: {
            //     required: function(element) {
            //         return $('#section1_old_image1').val() === '';
            //     },
            //     //extension: "jpg|jpeg|png|webp"
            // } 
        },
        messages: {
            section1_heading1: {
                required: "Heading is required",
                maxlength: "Maximum 255 characters allowed"
            },
            section1_sub_heading1: {
                required: "Sub Heading is required",
                maxlength: "Maximum 500 characters allowed"
            },
            section1_button_name1: {
                required: "Button Name is required",
                maxlength: "Maximum 100 characters allowed"
            },
            section1_button_url1: {
                required: "Button URL is required",
                url: "Please enter a valid URL"
            },
            section1_image1: {
                required: "Image is required",
                extension: "Only JPG, JPEG, PNG or WEBP files allowed"
            }
        },
        errorElement: 'div',
        errorClass: 'text-danger',
        submitHandler: function(form) {
            $("#btn-submit1").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
            form.submit(); // Proceed with form submission
        }
    });
});

$(document).ready(function () {
    $("#homeForm2").validate({
        rules: {
            section1_heading2: {
                required: true,
                maxlength: 255
            },
            section1_sub_heading2: {
                required: true,
                maxlength: 500
            },
            section1_button_name2: {
                required: true,
                maxlength: 100
            },
            section1_button_url2: {
                required: true,
                url: true
            },
            // section1_image2: {
            //    required: function(element) {
            //         return $('#section1_old_image2').val() === '';
            //     },
            //     //extension: "jpg|jpeg|png|webp"
            // }
        },
        messages: {
            section1_heading2: {
                required: "Heading is required",
                maxlength: "Maximum 255 characters allowed"
            },
            section1_sub_heading2: {
                required: "Sub Heading is required",
                maxlength: "Maximum 500 characters allowed"
            },
            section1_button_name2: {
                required: "Button Name is required",
                maxlength: "Maximum 100 characters allowed"
            },
            section1_button_url2: {
                required: "Button URL is required",
                url: "Please enter a valid URL"
            },
            section1_image2: {
                required: "Image is required",
                extension: "Only JPG, JPEG, PNG or WEBP files allowed"
            }
        },
        errorElement: 'div',
        errorClass: 'text-danger',
        submitHandler: function(form) {
            $("#btn-submit2").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
            form.submit(); // Proceed with form submission
        }
    });
});

$(document).ready(function () {
    $("#homeForm3").validate({
        rules: {
            section1_heading3: {
                required: true,
                maxlength: 255
            },
            section1_sub_heading3: {
                required: true,
                maxlength: 500
            },
            section1_button_name3: {
                required: true,
                maxlength: 100
            },
            section1_button_url3: {
                required: true,
                url: true
            },
            // section1_image3: {
            //     required: function(element) {
            //         return $('#section1_old_image3').val() === '';
            //     },
            //     //extension: "jpg|jpeg|png|webp"
            // }
        },
        messages: {
            section1_heading3: {
                required: "Heading is required",
                maxlength: "Maximum 255 characters allowed"
            },
            section1_sub_heading3: {
                required: "Sub Heading is required",
                maxlength: "Maximum 500 characters allowed"
            },
            section1_button_name3: {
                required: "Button Name is required",
                maxlength: "Maximum 100 characters allowed"
            },
            section1_button_url3: {
                required: "Button URL is required",
                url: "Please enter a valid URL"
            },
            section1_image3: {
                required: "Image is required",
                extension: "Only JPG, JPEG, PNG or WEBP files allowed"
            }
        },
        errorElement: 'div',
        errorClass: 'text-danger',
        submitHandler: function(form) {
            $("#btn-submit3").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
            form.submit(); // Proceed with form submission
        }
    });
});

$(document).ready(function () {
    $("#homeForm4").validate({
        rules: {
            section2_marquee_text: {
                required: true,
                //maxlength: 255
            }
        },
        messages: {
            section2_marquee_text: {
                required: "This field is required",
                maxlength: "Maximum 255 characters allowed"
            },
           
        },
        errorElement: 'div',
        errorClass: 'text-danger',
        submitHandler: function(form) {
            $("#btn-submit4").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
            form.submit(); // Proceed with form submission
        }
    });
});

$(document).ready(function () {
    $("#homeForm5").validate({
        rules: {
            section3_heading1: {
                required: true,
                //maxlength: 255
            },
            // section3_image1: {
            //     required: true,
            //     //extension: "jpg|jpeg|png|webp"
            // }
        },
        messages: {
            section3_heading1: {
                required: "This field is required",
                maxlength: "Maximum 255 characters allowed"
            },
           
        },
        errorElement: 'div',
        errorClass: 'text-danger',
        submitHandler: function(form) {
            $("#btn-submit5").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
            form.submit(); // Proceed with form submission
        }
    });
});

$(document).ready(function () {
    $("#homeForm6").validate({
        rules: {
            section3_heading2: {
                required: true,
                //maxlength: 255
            },
            // section3_image2: {
            //     required: true,
            //     //extension: "jpg|jpeg|png|webp"
            // }
        },
        messages: {
            section3_heading2: {
                required: "This field is required",
                maxlength: "Maximum 255 characters allowed"
            },
           
        },
        errorElement: 'div',
        errorClass: 'text-danger',
        submitHandler: function(form) {
            $("#btn-submit6").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
            form.submit(); // Proceed with form submission
        }
    });
});

$(document).ready(function () {
    $("#homeForm7").validate({
        rules: {
            section3_heading3: {
                required: true,
                //maxlength: 255
            },
            // section3_image3: {
            //     required: true,
            //     //extension: "jpg|jpeg|png|webp"
            // }
        },
        messages: {
            section3_heading3: {
                required: "This field is required",
                maxlength: "Maximum 255 characters allowed"
            },
           
        },
        errorElement: 'div',
        errorClass: 'text-danger',
        submitHandler: function(form) {
            $("#btn-submit7").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
            form.submit(); // Proceed with form submission
        }
    });
});

$(document).ready(function () {
    $("#homeForm8").validate({
        rules: {
            section4_heading: {
                required: true,
                
            },
            section4_sub_heading: {
                required: true,
                
            },
            section4_button_name: {
                required: true,
                maxlength: 100
            },
            section4_button_url: {
                required: true,
                url: true
            },
            // section4_image1: {
            //     required: true,
            //     //extension: "jpg|jpeg|png|gif"
            // },
            // section4_image2: {
            //     required: true,
            //     //extension: "jpg|jpeg|png|gif"
            // }
        },
        messages: {
            section4_heading: {
                required: "Please enter the heading",
                maxlength: "Maximum 255 characters allowed"
            },
            section4_sub_heading: {
                required: "Please enter the sub-heading",
                maxlength: "Maximum 255 characters allowed"
            },
            section4_button_name: {
                required: "Please enter the button name",
                maxlength: "Maximum 100 characters allowed"
            },
            section4_button_url: {
                required: "Please enter the button URL",
                url: "Please enter a valid URL"
            },
            // section4_image1: {
            //     required: "Please upload the first image",
            //     extension: "Only image files (jpg, jpeg, png, gif) are allowed"
            // },
            // section4_image2: {
            //     required: "Please upload the second image",
            //     extension: "Only image files (jpg, jpeg, png, gif) are allowed"
            // }
        },
        errorElement: 'span',
        errorClass: 'text-danger',
        submitHandler: function(form) {
            $("#btn-submit8").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
            form.submit(); // Proceed with form submission
        }
    });
});

$(document).ready(function () {
    $("#homeForm9").validate({
        rules: {
            section5_heading1: {
                required: true,
                
            },
            section5_sub_heading1: {
                required: true,
                
            },
            // section5_icon1: {
            //     required: true,
            //     //extension: "jpg|jpeg|png|gif|svg"
            // }
        },
        messages: {
            section5_heading1: {
                required: "Please enter a heading",
                minlength: "Heading must be at least 3 characters long"
            },
            section5_sub_heading1: {
                required: "Please enter a sub heading",
                minlength: "Sub heading must be at least 3 characters long"
            },
            section5_icon1: {
                required: "Please upload an icon image",
                extension: "Only image files (jpg, jpeg, png, gif, svg) are allowed"
            }
        },
        errorElement: 'div',
        errorClass: 'text-danger',
        submitHandler: function(form) {
            $("#btn-submit9").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
            form.submit(); // Proceed with form submission
        }
    });
});

$(document).ready(function () {
    $("#homeForm10").validate({
        rules: {
            section5_heading2: {
                required: true,
                
            },
            section5_sub_heading2: {
                required: true,
                
            },
            // section5_icon2: {
            //     required: true,
            //     //extension: "jpg|jpeg|png|gif|svg"
            // }
        },
        messages: {
            section5_heading2: {
                required: "Please enter a heading",
                minlength: "Heading must be at least 3 characters long"
            },
            section5_sub_heading2: {
                required: "Please enter a sub heading",
                minlength: "Sub heading must be at least 3 characters long"
            },
            section5_icon2: {
                required: "Please upload an icon image",
                extension: "Only image files (jpg, jpeg, png, gif, svg) are allowed"
            }
        },
        errorElement: 'div',
        errorClass: 'text-danger',
        submitHandler: function(form) {
            $("#btn-submit10").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
            form.submit(); // Proceed with form submission
        }
    });
});

$(document).ready(function () {
    $("#homeForm11").validate({
        rules: {
            section5_heading3: {
                required: true,
                
            },
            section5_sub_heading3: {
                required: true,
                
            },
            // section5_icon3: {
            //     required: true,
            //     //extension: "jpg|jpeg|png|gif|svg"
            // }
        },
        messages: {
            section5_heading3: {
                required: "Please enter a heading",
                minlength: "Heading must be at least 3 characters long"
            },
            section5_sub_heading3: {
                required: "Please enter a sub heading",
                minlength: "Sub heading must be at least 3 characters long"
            },
            section5_icon3: {
                required: "Please upload an icon image",
                extension: "Only image files (jpg, jpeg, png, gif, svg) are allowed"
            }
        },
        errorElement: 'div',
        errorClass: 'text-danger',
        submitHandler: function(form) {
            $("#btn-submit11").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
            form.submit(); // Proceed with form submission
        }
    });
});

$(document).ready(function () {
    $("#homeForm12").validate({
        rules: {
            section5_heading4: {
                required: true,
                
            },
            section5_sub_heading4: {
                required: true,
                
            },
            // section5_icon4: {
            //     required: true,
            //     //extension: "jpg|jpeg|png|gif|svg"
            // }
        },
        messages: {
            section5_heading4: {
                required: "Please enter a heading",
                minlength: "Heading must be at least 3 characters long"
            },
            section5_sub_heading4: {
                required: "Please enter a sub heading",
                minlength: "Sub heading must be at least 3 characters long"
            },
            section5_icon4: {
                required: "Please upload an icon image",
                extension: "Only image files (jpg, jpeg, png, gif, svg) are allowed"
            }
        },
        errorElement: 'div',
        errorClass: 'text-danger',
        submitHandler: function(form) {
            $("#btn-submit12").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
            form.submit(); // Proceed with form submission
        }
    });
});
