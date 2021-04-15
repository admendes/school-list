<!DOCTYPE html>
<html>
    <head>
        <title>School List</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <?php require_once 'process.php'; ?>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif ?>

        <div class="container">

            <?php
            $mysqli = new mysqli('localhost', 'root', '', 'school-list') or die(mysqli_error($mysqli));
            if (isset($_POST['list'])) {
                $school = $_POST['school'];
            } else {
                $school = "";
            }
            $result = $mysqli->query("SELECT * FROM data WHERE school='$school'");
            ?>

            <div class="row justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>School</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['school']; ?></td>
                            <td>
                                <a href="process.php?delete=<?php echo $row['id']; ?>"
                                   class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <form action="" method="POST">
                <div class ="row form-group">
                    <div class="col">
                        <select class="form-control" name="school" id="cars">
                            <option selected>Please select a school</option>
                            <option value="University of Porto">University of Porto</option>
                            <option value="University of Coimbra">University of Coimbra</option>
                            <option value="University of Minho">University of Minho</option>
                            <option value="NOVA University of Lisbon">NOVA University of Lisbon</option>
                        </select>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary" name="list">View</button>
                    </div>
                </div>
        </div>
    </form>

    <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <div class="form-group">
                <h3>Add a new student</h3>
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <label>School</label>
                <select class="form-control" name="school" id="cars">
                        <option value="University of Porto">University of Porto</option>
                        <option value="University of Coimbra">University of Coimbra</option>
                        <option value="University of Minho">University of Minho</option>
                        <option value="NOVA University of Lisbon">NOVA University of Lisbon</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="save">Add</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>