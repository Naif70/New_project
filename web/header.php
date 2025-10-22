<html>
<head>
<title>How to Create PHP Crud using OOPS and MySQLi</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="web/css/style.css" type="text/css" rel="stylesheet" />
</head>
<body class="bg-light">

  <h2 class="text-center mt-3">How to Create PHP Crud using OOPS and MySQLi</h2>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="index.php">Attendance System</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">Students</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?action=attendance">Attendance</a></li>

          <?php if (isset($_SESSION['username'])) { ?>
            <li class="nav-item">
            <a href="../logout.php" class="btn btn-danger btn-sm ms-2">🚪 Logout</a>

            </li>
          <?php } else { ?>
            <li class="nav-item">
              <a href="web/logout.php" class="btn btn-danger">🚪 Logout</a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
