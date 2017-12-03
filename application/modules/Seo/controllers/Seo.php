<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seo extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('WordPreprocessing');
	}
    
	public function index()
	{
		$this->data['title'] = $this->title;
		$this->load->view('home',$this->data);
	}
}
