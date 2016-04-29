<?php
	class User {
		private $db;

		function __construct($db) {
			$this ->db = $db;
		}

		public function register ($username, $fullname, $phoneNo, $email, $password) {
			try {
				$password_hashed = password_hash($password, PASSWORD_DEFAULT);
				$stmt = $this->db-> prepare("INSERT INTO rumah_user(uname, pwd, name, email, phone, date_registered, status) VALUES (:uname, :password, :fullname, :email, :phone, '".date('Y-m-d H:i:s')."', 'ACTIVE')");
				$stmt->bindparam(":uname", $username);
				$stmt->bindparam(":fullname", $fullname);
				$stmt->bindparam(":phone",$phoneNo);
				$stmt->bindparam(":email",$email);
				$stmt->bindparam(":password",$password_hashed);
				$stmt->execute();

          		return $stmt;
			}
			catch (PDOException $e) {
				echo $e->getMessage();
			}	
		}

		public function login($username, $password) {
			try{
				$passwordhashed = password_hash($password, PASSWORD_DEFAULT);
				$stmt = $this->db->prepare("SELECT * FROM rumah_user WHERE uname=:uname");
				$stmt->bindparam(":uname", $username);
				$stmt->execute();
				$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

				if($stmt->rowCount() > 0) {
					if(password_verify($password,$userRow['pwd'])) {
						$_SESSION['uname'] = $userRow['uname'];
						$_SESSION['name'] = $userRow['name'];
        	    		$_SESSION['email'] = $userRow['email'];					

            			return true;	
					}
					else {
						return false;
					}
				}
				else {
					return false;
				}
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}

		public function isLoggedIn() {
			if(isset($_SESSION['uname'])) {
				$stmt = $this->db->prepare("SELECT * FROM rumah_user WHERE uname=:uname");
				$stmt->bindparam(":uname", $_SESSION['uname']);
				$stmt->execute();
				$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

				if($stmt->rowCount() > 0) {
					return true;	
				}
				else {
					@session_start();
					unset($_SESSION['uname']);
					unset($_SESSION['name']);
					unset($_SESSION['email']);
					unset($_SESSION);
					return false;
				}
			}
		}

		public function redirect($url) {
			header("Location: $url");
		}

		public function logout() {
			session_destroy();
			unset($_SESSION['uname']);
			return true;
		}
	}
?>