
        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/

        $(document).ready(function () {

            // validate signup form on keyup and submit
            $("#login-form").validate({
                rules: {
                    uname: {
                        required: true,
                        minlength: 5
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    answer: {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {
                    uname: {
                        required: "Please Enter The User Name",
                        minlength: "Your User Name must consist of at least 5 characters"
                    },
                    password: {
                        required: "Please Enter The Password",
                        minlength: "Your Password must be at least 5 characters long"
                    },
                    answer: {
                        required: "Please Enter Security Question Answer",
                        minlength: "Your Security Question Answer must be at least 5 characters long"
                    }
                }
            });

        });


