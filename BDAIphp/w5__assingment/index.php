<?php
require_once "pdo.php";
session_start();

/// Set Error Message 
if (isset($_SESSION['error'])) {
    $msg = '<div class="alert alert-warning" role="alert">
                <strong>' . $_SESSION['error'] . '</strong>
            </div>';
    unset($_SESSION['error']);
}

/// Set Success Message
if (isset($_SESSION['success'])) {
    $msg = '<div class="alert alert-success" role="alert">
                <strong>' . $_SESSION['success'] . '</strong>
            </div>';
    unset($_SESSION['success']);
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Sajib Adhikary - READ</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <br>
        <span><?= empty($msg) ? '' : $msg ?></span>

        <?php if (!isset($_SESSION['user'])) : ?>
            <p><a href="login.php">Please log in</a></p>

            <p>Attempt to <a href="add.php">add data</a> without logging in</p>
        <?php else : ?>
            <?php
            $selectQuery = "SELECT * FROM autos";
            $data = $pdo->query($selectQuery);
            if ( !empty($data ) ) :
            ?>
                <!-- DataTable -->
                <table class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Year</th>
                            <th>Mileage</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot class="tfoot-inverse">
                        <tr>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Year</th>
                            <th>Mileage</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php while ($users = $data->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td scope="row"><?= htmlentities($users['make']) ?></td>
                                <td><?= htmlentities($users['model']) ?></td>
                                <td><?= htmlentities($users['year']) ?></td>
                                <td><?= htmlentities($users['mileage']) ?></td>
                                <td>
                                    <a class="btn btn-danger" href="edit.php?id=<?= $users['id'] ?>" role="button">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="delete.php?id=<?= $users['id'] ?>" role="button">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>No rows found</p>
            <?php endif ?>
            <!-- Add New Entry Button -->
            <div class="row">
                <a name="" id="" class="btn btn-primary" href="add.php" role="button">Add New Entry</a>
            </div>
            <br>
            <!-- Logout Button -->
            <div class="row">
                <a name="" id="" class="btn btn-warning" href="logout.php" role="button">Log Out</a>
            </div>
        <?php endif; ?>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>