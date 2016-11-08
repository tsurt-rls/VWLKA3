<?php

include(__DIR__ . "\config.php");

foreach ($config["global"]["module"] as $modul) {
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/" . $config["global"]["install_folder"] . "/modules/".$modul."/funcs/funcs_" . $modul . ".php")) {
        include($_SERVER['DOCUMENT_ROOT'] . "/" . $config["global"]["install_folder"] . "/modules/".$modul."/funcs/funcs_" . $modul . ".php");
    }
}


/**
 * Gibt den Ordnerinhalt als Array zurück
 * @param $filter --> Dateifilter
 * @param $config --> Globale Konfigurationsvariable
 * @return array
 */
function readFolder($filter, $config)
{
    $data = array();
    $dest = $config["global"]["dest_fwlk"];
    if (!is_dir($dest)) {
        die("Ordner ''" + $dest + "' wurde nicht gefunden");
    }
    $handle = opendir($dest);
    while ($file = readdir($handle)) {
        if ($file != "." && $file != ".." && !is_dir($file)) {
            $infos = pathinfo($file);
            if ($infos["extension"] == "pdf") {
                $temp = explode("-", $infos["filename"]);
                if ($config["global"]["BMZ"]) {
                    $bmz = nullenAuffuellen($temp[0],  "bmz");
                    $gruppe = nullenAuffuellen($temp[1], "gruppe");
                    $temp = $bmz . "-" . $gruppe;
                    $data[] = $temp;
                } else {
                    $gruppe = nullenAuffuellen($temp[0], "gruppe");
                    $data[] = $gruppe;
                }
            }
        }
    }
    return $data;
}


/**
 * Füllt einen String von Vorne mit einer Anzahl Nullen aufgefüllt
 * @param $string
 * @param $config
 * @param $art
 * @return string
 */
function nullenAuffuellen($string, $art)
{
    include(__DIR__ . "\config.php");

    if ($config["global"]["bmzNullen"] && $art == "bmz") {
        $string = str_pad($string, $config["global"]["bmzNullenAnzahl"], '0', STR_PAD_LEFT);
    }
    if ($config["global"]["gruppenNullen"] && $art == "gruppe") {
        $string = str_pad($string, $config["global"]["gruppenNullenAnzahl"], '0', STR_PAD_LEFT);
    }
    return $string;
}


/**
 * Konveriert eine PDF in PNG-Dateien um.
 * @param $filename
 * @param $config
 */
function convertFWLK($filename, $dest = false)
{
    include(__DIR__ . "\config.php");

    $convertEXE = $config["global"]["dest_imagemagick"];
    if ($dest) {
        $dest_FWLK = "";
    } else {
        $dest_FWLK = $config["global"]["dest_fwlk"];
    }

    $pdf = $dest_FWLK . $filename . ".pdf";
    $png = $dest_FWLK . $filename . ".png";

    exec("$convertEXE -quality 100 -compress Lossless -resize 300% $pdf $png");
}

function printArray($array) {
    echo "<pre>";
    echo print_r($array);
    echo "</pre>";
}
/**
 * Konvertiert den Dateinamen der PDF in seinen Ursprung zurück 01-01 --> 1-1 bzw 01 --> 1
 * @param $filename
 * @param $config
 * @return string
 */
function convertFilename($filename)
{

    include(__DIR__ . "\config.php");

    if ($config["global"]["BMZ"]) {

        $temp = explode("-", $filename);
        $bmz = $temp[0];
        $mg = $temp[1];

        while ($bmz[0] == "0") {
            $bmz = substr($bmz, 1);
        }

    } else {
        $mg = $filename;
    }

    while ($mg[0] == "0") {
        $mg = substr($mg, 1);
    }
    if ($config["global"]["BMZ"]) {
        $filename = $bmz . "-" . $mg;
    } else {
        $filename = $mg;
    }

    return $filename;
}


/**
 * Prüft ob ein Wort UTF8 ist, falls nicht, konvertiert er es in UTF8.
 * @param $wort
 * @return string
 */
function toUTF($wort)
{
    if (strcmp(mb_check_encoding($wort), "UTF-8")) {
        return utf8_encode($wort);
    } else {
        return $wort;
    }
}


function getVersions() {

    $filename = "versions.txt";
    $text = "";
    if (file_exists($filename)) {
        $handle = fopen($filename, "r");
        if (!$handle) {
            throw new Exception('File open failed.');
        }
        while ($inhalt = fgets($handle, 4096)) {
            $text  .= $inhalt . "<br />" ;
        }
        fclose($handle);
    }
    return $text;

}
