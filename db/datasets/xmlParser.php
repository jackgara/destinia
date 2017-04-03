<?php
/**
 * Author: Joaquin Garavaglia
 * Last change: 02/12/2015
 *
 **/

/**
 * Description: Function to parse an xml  and return string with VALUES to SQL
 * Uses xmlSimple PHP library
 */

function xmlSimpleParser($strXmlFile){
    $strQuery = "";
    $xmlLodging = simplexml_load_file($strXmlFile);
    /* For each <character> node, echo VALUES to SQL query  */
    foreach ($xmlLodging->lodging  as $l) {
            $strQuery .= '("' . $l->lodging_type . '","' . $l->name . '","' . $l->stars . '","' . $l->room_type . '",' . $l->apartments . ',' . $l->people . ',"' . $l->city . '","' . $l->province . '")' . "\n" . ',';
    }
    $strQuery = rtrim($strQuery,",")."; \n\n";
    return $strQuery;
}
/**
 * Description: Function to build an SQL query file
 */
function sqlQuery($strTable,$strSqlValues,$strSqlFile){
    $strInsertQuery = " SET NAMES utf8; \n"; //Ensures utf8 encoding
    $strInsertQuery .= " INSERT INTO $strTable (lodging_type, name, stars, room_type, apartments, people, city, province ) VALUES \n ";
    $strInsertQuery .= $strSqlValues;
    $fileSqlQuery = fopen($strSqlFile,"a");
    fwrite($fileSqlQuery,$strInsertQuery);
    return true;
}
/**
 * Description: Function to convert xml to SQL
 */
function xmlToSql($strXdxfFile,$strTable,$strSqlFile){
    $strQuery=xmlSimpleParser($strXdxfFile);
    sqlQuery($strTable,$strQuery,$strSqlFile);
    return true;
}
/**
 * Parse Dictionaries.xdxf
 */

$strSqlQueriesPath=__DIR__.DIRECTORY_SEPARATOR."../populateDB.sql";
$strXmlDictPath=__DIR__.DIRECTORY_SEPARATOR;
// Reset file //
unlink($strSqlQueriesPath);
//Parse Xdxf & write SQL Queries
xmlToSql($strXmlDictPath."latinLodgings.xml","latin_lodging",$strSqlQueriesPath);
xmlToSql($strXmlDictPath."arabicLodgings.xml","arabic_lodging",$strSqlQueriesPath);
xmlToSql($strXmlDictPath."cyrillicLodgings.xml","cyrillic_lodging",$strSqlQueriesPath);

?>