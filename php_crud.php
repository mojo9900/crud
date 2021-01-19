<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php crud</title>
</head>

<body>
    <?php require_once 'process.php'; ?>

    <?php

    if(isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">

        <?php 
    echo $_SESSION['message'];
    unset($_SESSION['message']);
    ?>
    </div>
    <?php endif ?>

    <div class="container">
        <?php
    $mysqli = new mysqli('%', 'mojo9900', 'mojtaba52', 'crud') or die(mysqli_error($mysqli));
    $result = $mysqli ->query("SELECT * FROM data") or die($mysqli->error);
    ?>

        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Salary</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>

                <?php
            while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['salary']; ?></td>
                    <td>
                        <a href="php_crud.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                        <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>

            </table>
        </div>

        <?php
    function pre_r($array){
        echo'<pre>';
        print_r($array);
        echo '</pre>';
    }

    ?>
        <div class="row justify-content-center">
            <form action="process.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $name ;?>" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $email ;?>" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label>Salary/AED</label>
                    <input type="text" name="salary" class="form-control" value="<?php echo $salary ;?>" placeholder="Enter salary">
                </div>
                <div class="form-group">
                    <?php
                    if ($update == true):
                    ?>
                    <button class="btn btn-info" type="submit" name="update">Update</button>
                    <?php else: ?>
                    <button class="btn btn-primary" type="submit" name="save">Save</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</body>

</html>