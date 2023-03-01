<?php
require_once 'connect.php';
require_once 'header.php';
require_once 'security.php';

if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($dbcon, $_POST['title']);
    $description = mysqli_real_escape_string($dbcon, $_POST ['description']);
    $slug = slug($title);
    $date = date('Y-m-d H:i');
    $posted_by = mysqli_real_escape_string($dbcon, $_SESSION['username']);

    $sql = "INSERT INTO posts (title, description, slug,posted_by, date) VALUES('$title', '$description', '$slug', '$posted_by', '$date')";
    mysqli_query($dbcon, $sql) or die("failed to post" . mysqli_connect_error());

    $permalink = "p/".mysqli_insert_id($dbcon) ."/".$slug;

    printf("Posted successfully. <meta http-equiv='refresh' content='2; url=%s'/>",
       $permalink);

} else {
    ?>
    <div class="w3-container mb-5">
        <div class="w3-card-4">
            <div class="w3-container bg-primary" style="text-align:center; color:white;">
                <h2>New Post</h2>
            </div>

            <form class="w3-container" method="POST">

                <p>
                    <label><h3>Title</h3></label>
                    <input type="text" class="w3-input w3-border" name="title" required>
                </p>

                <p>
                    <label><h3>Description</h3></label>
                    <textarea id = "description" row="30" cols="50" class="w3-input w3-border" name="description" required/></textarea>
                </p>
                <p>
                    <input type="submit" class="btn btn-success" name="submit" value="Post">
                </p>
            </form>

        </div>
    </div>
    <?php
}

include("footer.php");
