<div class=viewTable>
    <div class=viewRow>
        {foreach $data as $val}
            <div class="blockLink mgLink"><a href="#" {if $modus}data-bmz="{$bmz}"{/if}
                                             data-mg="{$val}">MG</br>{$val}</a></div>
        {/foreach}
    </div>
    {if #module_datenbank#}
        <script>
            getBlinkData(1, "list");
        </script>
    {/if}
</div>
