<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "blog";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$limit = 5; 
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;


$search = "";
$whereClause = "";
if (isset($_GET['search']) && $_GET['search'] != "") {
    $search = $_GET['search'];
    $whereClause = "WHERE title LIKE '%$search%' OR content LIKE '%$search%'";
}


$countSql = "SELECT COUNT(*) AS total FROM posts $whereClause";
$countResult = $conn->query($countSql);
$totalPosts = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalPosts / $limit);


$sql = "SELECT * FROM posts $whereClause ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Posts</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

  <h2 class="mb-4">Posts</h2>

  
  <form method="GET" class="d-flex mb-4">
    <input type="text" name="search" class="form-control me-2" placeholder="Search posts..." value="<?php echo htmlspecialchars($search); ?>">
    <button type="submit" class="btn btn-primary">Search</button>
  </form>

  
  <?php
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          echo "<div class='card mb-3'>";
          echo "<div class='card-body'>";
          echo "<h5 class='card-title'>" . htmlspecialchars($row['title']) . "</h5>";
          echo "<p class='card-text'>" . htmlspecialchars($row['content']) . "</p>";
          echo "<small class='text-muted'>Posted on " . $row['created_at'] . "</small>";
          echo "</div>";
          echo "</div>";
      }
  } else {
      echo "<p>No posts found.</p>";
  }
  ?>

  
  <nav>
    <ul class="pagination">
      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
          <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>">
            <?php echo $i; ?>
          </a>
        </li>
      <?php endfor; ?>
    </ul>
  </nav>

</body>
</html>
