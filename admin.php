<?php
require_once 'connect.php';
require_once 'header.php';
require_once 'security.php';
$username = $_SESSION['username'];


$sql = "SELECT * FROM admin WHERE username = '$username'";

$result = mysqli_query($dbcon, $sql);
$row = mysqli_fetch_assoc($result);
$row_count = mysqli_num_rows($result);


if ($row_count == 1) {
    $fname = $row['fname'];
    $password = $row['password'];
    $email = $row['email'];
    $profile_pic = $row['profile_pic'];
} else {
    echo "<div class='w3-panel w3-pale-red w3-display-container'>Incorrect username or password.</div>";
}


?>
<style>
    .inp {
        border: none;
        border-bottom: 2px solid #1890ff;
        padding: 5px 0px;
        outline: none;
    }
</style>
<div class="text-center bg-white">
    <h1 class="mb-2">User Dashboard</h1>
</div>
<div style="display: flex; align-items:center; padding:20px 0px 40px 0px; flex-direction:column ">
    <div class='page-header' style="width:80%; margin-bottom:20px;">
        <div class='btn-toolbar pull-right'>
            <div class='btn-group'>
                <a href="new.php"><button type='button' class='btn btn-primary'>Create New Blog</button></a>
            </div>
        </div>
        <h2>Welcome <?php echo $fname; ?>,</h2>
    </div>
    <div class="card p-5" style="max-width: 720px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <div>
                    <?php
                    // Check if a file has been uploaded
                    if (isset($_FILES['fileToUpload'])) {

                        // Specify the target directory where the file will be uploaded
                        $target_dir = "assets/profile_img/";

                        // Get the filename and path of the uploaded file
                        $file_name = basename($_FILES["fileToUpload"]["name"]);
                        $target_file = $target_dir . time() . '_' . $file_name;

                        // Check if the file already exists
                        if (file_exists($target_file)) {
                            echo "File already exists. Please rename your file and try again.";
                        } else {
                            // Check if the file is a PNG and less than 1MB in size
                            $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                            $file_size = $_FILES["fileToUpload"]["size"];
                            if ($file_type != "png") {
                                echo "Only PNG files are allowed.";
                            } elseif ($file_size > 1000000) {
                                echo "Sorry, your file is too large. Please upload a file less than 1MB in size.";
                            } else {
                                // Move the uploaded file to the target directory
                                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                    // echo "assets/profile_img/" . $file_name;
                                    $sqlupdpic = "UPDATE admin SET profile_pic = '$target_file' WHERE username = '$username'";

                                    if (mysqli_query($dbcon, $sqlupdpic)) {
                                        echo '<meta http-equiv="refresh" content="0">';
                                    } else {
                                        echo "failed to uplaod." . mysqli_connect_error();
                                    }
                                } else {
                                    echo "Sorry, there was an error uploading your file.";
                                }
                            }
                        }
                    }
                    ?>
                    <p><img style="width:140px" src="<?php echo $profile_pic; ?>" /></p>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        <label for="fileToUpload">Select a file to change:</label>
                        <input type="file" name="fileToUpload" id="fileToUpload"><br  />
                        <br /><input type="submit" value="Change Pic" name="submit" class="btn btn-outline-success">
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><h3>Your Profile Detials</h3></h5><br/>
                    <div>
                        <?php
                        $sql = "SELECT * FROM admin WHERE username = '$username'";
                        $result = mysqli_query($dbcon, $sql);
                        if (mysqli_num_rows($result) == 0) {
                            header("location: index.php");
                        }
                        $row = mysqli_fetch_assoc($result);
                        $fname = $row['fname'];
                        $password = $row['password'];
                        $email = $row['email'];

                        if (isset($_POST['updpro'])) {
                            $fname = mysqli_real_escape_string($dbcon, $_POST['fname']);
                            $password = mysqli_real_escape_string($dbcon, $_POST['password']);
                            $email = mysqli_real_escape_string($dbcon, $_POST['email']);

                            $sql = "select * from admin where (email='$email');";
                            $res = mysqli_query($dbcon, $sql);
                            if (mysqli_num_rows($res) > 0) {
                                $row = mysqli_fetch_assoc($res);
                                if ($email == isset($row['email'])) {
                                    echo '<script>alert("Email already exists")</script>';
                                    echo '<meta http-equiv="refresh" content="0">';
                                }
                                return;
                            }
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $emailErr = "Invalid email format";
                                echo '<script>alert("Invalid Email")</script>';
                                echo '<meta http-equiv="refresh" content="0">';
                                return;
                            }

                            $sqlupdpro = "UPDATE admin SET fname = '$fname', password = '$password', email = '$email' WHERE username = '$username'";

                            if (mysqli_query($dbcon, $sqlupdpro)) {
                                echo '<meta http-equiv="refresh" content="0">';
                            } else {
                                echo "failed to edit." . mysqli_connect_error();
                            }
                        }
                        ?>
                        <form action="" method="POST">
                            <label><h5>Your Name: </h5></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="inp" type="text" name="fname" value="<?php echo $fname; ?>" />
                            <label><h5>Your Email: </h5></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="inp" type="text" name="password" value="<?php echo $email; ?>" />
                            <label><h5>Your Password: </h5></label>&nbsp;&nbsp;&nbsp;<input class="inp" type="text" name="email" value="<?php echo $password; ?>" /><br />
                            <br /><input type="submit" name="updpro" value="Update Details" class="btn btn-outline-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- </div> --><br  /><br/>
<h2 class="w3-center">All Blogs</h2>
<?php
$sql = "SELECT COUNT(*) FROM posts";
$result = mysqli_query($dbcon, $sql);
$r = mysqli_fetch_row($result);

// $numrows = $r[0];
// $rowsperpage = PAGINATION;
// $totalpages = ceil($numrows / $rowsperpage);
// $page = 1;

// if (isset($_GET['page']) && is_numeric($_GET['page'])) {
//     $page = (int)$_GET['page'];
// }
// if ($page > $totalpages) {
//     $page = $totalpages;
// }
// if ($page < 1) {
//     $page = 1;
// }
// $offset = ($page - 1) * $rowsperpage;

// $sql = "SELECT * FROM posts WHERE posted_by = '$username' ORDER BY id DESC LIMIT $offset, $rowsperpage";
$sql = "SELECT * FROM posts WHERE posted_by = '$username' ORDER BY id DESC";
$result = mysqli_query($dbcon, $sql);

if (mysqli_num_rows($result) < 1) {
    echo "No post found";
}
echo '<table class="table table-striped" style="width:80%;"><thead><tr>';
echo '<th scope="col">Title</th>';
echo '<th scope="col">Date Created</th>';
echo '<th scope="col">Actions</th>';
echo '</tr></thead>';
echo '<tbody>';

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $title = $row['title'];
    $slug = $row['slug'];
    $author = $row['posted_by'];
    $time = $row['date'];

    $permalink = "p/" . $id . "/" . $slug;
?>

    <tr scope="row">
        <!-- <td><?php echo $id; ?></td> -->
        <td><a href="<?php echo $permalink; ?>"><?php echo substr($title, 0, 50); ?></a></td>
        <td><?php echo $time; ?></td>
        <td><a href="edit.php?id=<?php echo $id; ?>">Edit</a> | <a href="del.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
        </td>
    </tr>

<?php
}
echo "</table>
</div>";

// // pagination
// echo "<p><div class='w3-bar w3-center'>";
// if ($page > 1) {
//     echo "<a href='?page=1' class='w3-btn'><<</a>";
//     $prevpage = $page - 1;
//     echo "<a href='?page=$prevpage' class='w3-btn'><</a>";
// }
// $range = 3;
// for ($i = ($page - $range); $i < ($page + $range) + 1; $i++) {
//     if (($i > 0) && ($i <= $totalpages)) {
//         if ($i == $page) {
//             echo "<div class='w3-btn w3-teal w3-hover-green'> $i</div>";
//         } else {
//             echo "<a href='?page=$i' class='w3-btn w3-border'>$i</a>";
//         }
//     }
// }
// if ($page != $totalpages) {
//     $nextpage = $page + 1;
//     echo "<a href='?page=$nextpage' class='w3-btn'>></a>";
//     echo "<a href='?page=$totalpages' class='w3-btn'>>></a>";
// }
// echo "</div></p>";

include("footer.php");
