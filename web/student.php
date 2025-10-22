<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "web/header.php"; 
?>
<div style="text-align: right; margin: 20px 0px 10px;">
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
        <a id="btnAddAction" href="index.php?action=student-add">
            <img src="web/image/icon-add.png" /> Add Student
        </a>
    <?php } ?>
</div>

<div id="toys-grid">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th><strong>Student Name</strong></th>
                <th><strong>Roll Number</strong></th>
                <th><strong>Date of Birth</strong></th>
                <th><strong>Class</strong></th>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
                    <th><strong>Action</strong></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($result)) {
                foreach ($result as $row) {
            ?>
            <tr>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["roll_number"]; ?></td>
                <td><?php echo $row["dob"]; ?></td>
                <td><?php echo $row["class"]; ?></td>

                <?php if ($_SESSION['role'] === 'admin') { ?>
                <td>
                    <a class="btnEditAction" 
                       href="index.php?action=student-edit&id=<?php echo $row["id"]; ?>">
                        <img src="web/image/icon-edit.png" />
                    </a>
                    <a class="btnDeleteAction" 
                       href="index.php?action=student-delete&id=<?php echo $row["id"]; ?>"
                       onclick="return confirm('هل أنت متأكد من الحذف؟');">
                        <img src="web/image/icon-delete.png" />
                    </a>
                </td>
                <?php } ?>
            </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</body>
</html>
