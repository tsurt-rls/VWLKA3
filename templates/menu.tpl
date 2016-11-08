{config_load file="config.conf" section="module"}

<nav id="menu_left">
    {if #module_pdf_download#}<a id="fwlk_openPDF" href="{if isset($filename)}{$ordner}{$filename}.pdf{/if}"
                                 alt="PDF Download" target="_blank">PDF</a>{/if}
    {if #module_einsatzhinweise#}
        <a id="fwlk_openEinsatzhinweise" href="#" alt="Einsatzhinweise">Einsatzhinweise</a>
    {/if}
</nav>
<nav id="menu_right">
    {if #module_ansicht#}<a href="?ansicht=false" alt="Ansicht wechseln!">Ansicht wechseln!</a>{/if}
    {if #module_fwpl#}<a id="viewFWPL" href="#" alt="FWPL Anzeigen">Feuerwehrpläne</a>{/if}
    {if #module_datenbank_history#}<a id="openHistory" href="#" alt="Meldehistory öffnen">Meldehistory</a>{/if}
</nav>
