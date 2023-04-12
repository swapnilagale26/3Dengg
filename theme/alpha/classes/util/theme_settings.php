<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Mustache helper to load a theme configuration.
 *
 * @package    theme_alpha
 * @copyright  2019 Marcin Czaja - http://rosea.io
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_alpha\util;

use theme_config;
use stdClass;

defined('MOODLE_INTERNAL') || die();

/**
 * Helper to load a theme configuration.
 *
 * @package    theme_alpha
 * @copyright  2019 Marcin Czaja - http://rosea.io
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class theme_settings {

  /**
   * Get config theme footer itens
   *
   * @return array
   */
  public function sidebar_custom_block() {
      $theme = theme_config::load('alpha');

      $templatecontext = [];
      $sidebaritems = [
        'sidebarcustombox', 'customrooturl', 'sidebarcustomnav', 'sidebarcustomnavigationlinks', 'showadditionaltext', 'showmycourses', 'hiddensidebar', 'showsidebarlogo', 'SidebarButtonIconOpen', 'SidebarButtonIconClose'
      ];

      foreach ($sidebaritems as $setting) {
        if (!empty($theme->settings->$setting)) {
            $templatecontext[$setting] = $theme->settings->$setting;
        }
      }

      $sidebaritemshtml = [
        'sidebarcustomheading', 'sidebarcustomtext', 'sidebarcustomnavtitle', 'additionaltext'
      ];

      foreach ($sidebaritemshtml as $setting) {
        if (!empty($theme->settings->$setting)) {
            $templatecontext[$setting] = format_text(($theme->settings->$setting),FORMAT_HTML, array('noclean' => true));
        }
      }

      if (!empty($theme->setting_file_url('customlogosidebar', 'customlogosidebar'))) {
        $templatecontext['customlogosidebar'] = $theme->setting_file_url('customlogosidebar', 'customlogosidebar');
      }

      return $templatecontext;
  }

  public function login_block() {

      $theme = theme_config::load('alpha');

      $templatecontext = [];

      $loginitems = [
        'showloginbg'
      ];

      foreach ($loginitems as $setting) {
        if (!empty($theme->settings->$setting)) {
            $templatecontext[$setting] = $theme->settings->$setting;
        }
      }

      $loginfiles = [
        'logincustombg'
      ];

      foreach ($loginfiles as $setting) {
        if (!empty($theme->setting_file_url($setting, $setting))) {
            $templatecontext[$setting] = $theme->setting_file_url($setting,$setting);
        }
      }

      return $templatecontext;
  }


  /**
   * Get config theme team and urls
   *
   * @return array
   */
  public function team() {

      $theme = theme_config::load('alpha');

      $templatecontext = [];
      $teamitems = [
        'fpteam', 'showfpblock7hr', 'teammemberno'
      ];

      foreach ($teamitems as $setting) {
        if (!empty($theme->settings->$setting)) {
            $templatecontext[$setting] = $theme->settings->$setting;
        }
      }

      $teamitemshtml = [
        'fpteamtitle', 'fpteamcontent'
      ];

      foreach ($teamitemshtml as $setting) {
        if (!empty($theme->settings->$setting)) {
            $templatecontext[$setting] = format_text(($theme->settings->$setting),FORMAT_HTML, array('noclean' => true));
        }
      }

      $teamcount = $theme->settings->teamcount;

      for ($i = 1, $j = 0; $i <= $teamcount; $i++, $j++) {
        $teamimage = "teamimage{$i}";
        $teamurl = "teamurl{$i}";
        $teamname = "teamname{$i}";
        $teamtext = "teamtext{$i}";
        $teamcustomtext = "teamcustomtext{$i}";

        if (!empty($image = $theme->setting_file_url($teamimage, $teamimage))) {
          $templatecontext['team'][$j]['image'] = $image;
        }

        // image
        $teamimage = "teamimage{$i}";
        if (!empty($image = $theme->setting_file_url($teamimage, $teamimage))) {
          $templatecontext['team'][$j]['image'] = $image;
        }

        if (!empty($theme->settings->$teamurl)) {
          $templatecontext['team'][$j]['teamurl'] = $theme->settings->$teamurl;
        }

        if (!empty($theme->settings->$teamname)) {
          $templatecontext['team'][$j]['teamname'] = format_text(($theme->settings->$teamname),FORMAT_HTML, array('noclean' => true));
        }

        if (!empty($theme->settings->$teamtext)) {
          $templatecontext['team'][$j]['teamtext'] = format_text(($theme->settings->$teamtext),FORMAT_HTML, array('noclean' => true));
        }

        if (!empty($theme->settings->$teamcustomtext)) {
          $templatecontext['team'][$j]['teamcustomtext'] = format_text(($theme->settings->$teamcustomtext),FORMAT_HTML, array('noclean' => true));
        }
      }

      return $templatecontext;
  }

   /**
   * Get config theme heroslider and urls
   *
   * @return array
   */
   public function heroslider() {

       $theme = theme_config::load('alpha');

       $templatecontext['sliderenabled'] = $theme->settings->sliderenabled;
       $templatecontext['sliderwithouttext'] = $theme->settings->sliderwithouttext;
       $templatecontext['sliderintervalenabled'] = $theme->settings->sliderintervalenabled;
       $templatecontext['sliderinterval'] = $theme->settings->sliderinterval;
       $templatecontext['slidertextalign'] = $theme->settings->slidertextalign;
       $templatecontext['sliderfwenabled'] = $theme->settings->sliderfwenabled;

       if (empty($templatecontext['sliderenabled'])) {
           return $templatecontext;
       }

       $slidercount = $theme->settings->slidercount;

       for ($i = 1, $j = 0; $i <= $slidercount; $i++, $j++) {

			$slidertitle = "slidertitle{$i}";
			$slidersubtitle = "slidersubtitle{$i}";
			$slidercap = "slidercap{$i}";

			$fpblocksliderno = $i;

			$templatecontext['blockslider'][$j]['fpblocksliderno'] = $fpblocksliderno;

			$templatecontext['slides'][$j]['key'] = $j;
			$templatecontext['slides'][$j]['active'] = false;

			$templatecontext['slides'][$j]['title'] = format_text(($theme->settings->$slidertitle),FORMAT_HTML);
			$templatecontext['slides'][$j]['subtitle'] = format_text(($theme->settings->$slidersubtitle),FORMAT_HTML);
			$templatecontext['slides'][$j]['caption'] = format_text(($theme->settings->$slidercap),FORMAT_HTML);

			if ($i === 1) {
			   $templatecontext['slides'][$j]['active'] = true;
			}

			$sliderimage = "sliderimage{$i}";
			$image = $theme->setting_file_url($sliderimage, $sliderimage);
			if (empty($image)) {
			   $image = $OUTPUT->image_url('slide_default', 'theme');
			}
			$templatecontext['slides'][$j]['image'] = $image;
       }

       return $templatecontext;
   }

   public function logos() {

   	  $theme = theme_config::load('alpha');

       $templatecontext = [];
       $logositems = [
         'fplogos', 'showfpblock6hr', 'showfpblock6intro'
       ];

       foreach ($logositems as $setting) {
         if (!empty($theme->settings->$setting)) {
             $templatecontext[$setting] = $theme->settings->$setting;
         }
       }

       $logositemshtml = [
         'fplogostitle', 'fplogoscontent'
       ];

       foreach ($logositemshtml as $setting) {
         if (!empty($theme->settings->$setting)) {
             $templatecontext[$setting] = format_text(($theme->settings->$setting),FORMAT_HTML, array('noclean' => true));
         }
       }

       $logoscount = $theme->settings->logoscount;

       for ($i = 1, $j = 0; $i <= $logoscount; $i++, $j++) {
         $logosurl = "logosurl{$i}";
         $logosname = "logosname{$i}";

         // image
         $logosimage = "logosimage{$i}";
         if (!empty($image = $theme->setting_file_url($logosimage, $logosimage))) {
           $templatecontext['logos'][$j]['image'] = $image;
         }

         if (!empty($theme->settings->$logosurl)) {
           $templatecontext['logos'][$j]['logosurl'] = $theme->settings->$logosurl;
         }

         if (!empty($theme->settings->$logosname)) {
           $templatecontext['logos'][$j]['logosname'] = format_text(($theme->settings->$logosname),FORMAT_HTML, array('noclean' => true));
         }
       }

       return $templatecontext;
   }

	/**
	* Get config theme Custom Nav and urls
	*
	* @return array
	*/
	public function customnav() {
		$theme = theme_config::load('alpha');

    $templatecontext = [];

    $cnav = [
      'customnavicon', 'showcustomnav'
    ];

    foreach ($cnav as $setting) {
      if (!empty($theme->settings->$setting)) {
          $templatecontext[$setting] = $theme->settings->$setting;
      }
    }

    $cnavhtml = [
      'customnavhtml', 'extracustomnavhtml'
    ];

    foreach ($cnavhtml as $setting) {
      if (!empty($theme->settings->$setting)) {
        $templatecontext[$setting] = format_text(($theme->settings->$setting),FORMAT_HTML, array('noclean' => true));
      }
    }

		return $templatecontext;
	}



  /**
   * Get config theme Block #1 and urls
   *
   * @return array
   */
  public function block1() {
      $theme = theme_config::load('alpha');

      $templatecontext = [];
      $block1 = [
        'fpblock1', 'showfpblock1intro', 'showfpblock1hr', 'fpblock1layout'
      ];

      foreach ($block1 as $setting) {
        if (!empty($theme->settings->$setting)) {
            $templatecontext[$setting] = $theme->settings->$setting;
        }
      }

      $block1html = [
        'fpblock1title', 'fpblock1content'
      ];

      foreach ($block1html as $setting) {
        if (!empty($theme->settings->$setting)) {
            $templatecontext[$setting] = format_text(($theme->settings->$setting),FORMAT_HTML, array('noclean' => true));
        }
      }

      $fpblock1count = $theme->settings->fpblock1count;

      for ($i = 1, $j = 0; $i <= $fpblock1count; $i++, $j++) {
        $fpblock1icon = "fpblock1icon{$i}";
        $fpblock1heading = "fpblock1heading{$i}";
        $fpblock1text = "fpblock1text{$i}";

        $fpblock1no = $i;

        $templatecontext['block1'][$j]['fpblock1no'] = $fpblock1no;

        if (!empty($theme->settings->$fpblock1icon)) {
          $templatecontext['block1'][$j]['fpblock1icon'] = format_text(($theme->settings->$fpblock1icon),FORMAT_HTML, array('noclean' => true));
        }

        if (!empty($theme->settings->$fpblock1heading)) {
          $templatecontext['block1'][$j]['fpblock1heading'] = format_text(($theme->settings->$fpblock1heading),FORMAT_HTML, array('noclean' => true));
        }

        if (!empty($theme->settings->$fpblock1text)) {
          $templatecontext['block1'][$j]['fpblock1text'] = format_text(($theme->settings->$fpblock1text),FORMAT_HTML, array('noclean' => true));
        }

        // image
        $fpblock1imgicon = "fpblock1imgicon{$i}";
        if (!empty($image = $theme->setting_file_url($fpblock1imgicon, $fpblock1imgicon))) {
          $templatecontext['block1'][$j]['image'] = $image;
        }
      }

      return $templatecontext;
  }



    /**
   * Get config theme Block #2 and urls
   *
   * @return array
   */
  public function block2() {

		$theme = theme_config::load('alpha');

    $templatecontext = [];
    $block2 = [
      'fpblock2', 'showfpblock2intro', 'showfpblock2hr', 'fpblock2layout'
    ];

    foreach ($block2 as $setting) {
      if (!empty($theme->settings->$setting)) {
          $templatecontext[$setting] = $theme->settings->$setting;
      }
    }

    $block2html = [
      'fpblock2title', 'fpblock2content'
    ];

    foreach ($block2html as $setting) {
      if (!empty($theme->settings->$setting)) {
          $templatecontext[$setting] = format_text(($theme->settings->$setting),FORMAT_HTML, array('noclean' => true));
      }
    }

		$fpblock2count = $theme->settings->fpblock2count;


		for ($i = 1, $j = 0; $i <= $fpblock2count; $i++, $j++) {
			$fpblock2heading = "fpblock2heading{$i}";
			$fpblock2text = "fpblock2text{$i}";
			$fpblock2label = "fpblock2label{$i}";
			$fpblock2url = "fpblock2url{$i}";

			$fpblock2no = $i;

			$templatecontext['block2'][$j]['fpblock2no'] = $fpblock2no;

      if (!empty($theme->settings->$fpblock2heading)) {
        $templatecontext['block2'][$j]['fpblock2heading'] = format_text(($theme->settings->$fpblock2heading),FORMAT_HTML, array('noclean' => true));
      }

      if (!empty($theme->settings->$fpblock2text)) {
        $templatecontext['block2'][$j]['fpblock2text'] = format_text(($theme->settings->$fpblock2text),FORMAT_HTML, array('noclean' => true));
      }

      if (!empty($theme->settings->$fpblock2label)) {
        $templatecontext['block2'][$j]['fpblock2label'] = format_text(($theme->settings->$fpblock2label),FORMAT_HTML, array('noclean' => true));
      }

      if (!empty($theme->settings->$fpblock2url)) {
        $templatecontext['block2'][$j]['fpblock2url'] = $theme->settings->$fpblock2url;
      }

      // image
      $fpblock2image = "fpblock2image{$i}";
      if (!empty($image = $theme->setting_file_url($fpblock2image, $fpblock2image))) {
        $templatecontext['block2'][$j]['image'] = $image;
      }

		}

		return $templatecontext;
  }

  /**
   * Get config theme Block #8 and urls
   *
   * @return array
   */
  public function block8() {

      $theme = theme_config::load('alpha');

      $templatecontext = [];
      $block8 = [
        'fpblock8', 'showfpblock8intro', 'showfpblock8hr', 'fpblock8showbg', 'fpblock8slidesperrow'
      ];

      foreach ($block8 as $setting) {
        if (!empty($theme->settings->$setting)) {
            $templatecontext[$setting] = $theme->settings->$setting;
        }
      }

      $block8html = [
        'fpblock8title', 'fpblock8content'
      ];

      foreach ($block8html as $setting) {
        if (!empty($theme->settings->$setting)) {
            $templatecontext[$setting] = format_text(($theme->settings->$setting),FORMAT_HTML, array('noclean' => true));
        }
      }

      $fpblock8count = $theme->settings->fpblock8count;

      for ($i = 1, $j = 0; $i <= $fpblock8count; $i++, $j++) {
        $fpblock8first = "fpblock8first{$i}";
        $fpblock8second = "fpblock8second{$i}";
        $fpblock8third = "fpblock8third{$i}";
        $fpblock8no = $i;

        $templatecontext['block8'][$j]['fpblock8no'] = $fpblock8no;

        if (!empty($theme->settings->$fpblock8first)) {
          $templatecontext['block8'][$j]['fpblock8first'] = format_text(($theme->settings->$fpblock8first),FORMAT_HTML, array('noclean' => true));
        }

        if (!empty($theme->settings->$fpblock8second)) {
          $templatecontext['block8'][$j]['fpblock8second'] = format_text(($theme->settings->$fpblock8second),FORMAT_HTML, array('noclean' => true));
        }

        if (!empty($theme->settings->$fpblock8third)) {
          $templatecontext['block8'][$j]['fpblock8third'] = format_text(($theme->settings->$fpblock8third),FORMAT_HTML, array('noclean' => true));
        }

        // image
        $fpblock8image = "fpblock8image{$i}";
        if (!empty($image = $theme->setting_file_url($fpblock8image, $fpblock8image))) {
          $templatecontext['block8'][$j]['image'] = $image;
        }

      }

      return $templatecontext;
  }



  /**
   * Get config theme Block #9 and urls
   *
   * @return array
   */
  public function block9() {
      $theme = theme_config::load('alpha');

      $templatecontext = [];
      $block9 = [
        'fpblock9', 'showfpblock9intro', 'showfpblock9hr'
      ];

      foreach ($block9 as $setting) {
        if (!empty($theme->settings->$setting)) {
            $templatecontext[$setting] = $theme->settings->$setting;
        }
      }

      $block9html = [
        'fpblock9title', 'fpblock9content'
      ];

      foreach ($block9html as $setting) {
        if (!empty($theme->settings->$setting)) {
            $templatecontext[$setting] = format_text(($theme->settings->$setting),FORMAT_HTML, array('noclean' => true));
        }
      }

      $fpblock9count = $theme->settings->fpblock9count;

      for ($i = 1, $j = 0; $i <= $fpblock9count; $i++, $j++) {
        $fpblock9question = "fpblock9question{$i}";
        $fpblock9answer = "fpblock9answer{$i}";
        $fpblock9no = $i;

        $templatecontext['block9'][$j]['fpblock9no'] = $fpblock9no;

        if (!empty($theme->settings->$fpblock9question)) {
          $templatecontext['block9'][$j]['fpblock9question'] = format_text(($theme->settings->$fpblock9question),FORMAT_HTML, array('noclean' => true));
        }

        if (!empty($theme->settings->$fpblock9answer)) {
          $templatecontext['block9'][$j]['fpblock9answer'] = format_text(($theme->settings->$fpblock9answer),FORMAT_HTML, array('noclean' => true));
        }
      }

      return $templatecontext;
  }


  /**
   * Get config theme Block #10 and urls
   *
   * @return array
   */
  public function block10() {
      $theme = theme_config::load('alpha');

      $templatecontext = [];
      $block10 = [
        'fpblock10', 'showfpblock10intro', 'showfpblock10hr', 'fpblock10layout'
      ];

      foreach ($block10 as $setting) {
        if (!empty($theme->settings->$setting)) {
            $templatecontext[$setting] = $theme->settings->$setting;
        }
      }

      $block10html = [
        'fpblock10title', 'fpblock10content'
      ];

      foreach ($block10html as $setting) {
        if (!empty($theme->settings->$setting)) {
            $templatecontext[$setting] = format_text(($theme->settings->$setting),FORMAT_HTML, array('noclean' => true));
        }
      }

      $fpblock10count = $theme->settings->fpblock10count;

      for ($i = 1, $j = 0; $i <= $fpblock10count; $i++, $j++) {
        $fpblock10heading = "fpblock10heading{$i}";
        $fpblock10subheading = "fpblock10subheading{$i}";
        $fpblock10additionaltext = "fpblock10additionaltext{$i}";
        $fpblock10no = $i;

        $templatecontext['block10'][$j]['fpblock10no'] = $fpblock10no;

        if (!empty($theme->settings->$fpblock10additionaltext)) {
          $templatecontext['block10'][$j]['fpblock10additionaltext'] = format_text(($theme->settings->$fpblock10additionaltext),FORMAT_HTML, array('noclean' => true));
        }
        if (!empty($theme->settings->$fpblock10heading)) {
          $templatecontext['block10'][$j]['fpblock10heading'] = format_text(($theme->settings->$fpblock10heading),FORMAT_HTML, array('noclean' => true));
        }
        if (!empty($theme->settings->$fpblock10subheading)) {
          $templatecontext['block10'][$j]['fpblock10subheading'] = format_text(($theme->settings->$fpblock10subheading),FORMAT_HTML, array('noclean' => true));
        }

        // image
        $fpblock10imgicon = "fpblock10imgicon{$i}";
        if (!empty($image = $theme->setting_file_url($fpblock10imgicon, $fpblock10imgicon))) {
          $templatecontext['block10'][$j]['image'] = $image;
        }
      }

      return $templatecontext;
  }

  /**
   * Get config theme Block #12 and urls
   *
   * @return array
   */
  public function block12() {
    global $OUTPUT;
    $theme = theme_config::load('alpha');

    /***
    *
    *   HTML Block #8
    *
    ***/
        $templatecontext['fpblock12'] = $theme->settings->fpblock12;
        $templatecontext['showfpblock12intro'] = $theme->settings->showfpblock12intro;
        $templatecontext['showfpblock12hr'] = $theme->settings->showfpblock12hr;
        $templatecontext['fpblock12grid'] = $theme->settings->fpblock12grid;
        $templatecontext['fpblock12title'] = format_text(($theme->settings->fpblock12title),FORMAT_HTML);
        $templatecontext['fpblock12content'] = format_text(($theme->settings->fpblock12content),FORMAT_HTML);
        $templatecontext['fpblock12slidesperrow'] = $theme->settings->fpblock12slidesperrow;

        $fpblock12count = $theme->settings->fpblock12count;

        for ($i = 1, $j = 0; $i <= $fpblock12count; $i++, $j++) {
        $fpblock12first = "fpblock12first{$i}";
        $fpblock12second = "fpblock12second{$i}";
        $fpblock12third = "fpblock12third{$i}";
        $fpblock12html = "fpblock12html{$i}";
        $fpblock12no = $i;

        $templatecontext['block12'][$j]['fpblock12no'] = $fpblock12no;

        $templatecontext['block12'][$j]['fpblock12html'] = $theme->settings->$fpblock12html;
        $templatecontext['block12'][$j]['fpblock12first'] = format_text(($theme->settings->$fpblock12first),FORMAT_HTML);
        $templatecontext['block12'][$j]['fpblock12second'] = format_text(($theme->settings->$fpblock12second),FORMAT_HTML);
        $templatecontext['block12'][$j]['fpblock12third'] = format_text(($theme->settings->$fpblock12third),FORMAT_HTML);

        $fpblock12image = "fpblock12image{$i}";
        $image = $theme->setting_file_url($fpblock12image, $fpblock12image);
        if (empty($image)) {
                  continue;
        }
        $templatecontext['block12'][$j]['image'] = $image;

        }

        return $templatecontext;
}

  public function front_page_block() {
    global $OUTPUT;
		$theme = theme_config::load('alpha');

    $templatecontext['showfpblock11hr'] = $theme->settings->showfpblock11hr;
    $templatecontext['displaynavdrawerfp'] = $theme->settings->displaynavdrawerfp;

		/***
		*
		*   HERO
		*
		***/
    $templatecontext['herotextalign'] = $theme->settings->herotextalign;

    $templatecontext['herovideoenabled'] = $theme->settings->herovideoenabled;
    $templatecontext['heroimg'] = $theme->setting_file_url('heroimg', 'heroimg');
    $templatecontext['herovideomp4'] = $theme->setting_file_url('herovideomp4', 'herovideomp4');
    $templatecontext['herovideoposter'] = $theme->setting_file_url('herovideoposter', 'herovideoposter');
    $templatecontext['herovideoogv'] = $theme->setting_file_url('herovideoogv', 'herovideoogv');
    $templatecontext['herovideowebm'] = $theme->setting_file_url('herovideowebm', 'herovideowebm');
		$templatecontext['heroheading'] = format_text(($theme->settings->heroheading),FORMAT_HTML);
		$templatecontext['herotext'] = format_text(($theme->settings->herotext),FORMAT_HTML);
		$templatecontext['herotext2'] = format_text(($theme->settings->herotext2),FORMAT_HTML);
    $templatecontext['herohtml'] = $theme->settings->herohtml;

		/***
		*
		*   Custom Category Block
		*
		***/
		$templatecontext['fpcustomcategoryblock'] = $theme->settings->fpcustomcategoryblock;
    $templatecontext['showfpblock5hr'] = $theme->settings->showfpblock5hr;
		$templatecontext['showfpcustomcategoryintro'] = $theme->settings->showfpcustomcategoryintro;
		$templatecontext['fpcustomcategorytitle'] = format_text(($theme->settings->fpcustomcategorytitle),FORMAT_HTML);
		$templatecontext['fpcustomcategorycontent'] = format_text(($theme->settings->fpcustomcategorycontent),FORMAT_HTML);

		$templatecontext['fpcustomcategoryblockhtml1'] = format_text(($theme->settings->fpcustomcategoryblockhtml1),FORMAT_HTML);
		$templatecontext['fpcustomcategoryblockhtml2'] = format_text(($theme->settings->fpcustomcategoryblockhtml2),FORMAT_HTML);
		$templatecontext['fpcustomcategoryblockhtml3'] = format_text(($theme->settings->fpcustomcategoryblockhtml3),FORMAT_HTML);



		/***
		*
		*   HTML Block 3
		*
		***/
		$templatecontext['fpblock3'] = $theme->settings->fpblock3;
    $templatecontext['showfpblock3hr'] = $theme->settings->showfpblock3hr;
		$templatecontext['fpblock3heading'] = format_text(($theme->settings->fpblock3heading),FORMAT_HTML);
    $templatecontext['fpblock3text'] = format_text(($theme->settings->fpblock3text),FORMAT_HTML);
    $templatecontext['fpblock3html'] = $theme->settings->fpblock3html;
    $templatecontext['fpblock3bg'] = $theme->setting_file_url('fpblock3bg', 'fpblock3bg');

		/***
		*
		*   HTML Block 4
		*
		***/
		$templatecontext['fpblock4'] = $theme->settings->fpblock4;
    $templatecontext['showfpblock4hr'] = $theme->settings->showfpblock4hr;
		$templatecontext['fpblock4heading'] = format_text(($theme->settings->fpblock4heading),FORMAT_HTML);
		$templatecontext['fpblock4text'] = format_text(($theme->settings->fpblock4text),FORMAT_HTML);
		$templatecontext['fpblock4content'] = $theme->settings->fpblock4content;


    return $templatecontext;
  }


  public function top_bar_custom_block() {
      $theme = theme_config::load('alpha');

      $templatecontext['customtopnavhtml'] = $theme->settings->customtopnavhtml;
      $templatecontext['additionaltopbarnav'] = $theme->settings->additionaltopbarnav;
      $templatecontext['customlogotopbar'] = $theme->setting_file_url('customlogotopbar', 'customlogotopbar');

      return $templatecontext;
  }

  public function head_elements() {
      $theme = theme_config::load('alpha');

      $templatecontext['googlefonturl'] = $theme->settings->googlefonturl;
      $templatecontext['showloader'] = $theme->settings->showloader;
      $templatecontext['customwebfont'] = $theme->settings->customwebfont;
      $templatecontext['customwebfonthtml'] = $theme->settings->customwebfonthtml;

      $templatecontext['showauthorinfo'] = $theme->settings->showauthorinfo;

      return $templatecontext;
  }

  /**
   * Get config theme footer itens
   *
   * @return array
   */
  public function footer_items() {
      $theme = theme_config::load('alpha');

      $templatecontext = [];

      $templatecontext['showsociallist'] = $theme->settings->showsociallist;

      $footersettings = [
          'facebook', 'twitter', 'linkedin', 'youtube', 'instagram',
          'cwebsiteurl', 'website', 'mobile', 'mail', 'customsocialicon'
      ];

      foreach ($footersettings as $setting) {
          if (!empty($theme->settings->$setting)) {
              $templatecontext[$setting] = $theme->settings->$setting;
          }
      }

      $templatecontext['DisableBottomFooter'] = false;
      if (!empty($theme->settings->DisableBottomFooter)) {
          $templatecontext['DisableBottomFooter'] = true;
      }

      $templatecontext['customfootertext'] = format_text(($theme->settings->customfootertext),FORMAT_HTML);
      $templatecontext['copyrighttext'] = format_text(($theme->settings->copyrighttext),FORMAT_HTML);

      $templatecontext['customalert'] = $theme->settings->customalert;
      $templatecontext['customalertcontent'] = format_text(($theme->settings->customalertcontent),FORMAT_HTML);

      return $templatecontext;
  }

}
