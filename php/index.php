<?php

include 'include/db.php';

$id = 1;

if(isset($_GET['id'])) {
    //använd get id - url?id=ETT ID
    //$id = $_GET['id'];
    $filteredID = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
}

$sth = $dbh->prepare('SELECT * 
                    FROM story
                    WHERE id = filteredID');
$sth->bindParam(':filteredID', $filteredID);
$sth->execute();
$story = $sth->fetch(PDO::FETCH_ASSOC);

$sth = $dbh->prepare('SELECT * 
                    FROM links
                    WHERE story_id = :filteredID');
$sth->bindParam(':filteredID', $filteredID);
$sth->execute();
$links = $sth->fetchAll(PDO::FETCH_ASSOC);

$page_title = "Soloäventyr - Start";

include 'views/index_layout.php';

?>