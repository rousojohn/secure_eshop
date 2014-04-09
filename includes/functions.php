<?php
	include_once 'config.php';
	
	
	/**
	 * PHP Sessions are known to be insecure thus we'll wrap it 
	 * Stops crackers accessing the session id cookie through js.Also the "session_regenerate_id()" function, which regenerates the session id on every page * * reload, helps prevent session hijacking
	 */
	function sec_session_start(){
		$session_name = 'sec_session_id';
		$secure = SECURE;
		$httponly = true; // Stop js being able to access session id.
		
		// Force session to only use cookies.
		if (ini_set('session.use_only_cookies', 1) == FALSE ){
			header('Location: ../error.php?err=Could not initiate a safe session (ini_set)');
			exit();
		}
		
		// Get current cookie params.
		$cookieParams = session_get_cookie_params();
		session_set_cookie_params($cookieParams['lifetime'],
			$cookieParams['path'],
			$cookieParams['domain'],
			$secure,
			$httponly
		);
		
		session_name($session_name); 	 // Set the session name to the one set above.
		session_start();				//	Start PHP's session
		session_generate_id();			//	regenerated the session, delete the old one.
	}
	
	
	
	
	/**
	 *	Login function
	 *	Checks the email and password against the db and returns true if they match
	 *	otherwise false.
	 */
	 function login($email, $password, $mysqli){
		// prepared statements protect us from SQL injections
		if ($stmt = $mysqli->prepare("select id, username, password, salt from members where email=? limit 1")) {
			$stmt->bind_param('s', $email);  // bind '$email' to parameter
			$stmt->execute();
			$stmt->store_result();
			
			// get variables from result
			$stmt->bind_result($user_id, $username, $db_password, $salt);
			$stmt->fetch();
			
			// hash the password with the unique salt
			$password = hash('sha512', $password.$salt);
			if ($stmt->num_rows == 1){
				// the user exists
				// check if user is locked due to many failed login attempts
				if ( checkbruteforce($user_id, $mysqli) == true){
					// the account is locked.
					// Email the user.
					return false;
				}
				else{
					// check if the password matches
					if (db_password == $password){
						// Success.
						$user_browser = $_SERVER['HTTP_USER_AGENT'];
						$user_id = preg_replace("/[^0-9]+/", "", $user_id); // XSS protection in case we want to print this
						$_SESSION['user_id'] = $user_id;
						
						$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
						$_SESSION['username'] = $username;
						$_SESSION['login_string'] = hash('sha512', $password . $user_browser);
						return true;
					}
					else {
						// Failure
						// Record attempt to db
						$now = time();
						$mysqli->query("insert into login_attempts (user_id, time) values ('$user_id','$now')");
						return false;
					}
				}
			}
			else{
				//	Failure user doesn't exist
				return false;
			}
		}
	 }
?>