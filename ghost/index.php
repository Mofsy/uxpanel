<?php

include("../include/common.php");
include("../config.php");
include("../include/session.php");
include("../include/dbconnect.php");

include("../include/account.php");
include("../include/ghost.php");

if(isset($_SESSION['account_id']) && isset($_REQUEST['id']) && is_numeric($_REQUEST['id']) && isset($_SESSION['is_' . $_REQUEST['id'] . '_ghost'])) {
	$service_id = $_REQUEST['id'];
	$message = "";
	
	if(isset($_POST['action'])) {
		if($_POST['action'] == "start") {
			$result = ghostBotStart($service_id);
			
			if($result === true) {
				$message = "GHost instance started successfully.";
			} else {
				$message = $result;
			}
		} else if($_POST['action'] == "restart") {
			$result = ghostBotRestart($service_id);
			
			if($result === true) {
				$message = "GHost instance restarted successfully.";
			} else {
				$message = $result;
			}
		} else if($_POST['action'] == "stop") {
			$result = ghostBotStop($service_id);
			
			if($result === true) {
				$message = "GHost instance stopped successfully.";
			} else {
				$message = $result;
			}
		}
	}
	
	$status = ghostGetStatus($service_id);
	get_page("status", "ghost", array('service_id' => $service_id, 'status' => $status, 'message' => $message));
} else {
	header("Location: ../panel/");
}

?>
