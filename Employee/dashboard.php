<?php
include 'db.php';
include 'auth.php';
requireLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Dashboard</h2>
    <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
    <a href="logout.php" class="btn btn-danger">Logout</a>
        <a href="register.php" class="btn btn-primary">Register User</a>
        <a href="add_employee.php" class="btn btn-success">Add Employee</a>     
    <h3 class="mt-3">Employees</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Position</th>
            <?php if (isAdmin()): ?>
                <th>Actions</th>
            <?php endif; ?>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM employees";
        $result = $conn->query($sql);
        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['position']; ?></td>
                <a href="update_employee.php" class="btn btn-warning">Update</a>
                <a href="delete_employee.php" class="btn btn-danger">Delete</a>
            </tr>
        <?php
            endwhile;
        else:
        ?>
            <tr>
                <td colspan="<?php echo isAdmin() ? 6 : 5; ?>" class="text-center">No employees found</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
