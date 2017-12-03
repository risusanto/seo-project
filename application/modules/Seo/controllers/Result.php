<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Result extends MY_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->library('WordPreprocessing');
        $this->load->library('VectorSpaceModel');
        $this->load->model('Document_m');
	}
    
	public function index()
	{
        if ($this->input->get('q') == NULL || $this->input->get('search') == NULL) {
            redirect('seo');
            exit;
        }
        $stopWordrm = new WordPreprocessing();
        $documents = $this->Document_m->get();
        $_terms = $this->input->get('q');
        
        $terms = $stopWordrm->wordTokenizing($_terms);
        
        $vsm = new VectorSpaceModel();
        $vsm->init($documents,$terms);
        arsort($vsm->cosSimiliarity);
        $_resultSorted = $vsm->cosSimiliarity;
        $this->data['result'] = [];

        foreach ($documents as $doc) {

            if(isset($_resultSorted[$doc->id_document])){
                if($_resultSorted[$doc->id_document] != 0){
                    $this->data['result'][$doc->id_document] = json_encode($doc);
                }
            }
        }
        $this->data['title'] = $this->input->get('q');
        $this->load->view('search-result',$this->data);
	}
}
