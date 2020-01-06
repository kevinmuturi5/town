<?php
require_once "init.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $phone = "";
    //After validation and error hanlding...
    $name = trim($_POST["name"]);
    $phone = trim($_POST["phone"]);

    $sql = "UPDATE suppliers SET name = '$name', phone = '$phone' WHERE id='$supplier_id' ";
    if($result = mysqli_query($conn, $sql)){
        echo "success";
    }else{
        echo "Error";
    }
}   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
</head>
<body>
    <div style="margin: auto">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <?php
                $sql = "SELECT * FROM suppliers WHERE id = '$supplier_id'";

                if($result = mysqli_query($conn, $sql)){

                    while($row = mysqli_fetch_assoc($result)){
                        echo "<label for = 'name'>Name </label>";
                        echo "<input type'text' name='name' value='{$row["name"]}' >";
                        echo "<br>";
                        echo "<label for='phone'>Phone </label>";
                        echo "<input type='text' name='phone' value='{$row["phone"]}'>";
                        echo "<br><br>";
                        echo "<input type='submit' value='Submit'>";
                    }
                }else{
                    echo "Errror";
                }
            ?>
        </form>

    </div>
</body>
</html>