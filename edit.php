<?php
require_once 'connect.php';
require_once 'header.php';
require_once 'security.php';

$id = (int)$_GET['id'];
if ($id < 1) {
    header("location: index.php");
}

$sql = "SELECT * FROM posts WHERE id = '$id'";
$result = mysqli_query($dbcon, $sql);
if (mysqli_num_rows($result) == 0) {
    header("location: index.php");
}
$row = mysqli_fetch_assoc($result);
$id = $row['id'];
$title = $row['title'];
$description = $row['description'];
$slug = $row['slug'];
$permalink = "p/" . $id . "/" . $slug;

if (isset($_POST['upd'])) {
    $id = $_POST['id'];
    $title = mysqli_real_escape_string($dbcon, $_POST['title']);
    $description = mysqli_real_escape_string($dbcon, $_POST['description']);
    $slug = slug(mysqli_real_escape_string($dbcon, $_POST['slug']));

    $sql2 = "UPDATE posts SET title = '$title', description = '$description', slug = '$slug' WHERE id = $id";

    if (mysqli_query($dbcon, $sql2)) {
        echo '<meta http-equiv="refresh" content="0">';
    } else {
        echo "failed to edit." . mysqli_connect_error();
    }
}
?>

<div class="w3-container">
    <div class="w3-card-4">

        <div class="w3-container bg-primary" style="text-align:center; color:white;">
            <h2>Edit Post</h2>
        </div>
        <h4 class="w3-container" style="text-decoration: underline;"><a href="<?= $permalink ?>">Goto post</a> </h4>

        <form action="" method="POST" class="w3-container">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <p>
                <label>
                    <h3>Title</h3>
                </label>
                <input type="text" class="w3-input w3-border" name="title" value="<?php echo $title; ?>">
            <p>
            <p>
                <label>
                    <h3>Description</h3>
                </label>
                <textarea class="w3-input w3-border" id="description" name="description"><?php echo $description; ?> </textarea>
            </p>
            <p>
                <label>
                    <h3>Slug URL</h3>
                </label>
                <input type="text" class="w3-input w3-border" name="slug" value="<?php echo $slug; ?>">
            </p>
            <p>
                <input type="submit" class="btn btn-success" name="upd" value="Save post">
            </p>

            <p>
            <div class="w3-text-red">
                <a class="btn btn-danger" href="<?= $url_path ?>del.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?'); ">Delete Post</a>
            </div>
            </p>
        </form>
    </div>
</div>
<br />
<?php

mysqli_close($dbcon);
include("footer.php");
