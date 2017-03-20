/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
        $(function () {
            document.getElementById('supplier').focus();
            $("#supplier").autocomplete("supplier1.php", {
                width: 160,
                autoFill: true,
                selectFirst: true
            });
            $("#item").autocomplete("stock_purchse.php", {
                width: 160,
                autoFill: true,
                mustMatch: true,
                selectFirst: true
            });
            $("#item").blur(function () {
                document.getElementById('total').value = document.getElementById('cost').value * document.getElementById('quty').value
            });
            $("#item").blur(function () {


                $.post('check_item_details.php', {stock_name1: $(this).val()},
                    function (data) {
                        $("#cost").val(data.cost);
                        $("#sell").val(data.sell);
                        $("#stock").val(data.stock);
                        $('#guid').val(data.guid);
                        if (data.cost != undefined)
                            $("#0").focus();


                    }, 'json');


            });
            $("#quty").blur(function () {
                if (document.getElementById('item').value == "") {
                    document.getElementById('item').focus();
                }
            });
            $("#supplier").blur(function () {


                $.post('check_supplier_details.php', {stock_name1: $(this).val()},
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
                if ($(this).height() > hauteur) hauteur = $(this).height();
            });

            $('.code').each(function () {
                $(this).height(hauteur);
            });
        });
        //Reset form
$(document).ready(function() {
            $('#Reset').click(function() {
                location.reload();
            });
        }); 
        //Press Enter key using cursor focus to next textbox 
    $(document).ready(function(){
            $('#item').keypress(function(e){
             if(e.keyCode==13){                
                $(':input:eq(' + ($(':input').index(this) + 1) + ')').focus(); 
               return false;
             }
            });
        });
        
function checkValid(form)
{
if(document.form1.supplier.value=="")
{

document.form1.supplier.focus();
return false;
}

}       
        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/
        $(document).ready(function () {
            if (document.getElementById('item') === "") {
                document.getElementById('item').focus();
            }
            // validate signup form on keyup and submit
            $("#form1").validate({
                rules: {
                    
                    purchaseid: {
                        required: true
                    },
                    grand_total: {
                        required: true
                    },
                    payment: {
                        required: true
                    },
                    supplier: {
                        required: true,
                    }
                },
                messages: {
                    supplier: {
                        required: "Please Enter Supplier"
                    },
                    purchaseid: {
                        required: "Please Enter Purchase ID"
                    },
                    grand_total: {
                        required: "Add Stock Items"
                    },
                    payment: {
                        required: "Enter Payment"
                    },
                   
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
                    if (document.getElementById('item').value != "" && document.getElementById('quty').value != "" && document.getElementById('cost').value != "" && document.getElementById('total').value != "") {
                        code = document.getElementById('item').value;

                        quty = document.getElementById('quty').value;
                        cost = document.getElementById('cost').value;
                        sell = document.getElementById('sell').value;
                        disc = document.getElementById('stock').value;
                        total = document.getElementById('total').value;
                        item = document.getElementById('guid').value;
                        main_total = document.getElementById('posnic_total').value;

                        $('<tr id=' + item + '><td><input type=hidden value=' + item + ' id=' + item + 'id ><input type=text name="stock_name[]"  id=' + item + 'st style="width: 150px" class="round  my_with" ></td><td><input type=text name=quty[] readonly="readonly" value=' + quty + ' id=' + item + 'q class="round  my_with" style="text-align:right;" ></td><td><input type=text name=cost[] readonly="readonly" value=' + cost + ' id=' + item + 'c class="round  my_with" style="text-align:right;"></td><td><input type=text name=sell[] readonly="readonly" value=' + sell + ' id=' + item + 's class="round  my_with" style="text-align:right;"  ></td><td><input type=text name=stock[] readonly="readonly" value=' + disc + ' id=' + item + 'p class="round  my_with" style="text-align:right;" ></td><td><input type=text name=jibi[] readonly="readonly" value=' + total + ' id=' + item + 'to class="round  my_with" style="width: 120px;margin-left:20px;text-align:right;" ><input type=hidden name=total[] id=' + item + 'my_tot value=' + main_total + '> </td><td><input type=button value="" id=' + item + ' style="width:30px;border:none;height:30px;background:url(images/edit_new.png)" class="round" onclick="edit_stock_details(this.id)"  ></td><td><input type=button value="" id=' + item + ' style="width:30px;border:none;height:30px;background:url(images/close_new.png)" class="round" onclick= reduce_balance("' + item + '");$(this).closest("tr").remove() ></td></tr>').fadeIn("slow").appendTo('#item_copy_final');
                        document.getElementById('quty').value = "";
                        document.getElementById('cost').value = "";
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
                        document.getElementById('item').focus();

                    } else {
                        alert('Please Select An Item');
                    }
                } else {
                    id = document.getElementById('edit_guid').value;
                    document.getElementById(id + 'st').value = document.getElementById('item').value;
                    document.getElementById(id + 'q').value = document.getElementById('quty').value;
                    document.getElementById(id + 'c').value = document.getElementById('cost').value;
                    document.getElementById(id + 's').value = document.getElementById('sell').value;
                    document.getElementById(id + 'p').value = document.getElementById('stock').value;
                    document.getElementById('grand_total').value = parseFloat(document.getElementById('grand_total').value) + parseFloat(document.getElementById('posnic_total').value) - parseFloat(document.getElementById(id + 'my_tot').value);
                    document.getElementById('main_grand_total').value = parseFloat(document.getElementById('grand_total').value);
                    document.getElementById(id + 'to').value = document.getElementById('total').value;
                    document.getElementById(id + 'id').value = id;

                    document.getElementById(id + 'my_tot').value = document.getElementById('posnic_total').value
                    document.getElementById('quty').value = "";
                    document.getElementById('cost').value = "";
                    document.getElementById('sell').value = "";
                    document.getElementById('stock').value = "";
                    document.getElementById('total').value = "";
                    document.getElementById('item').value = "";
                    document.getElementById('guid').value = "";
                    document.getElementById('edit_guid').value = "";
                    document.getElementById('item').focus();
                }
            }

        }
        function reduce_balance(id) {
            var minus = parseFloat(document.getElementById(id + "my_tot").value);
            document.getElementById('grand_total').value = parseFloat(document.getElementById('grand_total').value) - minus;
            document.getElementById('main_grand_total').value = parseFloat(document.getElementById('grand_total').value);
            //console.log(id);
        }
        function total_amount() {
            balance_amount();

            document.getElementById('total').value = document.getElementById('cost').value * document.getElementById('quty').value
            document.getElementById('posnic_total').value = document.getElementById('total').value;
            document.getElementById('total').value = parseFloat(document.getElementById('total').value);
            if (document.getElementById('item').value === "") {
                document.getElementById('item').focus();
            }
        }
        function edit_stock_details(id) {
            document.getElementById('item').value = document.getElementById(id + 'st').value;
            document.getElementById('quty').value = document.getElementById(id + 'q').value;
            document.getElementById('cost').value = document.getElementById(id + 'c').value;
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
                document.getElementById('cost').value = "";
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
            if (document.getElementById('item').value == "") {
                document.getElementById('item').focus();
            }

            var unicode = e.charCode ? e.charCode : e.keyCode
            if (unicode != 13 && unicode != 9) {
            }
            else {
                add_values();

                document.getElementById("item").focus();

            }
            if (unicode != 27) {
            }
            else {

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
            if (document.getElementById('grand_total').value != "" && document.getElementById('total').value != "") {
                data = parseFloat(document.getElementById('grand_total').value);
                document.getElementById('total').value = data - parseFloat(document.getElementById('total').value);
                if (parseFloat(document.getElementById('grand_total').value) >= parseFloat(document.getElementById('total').value)) {

                } else {
                    if (document.getElementById('grand_total').value != "") {
                        document.getElementById('total').value = '000.00';
                        document.getElementById('total').value = parseFloat(document.getElementById('grand_total').value);
                    } else {
                        document.getElementById('total').value = '000.00';
                        document.getElementById('total').value = "";
                    }
                }
            } else {
                document.getElementById('total').value = "";
            }


        }

