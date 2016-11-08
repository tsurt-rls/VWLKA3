{config_load file="config.conf" section="body"}
{config_load file="config.conf" section="module"}
<!doctype html>
<html>
<head>
    {include file="head.tpl"}
    <style type="text/css">
        body {
            background-color: {#custom_backgroundcolor#}
        }
    </style>
</head>
<body>
{block name="index_wrapper"}
    <div class="wrapper {if #module_ansicht# && $ansicht != "true"}ansicht_wrapper{/if}" data-ansicht="{$ansicht}">
        {if #module_ansicht#}
            {if $ansicht eq "true"}
                {include file="Ansicht_Standard.tpl"}
            {else}
                {include file="{#module_ansicht_name#}.tpl"}
            {/if}
        {else}
            {include file="Ansicht_Standard.tpl"}
        {/if}
    </div>
{/block}
</body>
</html>
