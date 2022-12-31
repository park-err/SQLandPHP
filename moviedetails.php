<?php

    $db = new PDO('sqlite:Employees.db');

    try {
    $sql = "SELECT * FROM employees WHERE id=:eid";
    
    //prepare statement
    $statement = $db->prepare($sql);

    //get value form querystring and bind
    $id = filter_input(INPUT_GET, "id");
    $statement->bindValue(':eid', $id, PDO::PARAM_INT);

    // execute the query
    $statement->execute();

    // create the array of records
    $r = $statement->fetch();
    $db = null;

    //check contents of array
    if (!$r) {
        echo "No employee found";
        exit();
    }
    } catch(PDOException $e) {
    print "We had an error: " . $e->getMessage() . "<br/>";
    die();
    }

?>

<h1><?php echo htmlspecialchars($r['id']);?></h1>
<p>Name: <?php echo htmlspecialchars($r['name']);?></p>
<p>Position:<?php echo htmlspecialchars($r['position']); ?></p>