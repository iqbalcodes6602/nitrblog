<?php
require_once 'connect.php';
require_once 'header.php';

if (isset($_GET['q'])) {
  $q = mysqli_real_escape_string($dbcon, $_GET['q']);

  $sql = "SELECT * FROM posts WHERE title LIKE '%{$q}%' OR description LIKE '%{$q}%'";
  $result = mysqli_query($dbcon, $sql);

  if (mysqli_num_rows($result) < 1) {
    echo "<div class='w3-container w3-padding'><h2>No Result found for '$q'</h2></div>";
  } else {
    echo "<div class='w3-container w3-padding'><h2>Showing results for '$q'</h2></div>";
    echo "<div style='display:flex;flex-wrap:wrap;' >";

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

      echo '<div class="card m-3 my-4" style="width: 18rem;">
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
  }
}
echo "</div>";
include("footer.php");
