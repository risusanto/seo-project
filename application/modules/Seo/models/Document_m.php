<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Document_m extends MY_Model
{
    public function __construct(){
        parent::__construct();
        $this->data['table_name'] = 'document';
        $this->data['primary_key'] = 'id_document';
    }
}
