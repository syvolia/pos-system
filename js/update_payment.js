
        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/
        $(document).ready(function () {
            $('#test1').jdPicker();
            // validate signup form on keyup and submit
            $("#form1").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 200
                    },

                    cost: {
                        required: true

                    },
                    new_payment: {
                        required: true
                    },

                    paid: {
                        required: true

                    },
                    sell: {
                        required: true

                    }
                },
                messages: {
                    name: {
                        required: "Please enter a Stock Name",
                        minlength: "Stock must consist of at least 3 characters"
                    },
                    cost: {
                        required: "Please enter a cost Price"
                    },

                    new_payment: {
                        required: "Please enter a New Payment"
                    },
                    paid: {
                        required: "Please enter a Paid Amount"
                    },
                    sell: {
                        required: "Please enter a Sell Price"
                    }
                }
            });

        });
        function numbersonly(e) {
            var unicode = e.charCode ? e.charCode : e.keyCode
            if (unicode != 8 && unicode != 46 && unicode != 37 && unicode != 38 && unicode != 39 && unicode != 40) { //if the key isn't the backspace key (which we should allow)
                if (unicode < 48 || unicode > 57)
                    return false
            }
        }
        function change_balance() {
            if (parseFloat(document.getElementById('new_payment').value) > parseFloat(document.getElementById('balance').value)) {
                document.getElementById('new_payment').value = parseFloat(document.getElementById('balance').value);
            }
        }



