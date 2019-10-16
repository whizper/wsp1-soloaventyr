<?php
session_start(); // starta en session
include 'include/db.php';

$filteredId = 1;

if(isset($_GET['id'])) {
    $filteredId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $_SESSION['id'] = $filteredId; // spara story i session
} elseif (isset($_SESSION['id'])) {
    // om session har sparat en story id så ladda denna sida
    $filteredId = filter_var($_SESSION['id'], FILTER_VALIDATE_INT);
}

$sth = $dbh->prepare('SELECT * 
                    FROM story
                    WHERE id = :filteredId');
$sth->bindParam(':filteredId', $filteredId);
$sth->execute();
$story = $sth->fetch(PDO::FETCH_ASSOC);

$sth = $dbh->prepare('SELECT * 
                    FROM links
                    WHERE story_id = :filteredId');
$sth->bindParam(':filteredId', $filteredId);
$sth->execute();
$links = $sth->fetchAll(PDO::FETCH_ASSOC);

$page_title = "Soloäventyr - Start";

include 'views/index_layout.php';

?>