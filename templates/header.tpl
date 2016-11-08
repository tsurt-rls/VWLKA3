{config_load file="config.conf" section="allgemein"}
{config_load file="config.conf" section="header"}
<div id="logo">
  <img alt="{#firma#}" src="{#logo_src#}" />
</div>
<nav id="nav_mg">
  <ul>
    {if $modus}<li><a id="uebersichtButton"class="active" data-modus="bmz" href="#view">BMZ<br/>Übersicht</a></li>{else}<li><a id="uebersichtButton"class="active" href="#view" data-modus="mg">MG<br/>Übersicht</a></li>{/if}
  </ul>
</nav>
<nav id="nav_sites">
  <ul >
    <li><a id="scrollUp" href="#view">Seite<br/>1</a></li>
    <li><a id="scrollDown" href="#view">Seite<br/>2</a></li>
  </ul>
</nav>
