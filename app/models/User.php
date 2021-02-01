<?php
	class User
	{
		private Database $db;
		
		public function __construct()
		{
			$this->db = new Database;
		}
		
		public function login($email, $password)
		{
			$this->db->query('SELECT * FROM users WHERE email = :email');
			$this->db->bind(':email', $email);
			$row = $this->db->fetch();
			$hashedPassword = $row->password;
			
			if (password_verify($password, $hashedPassword)) {
				return $row;
			} else {
				return false;
			}
		}
		
		public function register($data)
		{
			$this->db->query('INSERT INTO users (username, nom, prenom, adresse, code_postal, email, password) VALUES (:username, :nom, :prenom, :adresse, :code_postal, :email, :password)');
			$this->db->bind(':username', $data['username']);
			$this->db->bind(':nom', $data['nom']);
			$this->db->bind(':prenom', $data['prenom']);
			$this->db->bind(':adresse', $data['adresse']);
			$this->db->bind(':code_postal', $data['code_postal']);
			$this->db->bind(':email', $data['email']);
			$this->db->bind(':password', $data['password']);
			
			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}
		
		public function findUserByEmail($email)
		{
			$this->db->query('SELECT * FROM users WHERE email = :email');
			$this->db->bind(':email', $email);
			
			if ($this->db->rowCount() > 0) {
				return true;
			} else {
				return false;
			}
		}

        public function showUserProfile($id)
        {
            $this->db->query('SELECT * FROM users WHERE user_id = :user_id');
            $this->db->bind(':user_id', $id);

            return $this->db->fetch();
		}

        public function editUserProfile($data)
        {
            $this->db->query('UPDATE users SET username = :username, nom = :nom, prenom = :prenom, adresse = :adresse , code_postal = :code_postal , email = :email WHERE user_id = :user_id');
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':nom', $data['nom']);
            $this->db->bind(':prenom', $data['prenom']);
            $this->db->bind(':adresse', $data['adresse']);
            $this->db->bind(':code_postal', $data['code_postal']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':user_id', $data['user_id']);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
		}
	}