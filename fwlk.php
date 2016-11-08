<?php
require 'libs/Smarty.class.php';
require 'configs/config.php';
require 'configs/funcs.php';

$smarty = new Smarty;
header("Content-Type: text/html");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$smarty->compile_check = true;
$smarty->force_compile = 1;

$folder = $_SERVER['DOCUMENT_ROOT'] . "/".$config["global"]["install_folder"]."/modules/";

foreach ($config["global"]["module"] as $modul) {
    if (is_dir($folder . "/" . $modul . "/templates/")) {
        $smarty->addTemplateDir($folder . "/" . $modul . "/templates/", $modul);
    }
}

if (isset($_GET["action"])) {
    $action = $_GET["action"];
    if ($action == "zeigeGruppen") {
        $bmz = $_GET["bmz"];
        $data = readFolder("pdf", $config);
        $gruppen = array();
        for ($x = 0; $x < count($data); $x++) {
            $temp = explode("-", $data[$x]);
            if ($temp[0] == $bmz) {
                $gruppen[] = $temp[1];
            }
            sort($gruppen);
        }
        $smarty->assign("data", $gruppen);
        $smarty->assign("bmz", $bmz);
        $smarty->assign("modus", $config["global"]["BMZ"]);
        $smarty->display('viewMeldegruppen.tpl');
    } elseif ($action == "zeigeUebersicht") {

        $data = readFolder("pdf", $config);
        $smarty->assign("modus", $config["global"]["BMZ"]);
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
            $smarty->display('viewBMZ.tpl');
        } // Initialisiere Startansicht ohne BMZ-Modus
        else {
            sort($data);
            $smarty->assign("data", $data);
            $smarty->display('viewMeldegruppen.tpl');
        }

    } // Zeigt die Meldegruppe als Bild an und läd die Einsatzhinweise
    elseif ($action == "zeigeMeldegruppe") {
        $mg = $_GET["mg"];
        if ($config["global"]["BMZ"]) {
            $bmz = $_GET["bmz"];
            $filename = $bmz . "-" . $mg;
            $smarty->assign("bmz", $bmz);
        } else {
            $filename = $mg;
        }

        $filename = convertFilename($filename);
        convertFWLK($filename);

        $einsatzhinweis_text = ladeEinsatzHinweisText($filename, $config);

        header("Content-Type: application/json");
        $smarty->assign("mg", $mg);
        $smarty->assign("filename", $filename);
        $smarty->assign("ordner", $config["global"]["dest_fwlk"]);
        $smarty->assign("einsatzhinweis", true);
        $smarty->assign("einsatzhinweis_text", $einsatzhinweis_text);

        $view = $smarty->fetch('viewFWLK.tpl');
        $menu = $smarty->fetch('menu.tpl');

        $arr = array("view" => $view, "menu" => $menu);

        echo json_encode($arr);
    }
}
?>
