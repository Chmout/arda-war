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
				<div id="titular_texto" style="display: block;">{$lm_alliance}</div>
			</div>
        </div>
	</div> 
{include file="left_menu.tpl"}
<div id="contenidoMostrado">                               
<div id="elCosoxD">
<div class="coso_izquierda_corto"></div>
<div class="coso_derecha_corto"></div>
<div id="planeta_small" style="background-image: url(styles/theme/{$Raza_skin}/adds/redes.jpg);"></div>	
<div id="titulo_alternativo_corto">
    <ul class="tabsbelow">
        <li>
              <span><b><font color="yellow" size = 2>{$al_name} : </font><font color="lime" size = 2>{$ally_name}</font></b> <a class="right" href="game.php?page=alliance&amp;mode=admin&amp;edit=ally"><b><font color="red" size = 2 >>></font><font size = 2>{$al_back}</font></b></a></span>
        </li>                                    
    </ul>
</div>	
<div id="eins">

              <span><b><font color="yellow" size = 2>{$al_new_name}</font></b></a></span>
         
<div>	
    <form action="" method="POST">
    <table>
        <tr>
 {if $l_max == 8 }         <td><center><div class="bg_input_special"><input class="text" type="text" name="newname" maxlength="8"/></div>{/if}
 {if $l_max == 30}         <td><center><div class="bg_input_special"><input class="text" type="text" name="newname" maxlength="30"/></div>{/if}
		  <input type="submit" class="submit" value="{$al_change_submit}" />&nbsp;&nbsp;</td>
        </tr>
    </table>
    </form>
</div>			
</div>
<div class="new_footer"></div>		
<br /><br /><br /><br /><br /><br />
</div>	
</div>
</div>	
</div>
</div>	
{include file="planet_menu.tpl"}
{include file="overall_footer.tpl"}