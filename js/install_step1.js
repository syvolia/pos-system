
  
        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/

        $(document).ready(function () {

            // validate signup form on keyup and submit
            $("#login-form").validate({
                rules: {
                    host: {
                        required: true,
                        minlength: 3
                    },
                    username: {
                        required: true,
                        minlength: 3
                    }
                },
                messages: {
                    host: {
                        required: "Please Enter The Host",
                        minlength: "Your Host must consist of at least 3 characters"
                    },
                    username: {
                        required: "Please Enter The User Name",
                        minlength: "Your User Name must be at least 3 characters long"
                    }
                }
            });

        });



