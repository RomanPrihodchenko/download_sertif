<?php
$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'bazait';

$connection = new mysqli($server, $username, $password, $dbname);
if ($connection -> connect_error) {
    die("Ошибка подключеия".$connection -> connect_error);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Hackathon</title>
        <!-- <link rel = "stylesheet" type = "text/css" href = "css/index.css"> -->
    </head>
    <body>
    <div class="container">
    <form action="index.php" method="post" enctype="multipart/form-data">
    <h3>Загрузите сертификаты</h3>
    <input autocomplete = "off" type="file" name="img_upload"><br>
    <input type="submit" name="upload" value="Загрузить">
    </form>
    <br>

    <hr>
    <br>
    
    <?php
	
    if(isset($_POST['upload'])){
	    if(!empty($_FILES['img_upload']['tmp_name'])) $img = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']));
	    $connection->query("INSERT INTO sertificates (img) VALUES ('$img')");
    }
	
	    $query = $connection->query("SELECT * FROM sertificates");
	    while($row = $query->fetch_assoc()){
		    $show_img = base64_encode($row['img']);?>
		    <img src="data:image/jpeg;base64, <?=$show_img ?>" alt="">
        <?php }
            $redirect_url = "index.php";
            // header('Location: index.php');
            // exit();
            mysqli_close($connection);
        ?>
        </div>
    </body>
</html>