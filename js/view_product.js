/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Nannette Thacker http://www.shiningstar.net



function deleteall()
{

//var info = 'id=' + checkedvaues;
//var jsonString = JSON.stringify(checkedvaues);
//alert(checkedvaues[0]);
    var file1 = "viewproduct";
    if (confirm("Are you sure you want to delete all records...?"))
    {
        $.ajax({
            type: "POST",
            url: "deleteall.php",
            data: {data: file1},
            cache: false,
            success: function () {
                sessionStorage.removeItem('checked-checkboxesviewproduct');
//sessionStorage.removeItem('checked-checkboxesviewsales');
                window.location.href = "view_product.php";
            }
        });
        $(this).parents(".show").animate({backgroundColor: "#003"}, "slow")
                .animate({opacity: "hide"}, "slow");
    }
    return false;

}





var arrCheckedCheckboxes1viewproduct = [];

var arrCheckedCheckboxes1viewcustomerselected = [];//For ROw Selection in view_product

function rowselection() {

    if (sessionStorage.getItem('checked-checkboxesviewproduct') && $.parseJSON(sessionStorage.getItem('checked-checkboxesviewproduct')).length !== 0)
    {
        arrCheckedCheckboxes1viewproduct = $.parseJSON(sessionStorage.getItem('checked-checkboxesviewproduct'));
        //Convert checked checkboxes array to comma seprated id
        $(arrCheckedCheckboxes1viewproduct.toString()).prop('checked', true);

    }
    if (sessionStorage.getItem('checked-checkboxesviewcustomer_selected') && $.parseJSON(sessionStorage.getItem('checked-checkboxesviewcustomer_selected')).length !== 0)
    {
        arrCheckedCheckboxes1viewcustomerselected = $.parseJSON(sessionStorage.getItem('checked-checkboxesviewcustomer_selected'));
        //Convert checked checkboxes array to comma seprated id
        //alert(arrCheckedCheckboxes1viewcustomerselected);
        $(arrCheckedCheckboxes1viewcustomerselected.toString()).css('background-color', '#DCDCDC');

    }

}

$(document).ready(function () {

    rowselection();

    $("input:checkbox").change(function () {
        // i++;
        //	var arrCheckedCheckboxes1viewproduct = [];
        //alert(arrCheckedCheckboxes);
        // Get all checked checkboxes
        var currentId = $(this).attr('id');
        if ($(this).is(':checked')) {
            arrCheckedCheckboxes1viewproduct.push("#" + currentId);
            arrCheckedCheckboxes1viewcustomerselected.push("#tr" + currentId);
        } else {
            console.log('came to else condition');
            arrCheckedCheckboxes1viewproduct = jQuery.grep(arrCheckedCheckboxes1viewproduct, function (value) {
                return value != "#" + currentId;
            });
            arrCheckedCheckboxes1viewcustomerselected = jQuery.grep(arrCheckedCheckboxes1viewcustomerselected, function (value) {
                return value != "#tr" + currentId;
            });

        }
        sessionStorage.setItem('checked-checkboxesviewproduct', JSON.stringify(arrCheckedCheckboxes1viewproduct));
        sessionStorage.setItem('checked-checkboxesviewcustomer_selected', JSON.stringify(arrCheckedCheckboxes1viewcustomerselected));

        // Convert checked checkboxes array to JSON ans store it in session storage




    });

});

function confirmSubmit() {
    var agree = confirm("Are you sure you wish to Delete this Entry?");
    if (agree)
        return true;
    else
        return false;
}

function confirmDeleteSubmit() {
    var retrievedData = sessionStorage.getItem("checked-checkboxesviewproduct");
    var checkedvaues = JSON.parse(retrievedData);

    var flag = checkedvaues.length;

    // alert(flag);
    /*var field = document.forms.deletefiles;
     for (i = 0; i < field.length; i++) {
     if (field[i].checked == true) {
     flag = flag + 1;
     
     }
     
     }*/
    if (flag == 0) {
        alert("You must check one and only one checkbox!");
        return false;
    } else {

        var agree = confirm("Are you sure you wish to Delete Selected Record.?");
        if (agree)


        {
            var file1 = "viewproduct";
            $.ajax({
                type: "POST",
                url: "deleterecords.php",
                data: {data: checkedvaues, file: file1},
                cache: false,
                success: function () {
                    sessionStorage.removeItem('checked-checkboxesviewproduct');
                    window.location.href = "view_product.php";
                }
            });
            $(this).parents(".show").animate({backgroundColor: "#003"}, "slow")
                    .animate({opacity: "hide"}, "slow");
        }
        return false;


    }
}
function confirmLimitSubmit() {
    if (document.getElementById('search_limit').value != "") {

        document.limit_go.submit();

    } else {
        return false;
    }
}


function checkAll() {

    var field = document.forms.deletefiles;
    for (i = 0; i < field.length; i++)
        field[i].checked = true;
}

function uncheckAll() {
    var field = document.forms.deletefiles;
    for (i = 0; i < field.length; i++)
        field[i].checked = false;
}

/*$.validator.setDefaults({
 submitHandler: function() { alert("submitted!"); }
 });*/
$(document).ready(function () {

    // validate signup form on keyup and submit
    $("#form1").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength: 200
            },
            address: {
                minlength: 3,
                maxlength: 500
            },
            contact1: {
                minlength: 3,
                maxlength: 20
            },
            contact2: {
                minlength: 3,
                maxlength: 20
            }
        },
        messages: {
            name: {
                required: "Please enter a supplier Name",
                minlength: "supplier must consist of at least 3 characters"
            },
            address: {
                minlength: "supplier Address must be at least 3 characters long",
                maxlength: "supplier Address must be at least 3 characters long"
            }
        }
    });

});
$(document).ready(function ()
{
    $("#checkall").live('click', function (event) {
        $('input:checkbox:not(#checkall)').attr('checked', this.checked);
//To Highlight
        if ($(this).attr("checked") == true)
        {
//$(this).parents('table:eq(0)').find('tr:not(#chkrow)').css("background-color","#FF3700");
            $("#tblDisplay").find('tr:not(#chkrow)').css("background-color", "#DCDCDC");
        } else
        {
//$(this).parents('table:eq(0)').find('tr:not(#chkrow)').css("background-color","#fff");
            $("#tblDisplay").find('tr:not(#chkrow)').css("background-color", "#DCDCDC");
        }
    });
    $('input:checkbox:not(#checkall)').live('click', function (event)
    {
        if ($("#checkall").attr('checked') == true && this.checked == false)
        {
            $("#checkall").attr('checked', false);
            $(this).closest('tr').css("background-color", "#ffffff");
        }
        if (this.checked == true)
        {
            $(this).closest('tr').css("background-color", "#DCDCDC");
            CheckSelectAll();
        }
        if (this.checked == false)
        {
            $(this).closest('tr').css("background-color", "#ffffff");
        }
    });

    function CheckSelectAll()
    {
        var flag = true;
        $('input:button:not(#checkall)').each(function () {
            if (this.checked == false)
                flag = false;
        });
        $("#checkall").attr('checked', flag);
    }
});
