{config_load file="config.conf" section="module"}

<div class=viewTable>
    <div class=viewRow>
        {foreach $data as $val}
            <div class="blockLink bmzLink"><a href="#" data-bmz="{$val}">BMZ</br>{$val}</a></div>
        {/foreach}
    </div>
    {if #module_datenbank#}
        <script>
            getBlinkData();
        </script>
    {/if}
</div>
