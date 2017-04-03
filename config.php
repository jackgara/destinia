<?php
/**
 * Author: Joaquin Garavaglia
 * Last change: 02/12/2015
 *
 * Descritpion: Site Configuration File
 */

/*-----------------------
Data base access globals.
-----------------------*/

/*------------
App. language.
------------*/
$gstrAppLanguage = "es";

/*------------
Idioma.
------------*/
$str_idioma	= "es";
$str_enlace_idioma ="";

/*-------------
Data base type.
-------------*/
$gstrDataBaseType = "data_base_specific/clsMySql.php";

/*----------------
Production server.
----------------*/
$gstrProdServerDNS	= array("|server|");
$gstrProdServerPort	= "";

/*-----------------------------------
Sets prod back office root directory.
-----------------------------------*/
define("strPRODBORD", "http://".$gstrProdServerDNS[0].$gstrProdServerPort."/destinia/bo/");
define("strPRODFORD", "http://".$gstrProdServerDNS[0].$gstrProdServerPort."/destinia/");

/*------------------
Developement server.
------------------*/
$gstrDevServerDNS	= "localhost/dev"; /* localhost; */
$gstrDevServerPort	= "";

/*----------------------------------
Sets dev back office root directory.
----------------------------------*/
define("strDEVBORD", "http://".$gstrDevServerDNS.$gstrDevServerPort."/destinia/bo/");
define("strDEVFORD", "http://".$gstrDevServerDNS.$gstrDevServerPort."/destinia/");

/*--------------------
Development environment.
--------------------*/
    ini_set('display_errors','On');

    /*---------------------------------
    We are in developement environment.
    Sets database.
    ---------------------------------*/
    $gstrDataBase  		= "destiniadb";
    $gintPort			= "3306";
    $gstrUser			= "root";
    $gstrPassword		= "";
    $gstrHost			= "localhost";
    define("strBOARD", strDEVBORD);
    define("strFOARD", strDEVFORD);
    define("strENV", "DEV");

    /*----------------------------------------
    Sets back and front office root directory.
    ----------------------------------------*/
    define("strBORD", "/bo/");


/*-------------------------------
All the config vars PHP,Apache
 and Mysql have to get charset utf8
--------------------------------*/


?>