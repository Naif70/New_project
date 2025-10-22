<?php
session_start();
include('class/DBController.php');
$db = new DBController();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username=? AND password=?";
    $user = $db->runQuery($query, "ss", array($username, $password));

    if (!empty($user)) {
        $_SESSION['username'] = $user[0]['username'];
        $_SESSION['role'] = $user[0]['role'];

        if ($user[0]['role'] == 'admin') {
            header("Location: index.php");
        } else {
            header("Location: index.php?action=attendance");
        }
        exit;
    } else {
        $error = "❌ اسم المستخدم أو كلمة المرور غير صحيحة";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>تسجيل الدخول</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
          <h4>🔑 تسجيل الدخول</h4>
        </div>
        <div class="card-body">

          <?php if (!empty($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
          <?php } ?>

          <form method="post">
            <div class="mb-3">
              <label class="form-label">اسم المستخدم</label>
              <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">كلمة المرور</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">دخول</button>
          </form>

        </div>
        <div class="card-footer text-center">
          <p>ما عندك حساب؟ <a href="register.php">سجل هنا</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
