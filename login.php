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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تسجيل الدخول</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Tajawal', sans-serif;
    }
    .login-box {
      background: #fff;
      border: 1px solid #dee2e6;
      border-radius: 10px;
      padding: 30px;
      width: 100%;
      max-width: 400px;
    }
    .login-box h2 {
      margin-bottom: 20px;
      font-weight: 600;
      font-size: 22px;
      text-align: center;
    }
    .form-control {
      border-radius: 8px;
    }
    .btn-login {
      background: #6c757d;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 10px;
      width: 100%;
      font-weight: 500;
    }
    .btn-login:hover {
      background: #5a6268;
    }
    .alert {
      border-radius: 8px;
      font-size: 14px;
    }
  </style>
</head>
<body>

<div class="login-box">
  <h2>تسجيل الدخول</h2>

  <?php if (!empty($error)) { ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
  <?php } ?>

  <form method="post">
    <div class="mb-3">
      <label class="form-label">اسم المستخدم</label>
      <input type="text" name="username" class="form-control" placeholder="أدخل اسم المستخدم" required>
    </div>
    
    <div class="mb-4">
      <label class="form-label">كلمة المرور</label>
      <input type="password" name="password" class="form-control" placeholder="أدخل كلمة المرور" required>
    </div>
    
    <button type="submit" name="login" class="btn btn-login">دخول</button>
  </form>
</div>

</body>
</html>
