<?php
/**
 * VFWLKA Application
 *
 * @package VWLKA-APP
 */

require 'libs/Smarty.class.php';
require 'configs/config.php';
require 'configs/funcs.php';

$smarty = new Smarty;

$smarty->debugging = false;
$smarty->caching = false;
$smarty->force_compile = true;

$folder_basis = $_SERVER['DOCUMENT_ROOT'] . "/" . $config["global"]["install_folder"] . "/modules/";

foreach ($config["global"]["module"] as $modul) {
    if (is_dir($folder_basis . "/" . $modul . "/templates/")) {
        $smarty->addTemplateDir($folder_basis . "/" . $modul . "/templates/", $modul);
    }
}


$css = array();
foreach ($config["global"]["module"] as $modul) {
    $folder = $folder_basis . $modul . "/css/";
    if (is_dir($folder)) {
        $cssfiles = scandir($folder);
        foreach ($cssfiles as $file) {
            $info = pathinfo($file);
            if ($info['extension'] == "css") {
                    $css[$modul]["file"] = $file;
                    $css[$modul]["name"] = $modul;
            }
        };
    }
}

$js = array();
foreach ($config["global"]["module"] as $modul) {
    $folder = $folder_basis . $modul . "/js/";
    if (is_dir($folder)) {
        $jsfiles = scandir($folder);
        foreach ($jsfiles as $file) {
            $info = pathinfo($file);
            if ($info['extension'] == "js") {
                $js[$modul]["file"] = $file;
                $js[$modul]["name"] = $modul;
            }
        };
    }
}


$data = readFolder("pdf", $config);

// Initialisiere Startansicht im BMZ-Modus
if ($config["global"]["BMZ"]) {
    $bmz = array();
    for ($x = 0; $x < count($data); $x++) {
        $temp = explode("-", $data[$x]);
        $bmz[] = $temp[0];
        sort($bmz);
        $bmz = array_unique($bmz);
    }
    $smarty->assign("data", $bmz);
} // Initialisiere Startansicht ohne BMZ-Modus
else {
    sort($data);
    $smarty->assign("data", $data);
}

if (in_array("datenbank", $config["global"]["module"])) {

    $db = getConnection();
    $smarty->assign("db", $db);

    $alarmCount = getAlarmCount();
    $smarty->assign("alarmCount", $alarmCount);

    $meldezentrum = getMeldeCounts($config["datenbank"]["Meldearten"]);
    $smarty->assign("meldezentrum", $meldezentrum);

    $smarty->assign("ansicht", false);

    if (isset($_GET["ansicht"])) {
        $smarty->assign("ansicht", $_GET["ansicht"]);
    }

    $smarty->assign("lageplan", false);

    if (isset($config["ansicht"]["lageplan"])) {
        $smarty->assign("lageplan", $config["ansicht"]["lageplan"]);
        $smarty->assign("lageplan_dest", $config["ansicht"]["lageplan_dest"]);
    }

    $alarmcenter = getAlarmCenter();
    $smarty->assign("alarmcenter", $alarmcenter);

    $blinkdata = getAlarmData();
    $smarty->assign("blinkdata", $blinkdata);

    $smarty->assign("filter", "false");

    $smarty->assign("css", $css);
    $smarty->assign("js", $js);

    $versionsinformationen = getVersions();
    $smarty->assign("versionsinformationen", $versionsinformationen);


}

$smarty->assign("modus", $config["global"]["BMZ"]);

$smarty->display('index.tpl');

