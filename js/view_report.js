/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/
        $(document).ready(function () {
            $('#from_sales_date').jdPicker();
            $('#to_sales_date').jdPicker();
            $('#from_purchase_date').jdPicker();
            $('#to_purchase_date').jdPicker();
            $('#from_sales_purchase_date').jdPicker();
            $('#to_sales_purchase_date').jdPicker();
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

        function sales_report_fn() {
            window.open("sales_report.php?from_sales_date=" + $('#from_sales_date').val() + "&to_sales_date=" + $('#to_sales_date').val(), "myNewWinsr", "width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no,scrollbars=yes");

        }
        function purchase_report_fn() {
            window.open("purchase_report.php?from_purchase_date=" + $('#from_purchase_date').val() + "&to_purchase_date=" + $('#to_purchase_date').val(), "myNewWinsr", "width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no,scrollbars=yes");

        }

        function sales_purchase_report_fn() {
            window.open("all_report.php?from_sales_purchase_date=" + $('#from_sales_purchase_date').val() + "&to_sales_purchase_date=" + $('#to_sales_purchase_date').val(), "myNewWinsr", "width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no,scrollbars=yes");

        }

        function stock_sales_report_fn() {
            window.open("sales_stock_report.php?from_stock_sales_date=" + $('#from_stock_sales_date').val() + "&to_stock_sales_date=" + $('#to_stock_sales_date').val(), "myNewWinsr", "width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no,scrollbars=yes");

        }
   
