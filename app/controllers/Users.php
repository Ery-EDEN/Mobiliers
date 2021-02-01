<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
	class Users extends Controller {
		/**
		 * @var mixed
		 */
		private $userModel;
		
		public function __construct() {
			$this->userModel = $this->loadModel('User');
		}

        public function index() {
            $user = $this->userModel->showUserProfile($_SESSION['user_id']);

            $data = [
                'user' => $user,
            ];

            $this->render('users/profile', $data);
        }
		
		public function login() {
			$data = [
				'title' => 'Login page',
				'email' => '',
				'password' => '',
				'emailError' => '',
				'passwordError' => ''
			];
			
			//Check for post
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				//Sanitize post data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				
				$data = [
					'email' => trim($_POST['email']),
					'password' => trim($_POST['password']),
					'emailError' => '',
					'passwordError' => '',
				];
				//Validate email
				if (empty($data['email'])) {
					$data['emailError'] = 'Please enter a email.';
				}
				
				//Validate password
				if (empty($data['password'])) {
					$data['passwordError'] = 'Please enter a password.';
				}
				
				//Check if all errors are empty
				if (empty($data['emailError']) && empty($data['passwordError'])) {
					$loggedInUser = $this->userModel->login($data['email'], $data['password']);
					
					if ($loggedInUser) {
						$this->createUserSession($loggedInUser);
					} else {
						$data['passwordError'] = 'Password or email is incorrect. Please try again.';
						
						$this->render('users/login', $data);
					}
				}
				
			} else {
				$data = [
					'email' => '',
					'password' => '',
					'emailError' => '',
					'passwordError' => ''
				];
			}
			$this->render('users/login', $data);
		}
		
		public function register()
		{
			$data = [
				'username' => '',
				'nom' => '',
				'prenom' => '',
				'adresse' => '',
				'code_postal' => '',
				'email' => '',
				'password' => '',
				'usernameError' => '',
				'nomError' => '',
				'prenomError' => '',
				'adresseError' => '',
				'code_postalError' => '',
				'emailError' => '',
				'passwordError' => '',
				'confirmPasswordError' => ''
			];
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				
				$data = [
					'username' => trim($_POST['username']),
					'nom' => trim($_POST['nom']),
					'prenom' => trim($_POST['prenom']),
					'adresse' => trim($_POST['adresse']),
					'code_postal' => trim($_POST['code_postal']),
					'email' => trim($_POST['email']),
					'password' => trim($_POST['password']),
					'confirmPassword' => trim($_POST['confirmPassword']),
					'usernameError' => '',
                    'nomError' => '',
                    'prenomError' => '',
                    'adresseError' => '',
                    'code_postalError' => '',
					'emailError' => '',
					'passwordError' => '',
					'confirmPasswordError' => ''
				];
				
				// Validation username & email
				$nameValidation = "/^[a-zA-Z0-9]*$/";
				$passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
				
				if (empty($data['email'])) {
					$data['emailError'] = 'Veuillez entrer un email';
				} elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
					$data['emailError'] = 'Veuillez entrer un email au bon format !!';
				} else {
					if ($this->userModel->findUserByEmail($data['email'])) {
						$data['emailError'] = 'E-mail déjà utilisé !!';
					}
				}
				
				if (empty($data['password'])) {
					$data['passwordError'] = 'Veuillez entrer un password';
				} elseif(strlen($data['password']) < 6) {
					$data['passwordError'] = 'Le mot dee passe doit contenir au moins 8 caractères';
				} elseif (preg_match($passwordValidation, $data['password'])) {
					$data['passwordError'] = 'Le mot de passe doit contenir au moins 1 chiffre';
				}
				
				if (empty($data['confirmPassword'])) {
					$data['confirmPasswordError'] = 'veuillez entrer la confirmation de mot de passe';
				} else {
					if($data['password'] != $data['confirmPassword']) {
						$data['confirmPasswordError'] = 'Les mots de passe ne correspondent pas !';
					}
				}
				
				if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {
					$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
					
					if ($this->userModel->register($data)) {
						header('location:' . URL_ROOT . '/users/login');
					} else {
						die('Une erreur est survenue !!');
					}
				}
			}
			$this->render('/users/register', $data);
		}
		
		public function createUserSession($user) {
			$_SESSION['user_id'] = $user->user_id;
			$_SESSION['username'] = $user->username;
			$_SESSION['email'] = $user->email;
			header('location:' . URL_ROOT . '/pages/index');
		}
		
		public function logout() {
			unset($_SESSION['user_id']);
			unset($_SESSION['username']);
			unset($_SESSION['email']);
			header('location:' . URL_ROOT . '/users/login');
		}

        public function edit() {
            $user = $this->userModel->showUserProfile($_SESSION['user_id']);

            /*if(!isLoggedIn()) {
                header("Location: " . URL_ROOT . "/mobiliers");
            } elseif($post->user_id != $_SESSION['user_id']){
                header("Location: " . URL_ROOT . "/mobiliers");
            }*/

            $data = [
                'user' => $user,
                'username' => '',
                'nom' => '',
                'prenom' => '',
                'adresse' => '',
                'code_postal' => '',
                'email' => '',
                'usernameError' => '',
                'nomError' => '',
                'prenomError' => '',
                'adresseError' => '',
                'code_postalError' => '',
                'emailError' => '',
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'user_id' => $_SESSION['user_id'],
                    'user' => $user,
                    'username' => trim($_POST['username']),
                    'nom' => trim($_POST['nom']),
                    'prenom' => trim($_POST['prenom']),
                    'adresse' => trim($_POST['adresse']),
                    'code_postal' => trim($_POST['code_postal']),
                    'email' => trim($_POST['email']),
                    'usernameError' => '',
                    'nomError' => '',
                    'prenomError' => '',
                    'adresseError' => '',
                    'code_postalError' => '',
                    'emailError' => '',
                ];

                if(empty($data['username'])) {
                    $data['usernameError'] = 'Your username cannot be empty';
                }
                if(empty($data['nom'])) {
                    $data['nomError'] = 'Your nom cannot be empty';
                }
                if(empty($data['prenom'])) {
                    $data['prenomError'] = 'Your prenom cannot be empty';
                }
                if(empty($data['adresse'])) {
                    $data['adresseError'] = 'Your adresse cannot be empty';
                }
                if(empty($data['code_postal'])) {
                    $data['code_postalError'] = 'Your code postal cannot be empty';
                }
                if(empty($data['email'])) {
                    $data['emailError'] = 'Your email cannot be empty';
                }

                if (empty($data['usernameError']) && empty($data['nomError']) && empty($data['prenomError']) && empty($data['adresseError']) && empty($data['code_postalError']) && empty($data['emailError'])) {
                    if ($this->userModel->editUserProfile($data)) {
                        header("Location: " . URL_ROOT . "/users/profile");
                    } else {
                        die("Something went wrong, please try again!");
                    }
                } else {
                    $this->render('users/edit', $data);
                }
            }

            $this->render('users/edit', $data);
        }
	}
