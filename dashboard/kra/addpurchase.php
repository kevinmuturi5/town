<?php
//session_start();
require_once "../init.php";
include "../config/database.php";
// require_once("../config/database.php");
$user_id=$_SESSION['id'];
$state="ALTER TABLE purchases  ADD STATUS VARCHAR(30) DEFAULT 'declared' ";
$result=mysqli_query($conn,$state);

$sql = "select distinct `s`.`name` AS `supplier_name`,`s`.`pin` AS `kra`,`s`.`supplier_id` AS `supplier_id`,p.id as purId,p.vat AS VAT,`p`.`receipt_number`
AS `receipt_number`,`p`.`name` AS `product`,p.STATUS,`p`.`total_price` AS `taxable_income`,`p`.`date` AS 
`date`,`p`.`description` AS `description` from `purchases` `p` join `product_suppliers` `s`
on `p`.`supplier_id` = `s`.`supplier_id` WHERE p.supplier_id=$user_id AND p.STATUS='undeclared'";
                                        //$sql="SELECT * FROM master_data WHERE supplier_id=$user AND STATUS='declared'";
$result=mysqli_query($conn,$sql);
// if(!$result) { 
//     die(mysqli_error()); // TODO: better error handling
// }

                if(mysqli_num_rows($result)>0) { 
                        echo "<table class='table table-responsive'>";
                        echo "<thead>"; 
                        echo'<tr>';
                        echo "<th>Supplier_Name</th>";
                        echo "<th>Supplier_pin</th>";
                        echo "<th>product</th>";
                        echo "<th>Invoice Date</th>";
                        echo "<th>invoice No</th>";
                        echo "<th>description</th>";
                        echo "<th>Taxable value</th>";
                        echo "<th>vat</th>";
                        echo "<th>action</th>";
                        echo '</tr>' ;
                        echo("</thead>");
                        while ($row=mysqli_fetch_assoc($result)) {
                            //print_r($row);//prints the contents of ana array
                            //var_dump($row);
                            //echo implode('', $row);
                            //echo json_encode($row);

                        echo "<tr>";
                        echo "<td>".mysqli_real_escape_string($conn,$row["supplier_name"])."</td>";
                        echo "<td>".mysqli_real_escape_string($conn,$row["kra"])."</td>";
                        echo "<td>".mysqli_real_escape_string($conn,$row["product"])."</td>";
                        echo "<td>".mysqli_real_escape_string($conn,$row["date"])."</td>";
                        echo "<td>".mysqli_real_escape_string($conn,$row["receipt_number"])."</td>";
                        echo "<td>".mysqli_real_escape_string($conn,$row["description"])."</td>";
                        echo "<td>".mysqli_real_escape_string($conn,$row["taxable_income"])."</td>";
                        echo "<td>".mysqli_real_escape_string($conn,$row["VAT"])."</td>";
                        echo '<td><form method="POST" action="delete.php">
                             <button name="addpurchase" id="addpurchase" class="btn btn-outline-success"><i class="fa fa-plus"></i></button><input  type="hidden" name="addpur" id="addpur" value="'.mysqli_real_escape_string($conn,$row["purId"]).'">
                             </form>
                             </td>'; 

                        echo "</tr>";
    }}
                        echo "</table>";
?>