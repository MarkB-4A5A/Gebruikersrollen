<?php

	class Database {

		function __construct($server,$database,$username,$password) {
			$this->db_host = $server;
			$this->db_name = $database;
			$this->db_username = $username;
			$this->db_password = $password;

			$this->conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_username, $this->db_password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}

		// CREATE
			public function CreateData($sql) {
				try {
					$this->conn->exec($sql);
					return $this->conn->lastInsertId();
				} catch(PDOException $e) {
					return "Error: " . $sql . "<br>" . $e->getMessage();
				}
			}

		// READ
			public function ReadData($sql) {
				try {

					$stmt = $this->conn->prepare($sql);
					$stmt->execute();
					$result = $stmt->fetch(PDO::FETCH_ASSOC);
					return $result;

				} catch(PDOException $e) {
					return "Error: " . $sql . "<br>" . $e->getMessage();
				}
			}

			public function ReadDataAll($sql) {
				try {

					$stmt = $this->conn->prepare($sql);
					$stmt->execute();
					$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $result;

				} catch(PDOException $e) {
					return "Error: " . $sql . "<br>" . $e->getMessage();
				}
			}

      public function ReadDataSecure($sql,$term,$value) {
          $stmt = $this->conn->prepare($sql);
          $stmt->bindParam($term, $value);
          $stmt->execute(array($value));
          if ($stmt->rowCount() > 0) {
              $result = $stmt->fetch(PDO::FETCH_ASSOC);
              return $result;
          } else {
              return false;
          }

      }

		// UPDATE
			public function UpdateData($sql) {
				try {
					$stmt = $this->conn->prepare($sql);
					$stmt->execute();
					return $stmt->rowCount();
				} catch (PDOException $e) {
					return $e;
				}
			}

		// DELETE
			public function DeleteData($sql) {
				try {
					$stmt = $this->conn->prepare($sql);
					$stmt->execute();
					return $stmt->rowCount();
				} catch (PDOException $e) {
					return $e;
				}
			}



	}


?>
