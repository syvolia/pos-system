<?php
$SQL = "SELECT * FROM  customer_details";
if (isset($_POST['Search']) AND trim($_POST['searchtxt']) != "") {

    $SQL = "SELECT * FROM  customer_details WHERE customer_name LIKE '%" . $_POST['searchtxt'] . "%' OR customer_address LIKE '%" . $_POST['searchtxt'] . "%' OR customer_contact1 LIKE '%" . $_POST['searchtxt'] . "%' OR customer_contact2 LIKE '%" . $_POST['searchtxt'] . "%'";


}

$tbl_name = "customer_details";        //your table name

// How many adjacent pages should be shown on each side?

$adjacents = 3;


/*

   First get total number of rows in data table.

   If you have a WHERE clause in your query, make sure you mirror it here.

*/

$query = "SELECT COUNT(*) as num FROM $tbl_name";
if (isset($_POST['Search']) AND trim($_POST['searchtxt']) != "") {

    $query = "SELECT COUNT(*) as num FROM  customer_details WHERE customer_name LIKE '%" . $_POST['searchtxt'] . "%' OR customer_address LIKE '%" . $_POST['searchtxt'] . "%' OR customer_contact1 LIKE '%" . $_POST['searchtxt'] . "%' OR customer_contact2 LIKE '%" . $_POST['searchtxt'] . "%'";


}


$total_pages = mysqli_fetch_array(mysqli_query($db->connection, $query));

$total_pages = $total_pages['num'];


/* Setup vars for query. */

$targetpage = "view_customer_details.php";    //your file name  (the name of this file)

$limit = 10;                                //how many items to show per page
if (isset($_GET['limit']))
    $limit = $_GET['limit'];


$page = isset($_GET['page']) ? $_GET['page'] : 0;

if ($page)

    $start = ($page - 1) * $limit;            //first item to display on this page

else

    $start = 0;                                //if no page var is given, set start to 0


/* Get data. */

$sql = "SELECT * FROM customer_details LIMIT $start, $limit ";
if (isset($_POST['Search']) AND trim($_POST['searchtxt']) != "") {

    $sql = "SELECT * FROM  customer_details WHERE customer_name LIKE '%" . $_POST['searchtxt'] . "%' OR customer_address LIKE '%" . $_POST['searchtxt'] . "%' OR customer_contact1 LIKE '%" . $_POST['searchtxt'] . "%' OR customer_contact2 LIKE '%" . $_POST['searchtxt'] . "%'  LIMIT $start, $limit";


}


$result = mysqli_query($db->connection, $sql);


/* Setup page vars for display. */

if ($page == 0) $page = 1;                    //if no page var is given, default to 1.

$prev = $page - 1;                            //previous page is page - 1

$next = $page + 1;                            //next page is page + 1

$lastpage = ceil($total_pages / $limit);        //lastpage is = total pages / items per page, rounded up.

$lpm1 = $lastpage - 1;                        //last page minus 1


/*

    Now we apply our rules and draw the pagination object.

    We're actually saving the code to a variable in case we want to draw it more than once.

*/

$pagination = "";

if ($lastpage > 1) {

    $pagination .= "<div class=\"pagination\">";

    //previous button

    if ($page > 1)

        $pagination .= "<a href=\"$targetpage?page=$prev&limit=$limit\">« previous</a>";

    else

        $pagination .= "<span class=\"disabled\">« previous</span>";


    //pages

    if ($lastpage < 7 + ($adjacents * 2))    //not enough pages to bother breaking it up

    {

        for ($counter = 1; $counter <= $lastpage; $counter++) {

            if ($counter == $page)

                $pagination .= "<span class=\"current\">$counter</span>";

            else

                $pagination .= "<a href=\"$targetpage?page=$counter&limit=$limit\">$counter</a>";

        }

    } elseif ($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some

    {

        //close to beginning; only hide later pages

        if ($page < 1 + ($adjacents * 2)) {

            for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {

                if ($counter == $page)

                    $pagination .= "<span class=\"current\">$counter</span>";

                else

                    $pagination .= "<a href=\"$targetpage?page=$counter&limit=$limit\">$counter</a>";

            }

            $pagination .= "...";

            $pagination .= "<a href=\"$targetpage?page=$lpm1&limit=$limit\">$lpm1</a>";

            $pagination .= "<a href=\"$targetpage?page=$lastpage&limit=$limit\">$lastpage</a>";

        } //in middle; hide some front and some back

        elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

            $pagination .= "<a href=\"$targetpage?page=1&limit=$limit\">1</a>";

            $pagination .= "<a href=\"$targetpage?page=2&limit=$limit\">2</a>";

            $pagination .= "...";

            for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {

                if ($counter == $page)

                    $pagination .= "<span class=\"current\">$counter</span>";

                else

                    $pagination .= "<a href=\"$targetpage?page=$counter&limit=$limit\">$counter</a>";

            }

            $pagination .= "...";

            $pagination .= "<a href=\"$targetpage?page=$lpm1&limit=$limit\">$lpm1</a>";

            $pagination .= "<a href=\"$targetpage?page=$lastpage&limit=$limit\">$lastpage</a>";

        } //close to end; only hide early pages

        else {

            $pagination .= "<a href=\"$targetpage?page=1&limit=$limit\">1</a>";

            $pagination .= "<a href=\"$targetpage?page=2&limit=$limit\">2</a>";

            $pagination .= "...";

            for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {

                if ($counter == $page)

                    $pagination .= "<span class=\"current\">$counter</span>";

                else

                    $pagination .= "<a href=\"$targetpage?page=$counter&limit=$limit\">$counter</a>";

            }

        }

    }


    //next button

    if ($page < $counter - 1)

        $pagination .= "<a href=\"$targetpage?page=$next&limit=$limit\">next »</a>";

    else

        $pagination .= "<span class=\"disabled\">next »</span>";

    $pagination .= "</div>\n";

}

?>