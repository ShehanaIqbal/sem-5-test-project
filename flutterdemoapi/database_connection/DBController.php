<?php require_once('connection.php'); ?>
<?php
class DBController {
	private $conn;

	function __construct() {
		$this->conn = $this->connectDB();
	}

	function connectDB() {
	    $db = Database::getInstance();
   	    $conn = $db->getConnection();
		return $conn;
	}

	//will run the query. (whatever it is)
	function runQuery($query) {
		$resultset = null;
		$result1 = mysqli_query($this->conn, $query);
		if ($result1)
		{
			while($row=mysqli_fetch_assoc($result1)) {
			$resultset[] = $row;
	}
		}
		return (!empty($resultset))? $resultset : false;
	}
	//will find the number of rows related to the results of the query.
	function numRows($query) {
	    $result2  = mysqli_query($this->conn, $query);
		$rowcount = mysqli_num_rows($result2);
		return $rowcount;
	}
	//if the query is invalid will let the query be updated.
	function updateQuery($query) {
	    $result3 = mysqli_query($this->conn, $query);
		if (!$result3) {
		    die('Invalid query: ' . mysqli_error($this->conn));
		} else {
			return $result3;
		}
	}
	//
	function insertQuery($query) {
	    $result4 = mysqli_query($this->conn, $query);
		if (!$result4) {
		    die('Invalid query: ' . mysqli_error($this->conn));
		} else {
		    return mysqli_insert_id($this->conn);
		}
	}
	function deleteQuery($query) {
	    $result = mysqli_query($this->conn, $query);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($this->conn));
		} else {
			return $result;
		}
	}

}
?>