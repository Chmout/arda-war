{include file="overall_header.tpl"}
<body id="mercado">
<div id="tooltip" class="tip"></div>
<div class="contenido_big">
<div id="cajaBG">
    <div id="caja">
<div id="topnav" class="header_normal"> 	
		{include file="overall_topnav.tpl"}	
			<div id="titular">
			<div id="estructura_titular" style="position:relative;">
				<div id="titular_texto" style="display: block;">{$lm_buildings} - <span>{$planetname}</span></div>
			</div>
        </div>
	</div> 
{include file="left_menu.tpl"}
<div id="contenidoMostrado">                               
<div id="elCosoxD">
<div id="titulo_alternativo_corto">
    <ul class="tabsbelow">
        <li>
              <span><b><font color="lime" size = 2>{$lm_buildings} : </font>
	<class="mercader_menu1" id="bl2" style="visibility:visible">				  
{if $allow == "allow"}<font color="yellow" size = 2>{$bv_gene}</font>	{/if}
{if $allow == "ressource"}<font color="yellow" size = 2>{$bv_ress}</font>	{/if}	
{if $allow == "stockage"}<font color="yellow" size = 2>{$bv_stoc}</font>	{/if}	
{if $allow == "infrastruture"}<font color="yellow" size = 2>{$bv_infra}</font>	{/if}	
{if $allow == "lune"}<font color="yellow" size = 2>{$bv_infra}</font>	{/if}				  
			  </b></span>
        </li>                                    
    </ul>
</div>
<div id="eins">
 <div>
      			      <td><center>	
				  <form action="" method="post" >
				  <input type="button"  class="submit" name="game.php?page=buildings&mode=1" value="{$bv_gene}" onclick="self.location.href='game.php?page=buildings&mode=1'" onclick>

				  
{if $planet_type == 1}					  
				  <form action="" method="post" >
				  <input type="button"  class="submit" name="game.php?page=buildings&mode=2" value="{$bv_ress}" onclick="self.location.href='game.php?page=buildings&mode=2'" onclick>
{/if}
				  <form action="" method="post" >
				  <input type="button"  class="submit" name="game.php?page=buildings&mode=3" value="{$bv_stoc}" onclick="self.location.href='game.php?page=buildings&mode=3'" onclick>
{if $planet_type == 1}				  
				  <form action="" method="post" >
				  <input type="button"  class="submit" name="game.php?page=buildings&mode=4" value="{$bv_infra}" onclick="self.location.href='game.php?page=buildings&mode=4'" onclick>
{/if}
{if $planet_type == 3}				  
				  <form action="" method="post" >
				  <input type="button"  class="submit" name="game.php?page=buildings&mode=5" value="{$bv_infra}" onclick="self.location.href='game.php?page=buildings&mode=5'" onclick>
{/if}				  
				  </form>				  
				  </td> 				  
				  
 <br />
   <table width="95%">	
		<ul class="estructuras_c">
		{foreach item=BuildInfoRow from=$BuildInfoList}
			<li>
				<a href="#" onclick="return Dialog.info({$BuildInfoRow.id})">
					<img class="tooltip" name="<table>
					<tr>
					<th colspan=2>{$BuildInfoRow.name}</th>
					</tr>
					<tr>
					<td><img src={$dpath}gebaeude/{$BuildInfoRow.id}.png width=140 height=140 /></td>
					<td>{$BuildInfoRow.descriptions}</td>
					</tr>
					</table>" src="{$dpath}gebaeude/{$BuildInfoRow.id}.png" width="100" height="100" />
				</a>
				{if $BuildInfoRow.level > 0}<div class="nivel_c"> <b style="cursor:help;" class="tooltip" name="{$bd_lvl} {$BuildInfoRow.level}"><font color="yellow">{$bd_lvl}</font> <font color="lime"> {$BuildInfoRow.level}</font></b></div>{/if}				
				{if $BuildInfoRow.EnergyNeed}
				<div class="energia_c tooltip" name="{$BuildInfoRow.RealEnergy}">{$BuildInfoRow.EnergyNeed}</div>
				{/if}	
				<br />
				<div class="construir_c">{$BuildInfoRow.BuildLink}</div>
				{if $BuildInfoRow.level > 0} <div class="tooltip destruir_c" name="<table style=\'width:100%;margin:0;padding:0\'><tr><th colspan=\'2\'>&nbsp;{$bd_price_for_destroy} {$BuildInfoRow.name} {$BuildInfoRow.level}&nbsp;</th></tr><tr><td class=\'transparent\'><img src=styles/theme/{$Raza_skin}/images/metal.jpg width=30 height=20 /></td><td class=\'transparent\'>{$BuildInfoRow.destroyress.metal}</td></tr><tr><td class=\'transparent\'><img src=styles/theme/{$Raza_skin}/images/cristal.jpg width=30 height=20 /></td><td class=\'transparent\'>{$BuildInfoRow.destroyress.crystal}</td></tr><tr><td class=\'transparent\'><img src=styles/theme/{$Raza_skin}/images/deuterio.jpg width=30 height=20 /></td><td class=\'transparent\'>{$BuildInfoRow.destroyress.deuterium}</td></tr><tr><td class=\'transparent\'><img src=styles/theme/{$Raza_skin}/images/norio.jpg width=30 height=20 /></td><td class=\'transparent\'>{$BuildInfoRow.destroyress.norio}</td></tr><tr><td class=\'transparent\'>{$bd_destroy_time}</td><td class=\'transparent\'>{$BuildInfoRow.destroytime}</td></tr></table>"><a href="game.php?page=buildings&amp;cmd=destroy&amp;building={$BuildInfoRow.id}"><img src="styles/theme/{$Raza_skin}/imagenes/navegacion/destruir.gif" /></a></div>{/if}
				<div class="demas_c">
				<div class="recursos_c">{$BuildInfoRow.price}</div>
				<div class="espacio_c"><br /></div>
				<div class="tiempo_c">
				<b>{$fgf_time}</b></font><br />{$BuildInfoRow.time}
				</div>		
				{if $BuildInfoRow.level > 0 && $BuildInfoRow.id != 33}
				{/if}
				</div>
			</li>
		{/foreach}
		<ul>
    </table>
</div>
</div>	
<div class="new_footer_small"></div>

	  
<br /><br /><br /><br /><br /><br /><br /><br />	
</div>
<div id="buildlist" style="display:none;"></div>  
<br/ ><br /><br />
</div>
</div>
</div>
</div>
{if $data}
<script type="text/javascript">
data	= {$data};
</script>
{/if}
{include file="planet_menu.tpl"}
{include file="overall_footer.tpl"}
<script>
function blink(Obj)
{
if (Obj.style.visibility == "visible" )
{
Obj.style.visibility = "hidden";
}
else
{
Obj.style.visibility = "visible";
}
}
setInterval("blink(bl2)",500);
</script>