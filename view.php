<?php
require_once 'connect.php';
require_once 'header.php';

$id = (INT)$_GET['id'];
if ($id < 1) {
    header("location: $url_path");
}
$sql = "Select * FROM posts WHERE id = '$id'";
$result = mysqli_query($dbcon, $sql);

$invalid = mysqli_num_rows($result);
if ($invalid == 0) {
    header("location: $url_path");
}

$hsql = "SELECT * FROM posts WHERE id = '$id'";
$res = mysqli_query($dbcon, $hsql);
$row = mysqli_fetch_assoc($result);

$id = $row['id'];
$title = $row['title'];
$description = $row['description'];
$author = $row['posted_by'];
$time = $row['date'];

echo '<div class="container p-3 my-3 border">';

echo "<center><h2>$title</h2></center>";
echo "<style>.container img{width:100%;}</style>";
echo '<div class="container p-10">';
echo "$description<br><br>";
echo '<div class="w3-text-grey">';
echo "Posted by: " . $author . "<br>";
echo "$time</div>";
?>

<br />
<?php
if (isset($_SESSION['username']) && $_SESSION['username']==$row['posted_by']) {
    ?>
    <div class="w3-text-green"><a class="btn btn-primary mb-3" href="<?=$url_path?>edit.php?id=<?php echo $row['id']; ?>">[Edit]</a></div>
    <div class="w3-text-red">
        <a class="btn btn-danger" href="<?=$url_path?>del.php?id=<?php echo $row['id']; ?>"
           onclick="return confirm('Are you sure you want to delete this post?'); ">[Delete]</a></div>
    <?php
}
echo '</div></div>';
echo '

';

include("footer.php");
