<?php
/**
 * Author: Joaquin Garavaglia
 * Last change: 02/12/2015
 *
 * Description: Main Function to Search in DB a User Input Word
 *  and return Lodgings information.
 * Requires a console mode that accepts UTF8
 *
 * //TODO feature to get more than a word,
 * // split it and do a multiple DB search
 */
require_once('config.php');
require_once('./data_access/clsDataBase.php');
require_once('clsSearch.php');
require_once('./utils/stdio.php');

/*-------------------------------------
Getting the User input 1 Word.
Accepts compound words(eg. 'Torres Blancas') but
does not do separate searches in DB with
'Torres' and 'Blancas'.
-------------------------------------*/
$input = ReadStdin("Busqueda : ");

/*-------------------------------
Creating the Word instance
-------------------------------*/
$word = new clsSearch($input);
/*-------------------------------
Querying the DB
-------------------------------*/
if($word->isSearchable()) {
    /*-------------------------------
    Instantiates data base conection.
    -------------------------------*/
    $obj_data_base = new clsDataBase();
    $obj_data_base->open();
    /*-------------------------------
    SQL set UTF8 before Query
    -------------------------------*/
    $obj_data_base->strQuery = "SET NAMES utf8;";
    $obj_data_base->execute($obj_data_base->strQuery);
    /*-------------------------------
    SQL Query
    -------------------------------*/
    $strQuery = $word->getQuery();
    $obj_data_base->strQuery = $strQuery;
    $obj_data_base->query($obj_data_base->strQuery, $arr_matches);
    $obj_data_base->close();
    /*-------------------------------------
    Writting Data to the Output
    -------------------------------------*/
    WriteResults($arr_matches);

}else{
    WriteError();
}

?>