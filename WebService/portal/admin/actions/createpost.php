<?php
include "../includes/logincheck.inc.php";
if($_SESSION["level"] <3)
{
  header("Location: ../noaccess.php");
  die();
}
include "../../config/config.inc.php";
include "../../includes/dictionary.inc.php";
include "../../includes/functions.inc.php";
$db = new PDO('mysql:host=localhost;dbname='.$mysqldb, $mysqluser, $mysqlpass);
$stmt = $db->prepare("INSERT INTO tblNews(title,text,author) VALUES (:title,:text,:author)");
$stmt->bindValue(':title', $_POST["posttitle"], PDO::PARAM_STR);
$stmt->bindValue(':deviceDesc', $_POST["text"], PDO::PARAM_STR);
$stmt->bindValue(':author', $_SESSION["username"], PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount()>0) {
	header("Location: ../index.php?message=postcreated");
}
?>
