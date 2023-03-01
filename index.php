<?php
require_once 'connect.php';
require_once 'header.php';
?>
<?php
// COUNT
$sql = "SELECT COUNT(*) FROM posts";
$result = mysqli_query($dbcon, $sql);
$r = mysqli_fetch_row($result);
$numrows = $r[0];

$rowsperpage = PAGINATION;
$totalpages = ceil($numrows / $rowsperpage);

$page = 1;
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = (int)$_GET['page'];
}

if ($page > $totalpages) {
    $page = $totalpages;
}

if ($page < 1) {
    $page = 1;
}
$offset = ($page - 1) * $rowsperpage;

$sql = "SELECT * FROM posts ORDER BY id DESC LIMIT $offset, $rowsperpage";
$result = mysqli_query($dbcon, $sql);

if (mysqli_num_rows($result) < 1) {
    echo '<div class="w3-panel w3-pale-red w3-card-2 w3-border w3-round">No post yet!</div>';
} else {
    echo "<div style='display:flex;flex-wrap:wrap;justify-content: space-evenly' >";
    while ($row = mysqli_fetch_assoc($result)) {

        $id = htmlentities($row['id']);
        $by = htmlentities($row['posted_by']);
        $title = htmlentities($row['title']);
        $des = htmlentities(strip_tags($row['description']));
        $slug = htmlentities($row['slug']);
        $time = htmlentities($row['date']);

        $permalink = "p/" . $id . "/" . $slug;

        $sqlby = "SELECT * FROM admin WHERE username='$by'";
        $resultby = mysqli_query($dbcon, $sqlby);
        $rowby = mysqli_fetch_assoc($resultby);
        $fname = htmlentities($rowby['fname']);

        echo '<div class="card m-2 my-3" style="width: 18rem;">
        <div class="card-body">';
        echo "<h5 class='card-title'><a href='$permalink'>$title</a></h5>";
        echo '<h6 class="card-subtitle mb-2 text-muted">by: ' . $fname . '</h6>';

        echo '<p class="card-text">';
        echo substr($des, 0, 100);
        echo '</p>';

        echo "<a href='$permalink' class='card-link'>Read more...</a></p>";
        echo "<div class='w3-text-grey'> $time </div>";
        echo '</div></div>';
    }


    // echo "<p><div class='w3-bar w3-center'>";

    // if ($page > 1) {
    //     echo "<a href='?page=1'>&laquo;</a>";
    //     $prevpage = $page - 1;
    //     echo "<a href='?page=$prevpage' class='w3-btn'><</a>";
    // }

    // $range = 5;
    // for ($x = $page - $range; $x < ($page + $range) + 1; $x++) {
    //     if (($x > 0) && ($x <= $totalpages)) {
    //         if ($x == $page) {
    //             echo "<div class='w3-teal w3-button'>$x</div>";
    //         } else {
    //             echo "<a href='?page=$x' class='w3-button w3-border'>$x</a>";
    //         }
    //     }
    // }

    // // if ($page != $totalpages) {
    // //     $nextpage = $page + 1;
    // //     echo "<a href='?page=$nextpage' class='w3-button'>></a>";
    // //     echo "<a href='?page=$totalpages' class='w3-btn'>&raquo;</a>";
    // // }

    // echo "</div></p>";
}
echo "</div>";
// echo '<div class="card" style="width: 18rem;">
// <div class="card-body">
//   <h5 class="card-title">Card title</h5>
//   <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
//   <p class="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
//   <a href="#" class="card-link">Card link</a>
//   <a href="#" class="card-link">Another link</a>
// </div>
// </div>';
// include("categories.php");
include("footer.php");
