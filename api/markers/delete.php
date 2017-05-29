<?php
/**
 * Created by PhpStorm.
 * User: Raluca Gherase
 * Date: 28.05.2017
 * Time: 16:32
 */

	require_once '../../database/dbconfig.php';

	$markers = $db_con->prepare("DELETE FROM tbl_markers WHERE id=:id");
	echo $markers->execute([
        ':id' => $_POST['id']
    ]);
	exit;