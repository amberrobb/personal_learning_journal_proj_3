<?php

#####################################################
# get all journals in chronologic order for index.php
#####################################################
function get_journal_list() {
	include "connection.php";

	try {
		return $db->query("SELECT id, title, date, tags FROM entries ORDER BY date(date) DESC");
	} catch (Exception $e) {
		echo $e->getMessage();
		die();
	}
}

#######################################################
# get all journals with the given tag
#######################################################
function get_journal_list_via_tag($tag) {
	include 'connection.php';

		$sql_tag = "%" . $tag . "%";
    
    $sql = "SELECT id, title, date, tags FROM entries WHERE tags LIKE ? ORDER BY date(date) DESC";
    
    try {
        $results = $db->prepare($sql);
        $results->bindValue(1, $sql_tag, PDO::PARAM_STR);
        $results->execute();
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
    return $results->fetchAll();
}

#####################################################
# get journal details for the given id
#####################################################
function get_journal($id){
    include 'connection.php';
    
    $sql = 'SELECT * FROM entries WHERE id = ?';
    
    try {
        $results = $db->prepare($sql);
        $results->bindValue(1, $id, PDO::PARAM_INT);
        $results->execute();
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
    return $results->fetch();
}

##########################################
# create new journal entry
##########################################
function new_journal($title, $date, $time_spent, $learned, $resources = null, $tags = null) {
	include 'connection.php';

	$sql = "INSERT INTO entries(title, date, time_spent, learned, resources, tags) VALUES(?, ?, ?, ?, ?, ?)";

	try {
		$results = $db->prepare($sql);
		$results->bindValue(1, $title, PDO::PARAM_STR);
		$results->bindValue(2, $date, PDO::PARAM_STR);
		$results->bindValue(3, $time_spent, PDO::PARAM_STR);
		$results->bindValue(4, $learned, PDO::PARAM_STR);
		$results->bindValue(5, $resources, PDO::PARAM_STR);
		$results->bindValue(6, $tags, PDO::PARAM_STR);
		$results->execute();
	} catch (Exception $e) {
		echo "<h3>Error: " . $e->getMessage() . "</h3><br />";
		return false;
	}
	return true;
}

#######################################
# fupdate journal
#######################################
function update_journal($id, $title, $date, $time_spent, $learned, $resources = null, $tags = null) {
	include 'connection.php';


	$sql = "UPDATE entries SET title = ?, date = ?, time_spent = ?, learned = ?, resources = ?, tags = ? WHERE id = ?";

	try {
		$results = $db->prepare($sql);
		$results->bindValue(1, $title, PDO::PARAM_STR);
		$results->bindValue(2, $date, PDO::PARAM_STR);
		$results->bindValue(3, $time_spent, PDO::PARAM_STR);
		$results->bindValue(4, $learned, PDO::PARAM_STR);
		$results->bindValue(5, $resources, PDO::PARAM_STR);
		$results->bindValue(6, $tags, PDO::PARAM_STR);
		$results->bindValue(7, $id, PDO::PARAM_STR);
		$results->execute();
	} catch (Exception $e) {
		echo "<h3>Error: " . $e->getMessage() . "</h3><br />";
		return false;
	}

	return true;
}

#############################################
# delete journal
#############################################
function delete_journal($id) {
	include 'connection.php';

	$sql = "DELETE FROM entries WHERE id = ?";

	try {
		$results = $db->prepare($sql);
		$results->bindValue(1, $id, PDO::PARAM_INT);
		$results->execute();
	} catch (Exception $e) {
		echo "Error!: " . $e->getMessage() . "<br />";
    return false;
	}

	return true;
}