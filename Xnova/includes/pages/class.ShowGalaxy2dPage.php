<?php
/*
ALTER TABLE xxxx_config ADD changer_vue int (11) NOT NULL ;
*/
include_once(ROOT_PATH . 'includes/classes/class.GalaxyRows.php');

class ShowGalaxy2dPage extends GalaxyRows
{
	private function ShowGalaxyRows($Galaxy, $System)
	{
		global $PLANET, $USER, $db, $LNG, $UNI;
		$GalaxyPlanets		= $db->query("SELECT SQL_BIG_RESULT DISTINCT p.`planet`, p.`id`, p.`id_owner`, p.`name`, p.`image`, p.`last_update`, p.`diameter`, p.`temp_min`, p.`destruyed`, p.`der_metal`, p.`der_crystal`, p.`id_luna`, u.`id` as `userid`, u.`ally_id`, u.`username`, u.`onlinetime`, u.`urlaubs_modus`, u.`banaday`, s.`total_points`, s.`total_rank`, a.`id` as `allyid`, a.`ally_tag`, a.`ally_web`, a.`ally_members`, a.`ally_name`, allys.`total_rank` as `ally_rank` FROM ".PLANETS." p	LEFT JOIN ".USERS." u ON p.`id_owner` = u.`id` LEFT JOIN ".STATPOINTS." s ON s.`id_owner` = u.`id` AND s.`stat_type` = '1'	LEFT JOIN ".ALLIANCE." a ON a.`id` = u.`ally_id` LEFT JOIN ".STATPOINTS." allys ON allys.`stat_type` = '2' AND allys.`id_owner` = a.`id` WHERE p.`universe` = '".$UNI."' AND p.`galaxy` = '".$Galaxy."' AND p.`system` = '".$System."' AND p.`planet_type` = '1' ORDER BY p.`planet` ASC;");
		$COUNT				= $db->num_rows($GalaxyPlanets);
		while($GalaxyRowPlanets = $db->fetch_array($GalaxyPlanets))
		{
			$PlanetsInGalaxy[$GalaxyRowPlanets['planet']]	= $GalaxyRowPlanets;
		}

		$db->free_result($GalaxyPlanets);
		
		for ($Planet = 1; $Planet < (1 + MAX_PLANET_IN_SYSTEM); $Planet++)
		{
			if (!isset($PlanetsInGalaxy[$Planet])) 
			{
				$Result[$Planet]	= false;
				continue;
			}
			
			$GalaxyRowPlanet  = $PlanetsInGalaxy[$Planet];
			$GalaxyRowPlanet['galaxy']	= $Galaxy;
			$GalaxyRowPlanet['system']	= $System;
			
			if ($GalaxyRowPlanet['destruyed'] != 0)
			{
 			$des	= "des";
			$Result[$Planet] = array('des' => $des,);
				continue;
			}
			
			if ($GalaxyRowPlanet['id_luna'] != 0)
			{
				$GalaxyRowMoon 				= $db->uniquequery("SELECT `destruyed`, `id`, `id_owner`, `diameter`, `name`, `temp_min`, `last_update` FROM ".PLANETS." WHERE `id` = '".$GalaxyRowPlanet['id_luna']."' AND planet_type='3';");
				@$Result[$Planet]['moon']	= $this->GalaxyRowMoon($GalaxyRowMoon);
				
				$GalaxyRowPlanet['last_update'] = max($GalaxyRowPlanet['last_update'], $GalaxyRowMoon['last_update']);
			} else {
				$Result[$Planet]['moon']	= false;
			}
			
			$Result[$Planet]['user']		= $this->GalaxyRowUser($GalaxyRowPlanet);
			$Result[$Planet]['planet']		= $this->GalaxyRowPlanet($GalaxyRowPlanet, $IsOwn);
			$Result[$Planet]['planetname']	= $this->GalaxyRowPlanetName ($GalaxyRowPlanet);
			
			$Result[$Planet]['action']	= $GalaxyRowPlanet['userid'] != $USER['id'] ? $this->GalaxyRowActions($GalaxyRowPlanet) : false;
			$Result[$Planet]['ally']	= $GalaxyRowPlanet['ally_id'] != 0 ? $this->GalaxyRowAlly($GalaxyRowPlanet) : false;
			$Result[$Planet]['derbis']	= $GalaxyRowPlanet['der_metal'] > 0 || $GalaxyRowPlanet['der_crystal'] > 0 ? $this->GalaxyRowDebris($GalaxyRowPlanet) : false;
											
		}
		return array('Result' => $Result, 'planetcount' => $COUNT);
	}

	public function __construct()
	{
		global $USER, $PLANET, $dpath, $resource, $LNG, $db, $reslist, $OfficerInfo, $CONF;
		
if($_GET['mode'] == 10 AND $modeaa == 1) 
{	
$modeaa == 0 ;	
header ("Refresh: 1");	
}
if($_GET['mode'] == 4)
{
$confirm = 4 ;

$_SESSION['galaxyd'] = $_GET['galaxy'];	
$_SESSION['systemd'] = $_GET['system'];
$_SESSION['planetd'] = $_GET['planet'];
$_SESSION['luned'] = $_GET['lune'];

}


$hoytime = $_SERVER['REQUEST_TIME'];
if ($PLANET['planet_time'] <= $hoytime AND $PLANET['planet_depla'] == 1) {
		$db->query("UPDATE ".PLANETS." SET `planet_depla`= '0' WHERE id=".$PLANET['id'].""); }


if($_GET['mode'] == 5)
{
$modeaa == 1 ;	
if ($_SESSION['galaxyd'] > 0 && $_SESSION['systemd'] > 0 && $_SESSION['planetd'] > 0)
{

$nb_min = VSL_MINI; 
$nb_max = VSL_MAX; 
$offtime = mt_rand($nb_min,(int) $nb_max);


      $newEndTime = $_SERVER['REQUEST_TIME'] + $offtime;

	$db->query("UPDATE ".USERS." SET galaxy = '".$_SESSION['galaxyd']."' WHERE `id_planet` = '".$PLANET['id']."';");
	$db->query("UPDATE ".USERS." SET system = '".$_SESSION['systemd']."' WHERE `id_planet` = '".$PLANET['id']."';");
	$db->query("UPDATE ".USERS." SET planet = '".$_SESSION['planetd']."' WHERE `id_planet` = '".$PLANET['id']."';");
	$db->query("UPDATE ".PLANETS." SET galaxy = '".$_SESSION['galaxyd']."' WHERE `id` = '".$PLANET['id']."';");
	$db->query("UPDATE ".PLANETS." SET system = '".$_SESSION['systemd']."' WHERE `id` = '".$PLANET['id']."';");
	$db->query("UPDATE ".PLANETS." SET planet = '".$_SESSION['planetd']."' WHERE `id` = '".$PLANET['id']."';");
	$db->query("UPDATE ".PLANETS." SET planet_time = '".$newEndTime."' WHERE `id` = '".$PLANET['id']."';");
	$db->query("UPDATE ".PLANETS." SET planet_depla = '1' WHERE `id` = '".$PLANET['id']."';");


 if ($_SESSION['luned']  > 0 ) 
{
	$db->query("UPDATE ".PLANETS." SET galaxy = '".$_SESSION['galaxyd']."' WHERE `id` = '".$_SESSION['luned']."';");
	$db->query("UPDATE ".PLANETS." SET system = '".$_SESSION['systemd']."' WHERE `id` = '".$_SESSION['luned']."';");
	$db->query("UPDATE ".PLANETS." SET planet = '".$_SESSION['planetd']."' WHERE `id` = '".$_SESSION['luned']."';");

}
$confirm = 5 ;

}
}



		
		$template		= new template();	
		$template->loadscript('galaxy.js');	
		$diam=round($GalaxyRowPlanet['diametr']/500);
		$maxfleet       = $db->num_rows($db->query("SELECT fleet_id FROM ".FLEETS." WHERE `fleet_owner` = '". $USER['id'] ."' AND `fleet_mission` != 10;"));
		
		$mode			= request_var('mode', 0);
		$galaxyLeft		= request_var('galaxyLeft', '');
		$galaxyRight	= request_var('galaxyRight', '');
		$systemLeft		= request_var('systemLeft', '');
		$systemRight	= request_var('systemRight', '');
		$galaxy			= min(max(abs(request_var('galaxy', $PLANET['galaxy'])), 1), MAX_GALAXY_IN_WORLD);
if($USER['authlevel'] == 3)		 {$system			= min(max(abs(request_var('system', $PLANET['system'])), 1), MAX_SYSTEM_IN_GALAXY);}
else							 {$system			= min(max(abs(request_var('system', $PLANET['system'])), 2), MAX_SYSTEM_IN_GALAXY);}
		$planet			= min(max(abs(request_var('planet', $PLANET['planet'])), 1), MAX_PLANET_IN_SYSTEM);
		$type			= request_var('type', 1);
		$current		= request_var('current', 0);
		$gl_cp           = request_var('gl_cp', 0);
			
		if ($mode == 1)
		{
			if (!empty($galaxyLeft))
				$galaxy	= max($galaxy - 1, 1);
			elseif (!empty($galaxyRight))
				$galaxy	= min($galaxy + 1, MAX_GALAXY_IN_WORLD);

			if (!empty($systemLeft))
if($USER['authlevel'] == 3)		{$system	= max($system - 1, 1);}		
else							{$system	= max($system - 1, 2);}	
			elseif (!empty($systemRight))
				$system	= min($system + 1, MAX_SYSTEM_IN_GALAXY);
		}

		if (!($galaxy == $PLANET['galaxy'] && $system == $PLANET['system']) && $mode != 0)
		{
			if($PLANET['deuterium'] < $CONF['deuterium_cost_galaxy'])
			{	
				$template->message("<font color=#FF0000 size=4>".$LNG['gl_no_deuterium_to_view_galaxy'], "game.php?page=galaxy&mode=0", 2);
				exit;
			}
			else
				$PLANET['deuterium']	-= $CONF['deuterium_cost_galaxy'];
		}
		
		$PlanetRess = new ResourceUpdate();
		$PlanetRess->CalcResource();
		$PlanetRess->SavePlanetToDB();
	
		unset($reslist['defense'][array_search(502, $reslist['defense'])]);
		$MissleSelector[0]	= $LNG['gl_all_defenses'];
		foreach($reslist['defense'] as $Element)
		{	
			$MissleSelector[$Element] = $LNG['tech'][$Element];
		}
		
$tableau = 20 ;
$systeme = $system ;
if ($galaxy > 1){$systeme = (MAX_SYSTEM_IN_GALAXY + 1) * ($galaxy - 1) + $system;

}
if ($systeme > $tableau){
	$index1 = $systeme/$tableau;
	$index2 = floor($index1)*$tableau ;
	$index = $systeme - $index2 + 1 ;
	
	}
if ($system <= $tableau){
	$index = $system ;
}
$galaxyPlanets = "galaxyPlanets" ;
$galaxyPlanets.= $index ;
	if ($confirm == 5){
	$darkmatter = VSL_PRIX ;
	$db->query("UPDATE ".USERS." SET darkmatter = darkmatter-'".$darkmatter."' WHERE `id` = '".$USER['id']."';");}		
		$Result	= $this->ShowGalaxyRows($galaxy, $system);
	

		$template->assign_vars(array(	
			'authlevel'			 		=> $USER['authlevel'],				
			'name_vaisseau'				=> $PLANET['name'],
			'gl_changer_vue'			=> $LNG['gl_changer_vue'],
			'galaxyPlanets'			=> $galaxyPlanets,

			
			'aaa'						=> '15',
			'expedition' 				=> MAX_PLANET_IN_SYSTEM,
			'GalaxyRows'				=> $Result['Result'],
			'planetcount'				=> sprintf($LNG['gl_populed_planets'], $Result['planetcount']),
			'a1'						=> 'left: 23px',
			'b1'						=> 'top: 5px',
			'a2'						=> 'left: 160px',
			'b2'						=> 'top: -33px',
			'a3'						=> 'left: 296px',
			'b3'						=> 'top: -58px',	
			'a4'						=> 'left: 433px',
			'b4'						=> 'top: -58px',
			'a5'						=> 'right: 296px',
			'b5'						=> 'top: -58px',
			'a6'						=> 'right: 160px',
			'b6'						=> 'top: -33px',
			'a7'						=> 'right: 23px',
			'b7'						=> 'top: 5px',
			'a8'						=> 'left: 316px',
			'b8'						=> 'top: 72px',
			'a9'						=> 'right: 316px',
			'b9'						=> 'top: 72px',
			'a10'						=> 'left: -44px',
			'b10'						=> 'top: 139px',
			'a11'						=> 'left: 76px',
			'b11'						=> 'top: 139px',
			'a12'						=> 'left: 196px',
			'b12'						=> 'top: 139px',	
			'a13'						=> 'right: 196px',
			'b13'						=> 'top: 139px',
			'a14'						=> 'right: 76px',
			'b14'						=> 'top: 139px',
			'a15'						=> 'right: -44px',
			'b15'						=> 'top: 139px',
			'diam'						=> '70',
			'mode'						=> $mode,
			'galaxy'					=> $galaxy,
			'system'					=> $system,
			'planet'					=> $planet,
			'gl_cp'                                  => $gl_cp,
			'current'					=> $current,
			'currentmip'				=> pretty_number($PLANET[$resource[503]]),
			'maxfleetcount'				=> $maxfleet,
			'fleetmax'					=> ($USER['computer_tech'] + 1) + ($USER['rpg_commandant'] * $OfficerInfo[611]['info']),
			'grecyclers'   				=> pretty_number($PLANET[$resource[219]]),
			'recyclers'   				=> pretty_number($PLANET[$resource[209]]),
			'spyprobes'   				=> pretty_number($PLANET[$resource[210]]),
			'missile_count'				=> sprintf($LNG['gl_missil_to_launch'], $PLANET[$resource[503]]),
			'spio_anz'					=> $USER['spio_anz'],
			'settings_fleetactions'		=> $USER['settings_fleetactions'],
		'current_id'			=> $PLANET['id'],
			'current_galaxy'			=> $PLANET['galaxy'],
			'current_system'			=> $PLANET['system'],
			'current_planet'			=> $PLANET['planet'],
			'planet_type' 				=> $PLANET['planet_type'],
		'lune'		=> $PLANET['id_luna'],
			'MissleSelector'			=> $MissleSelector,
			'gl_solar_system'			=> $LNG['gl_solar_system'],
		'inavitado'					=> $LNG['gl_inavitado'],
		'inavitado1'				=> $LNG['gl_inavitado1'],
		'gl_pos1'				=> $LNG['gl_pos1'],
		'planet_destroyed'			=> $LNG['gl_planet_destroyed'],
		'name_vaisseau'				=> $PLANET['name'],
		'planet_depla'				=> $PLANET['planet_depla'],			
			'gl_galaxy' 				=> $LNG['gl_galaxy'],
			'gl_missil_launch_action'	=> $LNG['gl_missil_launch_action'],
			'gl_objective'				=> $LNG['gl_objective'],
			'gl_missil_launch'			=> $LNG['gl_missil_launch'],
			'gl_pos'					=> $LNG['gl_pos'],
			'gl_planet'					=> $LNG['gl_planet'],
			'gl_alliance'				=> $LNG['gl_alliance'],
			'gl_actions'				=> $LNG['gl_actions'],
			'gl_name_activity'			=> $LNG['gl_name_activity'],
			'gl_player_estate'			=> $LNG['gl_player_estate'],
			'gl_debris'					=> $LNG['gl_debris'],
			'gl_moon'					=> $LNG['gl_moon'],
			'gl_show'					=> $LNG['gl_show'],
			'gl_out_space'				=> $LNG['gl_out_space'],
			'gl_out_space1'				=> $LNG['gl_out_space1'],
			'gl_out_retour'				=> $LNG['gl_out_retour'],
			'gl_legend'					=> $LNG['gl_legend'],
			'gl_strong_player'			=> $LNG['gl_strong_player'],
			'gl_nomplapla'				=> $LNG['gl_nomplapla'],
			'gl_ally'					=> $LNG['gl_ally'],
			'gl_pseudo'					=> $LNG['gl_pseudo'],
			'gl_nonally'				=> $LNG['gl_nonally'],
			
			'gl_s'						=> $LNG['gl_s'],
			'gl_week_player'			=> $LNG['gl_week_player'],
			'gl_w'						=> $LNG['gl_w'],
			'gl_vacation'				=> $LNG['gl_vacation'],
			'gl_v'						=> $LNG['gl_v'],
			'gl_banned'					=> $LNG['gl_banned'],
			'gl_b'						=> $LNG['gl_b'],
			'gl_inactive_seven'			=> $LNG['gl_inactive_seven'],
			'gl_i'						=> $LNG['gl_i'],
			'gl_inactive_twentyeight'	=> $LNG['gl_inactive_twentyeight'],
			'gl_I'						=> $LNG['gl_I'],
			'gl_avaible_grecyclers'		=> $LNG['gl_avaible_grecyclers'],
			'gl_avaible_recyclers'		=> $LNG['gl_avaible_recyclers'],
			'gl_avaible_spyprobes'		=> $LNG['gl_avaible_spyprobes'],
			'gl_fleets'					=> $LNG['gl_fleets'],
			'gl_avaible_missiles'		=> $LNG['gl_avaible_missiles'],
			'gl_moon'					=> $LNG['gl_moon'],
			'gl_diameter'				=> $LNG['gl_diameter'],
			'gl_features'				=> $LNG['gl_features'],
			'gl_temperature'			=> $LNG['gl_temperature'],
			'gl_actions'				=> $LNG['gl_actions'],
			'gl_debris_field'			=> $LNG['gl_debris_field'],
			'gl_resources'				=> $LNG['gl_resources'],
			'gl_collect'				=> $LNG['gl_collect'],
			'gl_with'					=> $LNG['gl_with'],
			'gl_alliance_page'			=> $LNG['gl_alliance_page'],
			'gl_see_on_stats'			=> $LNG['gl_see_on_stats'],
			'gl_alliance_web_page'		=> $LNG['gl_alliance_web_page'],
			'gl_spy'					=> $LNG['gl_spy'],
			'gl_buddy_request'			=> $LNG['gl_buddy_request'],
			'gl_missile_attack'			=> $LNG['gl_missile_attack'],
			'gl_player'					=> $LNG['gl_player'],
			'gl_playercard'				=> $LNG['gl_playercard'],
			'gl_phalanx'				=> $LNG['gl_phalanx'],
			'gl_points'					=> $LNG['gl_points'],
			'gl_ajax_status_ok'			=> $LNG['gl_ajax_status_ok'],
			'gl_ajax_status_fail'		=> $LNG['gl_ajax_status_fail'],
			'write_message'				=> $LNG['write_message'],
		'confirm' => $confirm,			
'points' => pretty_number($USER['total_points']),
'nivel'					=> $nivel,
'rango'				 => $rango,
'userid'					=> $USER['id'],
'username'					=> $USER['username'],
'lm_galaxy1'				=> $LNG['lm_galaxy1'],
		));
		
		$template->show('galaxy2d_overview.tpl');	
	}
}
?>