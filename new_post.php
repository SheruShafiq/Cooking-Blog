<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penetration</title>
    <link rel="stylesheet" href="styleask.css">
</head>

<body>
    <h1>Self INSERT Incel</h1>
    <form method="post">
        <h3>Title</h3>
        <input type="text" name="title" id="t1">
        <h3>Date</h3>
        <input type="time" name="date" id="r2">
        <h3>Image Url</h3>
        <input type="text" name="url" id="l3">
        <h3>Content</h3>
        <input type="text" name="content" id="o4">
        <h3>Author</h3>
        <input type="text" name="author" id="o0">
        <button type="submit" name="save" value="1" id="s7">Save Changes</button>
    </form>
    <?php
    $host = 'localhost';
    $db   = 'foodblog';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    if (isset($_POST['save'])) {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass) or die('Unable to connect');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $title = $_POST['title'];
        $author = $_POST['author'];
        $date =  $_POST['date'];
        $url  = $_POST['url'];
        $content = $_POST['content'];
        $sql = "
 INSERT INTO `posts` (`title`, `datum`, `imgurl`, `content`) VALUES
 ('$title', '$date', '$url', '$content')";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $sql = " INSERT INTO `writers` (`name`) VALUES
        ('$author')";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

    ?>
    <form action="index.php" method="post" action="index.php">
        <button type="submit" class="d6">Go back</button>
    </form>
</body>

</html>
