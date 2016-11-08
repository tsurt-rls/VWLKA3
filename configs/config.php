<?php
$config = array();
// Globale Konfiguration VFWLKA-APP


$dir = __DIR__;

$temp = explode("\\", $dir);
$count = count($temp);
$dir = $temp[$count-2];

$config["global"]["install_folder"] = $dir;

// Pfad zu den Feuerwehrlaufkarten
$config["global"]["dest_fwlk_relativ"] = $_SERVER['DOCUMENT_ROOT'] ."/" . $dir . "/PCTAB/";
$config["global"]["dest_fwlk"] = "PCTAB/";

// Ordner der IMAGEMAGICK convert.exe
$config["global"]["dest_imagemagick"] = "C:\\xampp\\ImageMagick\\convert.exe";

// Betriebsmodus mit BMZ
$config["global"]["BMZ"] = true;

// Sollen Gruppen mit Nullen aufgefüllt werden ( 01/1 --> 01/01 )
$config["global"]["gruppenNullen"] = false;

// Anzahl der Nullen
$config["global"]["gruppenNullenAnzahl"] = 3;

// Sollen BMZ mit Nullen aufgefüllt werden ( 01/1 --> 01/01 )
$config["global"]["bmzNullen"] = false;

// Anzahl der Nullen
$config["global"]["bmzNullenAnzahl"] = 2;

// Aktivierte module
// einsatzhinweise
// datenbank
// meldehistory
// fwpl
$config["global"]["module"] = array("einsatzhinweise", "datenbank", "meldehistory", "ansicht_nurMeldungen");

// Konfigurationsdateine der Module laden

foreach ($config["global"]["module"] as $modul) {
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/" . $dir . "/modules/" . $modul . "/config/config_" . $modul . ".php")) {
        include($_SERVER['DOCUMENT_ROOT'] . "/" . $dir . "/modules/" . $modul . "/config/config_" . $modul . ".php");
    }
}
?>
