<?php
session_start();
$host = 'localhost';
$db = 'foodblog';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass) or die('Unable to connect');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e . getMessage();
}

$_SESSION['conection'] = $conn;

function getMessage()
{
    "fuck";
}

$query = "SELECT * FROM posts WHERE id = 2";
$query2 = "SELECT posts.id, writers.name
FROM writers
INNER JOIN posts ON writers.id = posts.id
where writers.id = 2;";
$result = $conn->query($query);
$i = 0;
while ($row = $result->fetch()) {
    $i = $i + 1;
    $_SESSION['title2'] = $row['title'];
    $_SESSION['url2'] = $row['imgurl'];
    $_SESSION['content2'] = $row['content'];
    $_SESSION['datum2'] = $row['datum'];
    $_SESSION['id2'] = $row['id'];
    $_SESSION['likes2'] = $row['likes'];
}
$result = $conn->query($query2);
while ($row = $result->fetch()) {
    $_SESSION['writer2'] = $row['name'];
}

$query = "SELECT * FROM posts WHERE id = 1";
$query2 = "SELECT posts.id, writers.name
FROM writers
INNER JOIN posts ON writers.id = posts.id
where writers.id = 1;";
$result = $conn->query($query);
$i = 0;
while ($row = $result->fetch()) {
    $i = $i + 1;
    $_SESSION['title'] = $row['title'];
    $_SESSION['url'] = $row['imgurl'];
    $_SESSION['content'] = $row['content'];
    $_SESSION['datum'] = $row['datum'];
    $_SESSION['id'] = $row['id'];
    $_SESSION['likes'] = $row['likes'];
}
$result = $conn->query($query2);

while ($row = $result->fetch()) {
    $_SESSION['writer'] = $row['name'];
}

if (isset($_POST['like'])) {
    $_SESSION['likes'] = $_SESSION['likes'] + 1;
    $querylikes = 'UPDATE posts
SET likes =' . $_SESSION['likes'] . '
WHERE id = ' . $_SESSION['id'];

    $result = $conn->exec($querylikes);
}
unset($_POST['like']);

if (isset($_POST['like2'])) {
    $_SESSION['likes2'] = $_SESSION['likes2'] + 1;
    $querylikes = 'UPDATE posts
SET likes =' . $_SESSION['likes2'] . '
WHERE id = ' . $_SESSION['id2'];

    $result = $conn->exec($querylikes);
}
unset($_POST['like2']);



$query3 = "SELECT tags.tags
FROM posts
INNER JOIN tags ON posts.id=tags.id;";
$result4 = $conn->query($query3);
$result4 = $result4->fetchAll();
$_SESSION['tags1'] = $result4[0][0];

$query4 = "SELECT tags.tags
FROM posts
INNER JOIN tags ON posts.id=tags.id;";
$result4 = $conn->query($query3);
$result4 = $result4->fetchAll();
$_SESSION['tags2'] = $result4[1][0];


?>



<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php
    include 'connection.php';

    # Haal hier alle posts uit de data base op.
    ?>

    <div class="container">

        <div id="header">
            <h1>Foodblog</h1>
            <a href="new_post.php"><button>Nieuwe post</button></a>
        </div>
        <h3>Most Popular Cheifs</h3>

        <ol>
            <?php
            $query = "SELECT id FROM posts ORDER BY likes DESC";
            $result = $_SESSION['conection']->query($query);
            $resultmain = $result->fetchAll();
            for ($i = 0; $i < 2; $i++) {
                $query = "SELECT name FROM writers WHERE id =" . $resultmain[$i][0];
                $result = $_SESSION['conection']->query($query);
                $result = $result->fetchAll();
                $names[$i] = $result[0];
            }

            for ($i = 0; $i < 2; $i++) {
                echo "<li>" . $names[$i][0] . "</li>";
            }

            ?>
        </ol>
        <div class="post">

            <div class="header">
                <h2><?php echo $_SESSION['title'] ?></h2>
                <img src="<?php echo $_SESSION['url'] ?>" />
            </div>

            <span class="details"> <a href=""><?php echo $_SESSION['tags1'] ?> </a> <?php echo $_SESSION['writer'] ?>
                <?php echo $_SESSION['datum'] ?></b></span>
            <span class="right">
                <form action="index.php" method="post">
                    <button type="submit" value="<?php echo $_SESSION['id']; ?>" name="like">
                        <?= $_SESSION['likes']; ?> likes
                    </button>
                </form>
            </span>

            <p><?php echo $_SESSION['content'] ?></p>
        </div>

        <div class="post">

            <div class="header">
                <h2><?php echo $_SESSION['title2'] ?></h2>
                <img src="<?php echo $_SESSION['url2'] ?>" />
            </div>

            <span class="details"><a href=""><?php echo $_SESSION['tags2'] ?> </a> <?php echo $_SESSION['writer2'] ?>
                <?php echo $_SESSION['datum2'] ?></b></span>
            <span class="right">
                <form action="index.php" method="post">
                    <button type="submit" value="<?php echo $_SESSION['id2']; ?>" name="like2">
                        <?php echo $_SESSION['likes2']; ?> likes
                    </button>
                </form>
            </span>
            <p><?php echo $_SESSION['content2'] ?></p>
        </div>

    </div>
</body>

</html>
