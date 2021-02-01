<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
	/**
	 * Class Pages
	 * Gère les pages statiques
	 */
	class Pages extends Controller {
		/**
		 * Pages constructor.
		 */
		public function __construct() {
			//$this->userModel = $this->model('User');
		}
		
		/**
		 * Page Accueil
		 */
		public function index() {
			$data = [
				'title' => 'Home page'
			];
			
			$this->render('index', $data);
		}
		
		/**
		 * Page About
		 */
		public function about() {
			$data = [
				'title' => 'About me'
			];
			$this->render('pages/about', $data);
		}
	}
