<?php
/**
 * Author: Joaquin Garavaglia
 * Last change: 02/12/2015
 *
 * Description: Class to manage searchable words
 */

/*-------------------------------------
Class to do the search by alphabets
-------------------------------------*/

class clsSearch{

    static $arrAlphabets = array('lat','ara','cyr');

    /*------------------------------
    Search
    ------------------------------*/
    var $strSearch;
    /*------------------------------
    Search Lenght
    ------------------------------*/
    var $intLenght;
    /*------------------------------
    Valid Alphabet
    ------------------------------*/
    var $strAlphabet;

    /*------------------------------
    Search's Query to find matches in DB
    ------------------------------*/
    var $strQuery;

    /*------------------------------
    Search's Matches in DB
    ------------------------------*/
   // var $arrMatches;

    /*------------------------------
    Constructor
    ------------------------------*/
    function clsSearch($input){
        $this->strSearch=$input;
        $this->intLenght=strlen($this->strSearch);
        $this->strAlphabet = $this->setAlphabet();
        if($this->isSearchable()) {
            $this->strQuery = $this->setQuery();
        }
        //var_dump($this);
    }
    /*------------------------------
    Set Alphabet for the given string
    ------------------------------*/
    private function setAlphabet(){
        //Check first char to be a valid Alphabet
        $strSearch=$this->strSearch;
        $strAlphabet=clsSearch::findAlphabet($strSearch);

        if(!in_array($strAlphabet,clsSearch::$arrAlphabets)){
            return 'invalid';
        }else{
            return $strAlphabet;
        }
    }

    /*------------------------------
    Set the Query to find matching
    Assumes it is a Valid Searchable Word
    ------------------------------*/
    private function setQuery(){
        //define REGEX
        $search="'%".$this->strSearch."%'";

        switch($this->strAlphabet){
            case 'lat':
                $strQuery="SELECT * FROM latin_lodging WHERE name LIKE $search OR lodging_type LIKE $search OR city LIKE $search OR province LIKE $search ORDER BY name";
                return $strQuery;
                break;
            case 'ara':
                $strQuery="SELECT * FROM arabic_lodging WHERE name LIKE $search OR lodging_type LIKE $search OR city LIKE $search OR province LIKE $search ORDER BY name";
                return $strQuery;
                break;
            case 'cyr':
                $strQuery = " SELECT * FROM cyrillic_lodging WHERE name LIKE $search OR lodging_type LIKE $search OR city LIKE $search OR province LIKE $search ORDER BY name" ;
                return $strQuery;
                break;
            default:
                return "";
                break;
        }
    }

    /*------------------------------
    Functions that matches alphabet of a UTF8 char
    Source: https://en.wikipedia.org/wiki/Plane_%28Unicode%29#Basic_Multilingual_Plane
    [0000-0040] General Punctuation, includes space, symbols, etc
    ------------------------------*/
    private function isLatin($str){
        if(preg_match('/[\x{0000}-\x{024F}\x{1D00}-\x{1EFF}\x{A720}-\x{A7FF}\x{2C60}-\x{2C7F}\x{AB30}-\x{AB6F}]+/u',$str,$matches)){
            return $matches[0] == $str;
        }else{
            return false;
        }

    }
    private function isArabic($str){
        if(preg_match('/[\x{0000}-\x{0040}\x{0600}-\x{06FF}\x{0750}-\x{077F}\x{08A0}-\x{08FF}\x{FB50}-\x{FDFF}\x{FE70}-\x{FEFF}]+/u',$str,$matches)){
            return $matches[0] == $str;
        }else{
            return false;
        }
    }
    private function isCyrillic($str){
        if(preg_match('/[\x{0000}-\x{0040}\x{0400}-\x{052F}]+/u',$str,$matches)) {
            return $matches[0] == $str;
        }else{
            return false;
        }
    }


    /*------------------------------
    Function that detect Alphabet
   ------------------------------*/
    private function findAlphabet($str){

        if(clsSearch::isLatin($str)){
            return 'lat';
        }elseif(clsSearch::isArabic($str)){
            return 'ara';
        }elseif(clsSearch::isCyrillic($str)){
             return 'cyr';
        }else{
            return 'invalid';
        }
    }

    /*------------------------------
    Determine wheather a Word is valid
    to Search or not. Lenght >0 <40 and
    Alphabet contained in $arrAlphabets
    ------------------------------*/
    function isSearchable(){
        $bolValidLenght = ($this->intLenght >0) & ($this->intLenght < 40) ;
        $bolValidAlphabet = in_array($this->strAlphabet,clsSearch::$arrAlphabets);

        return $bolValidLenght & $bolValidAlphabet ;
    }

    /*------------------------------
    Getter
    ------------------------------*/
    function getAlphabet(){
        return $this->strAlphabet;
    }

    /*------------------------------
    Getter
   ------------------------------*/
    function getQuery(){
        return $this->strQuery;
    }
}
