<?php

function dbAccess($stmt, $dataReturn) {
	
	if (!$stmt->execute()) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	if ($dataReturn == 1) {
		if (!$stmt->bind_result($result)) {
			echo "Binding output paramters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->fetch()) {
			echo "Fetch failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		return $result;
	}
	return;
}
?>