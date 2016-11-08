{config_load file="config.conf" section="module"}
<img class="imgFWLK" id="seite1" alt="MG {$mg}" src="{$ordner}{$filename}-0.png"/><img class="imgFWLK" id="seite2"
                                                                                       alt="MG {$mg}"
                                                                                       src="{$ordner}{$filename}-1.png"/>
{if #module_einsatzhinweise#}
    <div id="dialog_fwlk" title="Einsatzhinweise zur Meldegruppe {$mg}{if isset($bmz)} aus BMZ {$bmz}{/if}">
        <p>{$einsatzhinweis_text}</p>
    </div>
    <script>
        $(function () {
            $("#dialog_fwlk").dialog({
                width: 1000,
                modal: true,
                autoOpen: false,
            });
        });
    </script>
{/if}
<script>
    {if #module_datenbank#}
        {if isset($bmz)}
         getBlinkData({$bmz}, "list");
        {else}
            getBlinkData(1, "list");
        {/if}
    {/if}
</script>
