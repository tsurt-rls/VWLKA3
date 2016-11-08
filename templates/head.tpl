{config_load file="config.conf" section="head"}
{config_load file="config.conf" section="module"}

<meta charset=utf-8>
<meta http-equiv="expires" content="0">
<meta http-equiv="cache-control" content="no-cache">

<meta name="author" content="RLS - Elektronische Informationssysteme GmbH - www.rls.gmbh">
<meta name="description" content="{#title#}">

<title>{#title#}</title>

<!--JavaScript -->
{block name="head_javascript"}
    <script type="text/javascript" src="{#jquery_src#}"></script>
    <script type="text/javascript" src="{#custom_js_src#}"></script>
    <script type="text/javascript" src="{#jquery_ui_src#}"></script>
    <script type="text/javascript" src="js/jquery.scrollTo.js"></script>
    <script src="js/lightbox/js/lightbox.js"></script>
    {foreach $js as $modul}
        <script type="text/javascript" src="modules/{$modul.name}/js/{$modul.file}"></script>
    {/foreach}
{/block}

<!-- CSS -->
{block name="head_css"}
    <link href="{#custom_css_src#}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="js/jqueryUI/jquery-ui.theme.min.css" type="text/css">
    <link rel="stylesheet" href="js/jqueryUI/jquery-ui.structure.css" type="text/css">
    <link rel="stylesheet" href="js/jqueryUI/jquery-ui.theme.css" type="text/css">
    <link rel="stylesheet" href="js/lightbox/css/lightbox.min.css" type="text/css">
    {foreach $css as $modul}
        <link href="modules/{$modul.name}/css/{$modul.file}" rel="stylesheet" type="text/css">
    {/foreach}
{/block}

<!-- FavIcon -->
<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" href="favicon/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="favicon/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="favicon/manifest.json">
<link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="apple-mobile-web-app-title" content="{#title#}">
<meta name="application-name" content="{#title#}">
<meta name="theme-color" content="#ffffff">
