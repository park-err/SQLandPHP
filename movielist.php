<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>
<body>
    <?php
        if (!isset($_POST['submit'])) { 
    ?>

    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
        <label for="MovieTitle">Movie Title</label>
        <input type="text" name="MovieTitle" required>
        <label for="Director">Director</label>
        <input type="text" name="Director" required>
        <label for="Length">Movie Length</label>
        <input type="number" name="Length" required>

        <input type="submit" name="submit">
    </form>

    <?php
        } else {
            try {
                $db = new PDO('sqlite:movies.db');
                $sql = "INSERT INTO movie VALUES (:MovieTitle, :Director, :Length)";
                $statement = $db->prepare($sql);
                // named params

                $title = filter_input(INPUT_POST, 'MovieTitle');
                $statement->bindValue(":MovieTitle, $title", PDO::PARAM_STR);

                $director = filter_input(INPUT_POST, 'Director');
                $statement->bindValue(":Director, $director", PDO::PARAM_STR);

                $length = filter_input(INPUT_POST, 'Length');
                $statement->bindValue(":Length, $length", PDO::PARAM_INT);

                $success = $statement->execute();
                if ($success) {
                    echo "Film was added successfully";
                } else {
                    echo "Something went wrong";
                }
                $db = null;
            } catch (PDOException $e) {
            // for dev
            print "we had an error" . $e->getMessage() . "</br>";
            die();
        }
    }
    ?>
</body>
</html>