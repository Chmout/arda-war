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

        </li>                                    
    </ul>
</div>	
<div id="eins">
<div>	
    <form action="" method="POST">
        <table>
		<br />
        <tr>
          <th>{$al_request_wait_message}</th>
        </tr>
        <tr>
          <td><center><input class="submita" type="submit" name="bcancel" value="{$button_text}"></td>
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