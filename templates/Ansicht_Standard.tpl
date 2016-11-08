{config_load file="config.conf" section="module"}

{block name="index_header"}
    <header class="clearfix"">
        {include file="header.tpl"}
    </header>
{/block}

{block name="index_datenabnk"}
    {if #module_datenbank#}
        <section id=datenbank class="clearfix">
            {include file="datenbank.tpl"}
        </section>
    {/if}
{/block}

{block name="index_view"}
    <section id=view class="clearfix">
        {if $modus}{include file="viewBMZ.tpl"}{else}{include file="viewMeldegruppen.tpl"}{/if}
    </section>
    {if #module_pdf_download# || #module_einsatzhinweise# || #module_fwpl# || #module_datenbank_history#}
        <section id=menu class="clearfix">
            {include file="menu.tpl"}
        </section>
    {/if}
{/block}

{block name="index_footer"}
    <footer class="clearfix">
        {include file="footer.tpl"}
    </footer>
{/block}
<div id="dialog_version" title="Versionsinformationen">
    <p>{$versionsinformationen}</p>
</div>
<script>
    $(function () {
        $("#dialog_version").dialog({
            width: 1000,
            modal: true,
            autoOpen: false,
        });
    });
</script>
