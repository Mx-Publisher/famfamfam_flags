<?php
/***************************************************************************
 *                              admin_country_flags.php
 *                            -------------------
 *   begin                : Thursday, February 6, 2003
 *   written by Nuttzy
 *  @copyright (c) RMcGirr83, Nuttzy, FlorinCB aka orynider
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
 
 /**
 * Modifications:
 *		26.11.2018 - ported for indexing flags in ../images/flags/country/ subfolder - by OryNider
 */

@define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Forum_Display']['Country_Flags'] = "$file";
	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
/* FLAG-start * /
@define('FLAG_TABLE', $table_prefix.'flags');
/* FLAG-end */
if( isset($_GET['mode']) || isset($_POST['mode']) )
{
	$mode = ($_GET['mode']) ? $_GET['mode'] : $_POST['mode'];
}
else 
{
	//
	// These could be entered via a form button
	//
	if( isset($_POST['add']) )
	{
		$mode = "add";
	}
	else if( isset($_POST['save']) )
	{
		$mode = "save";
	}
	else
	{
		$mode = "";
	}
}

// if we are are doing a delete make sure we got confirmation
if ( $mode == 'do_delete')
{
	// user bailed out, return to flag admin
	if ( !$_POST['confirm'] )
	{
		$mode = '' ;
	}
}

/* START Include language file */
$language = ($user->user_language_name) ? $user->user_language_name : (($board_config['default_lang']) ? $board_config['default_lang'] : 'english');

if ((@include $phpbb_root_path . "language/lang_" . $language . "/lang_admin_flags.$phpEx") === false)
{
	if ((@include $phpbb_root_path . "language/lang_english/lang_admin_flags.$phpEx") === false)
	{
		message_die(CRITICAL_ERROR, 'Language file ' . $phpbb_root_path . "language/lang_" . $language . "/lang_admin_flags.$phpEx" . ' couldn\'t be opened.');
	}
	$language = 'english'; 
} 

if( $mode != "" )
{
	if( $mode == "edit" || $mode == "add" )
	{
		//
		// They want to add a new flag, show the form.
		//
		$flag_id = ( isset($_GET['id']) ) ? intval($_GET['id']) : 0;
		
		$s_hidden_fields = "";
		
		if( $mode == "edit" )
		{
			if( empty($flag_id) )
			{
				message_die(GENERAL_MESSAGE, $lang['Must_select_flag']);
			}

			$sql = "SELECT * FROM " . FLAG_TABLE . "
				WHERE flag_id = $flag_id";
			if(!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, "Couldn't obtain flag data", "", __LINE__, __FILE__, $sql);
			}
			
			$flag_info = $db->sql_fetchrow($result);
			$s_hidden_fields .= '<input type="hidden" name="id" value="' . $flag_id . '" />';
		}
		$s_hidden_fields .= '<input type="hidden" name="mode" value="save" />';

		$template->set_filenames(array(
			"body" => "admin/flags_edit_body.tpl")
		);

		if (!is_file('../images/flags/country/'.$flag_info['flag_image']))
		{
			$flag_dir = '../images/flags/';
		}
		else
		{
			// 
			$flag_dir = '../images/flags/country/';
		}

		$template->assign_vars(array(
			//We do not need translation in the DB since is taken from the language file
			"FLAG" => $flag_info['flag_name'],

			"IMAGE" => ( $flag_info['flag_image'] != "" ) ? $flag_info['flag_image'] : "",
			"IMAGE_DISPLAY" => ( $flag_info['flag_image'] != "" ) ? '<img src="' . $flag_dir . $flag_info['flag_image'] . '" />' : "",

			"L_FLAGS_TITLE" => $lang['Flags_title'],
			"L_FLAGS_TEXT" => $lang['Flags_explain'],
			"L_FLAG_NAME" => $lang['Flag_name'],
			"L_FLAG_IMAGE" => $lang['Flag_image'],
			"L_FLAG_IMAGE_EXPLAIN" => $lang['Flag_image_explain'],
			"L_SUBMIT" => $lang['Submit'],
			"L_RESET" => $lang['Reset'],

			"S_FLAG_ACTION" => append_sid("admin_country_flags.$phpEx"),
			"S_HIDDEN_FIELDS" => $s_hidden_fields)
		);
	}
	else if( $mode == "save" )
	{
		//
		// Ok, they sent us our info, let's update it.
		//		
		$flag_id = ( isset($_POST['id']) ) ? intval($_POST['id']) : 0;
		$flag_name = ( isset($_POST['title']) ) ? trim($_POST['title']) : "";
		$flag_image = ( (isset($_POST['flag_image'])) ) ? trim($_POST['flag_image']) : "";

		if( $flag_name == "" )
		{
			message_die(GENERAL_MESSAGE, $lang['Must_select_flag']);
		}

		//
		// The flag image has to be a jpg, gif or png
		//
		if($flag_image != "")
		{
			if ( !preg_match("/(\.gif|\.png|\.jpg)$/is", $flag_image))
			{
				$flag_image = "";
			}
		}

		if ($flag_id)
		{
			$sql = "UPDATE " . FLAG_TABLE . "
				SET flag_name = '" . str_replace("\'", "''", $flag_name) . "', flag_image = '" . str_replace("\'", "''", $flag_image) . "'
				WHERE flag_id = $flag_id";

			$message = $lang['Flag_updated'];
		}
		else
		{
			$sql = "INSERT INTO " . FLAG_TABLE . " (flag_name, flag_image)
				VALUES ('" . str_replace("\'", "''", $flag_name) . "', '" . str_replace("\'", "''", $flag_image) . "')";

			$message = $lang['Flag_added'];
		}
		
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Couldn't update/insert into flags table", "", __LINE__, __FILE__, $sql);
		}

		$message .= "<br /><br />" . sprintf($lang['Click_return_flagadmin'], "<a href=\"" . append_sid("admin_country_flags.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

		message_die(GENERAL_MESSAGE, $message);

	}
	else if( $mode == 'delete' )
	{
		if( isset($_POST['id']) || isset($_GET['id']) )
		{
			$flag_id = ( isset($_POST['id']) ) ? intval($_POST['id']) : intval($_GET['id']);
		}
		else
		{
			$flag_id = 0;
		}
		$hidden_fields = '<input type="hidden" name="id" value="' . $flag_id . '" /><input type="hidden" name="mode" value="do_delete" />';

		//
		// Set template files
		//
		$template->set_filenames(array(
			'body' => 'confirm_body.tpl')
		);

		$template->assign_vars(array(
			'MESSAGE_TITLE' => $lang['Flag_confirm'],
			'MESSAGE_TEXT' => $lang['Confirm_delete_flag'],

			'L_YES' => $lang['Yes'],
			'L_NO' => $lang['No'],

			'S_CONFIRM_ACTION' => append_sid("admin_country_flags.$phpEx"),
			'S_HIDDEN_FIELDS' => $hidden_fields)
		);

	}
	else if( $mode == 'do_delete' )
	{
		//
		// Ok, they want to delete their flag
		//	
		if( isset($_POST['id']) || isset($_GET['id']) )
		{
			$flag_id = ( isset($_POST['id']) ) ? intval($_POST['id']) : intval($_GET['id']);
		}
		else
		{
			$flag_id = 0;
		}
		
		if( $flag_id )
		{
			// get the doomed flag's info
			$sql = "SELECT * FROM " . FLAG_TABLE . " 
				WHERE flag_id = $flag_id" ;
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't get flag data", "", __LINE__, __FILE__, $sql);
			}
			$row = $db->sql_fetchrow($result);
			$flag_image = $row['flag_image'] ;


			// delete the flag
			$sql = "DELETE FROM " . FLAG_TABLE . "
				WHERE flag_id = $flag_id";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't delete flag data", "", __LINE__, __FILE__, $sql);
			}
			
			// update the users who where using this flag			
			$sql = "UPDATE " . USERS_TABLE . " 
				SET user_from_flag = 'blank.gif' 
				WHERE user_from_flag = '$flag_image'";
			if( !$result = $db->sql_query($sql) ) 
			{
				message_die(GENERAL_ERROR, $lang['No_update_flags'], "", __LINE__, __FILE__, $sql);
			}

			$message = $lang['Flag_removed'] . "<br /><br />" . sprintf($lang['Click_return_flagadmin'], "<a href=\"" . append_sid("admin_country_flags.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

			message_die(GENERAL_MESSAGE, $message);

		}
		else
		{
			message_die(GENERAL_MESSAGE, $lang['Must_select_flag']);
		}
	}
	else
	{
		//
		// They didn't feel like giving us any information. Oh, too bad, we'll just display the
		// list then...
		//
		$template->set_filenames(array(
			"body" => "admin/flags_list_body.tpl")
		);

		$sql = "SELECT * FROM " . FLAG_TABLE . "
			ORDER BY flag_id ASC";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Couldn't obtain flags data", "", __LINE__, __FILE__, $sql);
		}

		$flag_rows = $db->sql_fetchrowset($result);
		$flag_count = count($flag_rows);

		$template->assign_vars(array(
			"L_FLAGS_TITLE" => $lang['Flags_title'],
			"L_FLAGS_TEXT" => $lang['Flags_explain'],
			"L_FLAG" => $lang['Flag_name'],

			"L_EDIT" => $lang['Edit'],
			"L_DELETE" => $lang['Delete'],
			"L_ADD_FLAG" => $lang['Add_new_flag'],
			"L_ACTION" => $lang['Action'],

			"S_FLAGS_ACTION" => append_sid("admin_country_flags.$phpEx"))
		);
		
		if (!file_exists('../images/flags/country/'.$flag_rows[$i]['flag_image']))
		{
			$flag_dir = '../images/flags/';
		}
		else
		{
			$flag_dir = '../images/flags/country/';
		}
		
		for( $i = 0; $i < $flag_count; $i++)
		{
			$flag = $flag_rows[$i]['flag_name'];
			$flag_id = $flag_rows[$i]['flag_id'];
			
			$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
	
			$template->assign_block_vars("flags", array(
				"ROW_COLOR" => "#" . $row_color,
				"ROW_CLASS" => $row_class,
				
				"FLAG" => isset($lang[$flag]) ? $lang[$flag] : $flag,
				//"FLAG" => $flag,
				"IMAGE_DISPLAY" => ( $flag_rows[$i]['flag_image'] != "" ) ? '<img src="' . $flag_dir . $flag_rows[$i]['flag_image'] . '" />' : "",

				"U_FLAG_EDIT" => append_sid("admin_country_flags.$phpEx?mode=edit&amp;id=$flag_id"),
				"U_FLAG_DELETE" => append_sid("admin_country_flags.$phpEx?mode=delete&amp;id=$flag_id"))
			);
		}
	}
}
else
{	
	/**
	 * function decode_lang from mx_traslator phpBB3 Extension
	 *
	 * $user_lang = decode_country_name($lang['USER_LANG'], 'country');
	 *
	 * @param unknown_type $lang
	 * @return unknown
	 */
	function decode_country_name($file_dir, $lang_country = 'country', $langs_countries = false)
	{
		/* known languages */
		switch ($file_dir)
		{
				case 'aa':
					$lang_name = 'afar';
					$country_name = 'AFAR'; //Ethiopia
				break;

				case 'ab':
					$lang_name = 'abkhazian';
					$country_name = 'ABKHAZIA';
				break;

				case 'ad':
					$lang_name = 'Angola';
					$country_name = 'ANGOLA';
				break;

				case 'ae':
					$lang_name = 'avestan';
					$country_name = 'UNITED_ARAB_EMIRATES';
				break;

				case 'af':
					$country_name = 'AFGHANISTAN'; // langs: pashto and dari
					$lang_name = 'AFRIKAANS'; // speakers: 6,855,082 - 13,4%
				break;
				
				case 'ak':
					$lang_name = 'akan';
					$country_name = '';
				break;
				
				case 'ag':
					$lang_name = ' english-creole';
					$country_name = 'ANTIGUA_&AMP;_BARBUDA';
				break;
				
				case 'ai':
					$lang_name = 'Anguilla';
					$country_name = 'ANGUILLA';
				break;
				
				case 'al':
					$lang_name = 'albanian';
					$country_name = 'ALBANIA';
				break;


				case 'am':
					$lang_name = 'amharic';
					//$lang_name = 'armenian';
					$country_name = 'ARMENIA';
				break;

				case 'an':
					$lang_name = 'aragonese'; //
					//$country_name = 'Andorra';
					$country_name = 'NETHERLAND_ANTILLES';
				break;
				
				case 'ao':
					$lang_name = 'angolian';
					$country_name = 'ANGOLA';
				break;
				
				case 'ap':
					$lang_name = 'angika';
					$country_name = 'ANGA'; //India
				break;

				case 'ar':
					$lang_name = 'arabic';
					$country_name = 'ARGENTINA';
				break;

				case 'aq':
					$lang_name = '';
					$country_name = 'ANTARCTICA';
				break;

				case 'as':
					$lang_name = 'assamese';
					$country_name = 'AMERICAN_SAMOA';
				break;

				case 'at':
					$lang_name = 'german';
					$country_name = 'AUSTRIA';
				break;

				case 'av':
					$lang_name = 'avaric';
					$country_name = '';
				break;

				case 'ay':
					$lang_name = 'aymara';
					$country_name = '';
				break;

				case 'aw':
					$lang_name = 'aruba';
					$country_name = 'ARUBA';
				break;

				case 'au':
					$lang_name = 'en-au'; //
					$country_name = 'AUSTRALIA';
				break;

				case 'az':
					$lang_name = 'azerbaijani';
					$country_name = 'AZERBAIJAN';
				break;
				
				case 'ax':
					$lang_name = 'finnish';
					$country_name = 'ÅLAND_ISLANDS';  //The Åland Islands or Åland (Swedish: Åland, IPA: [ˈoːland]; Finnish: Ahvenanmaa) is an archipelago province at the entrance to the Gulf of Bothnia in the Baltic Sea belonging to Finland.
				break;
				
				case 'ba':
					$lang_name = 'bashkir'; //Baskortostán (Rusia)
					$country_name = 'BOSNIA_&AMP;_HERZEGOVINA'; //Bosnian, Croatian, Serbian
				break;

				case 'bb':
					$lang_name = 'Barbados';
					$country_name = 'BARBADOS';
				break;

				case 'bd':
					$lang_name = 'Bangladesh';
					$country_name = 'BANGLADESH';
				break;

				case 'be':
					$lang_name = 'belarusian';
					$country_name = 'BELGIUM';
				break;

				case 'bf':
					$lang_name = 'Burkina Faso';
					$country_name = 'BURKINA_FASO';
				break;
				
				case 'bg':
					$lang_name = 'bulgarian';
					$country_name = 'BULGARIA';
				break;

				case 'bh':
					$lang_name = 'bhojpuri'; // Bihar (India) 
					$country_name = 'BAHRAIN'; // Mamlakat al-Ba?rayn (arabic)
				break;

				case 'bi':
					$lang_name = 'bislama';
					$country_name = 'BURUNDI';
				break;


				case 'bj':
					$lang_name = 'Benin';
					$country_name = 'BENIN';
				break;
				
				case 'bl':
					$lang_name = 'Bonaire';
					$country_name = 'BONAIRE';
				break;
				
				case 'bm':
					$lang_name = 'bambara';
					$country_name = 'Bermuda';
				break;

				case 'bn':
					$country_name = 'Brunei';
					$lang_name = 'bengali';

				break;
				case 'bo':
					$lang_name = 'tibetan';
					$country_name = 'BOLIVIA';
				break;


				case 'br':
					$lang_name = 'breton';
					$country_name = 'BRAZIL'; //pt
				break;


				case 'bs':
					$lang_name = 'bosnian';
					$country_name = 'BAHAMAS';
				break;

				case 'bt':
					$lang_name = 'Bhutan';
					$country_name = 'Bhutan';
				break;

				case 'bw':
					$lang_name = 'Botswana';
					$country_name = 'BOTSWANA';
				break;

				case 'bz':
					$lang_name = 'Belize';
					$country_name = 'BELIZE';
				break;

				case 'by':
					$lang_name = 'belarusian';
					$country_name = 'BELARUS';
				break;


				case 'cm':
					$lang_name = 'Cameroon';
					$country_name = 'CAMEROON';
				break;

				case 'ca':
					$lang_name = 'catalan';
					$country_name = 'CANADA';
				break;
				
				case 'cc':
					$lang_name = ''; //COA A Cocos dialect of Betawi Malay [ente (you) and ane (me)] and AU-English
					$country_name = 'COCOS_ISLANDS'; //CC 	Cocos (Keeling) Islands
				break;
				
				case 'cd':
					$lang_name = 'Congo Democratic Republic';
					$country_name = 'CONGO_DEMOCRATIC_REPUBLIC';
				break;
				//нохчийн мотт
				case 'ce':
					$lang_name = 'Chechen';
					$country_name = 'Chechenya';
				break;

				case 'cf':
					$lang_name = 'Central African Republic';
					$country_name = 'CENTRAL_AFRICAN_REPUBLIC';
				break;

				case 'cg':
					$lang_name = 'Congo';
					$country_name = 'CONGO';
				break;
				
				case 'ch':
					$lang_name = 'Switzerland';
					$country_name = 'SWITZERLAND';
				break;
				
				case 'ci':
					$lang_name = 'Cote D-Ivoire';
					$country_name = 'COTE_D-IVOIRE';
				break;
				
				case 'ck':
					$lang_name = '';
					$country_name = 'COOK_ISLANDS'; //CK 	Cook Islands
				break;
				
				case 'cl':
					$lang_name = 'Chile';
					$country_name = 'CHILE';
				break;
				
				case 'cn':
					$lang_name = 'China';
					$country_name = 'CHINA';
				break;
				
				case 'co':
					$lang_name = 'corsican'; // Corsica
					$country_name = 'COLUMBIA';
				break;
				
				case 'cr':
					$lang_name = 'cree';
					$country_name = 'COSTA_RICA';
				break;

				case 'cs':
					$lang_name = 'czech';
					$country_name = 'CZECH_REPUBLIC';
				break;

				case 'cu':
					$lang_name = 'slavonic';
					$country_name = 'CUBA'; //langs: 
				break;

				case 'cv':
					$country_name = 'Cape Verde';
					$lang_name = 'CHUVASH';
				break;
				
				case 'cx':
					$lang_name = ''; // Malaysian Chinese origin and  European Australians 
					$country_name = 'CHRISTMAS_ISLAND';
				break;
				
				case 'cy':
					$lang_name = 'Cyprus';
					$country_name = 'CYPRUS';
				break;
				
				case 'cz':
					$lang_name = 'czech';
					$country_name = 'CZECH_REPUBLIC';
				break;
				
				case 'cw':
					$lang_name = 'papiamentu';   // Papiamentu (Portuguese-based Creole), Dutch, English
					$country_name = 'CURAÇÃO'; // Ilha da Curação (Island of Healing)
				break;
				
				case 'da':
					$lang_name = 'danish';
					$country_name = 'DENMARK';
				break;

				case 'de':
					$lang_name = 'german';
					$country_name = 'Germany';
				break;
				
				case 'dk':
					$lang_name = 'danish';
					$country_name = 'Denmark';
				break;


				case 'dm':
					$lang_name = 'Dominica';
					$country_name = 'Dominica';
				break;

				case 'do':
					$lang_name = 'Dominican Republic';
					$country_name = 'Dominican Republic';
				break;

				case 'dj':
					$lang_name = 'Djibouti';
					$country_name = 'Djibouti';
				break;

				case 'dv':
					$lang_name = 'divehi';
					$country_name = '';
				break;

				case 'dz':
					$lang_name = 'dzongkha';
					$country_name = 'Algeria';
				break;

				case 'tl':
					$country_name = 'East Timor';
					$lang_name = 'East Timor';
				break;

				case 'ec':
					$country_name = 'Ecuador';
					$lang_name = 'Ecuador';
				break;

				case 'eg':
					$country_name = 'Egypt';
					$lang_name = 'Egypt';
				break;


				case 'eh':
					$lang_name = 'Western Sahara';
					$country_name = 'Western Sahara';
				break;


				case 'ee':
					$lang_name = 'Estonia';
					$country_name = 'Estonia';
				break;

				case 'en_us':
					$lang_name = 'en-us';
					$country_name = 'United States of America';
				break;

				case 'eo':
					$lang_name = 'esperanto';
					$country_name = '';
				break;

				case 'er':
					$lang_name = 'Eritrea';
					$country_name = 'Eritrea';
				break;

				case 'es':
					$lang_name = 'spanish';
					$country_name = 'Spain';
				break;

				case 'et':
					$lang_name = 'Amharic'; //Amharic - federal
					$country_name = 'ETHIOPIA';
				break;

				case 'eu':
					$lang_name = 'basque';
					$country_name = '';
				break;

				case 'fa':
					$lang_name = 'persian';
					$country_name = '';
				break;

				case 'ff':
					$lang_name = 'fulah';
					$country_name = '';
				break;

				case 'fi':
					$lang_name = 'finnish';
					$country_name = 'FINLAND';
				break;

				case 'fj':
					$lang_name = 'fijian';
					$country_name = 'FIJI';
				break;

				case 'fk':
					$lang_name = 'falklandian';
					$country_name = 'FALKLAND_ISLANDS';
				break;

				case 'fm':
					$lang_name = 'Micronesia';
					$country_name = 'MICRONESIA';
				break;

				case 'fo':
					$lang_name = 'faroese';
					$country_name = 'FAROE_ISLANDS';
				break;

				case 'fr':
					$lang_name = 'french';
					$country_name = 'FRANCE';
				break;

				case 'fy':
					$lang_name = 'frisian';
					$country_name = '';
				break;

				case 'ga':
					$lang_name = 'irish';
					$country_name = 'GABON';
				break;

				case 'gb':
					$lang_name = 'Great Britain';
					$country_name = 'GREAT_BRITAIN';
				break;
				
				case 'gd':
					$lang_name = 'scottish';
					$country_name = 'GRENADA';
				break;
				
				case 'ge':
					$lang_name = 'Georgia';
					$country_name = 'GEORGIA';
				break;
				
				case 'gi':
					$lang_name = 'Llanito'; //Llanito or Yanito
					$country_name = 'GIBRALTAR';
				break;
				
				case 'gg':
					$lang_name = 'guernesiais'; //English, Guernésiais, Sercquiais, Auregnais
					$country_name = 'GUERNSEY';
				break;
				
				case 'gh':
					$lang_name = 'Ghana';
					$country_name = 'GHANA';
				break;

				case 'gr':
					$lang_name = 'Greece';
					$country_name = 'GREECE';
				break;

				case 'gl':
					$lang_name = 'galician';
					$country_name = 'GREENLAND';
				break;
				
				case 'gm':
					$lang_name = 'Gambia';
					$country_name = 'GAMBIA';
				break;
				
				case 'gn':
					$lang_name = 'Guinea';
					$country_name = 'GUINEA';
				break;
				
				case 'gs':
					$lang_name = 'english';
					$country_name = 'SOUTH_GEORGIA_AND_THE_SOUTH_SANDWICH_ISLANDS';
				break;
				
				case 'gt':
					$lang_name = 'Guatemala';
					$country_name = 'GUATEMALA';
				break;
				
				case 'gq':
					$lang_name = 'Equatorial Guinea';
					$country_name = 'EQUATORIAL_GUINEA';
				break;

				case 'gu':
					$lang_name = 'gujarati';
					$country_name = 'GUAM';
				break;

				case 'gv':
					$lang_name = 'manx';
					$country_name = '';
				break;
				
				case 'gw':
					$lang_name = 'Guinea Bissau';
					$country_name = 'GUINEA_BISSAU';
				break;

				case 'gy':
					$lang_name = 'Guyana';
					$country_name = 'GUYANA';
				break;

				case 'ha':
					$country_name = '';
					$lang_name = 'hausa';
				break;


				case 'he':
					$country_name = 'ISRAEL';
					$lang_name = 'hebrew';
				break;

				case 'hi':
					$lang_name = 'hindi';
					$country_name = '';
				break;
				
				case 'ho':
					$lang_name = 'hiri_motu';
					$country_name = '';
				break;
				
				case 'hk':
					$lang_name = 'Hong Kong';
					$country_name = 'HONG_KONG';
				break;
				
				case 'hn':
					$country_name = 'Honduras';
					$lang_name = 'HONDURAS';
				break;
				
				case 'hr':
					$lang_name = 'croatian';
					$country_name = 'CROATIA';
				break;
				
				case 'ht':
					$lang_name = 'haitian';
					$country_name = 'HAITI';
				break;
				
				case 'ho':
					$lang_name = 'hiri_motu';
					$country_name = '';
				break;
				
				case 'hu':
					$lang_name = 'hungarian';
					$country_name = 'HUNGARY';
				break;
				
				case 'hy':
					$lang_name = 'armenian';
					$country_name = '';
				break;
				
				case 'hz':
					$lang_name = 'herero';
					$country_name = '';
				break;
				
				case 'ia':
					$lang_name = 'interlingua';
					$country_name = '';
				break;
				
				case 'ic':
					$lang_name = '';
					$country_name = 'CANARY_ISLANDS';
				break;
				
				case 'id':
					$lang_name = 'indonesian';
					$country_name = 'INDONESIA';
				break;
				
				case 'ie':
					$lang_name = 'interlingue';
					$country_name = 'IRELAND';
				break;
				
				case 'ig':
					$lang_name = 'igbo';
					$country_name = '';
				break;
				
				case 'ii':
					$lang_name = 'sichuan_yi';
					$country_name = '';
				break;
				
				case 'ik':
					$lang_name = 'inupiaq';
					$country_name = '';
				break;
				
				case 'il':
					$lang_name = 'ibrit';
					$country_name = 'ISRAEL';
				break;
				
				case 'im':
					$lang_name = 'Isle of Man';
					$country_name = 'ISLE_OF_MAN';
				break;
				
				case 'in':
					$lang_name = 'India';
					$country_name = 'INDIA';
				break;
				
				
				case 'ir':
					$lang_name = 'Iran';
					$country_name = 'IRAN';
				break;
				
				case 'is':
					$lang_name = 'Iceland';
					$country_name = 'ICELAND';
				break;
				
				case 'it':
					$lang_name = 'italian';
					$country_name = 'ITALY';
				break;
				
				case 'iq':
					$lang_name = 'Iraq';
					$country_name = 'IRAQ';
				break;
				
				case 'je':
					$lang_name = 'jerriais'; //Jèrriais
					$country_name = 'JERSEY'; //Bailiwick of Jersey
				break;
				
				case 'jm':
					$lang_name = 'Jamaica';
					$country_name = 'JAMAICA';
				break;
				
				case 'jo':
					$lang_name = 'Jordan';
					$country_name = 'JORDAN';
				break;
				
				case 'jp':
					$lang_name = 'japanese';
					$country_name = 'JAPAN';
				break;
				case 'jv':
					$lang_name = 'javanese';
					$country_name = '';
				break;
				
				case 'kh':
					$lang_name = 'Cambodia';
					$country_name = 'CAMBODIA';
				break;
				
				case 'ke':
					$lang_name = 'Kenya';
					$country_name = 'KENYA';
				break;
				
				case 'ki':
					$lang_name = 'Kiribati';
					$country_name = 'KIRIBATI';
				break;
				
				case 'km':
					$lang_name = 'Comoros';
					$country_name = 'COMOROS';
				break;
				
				case 'kn':
					$lang_name = 'kannada';
					$country_name = 'ST_KITTS-NEVIS';
				break;
				
				case 'ko':
				case 'kp':
					$lang_name = 'korean';
					// kor – Modern Korean
					// jje – Jeju
					// okm – Middle Korean
					// oko – Old Korean
					// oko – Proto Korean
					// okm Middle Korean
					 // oko Old Korean
					$country_name = 'Korea North';
				break;
				
				case 'kr':
					$lang_name = 'korean';
					$country_name = 'KOREA_SOUTH';
				break;
				
				case 'kn':
					$lang_name = 'St Kitts-Nevis';
					$country_name = 'ST_KITTS-NEVIS';
				break;
				
				case 'ks':
					$lang_name = 'kashmiri'; //Kashmir
					$country_name = 'KOREA_SOUTH';
				break;
				
				case 'ky':
					$lang_name = 'Cayman Islands';
					$country_name = 'CAYMAN_ISLANDS';
				break;

				case 'kz':
					$lang_name = 'Kazakhstan';
					$country_name = 'KAZAKHSTAN';
				break;

				case 'kw':
					$lang_name = 'Kuwait';
					$country_name = 'KUWAIT';
				break;

				case 'kg':
					$lang_name = 'Kyrgyzstan';
					$country_name = 'KYRGYZSTAN';
				break;

				case 'la':
					$lang_name = 'Laos';
					$country_name = 'LAOS';
				break;

				case 'lk':
					$lang_name = 'Sri Lanka';
					$country_name = 'SRI_LANKA';
				break;

				case 'lv':
					$lang_name = 'Latvia';
					$country_name = 'LATVIA';
				break;

				case 'lb':
					$lang_name = 'Lebanon';
					$country_name = 'LEBANON';
				break;
				
				case 'lc':
					$lang_name = 'St Lucia';
					$country_name = 'ST_LUCIA';
				break;
				
				case 'ls':
					$lang_name = 'Lesotho';
					$country_name = 'LESOTHO';
				break;

				case 'lr':
					$lang_name = 'Liberia';
					$country_name = 'LIBERIA';
				break;

				case 'ly':
					$lang_name = 'Libya';
					$country_name = 'Libya';
				break;

				case 'li':
					$lang_name = 'Liechtenstein';
					$country_name = 'LIECHTENSTEIN';
				break;

				case 'lt':
					$country_name = 'Lithuania';
					$lang_name = 'LITHUANIA';
				break;

				case 'lu':
					$lang_name = 'Luxembourg';
					$country_name = 'LUXEMBOURG';
				break;

				case 'mo':
					$lang_name = 'Macau';
					$country_name = 'MACAU';
				break;
				
				case 'me':
					$lang_name = 'montenegrin'; //Serbo-Croatian, Cyrillic, Latin
					$country_name = 'MONTENEGRO'; //Црна Гора
				break;
				
				case 'mf':
					$lang_name = 'french'; //
					$country_name = 'SAINT_MARTIN_(FRENCH_PART)'; 
				break;
				
				case 'mk':
					$lang_name = 'Macedonia';
					$country_name = 'MACEDONIA';
				break;
				
				case 'mg':
					$lang_name = 'Madagascar';
					$country_name = 'MADAGASCAR';
				break;

				case 'mw':
					$country_name = 'Malawi';
					$lang_name = 'MALAWI';
				break;

				case 'my':
					$lang_name = ' Myanmar';
					$country_name = 'MALAYSIA';
				break;

				case 'mv':
					$lang_name = 'Maldives';
					$country_name = 'MALDIVES';
				break;

				case 'ml':
					$lang_name = 'Mali';
					$country_name = 'MALI';
				break;

				case 'mt':
					$lang_name = 'Malta';
					$country_name = 'MALTA';
				break;

				case 'mh':
					$lang_name = 'Marshall Islands';
					$country_name = 'MARSHALL_ISLANDS';
				break;

				case 'mr':
					$lang_name = 'Mauritania';
					$country_name = 'Mauritania';
				break;

				case 'mu':
					$lang_name = 'Mauritius';
					$country_name = 'MAURITIUS';
				break;

				case 'mx':
					$lang_name = 'Mexico';
					$country_name = 'MEXICO';
				break;

				case 'md':
					$country_name = 'MOLDOVA';
					$lang_name = 'romanian';
				break;

				case 'mc':
					$country_name = 'MONACO';
					$lang_name = 'Monaco';
				break;

				case 'mn':
					$lang_name = 'Mongolia';
					$country_name = 'MONGOLIA';
				break;

				case 'ms':
					$lang_name = 'Montserrat';
					$country_name = 'MONTSERRAT';
				break;

				case 'ma':
					$lang_name = 'Morocco';
					$country_name = 'MOROCCO';
				break;
				
				case 'mz':
					$lang_name = 'Mozambique';
					$country_name = 'MOZAMBIQUE';
				break;
				
				case 'mm':
					$lang_name = 'Myanmar';
					$country_name = 'MYANMAR';
				break;
				
				case 'mp':
					$lang_name = 'chamorro'; //Carolinian
					$country_name = 'NORTHERN_MARIANA_ISLANDS';
				break;
				
				case 'mq':
					$lang_name = 'antillean-creole'; // Antillean Creole (Créole Martiniquais)
					$country_name = 'MARTINIQUE';
				break;
				
				case 'na':
					$lang_name = 'Nambia';
					$country_name = 'NAMBIA';
				break;
				
				case 'ni':
					$lang_name = 'Nicaragua';
					$country_name = 'NICARAGUA';
				break;
				
				case 'ne':
					$lang_name = 'Niger';
					$country_name = 'NIGER';
				break;
				
				case 'nc':
					$lang_name = 'paicî'; //French, Nengone, Paicî, Ajië, Drehu
					$country_name = 'NEW_CALEDONIA';
				break;
				
				case 'nk':
					$lang_name = 'Korea North';
					$country_name = 'KOREA_NORTH';
				break;
				
				case 'ng':
					$lang_name = 'Nigeria';
					$country_name = 'NIGERIA';
				break;
				
				case 'nf':
					$lang_name = 'Norfolk Island';
					$country_name = 'NORFOLK_ISLAND';
				break;
				
				case 'nl':
					$lang_name = 'Netherlands';
					$country_name = 'NETHERLANDS';
				break;
				
				case 'no':
					$lang_name = 'Norway';
					$country_name = 'NORWAY';
				break;
				
				case 'np':
					$lang_name = 'Nepal';
					$country_name = 'NEPAL';
				break;
				
				case 'nr':
					$lang_name = 'Nauru';
					$country_name = 'NAURU';
				break;
				
				case 'nu':
					$lang_name = 'niuean'; //Niuean (official) 46% (a Polynesian language closely related to Tongan and Samoan)
					$country_name = 'NIUE'; // Niuean: Niuē
				break;
				
				case 'nz':
					$lang_name = 'New Zealand';
					$country_name = 'NEW_ZEALAND';
				break;
				
				case 'ny':
					$lang_name = 'Chewa';
					$country_name = 'Nyanja';
				break;
				
				case 'oc':
					$lang_name = 'occitan';
					$country_name = '';
				break;

				case 'oj':
					$lang_name = 'ojibwa';
					$country_name = '';
				break;

				case 'om':
					$lang_name = 'Oman';
					$country_name = 'OMAN';
				break;

				case 'or':
					$lang_name = 'oriya';
					$country_name = '';
				break;

				case 'os':
					$lang_name = 'ossetian';
					$country_name = '';
				break;

				case 'pa':
					$country_name = 'Panama';
					$lang_name = 'PANAMA';
				break;


				case 'pe':
					$country_name = 'Peru';
					$lang_name = 'PERU';
				break;

				case 'ph':
					$lang_name = 'Philippines';
					$country_name = 'PHILIPPINES';
				break;
				
				case 'pf':
					$country_name = 'FRENCH_POLYNESIA';
					$lang_name = 'tahitian'; //Polynésie française
				break;
				
				case 'pg':
					$country_name = 'PAPUA_NEW_GUINEA';
					$lang_name = 'Papua New Guinea';
				break;
				
				case 'pi':
					$lang_name = 'pali';
					$country_name = '';
				break;
				
				case 'pl':
					$lang_name = 'Poland';
					$country_name = 'POLAND';
				break;
				
				case 'pn':
					$lang_name = 'Pitcairn Island';
					$country_name = 'PITCAIRN_ISLAND';
				break;
				
				case 'pr':
					$lang_name = 'Puerto Rico';
					$country_name = 'PUERTO_RICO';
				break;
				
				case 'pt':
					$lang_name = 'Portugal';
					$country_name = 'PORTUGAL';
				break;
				
				case 'pk':
					$lang_name = 'Pakistan';
					$country_name = 'PAKISTAN';
				break;
				
				case 'pw':
					$country_name = 'Palau Island';
					$lang_name = 'PALAU_ISLAND';
				break;
				
				case 'ps':
					$country_name = 'Palestine';
					$lang_name = 'PALESTINE';
				break;
				
				case 'py':
					$country_name = 'Paraguay';
					$lang_name = 'PARAGUAY';
				break;
				
				case 'qa':
					$lang_name = 'Qatar';
					$country_name = 'QATAR';
				break;
				case 'ri':
					$country_name = 'EASTEN_EUROPE';
					$lang_name = 'romani';
				break;
				case 'ro':
					$country_name = 'ROMANIA';
					$lang_name = 'romanian';
				break;
				
				case 'rn':
					$lang_name = 'kirundi';
					$country_name = '';
				break;
				
				case 'rm':
					$country_name = '';
					$lang_name = 'romansh'; //Switzerland
				break;
				
				case 'rs':
					$country_name = 'REPUBLIC_OF_SERBIA'; //Република Србија //Republika Srbija
					$lang_name = 'serbian'; //Serbia, Србија / Srbija
				break;
				
				case 'ru':
					$country_name = 'RUSSIA';
					$lang_name = 'Russia';
				break;
				
				case 'rw':
					$country_name = 'RWANDA';
					$lang_name = 'Rwanda';
				break;

				
				case 'sa':
					$lang_name = 'arabic';
					$country_name = 'SAUDI_ARABIA';
				break;
				
				case 'sb':
					$lang_name = 'Solomon Islands';
					$country_name = 'SOLOMON_ISLANDS';
				break;
				
				case 'sc':
					$lang_name = 'seychellois-creole';
					$country_name = 'SEYCHELLES';
				break;
				
				case 'sd':
					$lang_name = 'Sudan';
					$country_name = 'SUDAN';
				break;
				
				case 'si':
					$lang_name = 'slovenian';
					$country_name = 'SLOVENIA';
				break;
				
				case 'sh':
					$lang_name = 'St Helena';
					$country_name = 'ST_HELENA';
				break;
				
				case 'sk':
					$country_name = 'SLOVAKIA';
					$lang_name = 'Slovakia';
				break;
				
				case 'sg':
					$country_name = 'SINGAPORE';
					$lang_name = 'Singapore';
				break;
				
				case 'sl':
					$country_name = 'SIERRA_LEONE';
					$lang_name = 'Sierra Leone';
				break;
				
				case 'sm':
					$lang_name = 'San Marino';
					$country_name = 'SAN_MARINO';
				break;
				
				case 'sn':
					$lang_name = 'Senegal';
					$country_name = 'SENEGAL';
				break;
				
				case 'so':
					$lang_name = 'Somalia';
					$country_name = 'SOMALIA';
				break;
				
				case 'sr':
					$lang_name = 'Suriname';
					$country_name = 'SURINAME';
				break;
				
				case 'ss':
					$lang_name = ''; //Bari [Karo or Kutuk ('mother tongue', Beri)], Dinka, Luo, Murle, Nuer, Zande
					$country_name = 'REPUBLIC_OF_SOUTH_SUDAN';
				break;
				
				case 'st':
					$lang_name = 'Sao Tome &amp; Principe';
					$country_name = 'SAO_TOME_&AMP;_PRINCIPE';
				break;
				
				case 'sv':
					$lang_name = 'El Salvador';
					$country_name = 'EL_SALVADOR';
				break;
				
				case 'sx':
					$lang_name = 'dutch';
					$country_name = 'SINT_MAARTEN_(DUTCH_PART)';
				break;
				
				case 'sz':
					$lang_name = 'Swaziland';
					$country_name = 'SWAZILAND';
				break;
				
				case 'se':
					$lang_name = 'Sweden';
					$country_name = 'SWEDEN';
				break;

				case 'sy':
					$lang_name = 'arabic syrian';
					$country_name = 'SYRIA';
				break;
				
				case 'tc':
					$lang_name = 'Turks &amp; Caicos Is';
					$country_name = 'TURKS_&AMP;_CAICOS_IS';
				break;
				
				case 'td':
					$lang_name = 'Chad';
					$country_name = 'CHAD';
				break;
				
				case 'tf':
					$lang_name = 'french '; //
					$country_name = 'FRENCH_SOUTHERN_TERRITORIES'; //Terres australes françaises
				break;
				
				case 'tj':
					$lang_name = 'Tajikistan';
					$country_name = 'TAJIKISTAN';
				break;
				
				case 'tg':
					$lang_name = 'Togo';
					$country_name = 'TOGO';
				break;
				
				case 'th':
					$country_name = 'Thailand';
					$lang_name = 'THAILAND';
				break;
				
				case 'tk':
					//260 speakers of Tokelauan, of whom 2,100 live in New Zealand, 
					//1,400 in Tokelau, 
					//and 17 in Swains Island
					$lang_name = 'Tokelauan'; // /toʊkəˈlaʊən/ Tokelauans or Polynesians
					$country_name = 'TOKELAUAU'; //Dependent territory of New Zealand
				break;
					
				case 'to':
					$country_name = 'Tonga';
					$lang_name = 'TONGA';
				break;
				
				case 'tt':
					$country_name = 'Trinidad &amp; Tobago';
					$lang_name = 'TRINIDAD_&AMP;_TOBAGO';
				break;
				
				case 'tn':
					$lang_name = 'Tunisia';
					$country_name = 'TUNISIA';
				break;
				
				case 'tm':
					$lang_name = 'Turkmenistan';
					$country_name = 'TURKMENISTAN';
				break;
				
				case 'tr':
					$lang_name = 'Turkey';
					$country_name = 'TURKEY';
				break;
				
				case 'tv':
					$lang_name = 'Tuvalu';
					$country_name = 'TUVALU';
				break;
				
				case 'tw':
					$lang_name = 'Taiwan';
					$country_name = 'TAIWAN';
				break;
				
				case 'tz':
					$country_name = 'TANZANIA';
					$lang_name = 'Tanzania';
				break;

				case 'ug':
					$lang_name = 'Uganda';
					$country_name = 'UGANDA';
				break;

				case 'ua':
					$lang_name = 'Ukraine';
					$country_name = 'UKRAINE';
				break;

				case 'us':
					$lang_name = 'en-us';
					$country_name = 'UNITED_STATES_OF_AMERICA';
				break;
				
				case 'uz':
					$lang_name = 'uzbek'; //Uyghur Perso-Arabic alphabet
					$country_name = 'UZBEKISTAN';
				break;
				
				case 'uy':
					$lang_name = 'Uruguay';
					$country_name = 'URUGUAY';
				break;
				
				case 'va':
					$country_name = 'VATICAN_CITY'; //
					$lang_name = 'latin';
				break;
				
				case 'vc':
					$country_name = 'ST_VINCENT_&AMP;_GRENADINES'; //
					$lang_name = 'vincentian-creole';
				break;
				
				case 've':
					$lang_name = 'Venezuela';
					$country_name = 'VENEZUELA';
				break;
				
				case 'vi':
					$lang_name = 'Virgin Islands (USA)';
					$country_name = 'VIRGIN_ISLANDS_(USA)';
				break;
				
				case 'vn':
					$lang_name = 'Vietnam';
					$country_name = 'VIETNAM';
				break;

				case 'vg':
					$lang_name = 'Virgin Islands (Brit)';
					$country_name = 'VIRGIN_ISLANDS_(BRIT)';
				break;
				
				case 'vu':
					$lang_name = 'Vanuatu';
					$country_name = 'VANUATU';
				break;
				
				case 'wls':
					$lang_name = 'Wales';
					$country_name = 'WALES';
				break;
				
				case 'wf':
					$country_name = 'TERRITORY_OF_THE_WALLIS_AND_FUTUNA_ISLANDS';
					$lang_name = 'Wallisian'; 
					//Wallisian, or ʻUvean 
					//Futunan - Austronesian, Malayo-Polynesian
				break;
				
				case 'ws':
					$country_name = 'SAMOA';
					$lang_name = 'Samoa';
				break;
				
				case 'ye':
					$lang_name = 'Yemen';
					$country_name = 'YEMEN';
				break;
				
				case 'yt':
					$lang_name = 'Mayotte'; //Shimaore:
					$country_name = 'DEPARTMENT_OF_MAYOTTE'; //Département de Mayotte
				break;
				
				case 'za':
					$lang_name = 'zhuang';
					$country_name = 'SOUTH_AFRICA';
				break;
				case 'zm':
					$lang_name = 'zambian';
					$country_name = 'ZAMBIA';
				break;
				case 'zw':
					$lang_name = 'Zimbabwe';
					$country_name = 'ZIMBABWE';
				break;
				case 'zu':
					$lang_name = 'zulu';
					$country_name = 'ZULU';
				break;
				default:
					$lang_name = $file_dir;
					$country_name = $file_dir;
				break;
		}
		$return = ($lang_country == 'country') ? $country_name : $lang_name;
		$return = ($langs_countries == true) ? $lang_name[$country_name] : $return;
		return $return ;
	}
	
	/**
	 * Returns flag files list from an specific directory path
	 */
	 
	if (!class_exists('phpbb_db_tools') && !class_exists('tools'))
	{
		global $phpbb_root_path, $phpEx;
		require($phpbb_root_path . 'includes/db/tools.' . $phpEx);
	}

	if (class_exists('phpbb_db_tools'))
	{
		$db_tools = new phpbb_db_tools($db);
	}
	elseif (class_exists('tools'))
	{
		$db_tools = new tools($db);
	}
	
	$template->assign_vars(array(
		"L_FLAGS_TITLE" => $lang['Flags_title'],
		"L_FLAGS_TEXT" => $lang['Flags_explain'],
		"L_FLAG" => $lang['Flag_name'],
		"L_FLAG_PIC" => $lang['Flag_pic'],
		"L_EDIT" => $lang['Edit'],
		"L_DELETE" => $lang['Delete'],
		"L_ADD_FLAG" => $lang['Add_new_flag'],
		"L_ACTION" => $lang['Action'],
		
		"S_FLAGS_ACTION" => append_sid("admin_country_flags.$phpEx"))
	);	 

	//
	// Show the default page
	//
	$template->set_filenames(array(
		"body" => "admin/flags_list_body.tpl")
	);

	// get all countries installed
	$countries = array();
	$flag_rows = array();
	$flag_count = 0;
	//if (!is_object($db_tools) || (is_object($db_tools) && $db_tools->sql_table_exists($table_prefix . 'flags')))
	if (!is_object($db_tools) || (is_object($db_tools) && $db_tools->sql_table_exists(FLAG_TABLE)))
	{
		$sql = "SELECT * FROM " . FLAG_TABLE . "
			ORDER BY flag_id ASC";
		//$sql = "SELECT * FROM " . FLAG_TABLE;
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Couldn't obtain flags data", "", __LINE__, __FILE__, $sql);
		}

		$flag_count = $db->sql_numrows($result);
		$flag_rows = $db->sql_fetchrowset($result);
	}

	if (!is_object($db_tools) || (is_object($db_tools) && $db_tools->sql_table_exists(FLAG_TABLE) && $flag_count > 1))
	{
		for ($i = 0; $i < $flag_count; $i++)
		{
			$flag = $flag_rows[$i]['flag_name'];
			$flag_id = $flag_rows[$i]['flag_id'];

			$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

			$template->assign_block_vars("flags", array(
				"ROW_COLOR" => "#" . $row_color,
				"ROW_CLASS" => $row_class,

				//We need multilanguage traslation for each flag
				"FLAG" => isset($lang[$flag]) ? $lang[$flag] : $flag,
				//"FLAG" => $flag,

				"IMAGE_DISPLAY" => '<img src="../images/flags/' . $flag_rows[$i]['flag_image'] . '" />',

				"U_FLAG_EDIT" => append_sid("admin_country_flags.$phpEx?mode=edit&amp;id=$flag_id"),
				"U_FLAG_DELETE" => append_sid("admin_country_flags.$phpEx?mode=delete&amp;id=$flag_id"))
			);
		}
	}
	else
	{ 
		$flag_id = 1;
		$sql_ary[] = array();

		//$flag_count = (bool) count(glob($phpbb_root_path . '/images/flags', GLOB_BRACE));
		if (!is_dir('../images/flags/country'))
		{
			$dir = @opendir($phpbb_root_path . '/images/flags');
		}
		else
		{
			$dir = @opendir($phpbb_root_path . '/images/flags/country/');
		}

		while ($flag = @readdir($dir))
		{
			if (preg_match('#^png#i', substr(strrchr($flag, '.'), 1)) && !is_file($phpbb_root_path . '/images/flags' . $flag) && !is_link($phpbb_root_path . '/images/flags' . $flag))
			{
				$flag_id++;
				$filename = basename($flag);
				$displayname = substr($filename, 0, strrpos($filename, '.'));
				//$displayname = trim(str_replace(substr(strrchr($flag_file, '.'), 1), '', $flag_file));

				$displayname = preg_replace("/^(.*?)_(.*)$/", "\\1 [ \\2 ]", $displayname);
				$flag_name = preg_replace("/\[(.*?)_(.*)\]/", "[ \\1 - \\2 ]", $displayname);

				$country_name = ucfirst(decode_country_name(strtolower($flag_name)));	

				/* This code is commented and left as reference how a language list displays on other boards * /
				if (isset($lang['USER_LANG']))
				{
					if(!empty($lang['USER_LANG']) && is_file($phpbb_root_path . 'images/flags/'.$lang['USER_LANG'].'.png'))
					{
						$lang_name = decode_country_name($lang['USER_LANG'], 'language');
						//here You can set an icon with img src=
					}
				}
				/**/

				$flags[$flag_id] = $flag;
				$countries[$flag] = $country_name;
			}
		}
		@closedir($dir);

		$flag_id = 1;
		$flag_count = (bool) count($countries);

		foreach($countries as $flag => $country_name)
		{
			$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

			$filename = basename($flag);
			$displayname = substr($filename, 0, strrpos($filename, '.'));

			//$lang_name = decode_country_name($displayname, 'language');
			$country_name = decode_country_name($displayname, 'country');

			if (!is_dir('../images/flags/'))
			{
				// create the directory flags
				$result = mkdir('../images/flags/');
				chmod('../images/flags/', 777);
				chdir('../images/flags/');
			}

			if (!is_dir('../images/flags/country/'))
			{
				// create the directory country
				$result = mkdir('../images/flags/country/');
				chmod('../images/flags/country/', 777);
				chdir('../images/flags/country/');

				$flag_dir = '../images/flags/';
			}
			else
			{
				// 
				$flag_dir = '../images/flags/country/';
			}

			/** /
			$sql_ary = array(
				array(
					'flag_name'		=> 'Afghanistan',
					'flag_image'	=> 'AF.png',
				),
				array(
					'flag_name'		=> 'Albania',
					'flag_image'	=> 'AL.png',
				),
				array(
					'flag_name'		=> 'Algeria',
					'flag_image'	=> 'DZ.png',
				),
				array(
					'flag_name'		=> 'American Samoa',
					'flag_image'	=> 'AS.png',
				),
				array(
					'flag_name'		=> 'Andorra',
					'flag_image'	=> 'AD.png',
				),
				array(
					'flag_name'		=> 'Angola',
					'flag_image'	=> 'AO.png',
				),
				array(
					'flag_name'		=> 'Anguilla',
					'flag_image'	=> 'AI.png',
				),
				array(
					'flag_name'		=> 'Antigua &amp; Barbuda',
					'flag_image'	=> 'AG.png',
				),
				array(
					'flag_name'		=> 'Argentina',
					'flag_image'	=> 'AR.png',
				),
				array(
					'flag_name'		=> 'Armenia',
					'flag_image'	=> 'AM.png',
				),
				array(
					'flag_name'		=> 'Aruba',
					'flag_image'	=> 'AW.png',
				),
				array(
					'flag_name'		=> 'Australia',
					'flag_image'	=> 'AU.png',
				),
				array(
					'flag_name'		=> 'Austria',
					'flag_image'	=> 'AT.png',
				),
				array(
					'flag_name'		=> 'Azerbaijan',
					'flag_image'	=> 'AZ.png',
				),
				array(
					'flag_name'		=> 'Bahamas',
					'flag_image'	=> 'BS.png',
				),
				array(
					'flag_name'		=> 'Bahrain',
					'flag_image'	=> 'BH.png',
				),
				array(
					'flag_name'		=> 'Bangladesh',
					'flag_image'	=> 'BD.png',
				),
				array(
					'flag_name'		=> 'Barbados',
					'flag_image'	=> 'BB.png',
				),
				array(
					'flag_name'		=> 'Belarus',
					'flag_image'	=> 'BY.png',
				),
				array(
					'flag_name'		=> 'Belgium',
					'flag_image'	=> 'BE.png',
				),
				array(
					'flag_name'		=> 'Belize',
					'flag_image'	=> 'BZ.png',
				),
				array(
					'flag_name'		=> 'Benin',
					'flag_image'	=> 'BJ.png',
				),
				array(
					'flag_name'		=> 'Bermuda',
					'flag_image'	=> 'BM.png',
				),
				array(
					'flag_name'		=> 'Bhutan',
					'flag_image'	=> 'BT.png',
				),
				array(
					'flag_name'		=> 'Bolivia',
					'flag_image'	=> 'BO.png',
				),
				array(
					'flag_name'		=> 'Bonaire',
					'flag_image'	=> 'BL.png',
				),
				array(
					'flag_name'		=> 'Bosnia &amp; Herzegovina',
					'flag_image'	=> 'BA.png',
				),
				array(
					'flag_name'		=> 'Botswana',
					'flag_image'	=> 'BW.png',
				),
				array(
					'flag_name'		=> 'Brazil',
					'flag_image'	=> 'BR.png',
				),
				array(
					'flag_name'		=> 'Brunei',
					'flag_image'	=> 'BN.png',
				),
				array(
					'flag_name'		=> 'Bulgaria',
					'flag_image'	=> 'BG.png',
				),
				array(
					'flag_name'		=> 'Burkina Faso',
					'flag_image'	=> 'BF.png',
				),
				array(
					'flag_name'		=> 'Burundi',
					'flag_image'	=> 'BI.png',
				),
				array(
					'flag_name'		=> 'Cambodia',
					'flag_image'	=> 'KH.png',
				),
				array(
					'flag_name'		=> 'Cameroon',
					'flag_image'	=> 'CM.png',
				),
				array(
					'flag_name'		=> 'Canada',
					'flag_image'	=> 'CA.png',
				),
				array(
					'flag_name'		=> 'Cape Verde',
					'flag_image'	=> 'CV.png',
				),
				array(
					'flag_name'		=> 'Cayman Islands',
					'flag_image'	=> 'KY.png',
				),
				array(
					'flag_name'		=> 'Central African Republic',
					'flag_image'	=> 'CF.png',
				),
				array(
					'flag_name'		=> 'Chad',
					'flag_image'	=> 'TD.png',
				),
				array(
					'flag_name'		=> 'Chile',
					'flag_image'	=> 'CL.png',
				),
				array(
					'flag_name'		=> 'China',
					'flag_image'	=> 'CN.png',
				),
				array(
					'flag_name'		=> 'Columbia',
					'flag_image'	=> 'CO.png',
				),
				array(
					'flag_name'		=> 'Comoros',
					'flag_image'	=> 'KM.png',
				),
				array(
					'flag_name'		=> 'Congo',
					'flag_image'	=> 'CG.png',
				),
				array(
					'flag_name'		=> 'Congo Democratic Republic',
					'flag_image'	=> 'CD.png',
				),
				array(
					'flag_name'		=> 'Costa Rica',
					'flag_image'	=> 'CR.png',
				),
				array(
					'flag_name'		=> 'Cote D-Ivoire',
					'flag_image'	=> 'CI.png',
				),
				array(
					'flag_name'		=> 'Croatia',
					'flag_image'	=> 'HR.png',
				),
				array(
					'flag_name'		=> 'Cuba',
					'flag_image'	=> 'CU.png',
				),
				array(
					'flag_name'		=> 'Cyprus',
					'flag_image'	=> 'CY.png',
				),
				array(
					'flag_name'		=> 'Czech Republic',
					'flag_image'	=> 'CZ.png',
				),
				array(
					'flag_name'		=> 'Denmark',
					'flag_image'	=> 'DK.png',
				),
				array(
					'flag_name'		=> 'Djibouti',
					'flag_image'	=> 'DJ.png',
				),
				array(
					'flag_name'		=> 'Dominica',
					'flag_image'	=> 'DM.png',
				),
				array(
					'flag_name'		=> 'Dominican Republic',
					'flag_image'	=> 'DO.png',
				),
				array(
					'flag_name'		=> 'East Timor',
					'flag_image'	=> 'TL.png',
				),
				array(
					'flag_name'		=> 'Ecuador',
					'flag_image'	=> 'EC.png',
				),
				array(
					'flag_name'		=> 'Egypt',
					'flag_image'	=> 'EG.png',
				),
				array(
					'flag_name'		=> 'El Salvador',
					'flag_image'	=> 'SV.png',
				),
				array(
					'flag_name'		=> 'Equatorial Guinea',
					'flag_image'	=> 'GQ.png',
				),
				array(
					'flag_name'		=> 'Eritrea',
					'flag_image'	=> 'ER.png',
				),
				array(
					'flag_name'		=> 'Estonia',
					'flag_image'	=> 'EE.png',
				),
				array(
					'flag_name'		=> 'Ethiopia',
					'flag_image'	=> 'ET.png',
				),
				array(
					'flag_name'		=> 'Falkland Islands',
					'flag_image'	=> 'FK.png',
				),
				array(
					'flag_name'		=> 'Faroe Islands',
					'flag_image'	=> 'FO.png',
				),
				array(
					'flag_name'		=> 'Fiji',
					'flag_image'	=> 'FJ.png',
				),
				array(
					'flag_name'		=> 'Finland',
					'flag_image'	=> 'FI.png',
				),
				array(
					'flag_name'		=> 'France',
					'flag_image'	=> 'FR.png',
				),
				array(
					'flag_name'		=> 'Gabon',
					'flag_image'	=> 'GA.png',
				),
				array(
					'flag_name'		=> 'Gambia',
					'flag_image'	=> 'GM.png',
				),
				array(
					'flag_name'		=> 'Georgia',
					'flag_image'	=> 'GE.png',
				),
				array(
					'flag_name'		=> 'Germany',
					'flag_image'	=> 'DE.png',
				),
				array(
					'flag_name'		=> 'Ghana',
					'flag_image'	=> 'GH.png',
				),
				array(
					'flag_name'		=> 'Great Britain',
					'flag_image'	=> 'GB.png',
				),
				array(
					'flag_name'		=> 'Greece',
					'flag_image'	=> 'GR.png',
				),
				array(
					'flag_name'		=> 'Greenland',
					'flag_image'	=> 'GL.png',
				),
				array(
					'flag_name'		=> 'Grenada',
					'flag_image'	=> 'GD.png',
				),
				array(
					'flag_name'		=> 'Guam',
					'flag_image'	=> 'GU.png',
				),
				array(
					'flag_name'		=> 'Guatemala',
					'flag_image'	=> 'GT.png',
				),
				array(
					'flag_name'		=> 'Guinea',
					'flag_image'	=> 'GN.png',
				),
				array(
					'flag_name'		=> 'Guinea Bissau',
					'flag_image'	=> 'GW.png',
				),
				array(
					'flag_name'		=> 'Guyana',
					'flag_image'	=> 'GY.png',
				),
				array(
					'flag_name'		=> 'Haiti',
					'flag_image'	=> 'HT.png',
				),
				array(
					'flag_name'		=> 'Honduras',
					'flag_image'	=> 'HN.png',
				),
				array(
					'flag_name'		=> 'Hong Kong',
					'flag_image'	=> 'HK.png',
				),
				array(
					'flag_name'		=> 'Hungary',
					'flag_image'	=> 'HU.png',
				),
				array(
					'flag_name'		=> 'Iceland',
					'flag_image'	=> 'IS.png',
				),
				array(
					'flag_name'		=> 'India',
					'flag_image'	=> 'IN.png',
				),
				array(
					'flag_name'		=> 'Indonesia',
					'flag_image'	=> 'ID.png',
				),
				array(
					'flag_name'		=> 'Iran',
					'flag_image'	=> 'IR.png',
				),
				array(
					'flag_name'		=> 'Iraq',
					'flag_image'	=> 'IQ.png',
				),
				array(
					'flag_name'		=> 'Ireland',
					'flag_image'	=> 'IE.png',
				),
				array(
					'flag_name'		=> 'Isle of Man',
					'flag_image'	=> 'IM.png',
				),
				array(
					'flag_name'		=> 'Israel',
					'flag_image'	=> 'IL.png',
				),
				array(
					'flag_name'		=> 'Italy',
					'flag_image'	=> 'IT.png',
				),
				array(
					'flag_name'		=> 'Jamaica',
					'flag_image'	=> 'JM.png',
				),
				array(
					'flag_name'		=> 'Japan',
					'flag_image'	=> 'JP.png',
				),
				array(
					'flag_name'		=> 'Jordan',
					'flag_image'	=> 'JO.png',
				),
				array(
					'flag_name'		=> 'Kazakhstan',
					'flag_image'	=> 'KZ.png',
				),
				array(
					'flag_name'		=> 'Kenya',
					'flag_image'	=> 'KE.png',
				),
				array(
					'flag_name'		=> 'Kiribati',
					'flag_image'	=> 'KI.png',
				),
				array(
					'flag_name'		=> 'Korea North',
					'flag_image'	=> 'NK.png',
				),
				array(
					'flag_name'		=> 'Korea South',
					'flag_image'	=> 'KS.png',
				),
				array(
					'flag_name'		=> 'Kuwait',
					'flag_image'	=> 'KW.png',
				),
				array(
					'flag_name'		=> 'Kyrgyzstan',
					'flag_image'	=> 'KG.png',
				),
				array(
					'flag_name'		=> 'Laos',
					'flag_image'	=> 'LA.png',
				),
				array(
					'flag_name'		=> 'Latvia',
					'flag_image'	=> 'LV.png',
				),
				array(
					'flag_name'		=> 'Lebanon',
					'flag_image'	=> 'LB.png',
				),
				array(
					'flag_name'		=> 'Lesotho',
					'flag_image'	=> 'LS.png',
				),
				array(
					'flag_name'		=> 'Liberia',
					'flag_image'	=> 'LR.png',
				),
				array(
					'flag_name'		=> 'Libya',
					'flag_image'	=> 'LY.png',
				),
				array(
					'flag_name'		=> 'Liechtenstein',
					'flag_image'	=> 'LI.png',
				),
				array(
					'flag_name'		=> 'Lithuania',
					'flag_image'	=> 'LT.png',
				),
				array(
					'flag_name'		=> 'Luxembourg',
					'flag_image'	=> 'LU.png',
				),
				array(
					'flag_name'		=> 'Macau',
					'flag_image'	=> 'MO.png',
				),
				array(
					'flag_name'		=> 'Macedonia',
					'flag_image'	=> 'MK.png',
				),
				array(
					'flag_name'		=> 'Madagascar',
					'flag_image'	=> 'MG.png',
				),
				array(
					'flag_name'		=> 'Malawi',
					'flag_image'	=> 'MW.png',
				),
				array(
					'flag_name'		=> 'Malaysia',
					'flag_image'	=> 'MY.png',
				),
				array(
					'flag_name'		=> 'Maldives',
					'flag_image'	=> 'MV.png',
				),
				array(
					'flag_name'		=> 'Mali',
					'flag_image'	=> 'ML.png',
				),
				array(
					'flag_name'		=> 'Malta',
					'flag_image'	=> 'MT.png',
				),
				array(
					'flag_name'		=> 'Marshall Islands',
					'flag_image'	=> 'MH.png',
				),
				array(
					'flag_name'		=> 'Mauritania',
					'flag_image'	=> 'MR.png',
				),
				array(
					'flag_name'		=> 'Mauritius',
					'flag_image'	=> 'MU.png',
				),
				array(
					'flag_name'		=> 'Mexico',
					'flag_image'	=> 'MX.png',
				),
				array(
					'flag_name'		=> 'Micronesia',
					'flag_image'	=> 'FM.png',
				),
				array(
					'flag_name'		=> 'Moldova',
					'flag_image'	=> 'MD.png',
				),
				array(
					'flag_name'		=> 'Monaco',
					'flag_image'	=> 'MC.png',
				),
				array(
					'flag_name'		=> 'Mongolia',
					'flag_image'	=> 'MN.png',
				),
				array(
					'flag_name'		=> 'Montserrat',
					'flag_image'	=> 'MS.png',
				),
				array(
					'flag_name'		=> 'Morocco',
					'flag_image'	=> 'MA.png',
				),
				array(
					'flag_name'		=> 'Mozambique',
					'flag_image'	=> 'MZ.png',
				),
				array(
					'flag_name'		=> 'Myanmar',
					'flag_image'	=> 'MM.png',
				),
				array(
					'flag_name'		=> 'Nambia',
					'flag_image'	=> 'NA.png',
				),
				array(
					'flag_name'		=> 'Nauru',
					'flag_image'	=> 'NR.png',
				),
				array(
					'flag_name'		=> 'Nepal',
					'flag_image'	=> 'NP.png',
				),
				array(
					'flag_name'		=> 'Netherland Antilles',
					'flag_image'	=> 'AN.png',
				),
				array(
					'flag_name'		=> 'Netherlands',
					'flag_image'	=> 'NL.png',
				),
				array(
					'flag_name'		=> 'New Zealand',
					'flag_image'	=> 'NZ.png',
				),
				array(
					'flag_name'		=> 'Nicaragua',
					'flag_image'	=> 'NI.png',
				),
				array(
					'flag_name'		=> 'Niger',
					'flag_image'	=> 'NE.png',
				),
				array(
					'flag_name'		=> 'Nigeria',
					'flag_image'	=> 'NG.png',
				),
				array(
					'flag_name'		=> 'Norfolk Island',
					'flag_image'	=> 'NF.png',
				),
				array(
					'flag_name'		=> 'Norway',
					'flag_image'	=> 'NO.png',
				),
				array(
					'flag_name'		=> 'Oman',
					'flag_image'	=> 'OM.png',
				),
				array(
					'flag_name'		=> 'Pakistan',
					'flag_image'	=> 'PK.png',
				),
				array(
					'flag_name'		=> 'Palau Island',
					'flag_image'	=> 'PW.png',
				),
				array(
					'flag_name'		=> 'Palestine',
					'flag_image'	=> 'PS.png',
				),
				array(
					'flag_name'		=> 'Panama',
					'flag_image'	=> 'PA.png',
				),
				array(
					'flag_name'		=> 'Papua New Guinea',
					'flag_image'	=> 'PG.png',
				),
				array(
					'flag_name'		=> 'Paraguay',
					'flag_image'	=> 'PY.png',
				),
				array(
					'flag_name'		=> 'Peru',
					'flag_image'	=> 'PE.png',
				),
				array(
					'flag_name'		=> 'Philippines',
					'flag_image'	=> 'PH.png',
				),
				array(
					'flag_name'		=> 'Pitcairn Island',
					'flag_image'	=> 'PN.png',
				),
				array(
					'flag_name'		=> 'Poland',
					'flag_image'	=> 'PL.png',
				),
				array(
					'flag_name'		=> 'Portugal',
					'flag_image'	=> 'PT.png',
				),
				array(
					'flag_name'		=> 'Puerto Rico',
					'flag_image'	=> 'PR.png',
				),
				array(
					'flag_name'		=> 'Qatar',
					'flag_image'	=> 'QA.png',
				),
				array(
					'flag_name'		=> 'Romania',
					'flag_image'	=> 'RO.png',
				),
				array(
					'flag_name'		=> 'Russia',
					'flag_image'	=> 'RU.png',
				),
				array(
					'flag_name'		=> 'Rwanda',
					'flag_image'	=> 'RW.png',
				),
				array(
					'flag_name'		=> 'Samoa',
					'flag_image'	=> 'WS.png',
				),
				array(
					'flag_name'		=> 'San Marino',
					'flag_image'	=> 'SM.png',
				),
				array(
					'flag_name'		=> 'Sao Tome &amp; Principe',
					'flag_image'	=> 'ST.png',
				),
				array(
					'flag_name'		=> 'Saudi Arabia',
					'flag_image'	=> 'SA.png',
				),
				array(
					'flag_name'		=> 'Senegal',
					'flag_image'	=> 'SN.png',
				),
				array(
					'flag_name'		=> 'Seychelles',
					'flag_image'	=> 'SC.png',
				),
				array(
					'flag_name'		=> 'Sierra Leone',
					'flag_image'	=> 'SL.png',
				),
				array(
					'flag_name'		=> 'Singapore',
					'flag_image'	=> 'SG.png',
				),
				array(
					'flag_name'		=> 'Slovakia',
					'flag_image'	=> 'SK.png',
				),
				array(
					'flag_name'		=> 'Slovenia',
					'flag_image'	=> 'SI.png',
				),
				array(
					'flag_name'		=> 'Solomon Islands',
					'flag_image'	=> 'SB.png',
				),
				array(
					'flag_name'		=> 'Somalia',
					'flag_image'	=> 'SO.png',
				),
				array(
					'flag_name'		=> 'South Africa',
					'flag_image'	=> 'ZA.png',
				),
				array(
					'flag_name'		=> 'Spain',
					'flag_image'	=> 'ES.png',
				),
				array(
					'flag_name'		=> 'Sri Lanka',
					'flag_image'	=> 'LK.png',
				),
				array(
					'flag_name'		=> 'St Helena',
					'flag_image'	=> 'SH.png',
				),
				array(
					'flag_name'		=> 'St Kitts-Nevis',
					'flag_image'	=> 'KN.png',
				),
				array(
					'flag_name'		=> 'St Lucia',
					'flag_image'	=> 'LC.png',
				),
				array(
					'flag_name'		=> 'St Vincent &amp; Grenadines',
					'flag_image'	=> 'VC.png',
				),
				array(
					'flag_name'		=> 'Sudan',
					'flag_image'	=> 'SD.png',
				),
				array(
					'flag_name'		=> 'Suriname',
					'flag_image'	=> 'SR.png',
				),
				array(
					'flag_name'		=> 'Swaziland',
					'flag_image'	=> 'SZ.png',
				),
				array(
					'flag_name'		=> 'Sweden',
					'flag_image'	=> 'SE.png',
				),
					array(
					'flag_name'		=> 'Switzerland',
					'flag_image'	=> 'CH.png',
				),
				array(
					'flag_name'		=> 'Syria',
					'flag_image'	=> 'SY.png',
				),
				array(
					'flag_name'		=> 'Taiwan',
					'flag_image'	=> 'TW.png',
				),
				array(
					'flag_name'		=> 'Tajikistan',
					'flag_image'	=> 'TJ.png',
				),
				array(
					'flag_name'		=> 'Tanzania',
					'flag_image'	=> 'TZ.png',
				),
				array(
					'flag_name'		=> 'Thailand',
					'flag_image'	=> 'TH.png',
				),
				array(
					'flag_name'		=> 'Togo',
					'flag_image'	=> 'TG.png',
				),
				array(
					'flag_name'		=> 'Tonga',
					'flag_image'	=> 'TO.png',
				),
				array(
					'flag_name'		=> 'Trinidad &amp; Tobago',
					'flag_image'	=> 'TT.png',
				),
				array(
					'flag_name'		=> 'Tunisia',
					'flag_image'	=> 'TN.png',
				),
				array(
					'flag_name'		=> 'Turkey',
					'flag_image'	=> 'TR.png',
				),
				array(
					'flag_name'		=> 'Turkmenistan',
					'flag_image'	=> 'TM.png',
				),
				array(
					'flag_name'		=> 'Turks &amp; Caicos Is',
					'flag_image'	=> 'TC.png',
				),
				array(
					'flag_name'		=> 'Tuvalu',
					'flag_image'	=> 'TV.png',
				),
				array(
					'flag_name'		=> 'Uganda',
					'flag_image'	=> 'UG.png',
				),
				array(
					'flag_name'		=> 'Ukraine',
					'flag_image'	=> 'UA.png',
				),
				array(
					'flag_name'		=> 'United Arab Emirates',
					'flag_image'	=> 'AE.png',
				),
				array(
					'flag_name'		=> 'United States of America',
					'flag_image'	=> 'US.png',
				),
				array(
					'flag_name'		=> 'Uruguay',
					'flag_image'	=> 'UY.png',
				),
				array(
					'flag_name'		=> 'Uzbekistan',
					'flag_image'	=> 'UZ.png',
				),
				array(
					'flag_name'		=> 'Vanuatu',
					'flag_image'	=> 'VU.png',
				),
				array(
					'flag_name'		=> 'Venezuela',
					'flag_image'	=> 'VE.png',
				),
				array(
					'flag_name'		=> 'Vietnam',
					'flag_image'	=> 'VN.png',
				),
				array(
					'flag_name'		=> 'Virgin Islands (Brit)',
					'flag_image'	=> 'VG.png',
				),
				array(
					'flag_name'		=> 'Virgin Islands (USA)',
					'flag_image'	=> 'VI.png',
				),
				array(
					'flag_name'		=> 'Wales',
					'flag_image'	=> 'WLS.png',
				),
				array(
					'flag_name'		=> 'Western Sahara',
					'flag_image'	=> 'EH.png',
				),
				array(
					'flag_name'		=> 'Yemen',
					'flag_image'	=> 'YE.png',
				),
				array(
					'flag_name'		=> 'Zambia',
					'flag_image'	=> 'ZM.png',
				),
				array(
					'flag_name'		=> 'Zimbabwe',
					'flag_image'	=> 'ZW.png',
				),
			); 
			/**/

			$ary = array(
				'flag_id'			=> $flag_id,
				'flag_name'		=> strtoupper(str_replace(array(" ","_"), "_", $country_name)), //lang_name
				'flag_image'		=> $flag
			);
			
			if ($db_tools->sql_table_exists(FLAG_TABLE) && !is_request('add_table'))
			{
				$sql_flags = 'INSERT INTO ' . FLAG_TABLE . ' ' . $db->sql_build_array('INSERT', $ary);
				print('<div><span style="color: red;">This flags are now added to the country flags DB table..</div>');
				print($sql_flags . "</br>");
				$db->sql_query($sql_flags);
			}
			elseif (is_request('add_flags'))
			{
				$result = $db->sql_query($sql_flags);
				if (!($result))
				{
					message_die(CRITICAL_ERROR, "Could not add flags table to the DB", '', __LINE__, __FILE__, print_r($sql_ary, true));
				}
				
				$message = $lang['Virtual_Go'] . "<br /><br />" . sprintf($lang['Click_return_flagadmin'], "<a href=\"" . append_sid("admin_country_flags.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid($phpbb_root_path . "admin/index.$phpEx?pane=right") . "\">", "</a>");
				message_die(GENERAL_MESSAGE, $message);
			}
			elseif (is_request('add_table') && !$db_tools->sql_table_exists(FLAG_TABLE))
			{
				//$sql = "DROP TABLE " . $table_prefix . "flags";
				$sql = "CREATE TABLE " . FLAG_TABLE . " (
					flag_id int(10) NOT NULL auto_increment,
					flag_name varchar(25) default NULL,
					flag_image varchar(25) default NULL,
					PRIMARY KEY (flag_id)
				)";

				// We could add error handling here...
				$result = $db->sql_query($sql);
				if (!($result))
				{
					message_die(CRITICAL_ERROR, "Could not add flags table to the DB", '', __LINE__, __FILE__, $sql);
				}
			}

			$template->assign_block_vars("flags", array(
				"ROW_COLOR" => "#" . $row_color,
				"ROW_CLASS" => $row_class,
				"FLAG" => isset($lang[$country_name]) ? $lang[$country_name] : $country_name,
				"IMAGE_DISPLAY" => ($flag) ? '<img title="' . $country_name . '" alt="' . $displayname . '" src="' . $flag_dir . $flag . '" />' : "",

				"U_FLAG_EDIT" => append_sid("admin_country_flags.$phpEx?mode=edit&amp;id=$flag_id"),
				"U_FLAG_DELETE" => append_sid("admin_country_flags.$phpEx?mode=delete&amp;id=$flag_id"))
			);
			$flag_id++;
		}
		
		if ($db_tools->sql_table_exists(FLAG_TABLE))
		{
			$redirect_url = append_sid("admin_country_flags.$phpEx?add_flags=add_lang_flags", true);
			$message_info = '<div><span style="color: red;">Your flags are not added to the country flags DB table and so You will not be able to enable all features that come in this pannel...</div><i><div>Adding the flags to the is reversible from this pannel! You will be able to edit or remove each flag. If you are aware of that, please click this link to proceed:</i></span> <a href="' . $redirect_url . '">click here to begin</a></div>'; 
			print($message_info);
		}
		else
		{
			$redirect_url = append_sid("admin_country_flags.$phpEx?add_table=create_table", true);
			$message_info = '<div><span style="color: red;">Your flags table is not added to the DB and so You will not be able to enable all features that come in this pannel...</div><i><div>Adding the table is not reversible from this pannel! If you are aware of that, please click this link to proceed:</i></span> <a href="' . $redirect_url . '">click here to begin</a></div>'; 
			print($message_info);
		}
	}
}

$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>