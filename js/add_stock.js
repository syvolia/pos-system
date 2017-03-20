/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/
        $(document).ready(function () {
            $("#supplier").autocomplete("supplier1.php", {
                width: 160,
                autoFill: true,
                selectFirst: true
            });
            $("#category").autocomplete("category.php", {
                width: 160,
                autoFill: true,
                selectFirst: true
            });
            // validate signup form on keyup and submit
            $("#form1").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 200
                    },
                    stockid: {
                        required: true,
                        minlength: 3,
                        maxlength: 200
                    },
                    cost: {
                        required: true,

                    },
                    sell: {
                        required: true,

                    }
                },
                messages: {
                    name: {
                        required: "Please Enter Stock Name",
                        minlength: "Stock Name must consist of at least 3 characters"
                    },
                    stockid: {
                        required: "Please Enter Stock ID",
                        // minlength: "Category Name must consist of at least 3 characters"
                    },
                    sell: {
                        required: "Please Enter Selling Price",
                    },
                    cost: {
                        required: "Please Enter Cost Price",
                    }
                }
            });

        });
        function numbersonly(e) {
            var unicode = e.charCode ? e.charCode : e.keyCode
            if (unicode != 8 && unicode != 46 && unicode != 37 && unicode != 38 && unicode != 39 && unicode != 40 && unicode != 9) { //if the key isn't the backspace key (which we should allow)
                if (unicode < 48 || unicode > 57)
                    return false
            }
        }

