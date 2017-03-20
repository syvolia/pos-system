
        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/

        $(document).ready(function () {
            document.getElementById('create').checked = true;
            document.getElementById('select_box').disabled = true;

            // validate signup form on keyup and submit
            $("#login-form").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    }

                },
                messages: {
                    name: {
                        required: "Please Enter The Database Name",
                        minlength: "Your Database must consist of at least 3 characters"
                    }
                }
            });

        });
        function create_data() {
            document.getElementById("select_box").disabled = true;
            document.getElementById("name").disabled = false;

        }
        function select_data() {
            document.getElementById("select_box").disabled = false;
            document.getElementById("name").disabled = true;

        }
   

