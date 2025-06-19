<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>
<body>
    <h1>Search</h1>
    <form action="search.php" method="post">
      <input type="text" name="search" placeholder="Search username">
      <button type="submit">Search</button>
    </form>

    <?php
      require_once "includes/dbh.inc.php";

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $search = trim($_POST['search'] ?? "");

        $sql = "SELECT * FROM users WHERE username LIKE :search;";
        $stmt = $pdo->prepare($sql);

        $searchParams = "%$search%";
        $stmt->bindParam(':search', $searchParams, PDO::PARAM_STR);

        $stmt->execute();

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($users)) {
        echo "<p>No users found.</p>";
      } else {
        // Hiển thị bảng kết quả
        echo "<table>";
        echo "<tr><th>ID</th><th>Username</th><th>Email</th></tr>";

        foreach ($users as $user) {
          echo "<tr>";
          echo "<td>" . htmlspecialchars($user['id']) . "</td>";
          echo "<td>" . htmlspecialchars($user['username']) . "</td>";
          echo "<td>" . htmlspecialchars($user['email']) . "</td>";
          echo "</tr>";
        }

        echo "</table>";
      }

        $pdo = null;
        $stmt = null;
      }
  ?>
</body>
</html>


  