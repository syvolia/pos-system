 
        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/

        $(document).ready(function () {

            // validate signup form on keyup and submit
            $("#login-form").validate({
                rules: {
                    sname: {
                        required: true,
                        minlength: 3
                    },
                    address: {
                        required: true,
                        minlength: 3
                    },
                    place: {
                        required: true,
                        minlength: 3
                    },
                    website: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        minlength: 3
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 12
                    },
                    city: {
                        required: true,
                        minlength: 3
                    }
                },
                messages: {
                    sname: {
                        required: "Please Enter The Store Name",
                        minlength: "Your Store Name must consist of at least 3 characters"
                    },
                    address: {
                        required: "Please Enter The Address",
                        minlength: "Your Address must be at least 3 characters long"
                    },
                    place: {
                        required: "Please Enter The Place",
                        minlength: "Your place must be at least 3 characters long"
                    },
                    website: {
                        required: "Please Enter The Website",
                        minlength: "Your Website must be at least 3 characters long"
                    },
                    email: {
                        required: "Please Enter The email",
                        minlength: "Your Email must be at least 3 characters long"
                    },
                    phone: {
                        required: "Please Enter The Phone",
                        minlength: "Your Phone must be at least 10 characters long",
                        maxlength: "Your Phone must be at Less than 13 characters long"
                    },
                    city: {
                        required: "Please Enter The city",
                        minlength: "Your city must be at least 3 characters long"
                    }
                }
            });

        });
