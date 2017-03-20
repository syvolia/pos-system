/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {

    $("#supplier").autocomplete("customer1.php", {
        width: 160,
        autoFill: true,
        selectFirst: true
    });
    $("#item").autocomplete("stock.php", {
        width: 160,
        autoFill: true,
        mustMatch: true,
        selectFirst: true
    });
    $("#item").blur(function () {
        document.getElementById('total').value = document.getElementById('sell').value * document.getElementById('quty').value
    });
    $("#item").blur(function () {


        $.post('check_item_details.php', {stock_name1: $(this).val()},
                function (data) {

                    $("#sell").val(data.sell);
                    $("#stock").val(data.stock);
                    $('#guid').val(data.guid);
                    if (data.sell != undefined)
                        $("#0").focus();


                }, 'json');


    });
    $("#supplier").blur(function () {


        $.post('check_customer_details.php', {stock_name1: $(this).val()},
                function (data) {

                    $("#address").val(data.address);
                    $("#contact1").val(data.contact1);

                    if (data.address != undefined)
                        $("#0").focus();

                }, 'json');


    });
    $('#test1').jdPicker();
    $('#test2').jdPicker();


    var hauteur = 0;
    $('.code').each(function () {
        if ($(this).height() > hauteur)
            hauteur = $(this).height();
    });

    $('.code').each(function () {
        $(this).height(hauteur);
    });
});

//Reset form
$(document).ready(function () {
    $('#Reset').click(function () {
        location.reload();
    });
});

//Press Enter key using cursor focus to next textbox 
$(document).ready(function () {
    $('#item').keypress(function (e) {
        if (e.keyCode == 13) {
            $(':input:eq(' + ($(':input').index(this) + 1) + ')').focus();
            return false;
        }
    });
});

/*$.validator.setDefaults({
 submitHandler: function() { alert("submitted!"); }
 });*/
$(document).ready(function () {
    document.getElementById('item').focus();
    // validate signup form on keyup and submit
    $("#form1").validate({
        rules: {
            bill_no: {
                required: true,
            },
            stockid: {
                required: true
            },
            grand_total: {
                required: true
            },
            supplier: {
                required: true,
            },
        },
        messages: {
            supplier: {
                required: "Please Enter Supplier"
            },
            stockid: {
                required: "Please Enter Stock ID"
            },
            grand_total: {
                required: "Add Stock Items"
            },
            bill_no: {
                required: "Please Enter Bill Number",
                minlength: "Bill Number must consist of at least 3 characters"
            }
        }
    });

});
function numbersonly(e) {
    var unicode = e.charCode ? e.charCode : e.keyCode
    if (unicode != 8 && unicode != 46 && unicode != 37 && unicode != 27 && unicode != 38 && unicode != 39 && unicode != 40 && unicode != 9) { //if the key isn't the backspace key (which we should allow)
        if (unicode < 48 || unicode > 57)
            return false
    }
}



function remove_row(o) {
    var p = o.parentNode.parentNode;
    p.parentNode.removeChild(p);
}
function add_values() {
    if (unique_check()) {

        if (document.getElementById('edit_guid').value == "") {
            if (document.getElementById('item').value != "" && document.getElementById('quty').value != "" && document.getElementById('total').value != "") {

                if (document.getElementById('quty').value != 0) {
                    code = document.getElementById('item').value;

                    quty = document.getElementById('quty').value;
                    sell = document.getElementById('sell').value;
                    disc = document.getElementById('stock').value;
                    total = document.getElementById('total').value;
                    item = document.getElementById('guid').value;
                    main_total = document.getElementById('posnic_total').value;

                    $('<tr id=' + item + '><td><input type=hidden value=' + item + ' id=' + item + 'id ><input type=text name="stock_name[]"  id=' + item + 'st style="width: 150px" class="round  my_with" ></td><td><input type=text name=quty[] readonly="readonly" value=' + quty + ' id=' + item + 'q class="round  my_with" style="text-align:right;" ></td><td><input type=text name=sell[] readonly="readonly" value=' + sell + ' id=' + item + 's class="round  my_with" style="text-align:right;"  ></td><td><input type=text name=stock[] readonly="readonly" value=' + disc + ' id=' + item + 'p class="round  my_with" style="text-align:right;" ></td><td><input type=text name=jibi[] readonly="readonly" value=' + total + ' id=' + item + 'to class="round  my_with" style="width: 120px;margin-left:20px;text-align:right;" ><input type=hidden name=total[] id=' + item + 'my_tot value=' + main_total + '> </td><td><input type=button value="" id=' + item + ' style="width:30px;border:none;height:30px;background:url(images/edit_new.png)" class="round" onclick="edit_stock_details(this.id)"  ></td><td><input type=button value="" id=' + item + ' style="width:30px;border:none;height:30px;background:url(images/close_new.png)" class="round" onclick=reduce_balance("' + item + '");$(this).closest("tr").remove(); ></td></tr>').fadeIn("slow").appendTo('#item_copy_final');
                    document.getElementById('quty').value = "";
                    document.getElementById('sell').value = "";
                    document.getElementById('stock').value = "";
                    document.getElementById('total').value = "";
                    document.getElementById('item').value = "";
                    document.getElementById('guid').value = "";
                    if (document.getElementById('grand_total').value == "") {
                        document.getElementById('grand_total').value = main_total;
                    } else {
                        document.getElementById('grand_total').value = parseFloat(document.getElementById('grand_total').value) + parseFloat(main_total);
                    }
                    document.getElementById('main_grand_total').value = parseFloat(document.getElementById('grand_total').value);
                    document.getElementById(item + 'st').value = code;
                    document.getElementById(item + 'to').value = total;
                } else {
                    alert('No Stock Available For This Item');
                }
            } else {
                alert('Please Select An Item');
            }
        } else {
            id = document.getElementById('edit_guid').value;
            document.getElementById(id + 'st').value = document.getElementById('item').value;
            document.getElementById(id + 'q').value = document.getElementById('quty').value;
            document.getElementById(id + 's').value = document.getElementById('sell').value;
            document.getElementById(id + 'p').value = document.getElementById('stock').value;
            document.getElementById('grand_total').value = parseFloat(document.getElementById('grand_total').value) + parseFloat(document.getElementById('posnic_total').value) - parseFloat(document.getElementById(id + 'my_tot').value);
            document.getElementById('main_grand_total').value = parseFloat(document.getElementById('grand_total').value);
            document.getElementById(id + 'to').value = document.getElementById('total').value;
            document.getElementById(id + 'id').value = id;

            document.getElementById(id + 'my_tot').value = document.getElementById('posnic_total').value
            document.getElementById('quty').value = "";
            document.getElementById('sell').value = "";
            document.getElementById('stock').value = "";
            document.getElementById('total').value = "";
            document.getElementById('item').value = "";
            document.getElementById('guid').value = "";
            document.getElementById('edit_guid').value = "";
        }
    }
    discount_amount();
}
function total_amount() {
    balance_amount();
    
    if (document.getElementById('stock').value >= parseInt(document.getElementById('quty').value)) {

        document.getElementById('total').value = document.getElementById('sell').value * document.getElementById('quty').value
        document.getElementById('posnic_total').value = document.getElementById('total').value;
        //  document.getElementById('total').value = '$ ' + parseFloat(document.getElementById('total').value).toFixed(2);
        if (document.getElementById('item').value === "") {
            document.getElementById('item').focus();
        }
    }
}
function edit_stock_details(id) {
    document.getElementById('item').value = document.getElementById(id + 'st').value;
    document.getElementById('quty').value = document.getElementById(id + 'q').value;
    document.getElementById('sell').value = document.getElementById(id + 's').value;
    document.getElementById('stock').value = document.getElementById(id + 'p').value;
    document.getElementById('total').value = document.getElementById(id + 'to').value;

    document.getElementById('guid').value = id;
    document.getElementById('edit_guid').value = id;

}
function unique_check() {
    if (!document.getElementById(document.getElementById('guid').value) || document.getElementById('edit_guid').value == document.getElementById('guid').value) {
        return true;

    } else {

        alert("This Item is already added In This Purchase");
        document.getElementById('item').focus();
        document.getElementById('quty').value = "";
        document.getElementById('sell').value = "";
        document.getElementById('stock').value = "";
        document.getElementById('total').value = "";
        document.getElementById('item').value = "";
        document.getElementById('guid').value = "";
        document.getElementById('edit_guid').value = "";
        return false;
    }
}
function quantity_chnage(e) {
    var unicode = e.charCode ? e.charCode : e.keyCode
    if (unicode != 13 && unicode != 9) {
    } else {
        add_values();

        document.getElementById("item").focus();

    }
    if (unicode != 27) {
    } else {

        document.getElementById("item").focus();
    }
}
function formatCurrency(fieldObj) {
    if (isNaN(fieldObj.value)) {
        return false;
    }
    fieldObj.value = '$ ' + parseFloat(fieldObj.value).toFixed(2);
    return true;
}
function balance_amount() {
    if (document.getElementById('payable_amount').value != "" && document.getElementById('total').value != "") {
        data = parseFloat(document.getElementById('payable_amount').value);
        //document.getElementById('total').value = data - parseFloat(document.getElementById('payable_amount').value);
        if (parseFloat(document.getElementById('payable_amount').value) >= parseFloat(document.getElementById('total').value)) {

        } else {
            if (document.getElementById('payable_amount').value != "") {
                //document.getElementById('balance').value = '000.00';
                // document.getElementById('payment').value = parseFloat(document.getElementById('payable_amount').value);
            } else {
                //document.getElementById('balance').value = '000.00';
                // document.getElementById('payment').value = "";
            }
        }
    } else {
        //document.getElementById('balance').value = "";
    }


}
function stock_size() {
    if (parseFloat(document.getElementById('quty').value) > parseFloat(document.getElementById('stock').value)) {
        document.getElementById('quty').value = parseFloat(document.getElementById('stock').value);

        console.log();
    }
}
function discount_amount() {

    if (document.getElementById('grand_total').value != "") {
        document.getElementById('disacount_amount').value = parseFloat(document.getElementById('grand_total').value) *
                (parseFloat(document.getElementById('discount').value)) / 100;

    }
    if (document.getElementById('discount').value == "") {
        document.getElementById('disacount_amount').value = "";
    }
    discont = parseFloat(document.getElementById('disacount_amount').value);
    if (document.getElementById('disacount_amount').value == "") {
        discont = 0;
    }
    //--------------------*******************-----------------//
    if (document.getElementById('disacount_amount').value != "" && document.getElementById('tax').value != "") {
        document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value) - discont + tax;

    }

    //-------------------------------***************------------------//
    if (document.getElementById('tax').value == "") {
        document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value) - discont;
    }
    if (document.getElementById('tax').value != "" && document.getElementById('disacount_amount').value == "") {
        document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value) - discont + tax;

    }
    if (parseFloat(document.getElementById('grand_total').value) > parseFloat(document.getElementById('payable_amount').value)) {
        // document.getElementById('payment').value = parseFloat(document.getElementById('payable_amount').value);

    }
    balance_amount();
}
function discount_as_amount() {
    if (parseFloat(document.getElementById('disacount_amount').value) > parseFloat(document.getElementById('grand_total').value))
        document.getElementById('disacount_amount').value = "";
    discont = parseFloat(document.getElementById('disacount_amount').value);
    /***********************************************/

    var result = isNaN(parseFloat(document.getElementById('disacount_amount').value));
    if (result == true)
    {
        document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value) + tax;
        if (document.getElementById('tax').value == "") {
            document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value)
        }
    }


    /*************************************************/
    if (document.getElementById('grand_total').value != "") {
        if (parseFloat(document.getElementById('disacount_amount').value) < parseFloat(document.getElementById('grand_total').value)) {
            discont = parseFloat(document.getElementById('disacount_amount').value);
            //--------------------*******************-----------------//
            if (document.getElementById('disacount_amount').value != "" && document.getElementById('tax').value != "") {
                document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value) - discont + tax;
            }
            //-------------------------------***************------------------//
            if (document.getElementById('tax').value == "" || parseFloat(document.getElementById('disacount_amount').value != "")) {
                document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value) - discont;
            }

            if (parseFloat(document.getElementById('grand_total').value) > parseFloat(document.getElementById('payable_amount').value)) {
                //document.getElementById('payment').value = parseFloat(document.getElementById('payable_amount').value);

            }
        } else {
            // document.getElementById('disacount_amount').value=parseFloat(document.getElementById('grand_total').value)-1;
        }
    }

}


function add_tax() {
    var grand_tot = parseFloat(document.getElementById('grand_total').value);
    if (parseFloat(document.getElementById('tax').value) > parseFloat(document.getElementById('grand_total').value))
        document.getElementById('tax').value = "";
    var result = isNaN(parseFloat(document.getElementById('tax').value));
    if (result == true)
    {
        document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value) - discont;
    }
    if (document.getElementById('grand_total').value != "") {
        if (parseFloat(document.getElementById('tax').value) < parseFloat(document.getElementById('grand_total').value)) {
            tax = parseFloat(document.getElementById('tax').value);
            document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value) - discont + tax;
            if (parseFloat(document.getElementById('grand_total').value) > parseFloat(document.getElementById('payable_amount').value)) {
                // document.getElementById('payment').value = parseFloat(document.getElementById('payable_amount').value);
            }
        }
    }
    balance_amount();
}

function reduce_balance(id) {
    var minus = parseFloat(document.getElementById(id + "my_tot").value);
    document.getElementById('grand_total').value = parseFloat(document.getElementById('grand_total').value) - minus;
    document.getElementById('main_grand_total').value = parseFloat(document.getElementById('grand_total').value);
    discount_amount();
    //console.log(id);
}
function discount_type() {
    if (document.getElementById('round').checked) {
        document.getElementById("discount").readOnly = true;
        document.getElementById("disacount_amount").readOnly = false;
        if (parseFloat(document.getElementById('grand_total')) != "") {
            document.getElementById('disacount_amount').value = "";
            document.getElementById('discount').value = "";
            discount_amount();
        }
    } else {
        document.getElementById("discount").readOnly = false;
        document.getElementById("disacount_amount").readOnly = true;
    }
    if (document.getElementById('round').checked != true && document.getElementById("disacount_amount").value != "") {
        document.getElementById('disacount_amount').value = "";
        document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value);
        if (document.getElementById('tax').value != "") {
            document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value) + tax;
        } else {
            document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value);
        }
    }
}


