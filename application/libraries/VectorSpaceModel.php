<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class VectorSpaceModel {
    public $docTf = [];
    public $tfIdfWeight = [];
    public $docVector = [];
    public $dotProduct = []; 
    public $cosSimiliarity = [];
    public $tfQuery;
    public $vectorQuery;
    public $queryWeight = [];
    public $docIdf;
    private $wordProcessing;

    public function __construct(){
        $CI = & get_instance();
        $CI->load->library('WordPreprocessing');
        $this->wordProcessing = new WordPreprocessing();
    }

    public function init($documents,$terms){
        $this->tfIdfCalculator($documents,$terms);
        $this->tfQueryCalculator($terms);
        $this->documentWeight($documents,$terms);
        $this->queryWeightCalculator($terms);
        $this->documentVector($documents,$terms);
        $this->queryVectorCalculator($terms);
        $this->dotProductCalc($documents,$terms);
        $this->cosineSimiliarity($documents);
    }

    public function test($varTest){
        return $this->wordProcessing->wordTokenizing($varTest);
    }

    public function tfIdfCalculator($documents,$terms){
        $df = [];
        $docCount = 0;
        foreach ($documents as $doc) {

            foreach ($terms as $term) {
                if(!isset($df[$term]))
                    $df[$term] = 0;
                $f = $this->compare($doc->content,$term);
                $this->docTf[$doc->id_document][$term] = $f;
                if($f > 0)
                    $df[$term] += 1;

            }
            $docCount += 1;
        }
        foreach ($terms as $term) {
            if($df[$term] == 0)
                $this->docIdf[$term] = 0;
            else
                $this->docIdf[$term] = log($docCount/$df[$term]);
        }
    }

    public function compare($text,$_term){
        $term = mb_strtolower($_term);
        $words = $this->wordProcessing->wordTokenizing($text);
        $_f = 0;

        foreach ($words as $word) {
            if($word == $term)
                $_f += 1;
        }

        return $_f;
    }

    public function documentWeight($documents,$terms){
        
        foreach ($documents as $doc) {
            
            foreach ($terms as $term) {
                $this->tfIdfWeight[$doc->id_document][$term] = 
                $this->docTf[$doc->id_document][$term] *
                $this->docIdf[$term];
            }

        }

    }

    public function documentVector($documents,$terms){
        $squareWeight = 0;

        foreach ($documents as $doc) {
            
            foreach ($terms as $term) {
                $squareWeight += $this->tfIdfWeight[$doc->id_document][$term] *
                $this->tfIdfWeight[$doc->id_document][$term];
            }

            $this->docVector[$doc->id_document] = sqrt($squareWeight);
            $squareWeight = 0;

        }

    }

    public function dotProductCalc($documents,$terms){
        $eachDot = 0;

        foreach ($documents as $doc) {

            foreach ($terms as $term) {
                $eachDot += $this->tfIdfWeight[$doc->id_document][$term] *
                $this->queryWeight[$term];
            }

            $this->dotProduct[$doc->id_document] = $eachDot;
            $eachDot = 0;

        }

    }

    public function cosineSimiliarity($documents){

        foreach ($documents as $doc) {

            if ($this->docVector[$doc->id_document] == 0)
                $this->cosSimiliarity[$doc->id_document] = 0;
            else{
                $this->cosSimiliarity[$doc->id_document] =
                $this->docVector[$doc->id_document] * $this->vectorQuery;
            } 
        }
    }

    public function tfQueryCalculator($terms){
        $text = implode(' ',$terms);
        foreach ($terms as $term) {
            $this->tfQuery[$term] = $this->compare($text,$term);
        }
    }

    public function queryWeightCalculator($terms){
        
        foreach ($terms as $term) {
            $this->queryWeight[$term] = $this->tfQuery[$term] * $this->docIdf[$term];
        }

    }

    function queryVectorCalculator($terms){
        $squareWeight = 0;

        foreach ($terms as $term) {
            $squareWeight += $this->queryWeight[$term] * $this->queryWeight[$term];
            $this->vectorQuery = sqrt($squareWeight);
        }
    }

}
