#FamFamFam Language Flag Icons

These icons are public domain, and as such are free for any use (attribution appreciated but not required).

#Country flags by Mark James.

Note that these country flags are named using the ISO3166-1 alpha-2 codes where appropriate. A list of codes can be found at http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2

To get started, checkout http://tkrotoff.github.com/famfamfam_flags/

#Language flags by Florin C Bodin 

Note that these language flags are named using the ISO639-1 codes where appropriate. A list of codes can be found at https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes

If you find these flag icons for languages useful, please donate via paypal to orynider@rdslink.ro (or click the donate button available at http://paypal.me/orynider )

For country flag icons - http://www.famfamfam.com

To Do:
1. Move country flags to country\ folder.
2. Move language flags to language\ folder.
3. Adding a function in php to get country flags or language flags.

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
					$lang_name = 'AFAR';
					$country_name = 'Afar'; //Ethiopia
				break;

				case 'ab':
					$lang_name = 'ABKHAZIAN';
					$country_name = 'Abkhazia';
				break;

				case 'ad':
					$lang_name = 'Angola';
					$country_name = 'ANGOLA';
				break;

				case 'ae':
					$lang_name = 'avestan';
					$country_name = 'Persia';
				break;

				case 'af':
					$country_name = 'AFGHANISTAN'; // langs: pashto and dari
					$lang_name = 'AFRIKAANS'; // speakers: 6,855,082 - 13,4%
				break;

				case 'ag':
					$lang_name = ' english-creole';
					$country_name = 'Antigua &amp; Barbuda';
				break;
				
				case 'ai':
					$lang_name = 'Anguilla';
					$country_name = 'Anguilla';
				break;
				
				case 'aj':
					$lang_name = 'AROMANIAN';
					$country_name = 'Aromaya';
				break;
				
				case 'ak':
					$lang_name = 'AKAN';
					$country_name = '';
				break;

				case 'al':
					$lang_name = 'albanian';
					$country_name = 'ALBANIA';
				break;


				case 'am':
					$lang_name = 'AMHARIC';
					//$lang_name = 'armenian';
					$country_name = 'Armenia';
				break;

				case 'an':
					$lang_name = 'ARAGONESE'; //
					//$country_name = 'Andorra';
					$country_name = 'Netherland Antilles';
				break;
				
				case 'ao':
					$lang_name = 'angolian';
					$country_name = 'Angola';
				break;
				
				case 'ap':
					$lang_name = 'angika';
					$country_name = 'Anga'; //India
				break;

				case 'ar':
					$lang_name = 'ARABIC';
					$country_name = 'Argentina';
				break;

				case 'aq':
					$lang_name = '';
					$country_name = 'ANTARCTICA';
				break;

				case 'as':
					$lang_name = 'assamese';
					$country_name = 'American Samoa';
				break;

				case 'at':
					$lang_name = 'german';
					$country_name = 'Austria';
				break;

				case 'av':
					$lang_name = 'avaric';
					$country_name = '';
				break;

				case 'av-da':
					$lang_name = 'AVARIAN_KHANATE';
					$country_name = 'Daghestanian';
				break;

				case 'ay':
					$lang_name = 'aymara';
					$country_name = '';
				break;

				case 'aw':
					$lang_name = 'aruba';
					$country_name = 'Aruba';
				break;

				case 'au':
					$lang_name = 'en-au'; //
					$country_name = 'Australia';
				break;

				case 'az':
					$lang_name = 'azerbaijani';
					$country_name = 'Azerbaijan';
				break;
				
				case 'ax':
					$lang_name = 'finnish';
					$country_name = 'Åland Islands';  //The Åland Islands or Åland (Swedish: Åland, IPA: [ˈoːland]; Finnish: Ahvenanmaa) is an archipelago province at the entrance to the Gulf of Bothnia in the Baltic Sea belonging to Finland.
				break;
				
				case 'ba':
					$lang_name = 'bashkir'; //Baskortostán (Rusia)
					$country_name = 'Bosnia &amp; Herzegovina'; //Bosnian, Croatian, Serbian
				break;

				case 'bb':
					$lang_name = 'Barbados';
					$country_name = 'Barbados';
				break;

				case 'bd':
					$lang_name = 'Bangladesh';
					$country_name = 'Bangladesh';
				break;

				case 'be':
					$lang_name = 'belarusian';
					$country_name = 'Belgium';
				break;

				case 'bf':
					$lang_name = 'Burkina Faso';
					$country_name = 'Burkina Faso';
				break;
				
				case 'bg':
					$lang_name = 'bulgarian';
					$country_name = 'Bulgaria';
				break;

				case 'bh':
					$lang_name = 'bhojpuri'; // Bihar (India) 
					$country_name = 'Bahrain'; // Mamlakat al-Ba?rayn (arabic)
				break;

				case 'bi':
					$lang_name = 'bislama';
					$country_name = 'Burundi';
				break;


				case 'bj':
					$lang_name = 'Benin';
					$country_name = 'Benin';
				break;
				
				case 'bl':
					$lang_name = 'Bonaire';
					$country_name = 'Bonaire';
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
					$country_name = 'Bolivia';
				break;


				case 'br':
					$lang_name = 'breton';
					$country_name = 'Brazil'; //pt
				break;


				case 'bs':
					$lang_name = 'bosnian';
					$country_name = 'Bahamas';
				break;

				case 'bt':
					$lang_name = 'Bhutan';
					$country_name = 'Bhutan';
				break;

				case 'bw':
					$lang_name = 'Botswana';
					$country_name = 'Botswana';
				break;

				case 'bz':
					$lang_name = 'Belize';
					$country_name = 'Belize';
				break;

				case 'by':
					$lang_name = 'belarusian';
					$country_name = 'Belarus';
				break;


				case 'cm':
					$lang_name = 'Cameroon';
					$country_name = 'Cameroon';
				break;

				case 'ca':
					$lang_name = 'catalan';
					$country_name = 'Canada';
				break;
				
				case 'cc':
					$lang_name = ''; //COA A Cocos dialect of Betawi Malay [ente (you) and ane (me)] and AU-English
					$country_name = 'Cocos Islands'; //CC 	Cocos (Keeling) Islands
				break;
				
				case 'cd':
					$lang_name = 'Congo Democratic Republic';
					$country_name = 'Congo Democratic Republic';
				break;
				//нохчийн мотт
				case 'ce':
					$lang_name = 'Chechen';
					$country_name = 'Chechenya';
				break;
				
				case 'cf':
					$lang_name = 'Central African Republic';
					$country_name = 'Central African Republic';
				break;

				case 'cg':
					$lang_name = 'Congo';
					$country_name = 'CONGO';
				break;
				
				case 'ch':
					$lang_name = 'Chamorro'; //Finu' Chamoru
					$country_name = 'SWITZERLAND';
				break;
				
				case 'ci':
					$lang_name = 'Cote D-Ivoire';
					$country_name = 'Cote_D-Ivoire';
				break;
				
				case 'ck':
					$lang_name = '';
					$country_name = 'Cook Islands'; //CK 	Cook Islands
				break;
				
				case 'cl':
					$lang_name = 'Chile';
					$country_name = 'Chile';
				break;
				
				case 'cn':
				//Chinese Macrolanguage
				case 'zh': //639-1: zh
				case 'chi': //639-2/B: chi
				case 'zho': //639-2/T and 639-3: zho
					$lang_name = 'CHINESE';
					$country_name = 'CHINA';
				break;		
				//Chinese Individual Languages 
			    //	中文			
				// Fujian Province, Republic of China
				case 'cn-fj':		
				//	閩東話
				case 'cdo': 	//Chinese Min Dong  
					$lang_name = 'CHINESE_DONG';
					$country_name = 'CHINA';
				break;
				//1. Bingzhou		spoken in central Shanxi (the ancient Bing Province), including Taiyuan.
				//2. Lüliang		spoken in western Shanxi (including Lüliang) and northern Shaanxi.
				//3. Shangdang	spoken in the area of Changzhi (ancient Shangdang) in southeastern Shanxi.
				//4. Wutai			spoken in parts of northern Shanxi (including Wutai County) and central Inner Mongolia.
				//5. Da–Bao		spoken in parts of northern Shanxi and central Inner Mongolia, including Baotou.
				//6. Zhang-Hu	spoken in Zhangjiakou in northwestern Hebei and parts of central Inner Mongolia, including Hohhot.
				//7. Han-Xin		spoken in southeastern Shanxi, southern Hebei (including Handan) and northern Henan (including Xinxiang).
				//8. Zhi-Yan		spoken in Zhidan County and Yanchuan County in northern Shaanxi.
				//	晉語
				case 'cjy': 	//Chinese Jinyu  	
					$lang_name = 'CHINA_JINYU';
					$country_name = 'CHINA';
				break;
				// 官話
				case 'cmn': 	//Chinese Mandarin  
					$lang_name = 'CHINESE_MANDARIN';
					$country_name = 'CHINA';
				break;
				// 莆仙片 
				case 'cpx': 	//Chinese Pu-Xian 
					$lang_name = 'CHINESE_PU-XIAN';
					$country_name = 'CHINA';
				break;
				// 徽語
				case 'czh': 	//Chinese HuiZhou 	
					$lang_name = 'CHINESE_HUIZHOU';
					$country_name = 'CHINA';
				break;
				// 閩中片
				case 'czo': 	//Chinese Min Zhong  
					$lang_name = 'CHINESE_ZHONG';
					$country_name = 'CHINA';
				break;				
				// 東干話
				case 'dng': 	//Ding  Chinese 
					$lang_name = 'DING_CHINESE';
					$country_name = 'CHINA';
				break;				
				//	贛語
				case 'gan': 	//Gan Chinese  
					$lang_name = 'GAN_CHINESE';
					$country_name = 'CHINA';
				break;
				// 客家話
				case 'hak': 	//Chinese  Hakka 
					$lang_name = 'CHINESE_HAKKA';
					$country_name = 'CHINA';
				break;
				
				case 'hsn': 	//Xiang Chinese 	
					$lang_name = 'XIANG_CHINESE';
					$country_name = 'CHINA';
				break;				
				//	文言
				case 'lzh': 	//Literary Chinese 	
					$lang_name = 'LITERARY_CHINESE';
					$country_name = 'CHINA';
				break;
				// 閩北片
				case 'mnp': 	//Min Bei Chinese 
					$lang_name = 'MIN_BEI_CHINESE';
					$country_name = 'CHINA';
				break;
				// 閩南語
				case 'nan': 	//Min Nan Chinese 	
					$lang_name = 'MIN_NAN_CHINESE';
					$country_name = 'CHINA';
				break;			 
				 // 吴语
				case 'wuu': 	//Wu Chinese 
					$lang_name = 'WU_CHINESE ';
					$country_name = 'CHINA';
				break;
				// 粵語
				case 'yue': 	//Yue Chinese
					$lang_name = 'YUE_CHINESE';
					$country_name = 'CHINA';
				break;
				
				case 'co':
					$lang_name = 'corsican'; // Corsica
					$country_name = 'Columbia';
				break;
				
				case 'cr':
					$lang_name = 'cree';
					$country_name = 'Costa Rica';
				break;

				case 'cs':
					$lang_name = 'czech';
					$country_name = 'Czech Republic';
				break;

				case 'cu':
					$lang_name = 'slavonic';
					$country_name = 'Cuba'; //langs: 
				break;

				case 'cv':
					$country_name = 'Cape Verde';
					$lang_name = 'chuvash';
				break;
				
				case 'cx':
					$lang_name = ''; // Malaysian Chinese origin and  European Australians 
					$country_name = 'Christmas Island';
				break;
				
				case 'cy':
					$lang_name = 'Cyprus';
					$country_name = 'Cyprus';
				break;
				
				case 'cz':
					$lang_name = 'Czech Republic';
					$country_name = 'Czech Republic';
				break;
				
				case 'cw':
					$lang_name = 'papiamentu';   // Papiamentu (Portuguese-based Creole), Dutch, English
					$country_name = 'Curação'; // Ilha da Curação (Island of Healing)
				break;
				
				case 'da':
					$lang_name = 'danish';
					$country_name = 'Denmark';
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
					$lang_name = 'estonian';
					$country_name = 'ESTONIA';
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
					$country_name = 'Finland';
				break;

				case 'fj':
					$lang_name = 'fijian';
					$country_name = 'Fiji';
				break;

				case 'fk':
					$lang_name = 'falklandian';
					$country_name = 'Falkland Islands';
				break;


				case 'fm':
					$lang_name = 'Micronesia';
					$country_name = 'Micronesia';
				break;

				case 'fo':
					$lang_name = 'faroese';
					$country_name = 'Faroe Islands';
				break;

				case 'fr':
					$lang_name = 'french';
					$country_name = 'France';
				break;

				case 'fy':
					$lang_name = 'frisian';
					$country_name = '';
				break;

				case 'ga':
					$lang_name = 'irish';
					$country_name = 'Gabon';
				break;

				case 'gb':
					$lang_name = 'Great Britain';
					$country_name = 'Great Britain';
				break;
				
				case 'gd':
					$lang_name = 'scottish';
					$country_name = 'GRENADA';
				break;
				
				case 'ge':
					$lang_name = 'Georgia';
					$country_name = 'Georgia';
				break;
				
				case 'gi':
					$lang_name = 'Llanito'; //Llanito or Yanito
					$country_name = 'Gibraltar';
				break;
				
				case 'gg':
					$lang_name = 'guernesiais'; //English, Guernésiais, Sercquiais, Auregnais
					$country_name = 'Guernsey';
				break;
				
				case 'gh':
					$lang_name = 'Ghana';
					$country_name = 'Ghana';
				break;

				case 'gr':
					$lang_name = 'Greece';
					$country_name = 'Greece';
				break;

				case 'gl':
					$lang_name = 'galician';
					$country_name = 'Greenland';
				break;
				
				case 'gm':
					$lang_name = 'Gambia';
					$country_name = 'Gambia';
				break;
				
				case 'gn':
					$lang_name = 'Guinea';
					$country_name = 'Guinea';
				break;
				
				case 'gs':
					$lang_name = 'english';
					$country_name = 'South Georgia and the South Sandwich Islands';
				break;
				
				case 'gt':
					$lang_name = 'Guatemala';
					$country_name = 'Guatemala';
				break;
				
				case 'gq':
					$lang_name = 'Equatorial Guinea';
					$country_name = 'Equatorial Guinea';
				break;

				case 'gu':
					$lang_name = 'gujarati';
					$country_name = 'Guam';
				break;

				case 'gv':
					$lang_name = 'manx';
					$country_name = '';
				break;
				
				case 'gw':
					$lang_name = 'Guinea Bissau';
					$country_name = 'Guinea Bissau';
				break;

				case 'gy':
					$lang_name = 'Guyana';
					$country_name = 'Guyana';
				break;

				case 'ha':
					$country_name = '';
					$lang_name = 'hausa';
				break;


				case 'he':
					$country_name = 'Israel';
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
					$country_name = 'Hong Kong';
				break;
				
				case 'hn':
					$country_name = 'Honduras';
					$lang_name = 'Honduras';
				break;
				
				case 'hr':
					$lang_name = 'croatian';
					$country_name = 'Croatia';
				break;
				
				case 'ht':
					$lang_name = 'haitian';
					$country_name = 'Haiti';
				break;
				
				case 'ho':
					$lang_name = 'hiri_motu';
					$country_name = '';
				break;
				
				case 'hu':
					$lang_name = 'hungarian';
					$country_name = 'Hungary';
				break;
				
				case 'hy':
				case 'hy-am':
					$lang_name = 'ARMENIAN';
					$country_name = '';
				break;

				case 'hy-at':
					$lang_name = 'ARMENIAN-ARTSAKH';
					$country_name = 'REPUBLIC_OF_ARTSAKH';
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
					$country_name = 'Canary Islands';
				break;
				
				case 'id':
					$lang_name = 'indonesian';
					$country_name = 'Indonesia';
				break;
				
				case 'ie':
					$lang_name = 'interlingue';
					$country_name = 'Ireland';
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
					$country_name = 'Israel';
				break;
				
				case 'im':
					$lang_name = 'Isle of Man';
					$country_name = 'Isle of Man';
				break;
				
				case 'in':
					$lang_name = 'India';
					$country_name = 'India';
				break;
				
				
				case 'ir':
					$lang_name = 'Iran';
					$country_name = 'Iran';
				break;
				
				case 'is':
					$lang_name = 'Iceland';
					$country_name = 'Iceland';
				break;
				
				case 'it':
					$lang_name = 'italian';
					$country_name = 'Italy';
				break;
				
				case 'iq':
					$lang_name = 'Iraq';
					$country_name = 'Iraq';
				break;
				
				case 'je':
					$lang_name = 'jerriais'; //Jèrriais
					$country_name = 'Jersey'; //Bailiwick of Jersey
				break;
				
				case 'jm':
					$lang_name = 'Jamaica';
					$country_name = 'Jamaica';
				break;
				
				case 'jo':
					$lang_name = 'Jordan';
					$country_name = 'Jordan';
				break;
				
				case 'jp':
					$lang_name = 'japanese';
					$country_name = 'Japan';
				break;
				case 'jv':
					$lang_name = 'javanese';
					$country_name = '';
				break;
				
				case 'kh':
					$lang_name = 'Cambodia';
					$country_name = 'Cambodia';
				break;
				
				case 'ke':
					$lang_name = 'Kenya';
					$country_name = 'Kenya';
				break;
				
				case 'ki':
					$lang_name = 'Kiribati';
					$country_name = 'Kiribati';
				break;
				
				case 'km':
					$lang_name = 'Comoros';
					$country_name = 'Comoros';
				break;
				
				case 'kn':
					$lang_name = 'kannada';
					$country_name = 'St Kitts-Nevis';
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
					$country_name = 'Korea South';
				break;
				
				case 'kn':
					$lang_name = 'St Kitts-Nevis';
					$country_name = 'St Kitts-Nevis';
				break;
				
				case 'ks':
					$lang_name = 'kashmiri'; //Kashmir
					$country_name = 'Korea South';
				break;
				
				case 'ky':
					$lang_name = 'Cayman Islands';
					$country_name = 'Cayman Islands';
				break;

				case 'kz':
					$lang_name = 'Kazakhstan';
					$country_name = 'Kazakhstan';
				break;

				case 'kw':
					//endonim: Kernewek
					$lang_name = 'Cornish';
					$country_name = 'Kuwait';
				break;

				case 'kg':
					$lang_name = 'Kyrgyzstan';
					$country_name = 'Kyrgyzstan';
				break;

				case 'la':
					$lang_name = 'Laos';
					$country_name = 'Laos';
				break;

				case 'lk':
					$lang_name = 'Sri Lanka';
					$country_name = 'Sri Lanka';
				break;

				case 'lv':
					$lang_name = 'Latvia';
					$country_name = 'Latvia';
				break;

				case 'lb':
					$lang_name = 'Lebanon';
					$country_name = 'Lebanon';
				break;
				
				case 'lc':
					$lang_name = 'St Lucia';
					$country_name = 'St Lucia';
				break;
				
				case 'ls':
					$lang_name = 'Lesotho';
					$country_name = 'Lesotho';
				break;

				case 'lr':
					$lang_name = 'Liberia';
					$country_name = 'Liberia';
				break;

				case 'ly':
					$lang_name = 'Libya';
					$country_name = 'Libya';
				break;

				case 'li':
					$lang_name = 'Liechtenstein';
					$country_name = 'Liechtenstein';
				break;

				case 'lt':
					$country_name = 'Lithuania';
					$lang_name = 'Lithuania';
				break;

				case 'lu':
					$lang_name = 'Luxembourg';
					$country_name = 'Luxembourg';
				break;

				case 'mo':
					$lang_name = 'Macau';
					$country_name = 'Macau';
				break;
				
				case 'me':
					$lang_name = 'montenegrin'; //Serbo-Croatian, Cyrillic, Latin
					$country_name = 'Montenegro'; //Црна Гора
				break;
				
				case 'mf':
					$lang_name = 'french'; //
					$country_name = 'Saint Martin (French part)'; 
				break;
				
				case 'mk':
					$lang_name = 'Macedonia';
					$country_name = 'Macedonia';
				break;
				
				case 'mg':
					$lang_name = 'Madagascar';
					$country_name = 'Madagascar';
				break;

				case 'mw':
					$country_name = 'Malawi';
					$lang_name = 'Malawi';
				break;

				case 'my':
					$lang_name = 'Myanmar';
					$country_name = 'Malaysia';
				break;

				case 'mv':
					$lang_name = 'Maldives';
					$country_name = 'Maldives';
				break;

				case 'ml':
					$lang_name = 'Mali';
					$country_name = 'Mali';
				break;

				case 'mt':
					$lang_name = 'Malta';
					$country_name = 'Malta';
				break;

				case 'mh':
					$lang_name = 'Marshall Islands';
					$country_name = 'Marshall Islands';
				break;

				case 'mr':
					$lang_name = 'Mauritania';
					$country_name = 'Mauritania';
				break;

				case 'mu':
					$lang_name = 'Mauritius';
					$country_name = 'Mauritius';
				break;

				case 'mx':
					$lang_name = 'Mexico';
					$country_name = 'Mexico';
				break;

				case 'md':
					$country_name = 'Moldova';
					$lang_name = 'Moldova';
				break;

				case 'mc':
					$country_name = 'Monaco';
					$lang_name = 'Monaco';
				break;

				case 'mn':
					$lang_name = 'Mongolia';
					$country_name = 'Mongolia';
				break;

				case 'ms':
					$lang_name = 'Montserrat';
					$country_name = 'Montserrat';
				break;

				case 'ma':
					$lang_name = 'Morocco';
					$country_name = 'Morocco';
				break;
				
				case 'mz':
					$lang_name = 'Mozambique';
					$country_name = 'Mozambique';
				break;
				
				case 'mm':
					$lang_name = 'Myanmar';
					$country_name = 'Myanmar';
				break;
				case 'mp':
					$lang_name = 'chamorro'; //Carolinian
					$country_name = 'Northern Mariana Islands';
				break;
				case 'mq':
					$lang_name = 'antillean-creole'; // Antillean Creole (Créole Martiniquais)
					$country_name = 'Martinique';
				break;
				case 'na':
					$lang_name = 'Nambia';
					$country_name = 'Nambia';
				break;
				
				case 'ni':
					$lang_name = 'Nicaragua';
					$country_name = 'Nicaragua';
				break;
				
				case 'ne':
					$lang_name = 'Niger';
					$country_name = 'Niger';
				break;
				
				case 'nc':
					$lang_name = 'paicî'; //French, Nengone, Paicî, Ajië, Drehu
					$country_name = 'New Caledonia';
				break;
				
				case 'nk':
					$lang_name = 'Korea North';
					$country_name = 'Korea North';
				break;
				
				case 'ng':
					$lang_name = 'Nigeria';
					$country_name = 'Nigeria';
				break;
				
				case 'nf':
					$lang_name = 'Norfolk Island';
					$country_name = 'Norfolk Island';
				break;
				
				case 'nl':
					$lang_name = 'Netherlands';
					$country_name = 'Netherlands';
				break;
				
				case 'no':
					$lang_name = 'Norway';
					$country_name = 'Norway';
				break;
				
				case 'np':
					$lang_name = 'Nepal';
					$country_name = 'Nepal';
				break;
				
				case 'nr':
					$lang_name = 'Nauru';
					$country_name = 'Nauru';
				break;
				
				case 'nu':
					$lang_name = 'niuean'; //Niuean (official) 46% (a Polynesian language closely related to Tongan and Samoan)
					$country_name = 'Niue'; // Niuean: Niuē
				break;
				
				case 'nz':
					$lang_name = 'New Zealand';
					$country_name = 'New Zealand';
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
					$country_name = 'Oman';
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
					$lang_name = 'Panama';
				break;


				case 'pe':
					$country_name = 'Peru';
					$lang_name = 'Peru';
				break;

				case 'ph':
					$lang_name = 'Philippines';
					$country_name = 'Philippines';
				break;
				
				case 'pf':
					$country_name = 'French Polynesia';
					$lang_name = 'tahitian'; //Polynésie française
				break;
				
				case 'pg':
					$country_name = 'Papua New Guinea';
					$lang_name = 'Papua New Guinea';
				break;
				
				case 'pi':
					$lang_name = 'pali';
					$country_name = '';
				break;
				
				case 'pl':
					$lang_name = 'Poland';
					$country_name = 'Poland';
				break;
				
				case 'pn':
					$lang_name = 'Pitcairn Island';
					$country_name = 'Pitcairn Island';
				break;
				
				case 'pr':
					$lang_name = 'Puerto Rico';
					$country_name = 'Puerto Rico';
				break;
				
				case 'pt':
					$lang_name = 'Portugal';
					$country_name = 'Portugal';
				break;
				
				case 'pk':
					$lang_name = 'Pakistan';
					$country_name = 'Pakistan';
				break;
				
				case 'pw':
					$country_name = 'Palau Island';
					$lang_name = 'Palau Island';
				break;
				
				case 'ps':
					$country_name = 'Palestine';
					$lang_name = 'Palestine';
				break;
				
				case 'py':
					$country_name = 'Paraguay';
					$lang_name = 'Paraguay';
				break;
				
				case 'qa':
					$lang_name = 'Qatar';
					$country_name = 'Qatar';
				break;
				case 'ri':
					$country_name = 'romani';
					$lang_name = 'romani';
				break;
				case 'ro':
					$country_name = 'Romania';
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
					$country_name = 'Republic of Serbia'; //Република Србија //Republika Srbija
					$lang_name = ''; //Serbia, Србија / Srbija
				break;
				
				case 'ru':
					$country_name = 'Russia';
					$lang_name = 'Russia';
				break;
				
				case 'rw':
					$country_name = 'Rwanda';
					$lang_name = 'Rwanda';
				break;

				
				case 'sa':
					$lang_name = 'arabic';
					$country_name = 'Saudi Arabia';
				break;
				
				case 'sb':
					$lang_name = 'Solomon Islands';
					$country_name = 'Solomon Islands';
				break;
				
				case 'sc':
					$lang_name = 'seychellois-creole';
					$country_name = 'Seychelles';
				break;
				
				case 'sd':
					$lang_name = 'Sudan';
					$country_name = 'Sudan';
				break;
				
				case 'si':
					$country_name = 'Slovenia';
					$country_name = 'Slovenia';
				break;
				
				case 'sh':
					$country_name = 'St Helena';
					$country_name = 'St Helena';
				break;
				
				case 'sk':
					$country_name = 'Slovakia';
					$lang_name = 'Slovakia';
				break;
				
				case 'sg':
					$country_name = 'Singapore';
					$lang_name = 'Singapore';
				break;
				
				case 'sl':
					$country_name = 'Sierra Leone';
					$lang_name = 'Sierra Leone';
				break;
				
				case 'sm':
					$lang_name = 'San Marino';
					$country_name = 'San Marino';
				break;
				
				case 'sn':
					$lang_name = 'Senegal';
					$country_name = 'Senegal';
				break;
				
				case 'so':
					$lang_name = 'Somalia';
					$country_name = 'Somalia';
				break;
				
				case 'sq':
					$lang_name = 'ALBANIAN';
					$country_name = 'Albania';
				break;
				
				case 'sr':
					$lang_name = 'Suriname';
					$country_name = 'Suriname';
				break;
				
				case 'ss':
					$lang_name = ''; //Bari [Karo or Kutuk ('mother tongue', Beri)], Dinka, Luo, Murle, Nuer, Zande
					$country_name = 'Republic of South Sudan';
				break;
				
				case 'st':
					$lang_name = 'Sao Tome &amp; Principe';
					$country_name = 'Sao Tome &amp; Principe';
				break;
				
				case 'sv':
					$lang_name = 'El Salvador';
					$country_name = 'El Salvador';
				break;
				
				case 'sx':
					$lang_name = 'dutch';
					$country_name = 'Sint Maarten (Dutch part)';
				break;
				
				
				case 'sz':
					$lang_name = 'Swaziland';
					$country_name = 'Swaziland';
				break;
				case 'se':
					$lang_name = 'Sweden';
					$country_name = 'Sweden';
				break;

				case 'sy':
					$lang_name = 'Syria';
					$country_name = 'Syria';
				break;
				

				case 'tc':
					$lang_name = 'Turks &amp; Caicos Is';
					$country_name = 'Turks &amp; Caicos Is';
				break;
				
				case 'td':
					$lang_name = 'Chad';
					$country_name = 'Chad';
				break;
				
				case 'tf':
					$lang_name = 'french '; //
					$country_name = 'French Southern Territories'; //Terres australes françaises
				break;
				
				case 'tj':
					$lang_name = 'Tajikistan';
					$country_name = 'Tajikistan';
				break;
				
				case 'tg':
					$lang_name = 'Togo';
					$country_name = 'Togo';
				break;
				
				case 'th':
					$country_name = 'Thailand';
					$lang_name = 'Thailand';
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
					$lang_name = 'Tonga';
				break;
				
				case 'tt':
					$country_name = 'Trinidad &amp; Tobago';
					$lang_name = 'Trinidad &amp; Tobago';
				break;
				
				case 'tn':
					$lang_name = 'Tunisia';
					$country_name = 'Tunisia';
				break;
				
				case 'tm':
					$lang_name = 'Turkmenistan';
					$country_name = 'Turkmenistan';
				break;
				
				case 'tr':
					$lang_name = 'Turkey';
					$country_name = 'Turkey';
				break;
				
				case 'tv':
					$lang_name = 'Tuvalu';
					$country_name = 'Tuvalu';
				break;
				
				case 'tw':
					$lang_name = 'Taiwan';
					$country_name = 'Taiwan';
				break;
				
				case 'tz':
					$country_name = 'Tanzania';
					$lang_name = 'Tanzania';
				break;

				case 'ug':
					$lang_name = 'Uganda';
					$country_name = 'Uganda';
				break;

				case 'ua':
					$lang_name = 'Ukraine';
					$country_name = 'Ukraine';
				break;

				case 'us':
					$lang_name = 'en-us';
					$country_name = 'United States of America';
				break;
				
				case 'uz':
					$lang_name = 'uzbek'; //Uyghur Perso-Arabic alphabet
					$country_name = 'Uzbekistan';
				break;
				
				case 'uy':
					$lang_name = 'Uruguay';
					$country_name = 'Uruguay';
				break;
				
				case 'va':
					$country_name = 'Holy See'; //
					$lang_name = 'latin';
				break;
				
				case 'vc':
					$country_name = 'St Vincent &amp; Grenadines'; //
					$lang_name = 'vincentian-creole';
				break;
				
				case 've':
					$lang_name = 'Venezuela';
					$country_name = 'Venezuela';
				break;
				
				case 'vi':
					$lang_name = 'Virgin Islands (USA)';
					$country_name = 'Virgin Islands (USA)';
				break;
				
				case 'vn':
					$lang_name = 'Vietnam';
					$country_name = 'Vietnam';
				break;

				case 'vg':
					$lang_name = 'Virgin Islands (Brit)';
					$country_name = 'Virgin Islands (Brit)';
				break;
				
				case 'vu':
					$lang_name = 'Vanuatu';
					$country_name = 'Vanuatu';
				break;
				
				case 'wls':
					$lang_name = 'Wales';
					$country_name = 'Wales';
				break;
				
				case 'wf':
					$country_name = 'Territory of the Wallis and Futuna Islands';
					$lang_name = 'Wallisian'; 
					//Wallisian, or ʻUvean 
					//Futunan - Austronesian, Malayo-Polynesian
				break;
				
				case 'ws':
					$country_name = 'Samoa';
					$lang_name = 'Samoa';
				break;
				
				case 'ye':
					$lang_name = 'Yemen';
					$country_name = 'Yemen';
				break;
				
				case 'yt':
					$lang_name = 'Mayotte'; //Shimaore:
					$country_name = 'Department of Mayotte'; //Département de Mayotte
				break;
				
				case 'za':
					$lang_name = 'zhuang';
					$country_name = 'South Africa';
				break;
				case 'zm':
					$lang_name = 'zambian';
					$country_name = 'Zambia';
				break;
				case 'zw':
					$lang_name = 'Zimbabwe';
					$country_name = 'Zimbabwe';
				break;
				case 'zu':
					$lang_name = 'zulu';
					$country_name = 'zulu';
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
	
	

Contact: orynider@gmail.com 
