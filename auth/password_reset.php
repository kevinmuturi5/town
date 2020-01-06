<?php
/**
 * Created by PhpStorm.
 * User: nabesh
 * Date: 8/3/19
 * Time: 5:45 PM
 */
?>
</<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script src="../public/js/script.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/js/bootstrap.min.js">
    <link rel="stylesheet" href="../public/css/main.css">
    <script src="script.js"></script>

    <title>Password reset</title>
</head>
<body>
<main>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 offset-4">
            <div id="msg"></div>
            <h2>Change Password here</h2>
            <?php
            require_once '../config/database.php';
            $mail = $_GET['email'];
            ?>
            <input type="hidden" class="form-control" id="email" value="<?php echo $mail;?>" readonly>
            <div class="form-group">
                    <label>Enter Recovery Password</label>
                    <input type="password" class="form-control" id="oldpass">
                <div id="olderr"></div>
                </div>
            <div class="form-group">
                    <label>Enter New Password</label>
                    <input type="password" class="form-control" id="newpass">
                <div id="newerr"></div>
                </div>
            <button class="btn btn-outline-primary" id="changepass">Change Password</button>
        </div>
    </div>

</div>
</main>
</body>
</html>
