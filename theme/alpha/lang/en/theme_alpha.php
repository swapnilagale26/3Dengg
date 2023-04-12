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
 * Language file.
 *
 * @package   theme_alpha
 * @copyright 2019 - 2020 Marcin Czaja - Rosea Themes
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
$siteurl = $CFG->wwwroot;

    $string['coursesections'] = 'Course sections';

    $string['bootswatch'] = 'Bootswatch';
    $string['bootswatch_desc'] = 'A bootswatch is a set of Bootstrap variables and css to style Bootstrap';
    $string['choosereadme'] = 'Alpha offers you the best Moodle experience ever. Friendly user experience and modern design will take your moodle website to the next level.
    <br>
    <div class="alert alert-info"><h4><strong>Important! Remember to clean global cache.</strong></h4>
    <strong>Go to:</strong> Dashboard → Site administration → Development → Purge all cache</div>
	<a class="btn btn-secondary" href="https://docs.alpha.rosea.io" target="_blank"><i class="fas fa-book mr-2"></i>  Documentation</a> <a class="mx-2 btn btn-secondary" href="https://themeforest.net/item/alpha-responsive-moodle-premium-theme/24146338/support" target="_blank"><i class="far fa-life-ring mr-2"></i>  Theme Support</a>';
    $string['currentinparentheses'] = '(current)';
    $string['currentinparentheses'] = '(current)';
    $string['configtitle'] = 'Alpha (1.5.5)';
    $string['nobootswatch'] = 'None';
    $string['pluginname'] = 'Alpha (1.5.5)';

    $string['HVariable'] = '<hr class="my-5"/>Colors Customization';
    $string['HVariable_desc'] = 'You can change colors of the theme using options below or custom CSS.';


    /***
    *
    *   Settings - Advanced
    *
    ***/
    $string['hscss'] = '<br /><hr /><br />Advanced SCSS';
    $string['hscss_desc'] = '';

    $string['privacy:metadata'] = 'The alpha theme does not store any personal data about any user.';
    $string['rawscss'] = 'Raw SCSS';
    $string['rawscss_desc'] = 'Use this field to provide SCSS or CSS code which will be injected at the end of the style sheet.';
    $string['rawscsspre'] = 'Raw initial SCSS';
    $string['rawscsspre_desc'] = 'In this field you can provide initialising SCSS code, it will be injected before everything else. Most of the time you will use this setting to define variables.';
    $string['region-side-pre'] = 'Right';
    $string['region-sidebar'] = 'Sidebar (Bottom)';
    $string['region-sidebar-top'] = 'Sidebar (Top)';
    $string['region-maintopwidgets'] = 'Main (top)';
    $string['region-mainfwidgets'] = 'Main (bottom)';
    $string['access'] = 'Get access';


    /* Login Page */
    $string['hloginpage'] = '';
    $string['hloginpage_desc'] = '<br /><div class="alert alert-info mb-2"><h4>Important! Remember to add logo for login page.</h4><strong>Go to:</strong> Dashboard → Site administration → Dashboard → Appearance → Logos</div><div class="alert alert-info mb-0"><h4>How to add instruction box on login page?</h4><strong>Go to:</strong> Dashboard → Site administration → Site administration → Plugins → Authentication → Manage authentication</div>';

    $string['loginpagesettings'] = 'Login Page';
    $string['showloginbg'] = '✓ Show Background Image';
    $string['showloginbg_desc'] = 'Turn on to show up background image on the login page';
    $string['logincustombg'] = '✚ Upload Login Background Image';
    $string['logincustombg_desc'] = '<strong>Remember</strong> to check the field: "Show Background Image".';
    $string['loginalignment'] = 'Login Box Position';
    $string['loginalignment_desc'] = 'You can display the login box on the left, right or on the middle.';
    $string['loginalignment-left'] = 'Left';
    $string['loginalignment-center'] = 'Center';
    $string['loginalignment-right'] = 'Right';

    $string['customloginlogo'] = 'Custom Logo<br />on the Login Page';
    $string['customloginlogo_desc'] = '<strong>Recommendation:</strong> SVG files or png files with transparent background.';

    $string['showloader'] = 'Page loader';
    $string['showloader_desc'] = "Turn on page load. The loader uses default primary color.";

    $string['hcustomfont'] = '<hr />Custom Font';
    $string['hcustomfont_desc'] = '';
    $string['customwebfont'] = 'Use custom Web Font (not Google Fonts)';
    $string['customwebfont_desc'] = "Turn on custom web font instead Google Fonts";
    $string['customwebfonthtml'] = 'Custom Web Font HTML';
    $string['customwebfonthtml_desc'] = "HTML code for custom web fonts.";


    $string['hgooglefont'] = '<hr />Google Fonts';
    $string['hgooglefont_desc'] = '<br /><p>List of fonts <a href="https://fonts.google.com" target="_blank">Google Fonts Library</a></p>';
    $string['googlefonturl'] = 'Google Font URL';
    $string['googlefonturl_desc'] = "URL address should include https://";

    $string['googlefontname'] = 'Font Name';
    $string['googlefontname_desc'] = 'Field for Google Fonts and Custom Web Fonts. E.g: Poppins, sans-serif';

    $string['fontweightregular'] = 'Font weight: Regular';
    $string['fontweightregular_desc'] = 'e.g 400';

    $string['fontweightmedium'] = 'Font weight: Medium';
    $string['fontweightmedium_desc'] = 'e.g 500, 600';

    $string['fontweightbold'] = 'Font weight: Bold';
    $string['fontweightbold_desc'] = 'e.g 700, 800, 900';


    /***
    *
    *   Settings - General
    *
    ***/
    $string['generalsettings'] = 'General';
    $string['favicon'] = 'Custom favicon';
    $string['favicon_desc'] = 'Upload your own favicon.  It should be an .ico file.';

    $string['presetfiles'] = 'Additional theme preset files';
    $string['presetfiles_desc'] = 'Preset files can be used to dramatically alter the appearance of the theme.';
    $string['preset'] = 'Theme preset';
    $string['preset_desc'] = 'Pick a preset to broadly change the look of the theme.';

    $string['themecolor'] = 'Theme Color #1';
    $string['themecolor_desc'] = '';

    $string['themecolor2'] = 'Theme Color #2';
    $string['themecolor2_desc'] = '';

    $string['themecolor3'] = 'Theme Color #3';
    $string['themecolor3_desc'] = '';

    $string['themecolor4'] = 'Theme Color #4';
    $string['themecolor4_desc'] = '';

    $string['themecolor5'] = 'Theme Color #5';
    $string['themecolor5_desc'] = '';

    $string['themecolor6'] = 'Theme Color #6';
    $string['themecolor6_desc'] = '';

    $string['themecolor7'] = 'Theme Color #7';
    $string['themecolor7_desc'] = '';

    $string['themecolor8'] = 'Theme Color #8';
    $string['themecolor8_desc'] = '';

    $string['themecolor9'] = 'Theme Color #9';
    $string['themecolor9_desc'] = '';

    $string['themegradient1'] = 'Theme Gradient #1<br /><small>Primary button</small>';
    $string['themegradient1_desc'] = '';

    $string['themegradient2'] = 'Theme Gradient #2<br /><small>Primary button</small>';
    $string['themegradient2_desc'] = '<br /><hr />';

    $string['gray100'] = 'Gray 100';
    $string['gray100_desc'] = '';

    $string['gray200'] = 'Gray 200';
    $string['gray200_desc'] = '';

    $string['gray300'] = 'Gray 300';
    $string['gray300_desc'] = '';

    $string['gray400'] = 'Gray 400';
    $string['gray400_desc'] = '';

    $string['gray500'] = 'Gray 500';
    $string['gray500_desc'] = '';

    $string['gray600'] = 'Gray 600';
    $string['gray600_desc'] = '';

    $string['gray700'] = 'Gray 700';
    $string['gray700_desc'] = '';

    $string['gray800'] = 'Gray 800';
    $string['gray800_desc'] = '';

    $string['gray900'] = 'Gray 900';
    $string['gray900_desc'] = '';

    $string['showauthorinfo'] = '✓ Show Author Info';
    $string['showauthorinfo_desc'] = 'Uncheck if you want to hide theme author info - visible in HTML code.';

    /***
    *
    *   Settings - Advanced settings tab
    *
    ***/
    $string['hgoogleanalytics'] = '<hr />Google Analytics';
    $string['hgoogleanalytics_desc'] = '';

    $string['advancedsettings'] = 'Advanced';
    $string['googleanalytics'] = 'Google Analytics Code';
    $string['googleanalytics_desc'] = 'Please enter your Google Analytics code to enable analytics on your website. The code format shold be like [UA-XXXXX-Y]';



    /***
    *
    *   Settings - Team on the Front Page
    *
    ***/
    $string['teamsettings'] = 'Block #7';
    $string['hteam'] = '<br />Team';
    $string['hteam_desc'] = 'List of team members. <br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-block7.png" class="img-fluid rounded mt-4" />';

    $string['fpteam'] = '✓ Turn on';
    $string['fpteam_desc'] = 'Turn on Team Block.';

  	$string['teammemberno'] = 'Number of team members per row';
  	$string['teammemberno_desc'] = 'Select how many team members you want to add then click SAVE to load the input fields.';

    $string['fpteamtitle'] = 'Section Title';
    $string['fpteamtitle_desc'] = 'Add section introduction title.';

    $string['fpteamcontent'] = 'Team section description';
    $string['fpteamcontent_desc'] = 'Team Block description';

    $string['teamcount'] = 'Number of team members';
    $string['teamcount_desc'] = '<div class="alert alert-warning"><strong><a href="#page-footer">Save to apply changes ► </a><br /></strong> Select how many team members you want to add then click SAVE to load the input fields.</div>';

    $string['h2team'] = '<hr /><br />List of Team Members';
    $string['h2team_desc'] = 'You can add up to 60 team members.';

    $string['teamtext'] = ' | <strong>Description</strong><br /><small>Team Member</small>';
    $string['teamtext_desc'] = '';

    $string['teamimage'] = ' | <strong>Image</strong><br /><small>Team Member</small><br /><small>280px x 410px</small>';
    $string['teamimage_desc'] = '<div class="alert alert-warning">Team member picture is required</div>';

    $string['teamname'] = ' | <strong>Name</strong><br /><small>Team Member</small>';
    $string['teamname_desc'] = '';

    $string['teamurl'] = ' | <strong>URL</strong><br /><small>Team Member</small>';
    $string['teamurl_desc'] = '';

    $string['teamcustomtext'] = ' | <strong>Custom HTML</strong><br /><small>Team Member</small>';
    $string['teamcustomtext_desc'] = 'Custom HTML Block for Team member. <br /><br /><br /><hr class="hr-bold" />';




    /***
    *
    *   Settings - Slider Tab
    *
    ***/

    $string['hheroslider'] = '<br />Hero Slider';
    $string['hheroslider_desc'] = 'up to 6 slides.';

    $string['heroslidersettings'] = 'Hero Slider';
    $string['sliderenabled'] = 'Turn on Hero Slider';
    $string['sliderwithouttext'] = 'Enable slider without text inside each images';
    $string['sliderwithouttext_desc'] = 'If you want to have image slider fully responsive (width and height) and you don\'t have content inside.';
    $string['sliderenabled_desc'] = '';
    $string['sliderintervalenabled'] = 'Enable slider interval';
    $string['sliderintervalenabled_desc'] = 'Turn on slider auto play.';
    $string['sliderinterval'] = 'Slider interval';
    $string['sliderinterval_desc'] = 'Units: 1000 -> 1s. Enable slider interval must be checked.';
    $string['sliderfrontpage'] = 'Show slideshow in frontpage';
    $string['sliderfrontpage_desc'] = 'If enabled, the slideshow will be showed in the frontpage page replacing the header image.';
    $string['h2slider'] = '<hr /><br />List of slides';
    $string['h2slider_desc'] = 'up to 6 slides.';
    $string['slidertextalign'] = 'Slider Text Align';
    $string['slidertextalign_desc'] = '';
    $string['slidercount'] = 'Slider count';
    $string['slidercount_desc'] = '<div class="alert alert-warning"><strong><a href="#page-footer">Save to apply changes ► </a><br /></strong> Select how many slides you want to add then click SAVE to load the input fields.</div>';
    $string['sliderimage'] = ' | Slider image';
    $string['sliderimage_desc'] = 'Add an image for your slide. Recommended size: 1320px x 650px';
    $string['slidertitle'] = ' | Slide title';
    $string['slidertitle_desc'] = 'Add the slide\'s title.<br/>If you want to add URL just add <pre>&lt;a href="YOUR URL"&gt;LINK LABEL&lt;/a&gt;</pre>';
    $string['slidersubtitle'] = ' | Slide sub title';
    $string['slidersubtitle_desc'] = 'Add the slide\'s sub title.<br/>If you want to add URL just add <pre>&lt;a href="YOUR URL"&gt;LINK LABEL&lt;/a&gt;</pre>';
    $string['slidercaption'] = ' | Slider caption';
    $string['slidercaption_desc'] = 'If you want to add buttons below just add this code:<br/><pre>&lt;div class="row mt-5 justify-content-center"&gt;
    &lt;a href="http://LINK" class="my-2 mr-2 ml-2 btn btn-cta btn-cta--primary"&gt;Sign in&lt;/a&gt;
    &lt;a href="https://LINK2" class="my-2 mr-2 ml-2 btn btn-cta btn-cta--secondary"&gt;But this theme&lt;/a&gt;
&lt;/div&gt;</pre><br /><hr class="hr-bold"/>';

    $string['sliderfwenabled'] = 'Full width slider';
    $string['sliderfwenabled_desc'] = 'Slider container will have full width instead of max-width: 1440px';

    /***
    *
    *   Settings - Sidebar Tab
    *
    ***/
    $string['sidebarsettings'] = '▐░ Sidebar';

    $string['SidebarButtonIconOpen'] = 'Sidebar Button Icon';
    $string['SidebarButtonIconOpen_desc'] = 'Add class <strong>opened</strong>. You can use custom SVG icon or FontAwesome. More icons you can find here: <a href="https://fontawesome.com/icons">FontAwesome</a>';

    $string['SidebarButtonIconClose'] = 'Sidebar Close Button Icon';
    $string['SidebarButtonIconClose_desc'] = 'Add class <strong>closed</strong>. You can use custom SVG icon or FontAwesome. More icons you can find here: <a href="https://fontawesome.com/icons">FontAwesome</a>';

    $string['hsidebarcustombox'] = '<div class="alert alert-info mt-3"><h4>Language menu</h4><ol class="mb-0"><li>Go to: Dashboard → Site administration → Language → Language settings</li><li>Check: Display language menu</li><li>Save</li></ol></div><hr /><br />Sidebar Custom Box';
    $string['hsidebarcustombox_desc'] = '';

    $string['customrooturl'] = 'Custom Root URL';
    $string['customrooturl_desc'] = '';

    $string['customlogosidebar'] = '✓ Custom sidebar logo';
    $string['customlogosidebar_desc'] = 'Upload custom sidebar logo.<br><strong>Recommendation:</strong> SVG files or png files with transparent background.<br><strong>Logo width:</strong> 216px or double (432px) or triple (648px) of 216px for retina displays.';

    $string['showsidebarlogo'] = '✓ Show logo on the sidebar';
    $string['showsidebarlogo_desc'] = '';

    $string['hiddensidebar'] = '✓ Hidden sidebar';
    $string['hiddensidebar_desc'] = '';

    $string['showmycourses'] = '✓ Expand "My courses"';
    $string['showmycourses_desc'] = 'Check this field if you want to have "My courses" menu expanded. <br /> To edit "My courses" menu go to Dashboard → Site administration → Appearance → Navigation';

    $string['sidebarcustombox'] = '✓ Sidebar<br />Custom Box';
    $string['sidebarcustombox_desc'] = 'Select to turn on Custom Sidebar Custom Box';
    $string['sidebarcustomheading'] = 'Sidebar<br />Custom Heading';
    $string['sidebarcustomheading_desc'] = 'Sidebar Custom Heading';
    $string['sidebarcustomtext'] = 'Sidebar<br />Custom Text';
    $string['sidebarcustomtext_desc'] = 'You can add whatever you want using HTML';

    $string['hsidebarcustomnav'] = '<hr /><br />Sidebar Custom Navigation';
    $string['hsidebarcustomnav_desc'] = 'Additional sidebar navigation block.';

    $string['sidebarcustomnav'] = '✓ Sidebar<br />Custom Navigation';
    $string['sidebarcustomnav_desc'] = 'Select to turn on Custom Sidebar Navigation Box';
    $string['sidebarcustomnavtitle'] = 'Sidebar<br/>Custom Navigation Title';
    $string['sidebarcustomnavtitle_desc'] = 'Heading for Custom Navigation Box';
    $string['sidebarcustomnavigationlinks'] = 'Sidebar<br/>Custom Navigation List of Links';
    $string['sidebarcustomnavigationlinks_desc'] = 'You can add custom navigation using HTML
    <br /><strong>Example:</strong> <pre><code>&lt;ul&gt;
&lt;li&gt;&lt;a href=&quot;http://limonija.com&quot;&gt;Limonija &lt;i class=&quot;fas fa-external-link-alt&quot;&gt;&lt;/i&gt;&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://rosea.io&quot;&gt;Rosea Themes &lt;i class=&quot;fas fa-external-link-alt&quot;&gt;&lt;/i&gt;&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;</code></pre>';


    $string['hadditionaltext'] = '<hr /><br />Sidebar - Additional Text';
    $string['hadditionaltext_desc'] = 'Additional sidebar section on the bottom of the sidebar.';

    $string['showadditionaltext'] = '✓ Turn on';
    $string['showadditionaltext_desc'] = 'Show Additional Text on bottom of the left sidebar.';
    $string['additionaltext'] = 'Additional Custom Text';
    $string['additionaltext_desc'] = 'You can add custom text or html
    <br /><strong>Example:</strong> <pre><code>&lt;i class=&quot;fas fa-phone mr-3&quot;&gt;&lt;/i&gt;&lt;strong&gt;Need help?&lt;/strong&gt; +48 888 932 322</code></pre><br />More icons → <a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">FontAwesome</a>';



    $string['hsidebarcolors'] = '<hr /><br />Sidebar - Customization';
    $string['hsidebarcolors_desc'] = '';

    $string['drawerbg'] = 'Sidebar<br />Background Color';
    $string['drawerbg_desc'] = 'Default: #1E1E2C<br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-sidebar-bgcolor.png" class="img-fluid rounded mt-2" /><hr />';

    $string['drawerbordercolor'] = 'Sidebar<br />Border Color';
    $string['drawerbordercolor_desc'] = 'Default: #303248<br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-sidebar-bordercolor.png" class="img-fluid rounded mt-2" /><hr />';

    $string['drawericonscolor'] = 'Sidebar<br />Icons Color';
    $string['drawericonscolor_desc'] = 'Default: #494B74<br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-sidebar-iconscolor.png" class="img-fluid rounded mt-2" /><hr />';

    $string['drawericonscolorhover'] = 'Sidebar<br />Icons Color - Hover and Active';
    $string['drawericonscolorhover_desc'] = 'Default: #6866ED<br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-sidebar-iconscolorhover.png" class="img-fluid rounded mt-2" /><hr />';

    $string['drawerheadingcolor'] = 'Sidebar<br />Heading Color';
    $string['drawerheadingcolor_desc'] = 'Default: #67698c<br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-sidebar-headingcolor.png" class="img-fluid rounded mt-2" /><hr />';

    $string['drawerlinkactivecolor'] = 'Sidebar<br />Link - Active';
    $string['drawerlinkactivecolor_desc'] = 'Default: #13121d<br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-sidebar-linkactivecolor.png" class="img-fluid rounded mt-2" /><hr />';

    $string['drawerlinkhovercolor'] = 'Sidebar<br />Link - Hover Color';
    $string['drawerlinkhovercolor_desc'] = 'Default: #2d2c3a<br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-sidebar-linkhovercolor.png" class="img-fluid rounded mt-2" /><hr />';

    $string['drawertext'] = 'Sidebar<br />Text';
    $string['drawertext_desc'] = 'Default: #ffffff<br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-sidebar-text.png" class="img-fluid rounded mt-2" /><hr />';

    $string['drawerscrollbar'] = 'Sidebar<br />Scrollbar';
    $string['drawerscrollbar_desc'] = 'Default: #ffffff<br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-sidebar-scrollbar.png" class="img-fluid rounded mt-2" /><hr />';

    $string['drawerbtngradient1'] = 'Sidebar<br />Button Gradient Color #1';
    $string['drawerbtngradient1_desc'] = 'Default: #616486.<br />If you want to change button text color just add custom CSS in Advanced tab.<br />Example: <pre><code>.c-lang-menu .dropdown-toggle { color:# fff; }</code></pre><br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-sidebar-btngradient1.png" class="img-fluid rounded mt-2" /><hr />';

    $string['drawerbtngradient2'] = 'Sidebar<br />Button Gradient Color #2';
    $string['drawerbtngradient2_desc'] = 'Default: #333146<br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-sidebar-btngradient2.png" class="img-fluid rounded mt-2" />';



    /***
    *
    *   Settings - Front Page
    *
    ***/
    $string['frontpagesettings'] = 'Hero Image';
    $string['herovideosettings'] = 'Hero Video';


    /***
    *
    *   Hero
    *
    ***/

    $string['heroimg'] = 'Hero Image';
    $string['heroimg_desc'] = 'Upload Hero Image to display Hero block on the front page. Recommended size: 1320px x 650px';

    $string['herovideoenabled'] = 'Turn on Hero Video';
    $string['herovideoenabled_desc'] = '<span class="badge badge-danger"><strong class="mr-1">Important:</strong> You have to add <strong class="mx-1">mp4</strong>, <strong class="mx-1">webm</strong> and <strong class="mx-1">poster</strong> which will be a placeholder.</span>';

    $string['herovideofwenabled'] = 'Full width Hero Video';
    $string['herovideofwenabled_desc'] = '';

    $string['herovideocontent'] = '<small>Hero</small><br />Video Content';
    $string['herovideocontent_desc'] = '';

    $string['herovideoposter'] = 'Hero Video Background (poster)';
    $string['herovideoposter_desc'] = '';

    $string['herovideomp4'] = 'Hero Video Background (mp4)';
    $string['herovideomp4_desc'] = '';

    $string['herovideoogv'] = 'Hero Video Background (ogv)';
    $string['herovideoogv_desc'] = '';

    $string['herovideowebm'] = 'Hero Video Background (webm)';
    $string['herovideowebm_desc'] = '';

    $string['herotextalign'] = 'Hero Text Align';
    $string['herotextalign_desc'] = '';

    $string['herohtml'] = 'Hero HTML';
    $string['herohtml_desc'] = '';

    $string['heroheading'] = 'Heading';
    $string['heroheading_desc'] = 'Main Heading on the Hero image';

    $string['herotext'] = 'Text';
    $string['herotext_desc'] = 'Code snippets:<br />
    <h4>Buttons - middle of the site.</h4>
    <pre><code>&#x3C;div class=&#x22;row no-gutters mt-5 justify-content-center&#x22;&#x3E;
     &#x3C;a href=&#x22;#&#x22; class=&#x22;my-2 mr-2 btn btn-cta btn-cta--primary&#x22;&#x3E;Label 1&#x3C;/a&#x3E;
     &#x3C;a href=&#x22;#&#x22; class=&#x22;my-2 mr-2 btn btn-cta btn-cta--secondary&#x22;&#x3E;Label 2&#x3C;/a&#x3E;
    &#x3C;/div&#x3E;</code></pre>
    <h4>Buttons - align to the left</h4>
    <pre><code>&#x3C;div class=&#x22;row no-gutters mt-5 justify-content-start&#x22;&#x3E;
     &#x3C;a href=&#x22;#&#x22; class=&#x22;my-2 mr-2 btn btn-cta btn-cta--primary&#x22;&#x3E;Label 1&#x3C;/a&#x3E;
     &#x3C;a href=&#x22;#&#x22; class=&#x22;my-2 mr-2 btn btn-cta btn-cta--secondary&#x22;&#x3E;Label 2&#x3C;/a&#x3E;
    &#x3C;/div&#x3E;</code></pre>
    ';

    $string['herotext2'] = 'Additional Text<br /><small>First line of text</small>';
    $string['herotext2_desc'] = 'Additional Text on the Hero image<br /><br /><br /><hr class="hr-bold" />';



    /* hr */
    $string['showfpblock1hr'] = 'Show separator';
    $string['showfpblock1hr_desc'] = '';

    $string['showfpblock2hr'] = 'Show separator';
    $string['showfpblock2hr_desc'] = '';

    $string['showfpblock3hr'] = 'Show separator';
    $string['showfpblock3hr_desc'] = '';

    $string['showfpblock4hr'] = 'Show separator';
    $string['showfpblock4hr_desc'] = '';

    $string['showfpblock5hr'] = 'Show separator';
    $string['showfpblock5hr_desc'] = '';

    $string['showfpblock6hr'] = 'Show separator';
    $string['showfpblock6hr_desc'] = '';

    $string['showfpblock7hr'] = 'Show separator';
    $string['showfpblock7hr_desc'] = '';

    $string['showfpblock8hr'] = 'Show separator';
    $string['showfpblock8hr_desc'] = '';

    $string['showfpblock9hr'] = 'Show separator';
    $string['showfpblock9hr_desc'] = '';

    $string['showfpblock10hr'] = 'Show separator';
    $string['showfpblock10hr_desc'] = '';

    $string['showfpblock11hr'] = 'Show separator';
    $string['showfpblock11hr_desc'] = '';

    $string['showfpblock12hr'] = 'Show separator';
    $string['showfpblock12hr_desc'] = '';

    /***
    *
    *   Custom Categories Block
    *
    ***/
    $string['fpcustomcategoryblocksettings'] = 'Block #5';

    $string['hfpcustomcategoryblock'] = '<br />Block #5';
    $string['hfpcustomcategoryblock_desc'] = 'Custom Categories Block. <br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-block5.png" class="img-fluid rounded mt-4" />';

    $string['fpcustomcategoryblock'] = '✓ Turn on';
    $string['fpcustomcategoryblock_desc'] = 'Turn on Custom Categories Block.';

    $string['showfpcustomcategoryintro'] = '✓ Show intro';
    $string['showfpcustomcategoryintro_desc'] = 'Turn on Show intro contains section title and introduction text.';

    $string['fpcustomcategorytitle'] = 'Section Title';
    $string['fpcustomcategorytitle_desc'] = 'Add section introduction title.';

    $string['fpcustomcategorycontent'] = 'Content';
    $string['fpcustomcategorycontent_desc'] = 'Add section introduction content.';

    $string['fpcustomcategoryblockhtml1'] = '●○○ Content #1<br /><sup>(left)</sup>';
    $string['fpcustomcategoryblockhtml1_desc'] = '<strong>First switch to HTML view.</strong><img src="'.$siteurl.'/theme/alpha/doc/htmlview.png" class="img-fluid mt-2 mb-4" ><br /> Custom HTML for Custom Categories Block
    <br /><strong>Example:</strong> <pre><code>&#x3C;h4 class=&#x22;c-courses-list-heading mb-4&#x22;&#x3E;Heading&#x3C;/h4&#x3E;
&#x3C;ul class=&#x22;c-courses-list&#x22;&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=9&#x22;&#x3E;Celebrating Cultures&#x3C;/a&#x3E;&#x3C;/li&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=8&#x22;&#x3E;Introduction to Open Education&#x3C;/a&#x3E;&#x3C;/li&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=7&#x22;&#x3E;Digital Literacy&#x3C;/a&#x3E;&#x3C;/li&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=6&#x22;&#x3E;Celebrating Cultures&#x3C;/a&#x3E;&#x3C;/li&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=9&#x22;&#x3E;Celebrating Cultures&#x3C;/a&#x3E;&#x3C;/li&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=8&#x22;&#x3E;Introduction to Open Education&#x3C;/a&#x3E;&#x3C;/li&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=7&#x22;&#x3E;Digital Literacy&#x3C;/a&#x3E;&#x3C;/li&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=6&#x22;&#x3E;Celebrating Cultures&#x3C;/a&#x3E;&#x3C;/li&#x3E;
&#x3C;/ul&#x3E;</code></pre>';

    $string['fpcustomcategoryblockhtml2'] = '○●○ Content #2<br /><sup>(middle)</sup>';
    $string['fpcustomcategoryblockhtml2_desc'] = '<strong>First switch to HTML view.</strong><img src="'.$siteurl.'/theme/alpha/doc/htmlview.png" class="img-fluid mt-2 mb-4" ><br /> Custom HTML for Custom Categories Block
    <br /><strong>Example:</strong> <pre><code>&#x3C;h4 class=&#x22;c-courses-list-heading mb-4&#x22;&#x3E;Heading&#x3C;/h4&#x3E;
&#x3C;ul class=&#x22;c-courses-list&#x22;&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=9&#x22;&#x3E;Celebrating Cultures&#x3C;/a&#x3E;&#x3C;/li&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=8&#x22;&#x3E;Introduction to Open Education&#x3C;/a&#x3E;&#x3C;/li&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=7&#x22;&#x3E;Digital Literacy&#x3C;/a&#x3E;&#x3C;/li&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=6&#x22;&#x3E;Celebrating Cultures&#x3C;/a&#x3E;&#x3C;/li&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=9&#x22;&#x3E;Celebrating Cultures&#x3C;/a&#x3E;&#x3C;/li&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=8&#x22;&#x3E;Introduction to Open Education&#x3C;/a&#x3E;&#x3C;/li&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=7&#x22;&#x3E;Digital Literacy&#x3C;/a&#x3E;&#x3C;/li&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=6&#x22;&#x3E;Celebrating Cultures&#x3C;/a&#x3E;&#x3C;/li&#x3E;
&#x3C;/ul&#x3E;</code></pre>';

    $string['fpcustomcategoryblockhtml3'] = '○○● Content #3<br /><sup>(right)</sup>';
    $string['fpcustomcategoryblockhtml3_desc'] = '<strong>First switch to HTML view.</strong><img src="'.$siteurl.'/theme/alpha/doc/htmlview.png" class="img-fluid mt-2 mb-4" ><br /> Custom HTML for Custom Categories Block
    <br /><strong>Example:</strong> <pre><code>&#x3C;h4 class=&#x22;c-courses-list-heading mb-4&#x22;&#x3E;Heading&#x3C;/h4&#x3E;
&#x3C;ul class=&#x22;c-courses-list&#x22;&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=9&#x22;&#x3E;Celebrating Cultures&#x3C;/a&#x3E;&#x3C;/li&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=8&#x22;&#x3E;Introduction to Open Education&#x3C;/a&#x3E;&#x3C;/li&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=7&#x22;&#x3E;Digital Literacy&#x3C;/a&#x3E;&#x3C;/li&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=6&#x22;&#x3E;Celebrating Cultures&#x3C;/a&#x3E;&#x3C;/li&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=9&#x22;&#x3E;Celebrating Cultures&#x3C;/a&#x3E;&#x3C;/li&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=8&#x22;&#x3E;Introduction to Open Education&#x3C;/a&#x3E;&#x3C;/li&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=7&#x22;&#x3E;Digital Literacy&#x3C;/a&#x3E;&#x3C;/li&#x3E;
    &#x3C;li&#x3E;&#x3C;a href=&#x22;course/view.php?id=6&#x22;&#x3E;Celebrating Cultures&#x3C;/a&#x3E;&#x3C;/li&#x3E;
&#x3C;/ul&#x3E;</code></pre>';


    /***
    *
    *   HTML Block 1
    *
    ***/
    $string['fpblock1settings'] = 'Block #1';
    $string['hfpblock1'] = '<br />Block #1';
    $string['hfpblock1_desc'] = '4-column, repeatable block.<br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-block1.png" class="img-fluid rounded mt-4" />';

    $string['fpblock1'] = '✓ Turn on';
    $string['fpblock1_desc'] = 'Select to turn on HTML Block #1 on the front page';

    $string['showfpblock1intro'] = '✓ Show intro';
    $string['showfpblock1intro_desc'] = 'Turn on Show intro contains section title and introduction text.';

    $string['fpblock1title'] = 'Section Title';
    $string['fpblock1title_desc'] = 'Add section introduction title.';

    $string['fpblock1content'] = 'Content';
    $string['fpblock1content_desc'] = 'Add section introduction content.';

    $string['h2fpblock1'] = '<hr /><br />List of items';
    $string['h2fpblock1_desc'] = 'up to 60 items. (4 per row)<br /><br /><div class="alert alert-light text-left"><h4>Icons color</h4><p>If you want to change icons color you can do it via General Settings or via SASS (Advanced settings tab).</p><br />
    <pre><code>.c-special-box-icon { background-color: #d5e7ff; width: 60px; height: 60px; border-radius: 10px; }<br />.c-special-box-icon i { color: #0972ff; }</code></pre>
    <p>If you want to change color single element just add his ID (#block1-1, #block1-2, etc.) name e.g </p>
    <pre><code>#block1-1 .c-special-box-icon { background-color: #d5e7ff; width: 60px; height: 60px; border-radius: 10px; }<br />#block1-1 .c-special-box-icon i { color: #0972ff; }</code></pre></div>';

    $string['fpblock1count'] = 'Number of blocks';
    $string['fpblock1count_desc'] = '<div class="alert alert-warning"><strong><a href="#page-footer">Save to apply changes ► </a><br /></strong> Select how many items you want to add then click SAVE to load the input fields.</div>';

    $string['fpblock1icon'] = ' | Icon';
    $string['fpblock1icon_desc'] = 'Icon for Custom HTML Block.<br />More icons → <a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">FontAwesome</a>.
    <br /><strong>Example:</strong> <pre><code>&lt;i class=&quot;fas fa-bolt&quot;&gt;&lt;/i&gt;</code></pre><br />';

    $string['fpblock1imgicon'] = ' | Image';
    $string['fpblock1imgicon_desc'] = '';

    $string['fpblock1heading'] = ' | Heading';
    $string['fpblock1heading_desc'] = '';

    $string['fpblock1text'] = ' | Content';
    $string['fpblock1text_desc'] = '<br /><hr class="hr-bold"/>';

    $string['fpblock1layout'] = 'Number of columns';
    $string['fpblock1layout_desc'] = '';


    /***
    *
    *   HTML Block 2
    *
    ***/
    $string['fpblock2settings'] = 'Block #2';

    $string['hfpblock2'] = '<br />Block #2';
    $string['hfpblock2_desc'] = '2-column, repeatable block.<br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-block2.jpg" class="img-fluid rounded mt-4" />';

    $string['fpblock2'] = '✓ Turn on';
    $string['fpblock2_desc'] = 'Select to turn on HTML Block #2 on the front page';

    $string['showfpblock2intro'] = '✓ Show intro';
    $string['showfpblock2intro_desc'] = 'Turn on Show intro contains section title and introduction text.';

    $string['fpblock2title'] = 'Section Title';
    $string['fpblock2title_desc'] = 'Add section introduction title.';

    $string['fpblock2content'] = 'Content';
    $string['fpblock2content_desc'] = 'Add section introduction content.';

    $string['h2fpblock2'] = '<hr />Blocks';
    $string['h2fpblock2_desc'] = 'You can add up to 60 blocks.';

    $string['fpblock2count'] = 'Number of blocks';
    $string['fpblock2count_desc'] = '<div class="alert alert-warning"><strong><a href="#page-footer">Save to apply changes ► </a><br /></strong> Select how many items you want to add then click SAVE to load the input fields.</div>';

    $string['fpblock2heading'] = ' | Heading';
    $string['fpblock2heading_desc'] = 'Add Heading #1 for Custom HTML Block';

    $string['fpblock2image'] = ' | Image';
    $string['fpblock2image_desc'] = 'svg, png, jpg, gif';

    $string['fpblock2text'] = ' | Content';
    $string['fpblock2text_desc'] = 'Add description for Custom HTML Block';

    $string['fpblock2label'] = ' | Link<br /><small>Label</small>';
    $string['fpblock2label_desc'] = 'Add Link Label - Custom HTML Block ';

    $string['fpblock2url'] = ' | Link<br /><small>URL</small>';
    $string['fpblock2url_desc'] = 'Add URL for Link - Custom HTML Block, eg. http://sample.com<br /><br /><br /><hr class="hr-bold"/>';

    $string['fpblock2layout'] = 'Number of columns';
    $string['fpblock2layout_desc'] = '';



    /***
    *
    *   HTML Block 3
    *
    ***/
    $string['fpblock3settings'] = 'Block #3';

    $string['hfpblock3'] = '<br />Block #3';
    $string['hfpblock3_desc'] = 'Call to action block.<br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-block3.jpg" class="img-fluid rounded mt-4" />';

    $string['fpblock3'] = '✓ Turn on';
    $string['fpblock3_desc'] = 'Select to turn on HTML Block #3 on the front page. If you want to add some custom CSS just override this class <strong>.s-special-box-bg-cta</strong>';

    $string['fpblock3heading'] = 'Heading';
    $string['fpblock3heading_desc'] = '';

    $string['fpblock3text'] = 'Text';
    $string['fpblock3text_desc'] = '';

    $string['fpblock3html'] = 'Custom HTML';
    $string['fpblock3html_desc'] = '';

    $string['fpblock3bg'] = 'Background';
    $string['fpblock3bg_desc'] = '';




    /***
    *
    *   HTML Block 4
    *
    ***/
    $string['fpblock4settings'] = 'Block #4';
    $string['hfpblock4'] = '<br />Block #4';
    $string['hfpblock4_desc'] = 'Single column custom HTML block on the front page.<br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-block4.png" class="img-fluid rounded mt-4" />';

    $string['fpblock4'] = '✓ Turn on';
    $string['fpblock4_desc'] = 'Select to turn on HTML Block #4 on the front page.';

    $string['fpblock4heading'] = 'Heading';
    $string['fpblock4heading_desc'] = 'Add Heading for Custom HTML Block #4';

    $string['fpblock4text'] = 'Text';
    $string['fpblock4text_desc'] = 'Add description for Custom HTML Block #4';

    $string['fpblock4content'] = 'Block HTML Content';
    $string['fpblock4content_desc'] = 'HTML Content<br />Example:<br /><pre><code>&#x3C;form action=&#x22;&#x22;&#x3E;
&#x9;&#x3C;div class=&#x22;row col-sm-12 col-md-6 align-items-center d-inline-flex&#x22;&#x3E;
&#x9;&#x9;&#x3C;div class=&#x22;col-sm-12 col-md&#x22;&#x3E;
&#x9;&#x9;&#x9;&#x3C;input class=&#x22;w-100&#x22; type=&#x22;text&#x22; name=&#x22;firstname&#x22; value=&#x22;&#x22; placeholder=&#x22;First name:&#x22;&#x3E;
&#x9;&#x9;&#x3C;/div&#x3E;
&#x9;&#x9;&#x3C;div class=&#x22;col-sm-12 col-md&#x22;&#x3E;
&#x9;&#x9;&#x9;&#x3C;input type=&#x22;submit&#x22;  class=&#x22;w-100 btn btn-primary&#x22; value=&#x22;Submit&#x22;&#x3E;
&#x9;&#x9;&#x3C;/div&#x3E; &#x9;&#x9;
&#x9;&#x3C;/div&#x3E;
&#x3C;/form&#x3E;</code></pre>';



    /***
    *
    *   Settings - Top Bar
    *
    ***/
    $string['hcustomtopnav'] = '<div class="alert alert-info mt-3"><h4>Search button</h4><ol class="mb-0"><li>Go to: Dashboard → Site administration → Advanced features</li><li>Check: Enable global search</li><li>Save</li></ol></div>';
    $string['hcustomtopnav_desc'] = '';

    $string['customlogotopbar'] = '✓ Custom logo';
    $string['customlogotopbar_desc'] = 'Upload custom logo.';

    $string['topbarsettings'] = 'Top Bar';
	$string['customtopnavhtml'] = 'Custom Top Navigation HTML';
    $string['customtopnavhtml_desc'] = 'Example:<br /><pre><code>&#x3C;ul class=&#x22;navbar-nav mr-auto&#x22;&#x3E;
            &#x3C;li class=&#x22;nav-item active&#x22;&#x3E;
              &#x3C;a class=&#x22;nav-link&#x22; href=&#x22;#&#x22;&#x3E;Home &#x3C;span class=&#x22;sr-only&#x22;&#x3E;(current)&#x3C;/span&#x3E;&#x3C;/a&#x3E;
            &#x3C;/li&#x3E;
            &#x3C;li class=&#x22;nav-item&#x22;&#x3E;
              &#x3C;a class=&#x22;nav-link&#x22; href=&#x22;#&#x22;&#x3E;Link&#x3C;/a&#x3E;
            &#x3C;/li&#x3E;
            &#x3C;li class=&#x22;nav-item dropdown&#x22;&#x3E;
              &#x3C;a class=&#x22;nav-link dropdown-toggle&#x22; href=&#x22;#&#x22; id=&#x22;navbarDropdown&#x22; role=&#x22;button&#x22; data-toggle=&#x22;dropdown&#x22; aria-haspopup=&#x22;true&#x22; aria-expanded=&#x22;false&#x22;&#x3E;Dropdown&#x3C;/a&#x3E;
              &#x3C;div class=&#x22;dropdown-menu&#x22; aria-labelledby=&#x22;navbarDropdown&#x22;&#x3E;
                &#x3C;a class=&#x22;dropdown-item&#x22; href=&#x22;#&#x22;&#x3E;Action&#x3C;/a&#x3E;
                &#x3C;a class=&#x22;dropdown-item&#x22; href=&#x22;#&#x22;&#x3E;Another action&#x3C;/a&#x3E;
                &#x3C;div class=&#x22;dropdown-divider&#x22;&#x3E;&#x3C;/div&#x3E;
                &#x3C;a class=&#x22;dropdown-item&#x22; href=&#x22;#&#x22;&#x3E;Something else here&#x3C;/a&#x3E;
              &#x3C;/div&#x3E;
            &#x3C;/li&#x3E;
&#x3C;/ul&#x3E;</code></pre>
<br />
<strong>With multiple submenus</strong>
<pre><code>&#x3C;div id=&#x22;navbarNavDropdown&#x22;&#x3E;
&#x3C;ul class=&#x22;navbar-nav&#x22;&#x3E;
    &#x3C;li class=&#x22;nav-item active&#x22;&#x3E;
        &#x3C;a class=&#x22;nav-link&#x22; href=&#x22;#&#x22;&#x3E;Home &#x3C;span class=&#x22;sr-only&#x22;&#x3E;(current)&#x3C;/span&#x3E;&#x3C;/a&#x3E;
    &#x3C;/li&#x3E;
    &#x3C;li class=&#x22;nav-item&#x22;&#x3E;
        &#x3C;a class=&#x22;nav-link&#x22; href=&#x22;#&#x22;&#x3E;Features&#x3C;/a&#x3E;
    &#x3C;/li&#x3E;
    &#x3C;li class=&#x22;nav-item&#x22;&#x3E;
        &#x3C;a class=&#x22;nav-link&#x22; href=&#x22;#&#x22;&#x3E;Pricing&#x3C;/a&#x3E;
    &#x3C;/li&#x3E;
    &#x3C;li class=&#x22;nav-item dropdown&#x22;&#x3E;
        &#x3C;a class=&#x22;nav-link dropdown-toggle&#x22; href=&#x22;#&#x22; id=&#x22;navbarDropdownMenuLink&#x22; data-toggle=&#x22;dropdown&#x22; aria-haspopup=&#x22;true&#x22; aria-expanded=&#x22;false&#x22;&#x3E;
            Dropdown link
        &#x3C;/a&#x3E;
        &#x3C;ul class=&#x22;dropdown-menu&#x22; aria-labelledby=&#x22;navbarDropdownMenuLink&#x22;&#x3E;
            &#x3C;li&#x3E;&#x3C;a class=&#x22;dropdown-item&#x22; href=&#x22;#&#x22;&#x3E;Action&#x3C;/a&#x3E;&#x3C;/li&#x3E;
            &#x3C;li&#x3E;&#x3C;a class=&#x22;dropdown-item&#x22; href=&#x22;#&#x22;&#x3E;Another action&#x3C;/a&#x3E;&#x3C;/li&#x3E;
            &#x3C;li&#x3E;&#x3C;a class=&#x22;dropdown-item dropdown-toggle&#x22; href=&#x22;#&#x22;&#x3E;Submenu&#x3C;/a&#x3E;
                &#x3C;ul class=&#x22;dropdown-menu&#x22;&#x3E;
                    &#x3C;li&#x3E;&#x3C;a class=&#x22;dropdown-item&#x22; href=&#x22;#&#x22;&#x3E;Submenu action&#x3C;/a&#x3E;&#x3C;/li&#x3E;
                    &#x3C;li&#x3E;&#x3C;a class=&#x22;dropdown-item&#x22; href=&#x22;#&#x22;&#x3E;Another submenu action&#x3C;/a&#x3E;&#x3C;/li&#x3E;


                    &#x3C;li&#x3E;&#x3C;a class=&#x22;dropdown-item dropdown-toggle&#x22; href=&#x22;#&#x22;&#x3E;Subsubmenu&#x3C;/a&#x3E;
                        &#x3C;ul class=&#x22;dropdown-menu&#x22;&#x3E;
                            &#x3C;li&#x3E;&#x3C;a class=&#x22;dropdown-item&#x22; href=&#x22;#&#x22;&#x3E;Subsubmenu action aa&#x3C;/a&#x3E;&#x3C;/li&#x3E;
                            &#x3C;li&#x3E;&#x3C;a class=&#x22;dropdown-item&#x22; href=&#x22;#&#x22;&#x3E;Another subsubmenu action&#x3C;/a&#x3E;&#x3C;/li&#x3E;
                        &#x3C;/ul&#x3E;
                    &#x3C;/li&#x3E;
                    &#x3C;li&#x3E;&#x3C;a class=&#x22;dropdown-item dropdown-toggle&#x22; href=&#x22;#&#x22;&#x3E;Second subsubmenu&#x3C;/a&#x3E;
                        &#x3C;ul class=&#x22;dropdown-menu&#x22;&#x3E;
                            &#x3C;li&#x3E;&#x3C;a class=&#x22;dropdown-item&#x22; href=&#x22;#&#x22;&#x3E;Subsubmenu action bb&#x3C;/a&#x3E;&#x3C;/li&#x3E;
                            &#x3C;li&#x3E;&#x3C;a class=&#x22;dropdown-item&#x22; href=&#x22;#&#x22;&#x3E;Another subsubmenu action&#x3C;/a&#x3E;&#x3C;/li&#x3E;
                        &#x3C;/ul&#x3E;
                    &#x3C;/li&#x3E;
                &#x3C;/ul&#x3E;
            &#x3C;/li&#x3E;
            &#x3C;li&#x3E;&#x3C;a class=&#x22;dropdown-item dropdown-toggle&#x22; href=&#x22;#&#x22;&#x3E;Submenu 2&#x3C;/a&#x3E;
                &#x3C;ul class=&#x22;dropdown-menu&#x22;&#x3E;
                    &#x3C;li&#x3E;&#x3C;a class=&#x22;dropdown-item&#x22; href=&#x22;#&#x22;&#x3E;Submenu action 2&#x3C;/a&#x3E;&#x3C;/li&#x3E;
                    &#x3C;li&#x3E;&#x3C;a class=&#x22;dropdown-item&#x22; href=&#x22;#&#x22;&#x3E;Another submenu action 2&#x3C;/a&#x3E;&#x3C;/li&#x3E;


                    &#x3C;li&#x3E;&#x3C;a class=&#x22;dropdown-item dropdown-toggle&#x22; href=&#x22;#&#x22;&#x3E;Subsubmenu&#x3C;/a&#x3E;
                        &#x3C;ul class=&#x22;dropdown-menu&#x22;&#x3E;
                            &#x3C;li&#x3E;&#x3C;a class=&#x22;dropdown-item&#x22; href=&#x22;#&#x22;&#x3E;Subsubmenu action 1 3&#x3C;/a&#x3E;&#x3C;/li&#x3E;
                            &#x3C;li&#x3E;&#x3C;a class=&#x22;dropdown-item&#x22; href=&#x22;#&#x22;&#x3E;Another subsubmenu action 2 3&#x3C;/a&#x3E;&#x3C;/li&#x3E;
                        &#x3C;/ul&#x3E;
                    &#x3C;/li&#x3E;
                    &#x3C;li&#x3E;&#x3C;a class=&#x22;dropdown-item dropdown-toggle&#x22; href=&#x22;#&#x22;&#x3E;Second subsubmenu 3&#x3C;/a&#x3E;
                        &#x3C;ul class=&#x22;dropdown-menu&#x22;&#x3E;
                            &#x3C;li&#x3E;&#x3C;a class=&#x22;dropdown-item&#x22; href=&#x22;#&#x22;&#x3E;Subsubmenu action 3 &#x3C;/a&#x3E;&#x3C;/li&#x3E;
                            &#x3C;li&#x3E;&#x3C;a class=&#x22;dropdown-item&#x22; href=&#x22;#&#x22;&#x3E;Another subsubmenu action 3&#x3C;/a&#x3E;&#x3C;/li&#x3E;
                        &#x3C;/ul&#x3E;
                    &#x3C;/li&#x3E;
                &#x3C;/ul&#x3E;
            &#x3C;/li&#x3E;
        &#x3C;/ul&#x3E;
    &#x3C;/li&#x3E;
&#x3C;/ul&#x3E;
&#x3C;/div&#x3E;</code></pre>
';

    $string['additionaltopbarnav'] = 'Additional Top Navigation HTML';
    $string['additionaltopbarnav_desc'] = 'Example:<br /><pre><code>&#x3C;ul class=&#x22;navbar-nav mr-auto&#x22;&#x3E;
            &#x3C;li class=&#x22;nav-item active&#x22;&#x3E;
            &#x3C;a class=&#x22;nav-link&#x22; href=&#x22;#&#x22;&#x3E;Home &#x3C;span class=&#x22;sr-only&#x22;&#x3E;(current)&#x3C;/span&#x3E;&#x3C;/a&#x3E;
            &#x3C;/li&#x3E;
            &#x3C;li class=&#x22;nav-item&#x22;&#x3E;
            &#x3C;a class=&#x22;nav-link&#x22; href=&#x22;#&#x22;&#x3E;Link&#x3C;/a&#x3E;
            &#x3C;/li&#x3E;
            &#x3C;li class=&#x22;nav-item dropdown&#x22;&#x3E;
            &#x3C;a class=&#x22;nav-link dropdown-toggle&#x22; href=&#x22;#&#x22; id=&#x22;navbarDropdown&#x22; role=&#x22;button&#x22; data-toggle=&#x22;dropdown&#x22; aria-haspopup=&#x22;true&#x22; aria-expanded=&#x22;false&#x22;&#x3E;Dropdown&#x3C;/a&#x3E;
            &#x3C;div class=&#x22;dropdown-menu&#x22; aria-labelledby=&#x22;navbarDropdown&#x22;&#x3E;
                &#x3C;a class=&#x22;dropdown-item&#x22; href=&#x22;#&#x22;&#x3E;Action&#x3C;/a&#x3E;
                &#x3C;a class=&#x22;dropdown-item&#x22; href=&#x22;#&#x22;&#x3E;Another action&#x3C;/a&#x3E;
                &#x3C;div class=&#x22;dropdown-divider&#x22;&#x3E;&#x3C;/div&#x3E;
                &#x3C;a class=&#x22;dropdown-item&#x22; href=&#x22;#&#x22;&#x3E;Something else here&#x3C;/a&#x3E;
            &#x3C;/div&#x3E;
            &#x3C;/li&#x3E;
    &#x3C;/ul&#x3E;</code></pre>';



    /***
    *
    *   Settings - Custom Nav
    *
    ***/
    $string['hcustomnav'] = 'Custom Navigation';
    $string['hcustomnav_desc'] = 'Please add ticket on dedicated: <a class="badge badge-link badge-light" href="https://roseathemes.ticksy.com">Support page <i class="ml-1 fas fa-external-link-alt"></i></a> if you need help with this section.';

    $string['showcustomnav'] = '★ Show Custom Nav';
    $string['showcustomnav_desc'] = '';
    $string['customnavsettings'] = '★ Custom Nav';
    $string['customnavicon'] = 'Custom Navigation Icon';
    $string['customnavicon_desc'] = '<br /><strong>Example:</strong><pre><code>&lt;i class=&quot;fas fa-list-ul&quot;&gt;&lt;/i&gt;</code></pre>You can change the icon of the custom navigation button.<br />More icons → <a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">FontAwesome</a>';
    $string['customnavhtml'] = 'Custom Navigation HTML';
    $string['customnavhtml_desc'] = '<strong>Example:</strong> <pre><code>&lt;ul class=&quot;c-custom-nav-container&quot;&gt;
      &lt;li&gt;&lt;a href=&quot;#&quot;&gt;&lt;i class=&quot;fas fa-box-open&quot;&gt;&lt;/i&gt;&lt;span class=&quot;nav-label&quot;&gt;Courses list&lt;/span&gt;&lt;/a&gt;&lt;/li&gt;
      &lt;li&gt;&lt;a href=&quot;#&quot;&gt;&lt;i class=&quot;fas fa-flag-checkered&quot;&gt;&lt;/i&gt;&lt;span class=&quot;nav-label&quot;&gt;Courses list&lt;/span&gt;&lt;/a&gt;&lt;/li&gt;
      &lt;li&gt;&lt;a href=&quot;#&quot;&gt;&lt;i class=&quot;fab fa-slack&quot;&gt;&lt;/i&gt;&lt;span class=&quot;nav-label&quot;&gt;Courses list&lt;/span&gt;&lt;/a&gt;&lt;/li&gt;
      &lt;li&gt;&lt;a href=&quot;#&quot;&gt;&lt;i class=&quot;far fa-calendar-alt&quot;&gt;&lt;/i&gt;&lt;span class=&quot;nav-label&quot;&gt;Courses list&lt;/span&gt;&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;</code></pre><br />More icons → <a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">FontAwesome</a>';
    $string['extracustomnavhtml'] = 'Extra Custom Navigation HTML';
    $string['extracustomnavhtml_desc'] = 'You can add custom text simple string or html
    <br /><strong>Example:</strong> <pre><code>&lt;h4 class=&quot;c-custom-nav-extra-title&quot;&gt;External resources &lt;i class=&quot;fas fa-external-link-square-alt&quot;&gt;&lt;/i&gt;&lt;/h4&gt;
&lt;ul class=&quot;c-custom-nav-extra-container&quot;&gt;
        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;&lt;span class=&quot;nav-label&quot;&gt;Get this theme&lt;/span&gt;&lt;/a&gt;&lt;/li&gt;
        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;&lt;span class=&quot;nav-label&quot;&gt;Get this theme&lt;/span&gt;&lt;/a&gt;&lt;/li&gt;
        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;&lt;span class=&quot;nav-label&quot;&gt;Get this theme&lt;/span&gt;&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;</code></pre><br />More icons → <a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">FontAwesome</a>';


    /***
    *
    *   Settings - Logotypes on the Front Page
    *
    ***/
    $string['logossettings'] = 'Block #6';

    $string['hlogos'] = '<br />Block #6';
    $string['hlogos_desc'] = '<strong>Logotypes list</strong>. You can add up to 30 logotypes.<br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-block6.png" class="img-fluid rounded mt-4" />';

    $string['fplogos'] = '✓ Turn on';
    $string['fplogos_desc'] = 'Turn on Partner Logotypes Block';

    $string['showfpblock6intro'] = '✓ Show intro';
    $string['showfpblock6intro_desc'] = 'Turn on Show intro contains section title and introduction text.';

    $string['fplogostitle'] = 'Section Title';
    $string['fplogostitle_desc'] = '';

    $string['fplogoscontent'] = 'Section description';
    $string['fplogoscontent_desc'] = '';

    $string['h2logos'] = '<hr /><br />List of Logotypes';
    $string['h2logos_desc'] = 'up to 30 logotypes.';

    $string['logosperrow'] = 'Logotypes per row';
    $string['logosperrow_desc'] = 'Default: 6 per row';

    $string['logoscount'] = 'Number of logotypes';
    $string['logoscount_desc'] = '<div class="alert alert-warning"><strong><a href="#page-footer">Save to apply changes ► </a><br /></strong> Select how many logotypes you want to add then click SAVE to load the input fields.</div>';

    $string['logosimage'] = ' | Logo';
    $string['logosimage_desc'] = '<div class="alert alert-warning">* Required</div>. e.g 280px x 120px';

    $string['logosurl'] = ' | URL';
    $string['logosurl_desc'] = 'If you want to have active logotypes just add a website URL.';

    $string['logosname'] = ' | Title for web browsers';
    $string['logosname_desc'] = 'Logotype title for better SEO - this title will be visable only for web browsers. <br /><br /><br /><hr class="hr-bold" />';




    /***
    *
    *   HTML Block 8
    *
    ***/
    $string['fpblock8settings'] = 'Block #8';
    $string['hfpblock8'] = '<br />Block #8';
    $string['hfpblock8_desc'] = '<strong>Courses list</strong>. Custom Courses List on the front page. Up to 60 courses.<br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-block8.png" class="img-fluid rounded mt-4" />';

    $string['fpblock8'] = '✓ Turn on';
    $string['fpblock8_desc'] = 'Turn on Custom Courses List Block';

    $string['showfpblock8intro'] = '✓ Show intro';
    $string['showfpblock8intro_desc'] = 'Turn on Show intro contains section title and introduction text.';

    $string['fpblock8title'] = 'Section title';
    $string['fpblock8title_desc'] = 'Add section introduction title.';

    $string['fpblock8content'] = 'Content';
    $string['fpblock8content_desc'] = 'Add section introduction content.';

    $string['fpblock8showbg'] = 'Show Course Background Images';
    $string['fpblock8showbg_desc'] = 'Select to show course image without hover effect.';

    $string['h2fpblock8'] = '<hr /><br />List of courses';
    $string['h2fpblock8_desc'] = 'You can add up to 60 items.';

    $string['fpblock8count'] = 'Number of courses';
    $string['fpblock8count_desc'] = '<div class="alert alert-warning"><strong><a href="#page-footer">Save to apply changes ► </a><br /></strong> Select how many courses you want to add then click SAVE to load the input fields.</div>';

    $string['fpblock8first'] = ' | Additional Text<br /><small>on the top</small>';
    $string['fpblock8first_desc'] = 'If you want to add hyperlink to text just use html code below:<br /><pre><code>&#x3C;a href=&#x22;YOUR URL&#x22;&#x3E;Link Label&#x3C;/a&#x3E;</code></pre><br />';

    $string['fpblock8second'] = ' | Heading';
    $string['fpblock8second_desc'] = 'If you want to add hyperlink to text just use html code below:<br /><pre><code>&#x3C;a href=&#x22;YOUR URL&#x22;&#x3E;Link Label&#x3C;/a&#x3E;</code></pre><br />';

    $string['fpblock8image'] = ' | Course Image<br /><small>Image size: 810 × 780 px</small>';
    $string['fpblock8image_desc'] = '';

    $string['fpblock8third'] = ' | Additional Text<br /><small>on the bottom</small>';
    $string['fpblock8third_desc'] = 'If you want to add hyperlink to text just use html code below:<br /><pre><code>&#x3C;a href=&#x22;YOUR URL&#x22;&#x3E;Link Label&#x3C;/a&#x3E;</code></pre><br /><br /><br /><hr class="hr-bold" />';

    $string['fpblock8slidesperrow'] = 'Slides per row';
    $string['fpblock8slidesperrow_desc'] = '';

    /***
    *
    *   HTML Block 9
    *
    ***/
    $string['fpblock9settings'] = 'Block #9';
    $string['hfpblock9'] = '<br />Block #9';
    $string['hfpblock9_desc'] = '<strong>FAQ block</strong>. You can add up to 60 questions and answers.<br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-block9.png" class="img-fluid rounded mt-4" />';

    $string['fpblock9'] = '✓ Turn on';
    $string['fpblock9_desc'] = 'Check to turn on Block #9.';

    $string['showfpblock9intro'] = '✓ Show intro';
    $string['showfpblock9intro_desc'] = 'Turn on Show intro contains section title and introduction text.';

    $string['fpblock9title'] = 'Section Title';
    $string['fpblock9title_desc'] = 'Add section introduction title.';

    $string['fpblock9content'] = 'Section Description';
    $string['fpblock9content_desc'] = 'Section Description.';

    $string['h2fpblock9'] = '<hr /><br />List of questions';
    $string['h2fpblock9_desc'] = 'You can add up to 60 FAQ fields.';

    $string['fpblock9count'] = 'Number of FAQ blocks';
    $string['fpblock9count_desc'] = 'Up to 60 questions. <br /><div class="alert alert-warning"><strong><a href="#page-footer">Save to apply changes ► </a><br /></strong> Select how many items you want to add then click SAVE to load the input fields.</div>';

    $string['fpblock9question'] = ' | Question';
    $string['fpblock9question_desc'] = '';

    $string['fpblock9answer'] = ' | Answer';
    $string['fpblock9answer_desc'] = 'Content<br /><br /><br /><hr class="hr-bold" />';




    /***
    *
    *   HTML Block 10
    *
    ***/
    $string['fpblock10settings'] = 'Block #10';
    $string['hfpblock10'] = '<br />Block #10';
    $string['hfpblock10_desc'] = '<strong>Custom 4 Column Content</strong>. Up to 60 items (4 per row).<br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-block10.png" class="img-fluid rounded mt-4" />';

    $string['fpblock10'] = '✓ Turn on';
    $string['fpblock10_desc'] = 'Check to turn on Block #10.';

    $string['showfpblock10intro'] = '✓ Show intro';
    $string['showfpblock10intro_desc'] = 'Turn on Show intro contains section title and introduction text.';

    $string['fpblock10title'] = 'Heading';
    $string['fpblock10title_desc'] = 'Add section introduction title.';

    $string['fpblock10content'] = 'Content';
    $string['fpblock10content_desc'] = 'Add section introduction content.';

    $string['h2fpblock10'] = '<hr /><br />List of items';
    $string['h2fpblock10_desc'] = 'You can add up to 60 items.';

    $string['fpblock10count'] = 'Number of blocks';
    $string['fpblock10count_desc'] = '<div class="alert alert-warning"><strong><a href="#page-footer">Save to apply changes ► </a><br /></strong> Select how many items you want to add then click SAVE to load the input fields.</div>';

    $string['fpblock10heading'] = ' | Heading';
    $string['fpblock10heading_desc'] = '<pre><code>&#x3C;i class=&#x22;fas fa-language&#x22;&#x3E;&#x3C;/i&#x3E;&#x3C;br /&#x3E;
&#x3C;span class=&#x22;d-block mt-3&#x22;&#x3E;Heading&#x3C;/span&#x3E;</code></pre>More icons → <a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">FontAwesome</a>';

    $string['fpblock10subheading'] = ' | Subheading';
    $string['fpblock10subheading_desc'] = '';

    $string['fpblock10additionaltext'] = ' | Content';
    $string['fpblock10additionaltext_desc'] = '<pre><code>&#x3C;p&#x3E;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&#x3C;/p&#x3E;
&#x3C;a href=&#x22;&#x22; class=&#x22;btn-link small text-uppercase&#x22;&#x3E;&#x3C;strong&#x3E;Learn more&#x3C;/strong&#x3E;&#x3C;/a&#x3E;</code></pre><br /><br /><br /><hr class="hr-bold" />';

    $string['fpblock10imgicon'] = ' | Image';
    $string['fpblock10imgicon_desc'] = '';

    $string['fpblock10layout'] = 'Number of columns';
    $string['fpblock10layout_desc'] = '';


    /***
    *
    *   HTML Block 12
    *
    ***/
    $string['fpblock12settings'] = 'Block #12';
    $string['hfpblock12'] = '<br />Block #12 (Testimonials)';
    $string['hfpblock12_desc'] = 'Testimonials on the front page. Up to 60.<br /><img src="'.$siteurl.'/theme/alpha/doc/alpha-settings-block-12.jpg" class="img-fluid rounded mt-4" />';

    $string['fpblock12'] = '✓ Turn on';
    $string['fpblock12_desc'] = 'Turn on Testimonials Block';

    $string['showfpblock12intro'] = '✓ Show intro';
    $string['showfpblock12intro_desc'] = 'Turn on Show intro contains section title and introduction text.';

    $string['fpblock12title'] = 'Section title';
    $string['fpblock12title_desc'] = 'Add section introduction title.';

    $string['fpblock12content'] = 'Content';
    $string['fpblock12content_desc'] = 'Add section introduction content.';

    $string['fpblock12slidesperrow'] = 'Slides per row';
    $string['fpblock12slidesperrow_desc'] = '';

    $string['fpblock12showbg'] = 'Show Author Avatar';
    $string['fpblock12showbg_desc'] = '';

    $string['h2fpblock12'] = '<hr /><br />List of testimonials';
    $string['h2fpblock12_desc'] = 'You can add up to 60 items.';

    $string['fpblock12count'] = 'Number of testimonials';
    $string['fpblock12count_desc'] = '<div class="alert alert-warning"><strong><a href="#page-footer">Save to apply changes ► </a><br /></strong> Select how many courses you want to add then click SAVE to load the input fields.</div>';

    $string['fpblock12html'] = ' | HTML Content';
    $string['fpblock12html_desc'] = '';

    $string['fpblock12first'] = ' | Content';
    $string['fpblock12first_desc'] = 'If you want to add hyperlink to text just use html code below:<br /><pre><code>&#x3C;a href=&#x22;YOUR URL&#x22;&#x3E;Link Label&#x3C;/a&#x3E;</code></pre><br />';

    $string['fpblock12second'] = ' | Author';
    $string['fpblock12second_desc'] = 'If you want to add hyperlink to text just use html code below:<br /><pre><code>&#x3C;a href=&#x22;YOUR URL&#x22;&#x3E;Link Label&#x3C;/a&#x3E;</code></pre><br />';

    $string['fpblock12image'] = ' | Image/Avatar';
    $string['fpblock12image_desc'] = 'Size: 60x60px';

    $string['fpblock12third'] = ' | Additional Text';
    $string['fpblock12third_desc'] = 'If you want to add hyperlink to text just use html code below:<br /><pre><code>&#x3C;a href=&#x22;YOUR URL&#x22;&#x3E;Link Label&#x3C;/a&#x3E;</code></pre><br /><br /><br /><hr class="hr-bold" />';

    $string['fpblock12grid'] = ' Grid view';
    $string['fpblock12grid_desc'] = '<br /><hr class="hr-bold" />';





    /***
    *
    *   Settings - Footer
    *
    ***/
    $string['footersettings'] = 'Footer';
    $string['showsociallist'] = 'Display footer social list';
    $string['showsociallist_desc'] = 'Check this field to show up social icons list.';
    $string['website'] = 'Website Title';
    $string['website_desc'] = 'Main company website Title';
    $string['cwebsiteurl'] = 'Website URL';
    $string['cwebsiteurl_desc'] = 'Main company website';

    $string['hcustomfooter'] = '<hr /><br />Custom Footer Text';
    $string['hcustomfooter_desc'] = '';

    $string['customfootertext'] = 'Custom Footer Text';
    $string['customfootertext_desc'] = 'You can add custom footer content with html tags';
    $string['copyrighttext'] = 'Copyright Text';
    $string['copyrighttext_desc'] = 'Add copyright text e.g All rights reserved or leave this field empty.';
    $string['mobile'] = 'Mobile';
    $string['mobile_desc'] = 'Enter mobile Number';
    $string['mail'] = 'E-mail';
    $string['mail_desc'] = 'Enter E-mail ID';


    $string['facebook'] = 'Facebook URL';
    $string['facebook_desc'] = 'Enter the URL of your Facebook. (i.e http://www.facebook.com/moodlehq)';
    $string['twitter'] = 'Twitter URL';
    $string['twitter_desc'] = 'Enter the URL of your Twitter. (i.e http://www.twitter.com/moodlehq)';
    $string['linkedin'] = 'LinkedIn URL';
    $string['linkedin_desc'] = 'Enter the URL of your LinkedIn. (i.e http://www.linkedin.com/moodlehq)';
    $string['youtube'] = 'YouTube URL';
    $string['youtube_desc'] = 'Enter the URL of your YouTube. (i.e https://www.youtube.com/user/moodlehq)';
    $string['instagram'] = 'Instagram URL';
    $string['instagram_desc'] = 'Enter the URL of your Instagram. (i.e https://www.instagram.com/moodlehq)';
    $string['customsocialicon'] = 'More icons';
    $string['customsocialicon_desc'] = '<br>More icons you can find here: <a href="https://fontawesome.com/icons">FontAwesome</a>.
    <br><strong>Sample:</strong> <pre><code>&#x3C;li class=&#x22;list-inline-item&#x22;&#x3E;
&#x9;&#x3C;a href=&#x22;http://YOUR-URL)&#x22; target=&#x22;_blank&#x22;&#x3E;
&#x9;&#x9;&#x3C;i class=&#x22;fab fa-github&#x22;&#x3E;&#x3C;/i&#x3E;
&#x9;&#x3C;/a&#x3E;
&#x3C;/li&#x3E;
&#x3C;li class=&#x22;list-inline-item&#x22;&#x3E;
&#x9;&#x3C;a href=&#x22;http://YOUR-URL)&#x22; target=&#x22;_blank&#x22;&#x3E;
&#x9;&#x9;&#x3C;i class=&#x22;fab fa-whatsapp&#x22;&#x3E;&#x3C;/i&#x3E;
&#x9;&#x3C;/a&#x3E;
&#x3C;/li&#x3E;</code></pre>';
    $string['TopFooterIMG'] = 'Footer image';
    $string['TopFooterIMG_desc'] = 'Upload your custom footer image here if you want to replace the default image. Recommended size is 1500px x 400px or higher.';
    $string['DisableBottomFooter'] = 'Disable bottom footer';
    $string['DisableBottomFooter_desc'] = 'Disables the orange bottom footer';

    $string['hcustomalert'] = '<hr /><br />Custom Alert';
    $string['hcustomalert_desc'] = 'You can set up custom alert  which will displays on the bottom of the page.<br />If you close it you have to remove cookies or clear history of the browser.';
    $string['customalert'] = 'Custom Alert';
    $string['customalert_desc'] = 'Turn on custom alert. <span class="badge badge-info">Show up once per session.</span>';
    $string['customalertcontent'] = 'Custom alert content';
    $string['customalertcontent_desc'] = '';



    $string['blockordersettings'] = 'Front Page Builder';

    $string['fpsectionspadding'] = 'Front Page Sections Padding';
    $string['fpsectionspadding_desc'] = '';

    $string['slotblock14'] = 'Hero Image';
    $string['slotblock14_desc'] = '';

    $string['slotblock15'] = 'Hero Video';
    $string['slotblock15_desc'] = '';

    $string['slotblock13'] = 'Hero Slider';
    $string['slotblock13_desc'] = '';

    $string['slotblock1'] = 'Block #1';
    $string['slotblock1_desc'] = '4-column custom block.';

    $string['slotblock2'] = 'Block #2';
    $string['slotblock2_desc'] = '2-column custom block.';

    $string['slotblock3'] = 'Block #3';
    $string['slotblock3_desc'] = 'Call to action block.';

    $string['slotblock4'] = 'Block #4';
    $string['slotblock4_desc'] = 'Single column custom HTML block.';

    $string['slotblock5'] = 'Block #5';
    $string['slotblock5_desc'] = 'Custom Categories Block.';

    $string['slotblock6'] = 'Block #6';
    $string['slotblock6_desc'] = 'Logotypes list.';

    $string['slotblock7'] = 'Block #7';
    $string['slotblock7_desc'] = 'List of team members.';

    $string['slotblock8'] = 'Block #8';
    $string['slotblock8_desc'] = 'Courses list.';

    $string['slotblock9'] = 'Block #9';
    $string['slotblock9_desc'] = 'FAQ block.';

    $string['slotblock10'] = 'Block #10';
    $string['slotblock10_desc'] = '4-column Custom Content.';

    $string['slotblock11'] = 'Block #11';
    $string['slotblock11_desc'] = '<strong>Go to:</strong> Dashboard → Site administration → Front page settings → Edit settings<br /><strong>Select items:</strong> Front page, Front page items when logged in<br /><strong>Save</strong>';

    $string['slotblock12'] = 'Block #12';
    $string['slotblock12_desc'] = 'Testimonials Block';

    $string['blockordertitle'] = 'Simple Front Page Builder';
    $string['blockordertitle_desc'] = 'You can change position of each blocks on the front page.<br /><img src="https://moodle-themes.rosea.io/space/theme-assets/simple-front-page-builder.png" class="img-fluid rounded mt-4" />';


    $string['hintro'] = '<br />Alpha Moodle Theme<br /><small>by Rosea Themes</small><br /><div class="badge badge-info mt-2 mx-0">version 1.5.5</div>';
    $string['hintro_desc'] = '<div class="col-sm-12 col-md-6 my-5 mx-auto"><a class="btn btn-secondary mb-1" href="https://docs.alpha.rosea.io" target="_blank"><i class="fas fa-book mr-2"></i>  Documentation</a>
    <a class="mx-2 mb-1 btn btn-secondary" href="https://themeforest.net/item/alpha-responsive-moodle-premium-theme/24146338/support" target="_blank"><i class="far fa-life-ring mr-2"></i>  Theme Support</a></div>';

    $string['docH1'] = '<div class="d-block text-center"><br />Theme Colors</div>';
    $string['docH1_desc'] = '<br /><img src="'.$siteurl.'/theme/alpha/doc/colors-theme-palette.png" class="img-fluid rounded mt-3" />';

    $string['docH2'] = '<div class="d-block text-center"><br />Theme Colors - Grays</div>';
    $string['docH2_desc'] = '<br /><img src="'.$siteurl.'/theme/alpha/doc/colors-gray-palette.png" class="img-fluid rounded mt-3" />';

    $string['docH3'] = '<div class="d-block text-center"><div class="d-block text-center"><br />Button Primary</div>';
    $string['docH3_desc'] = '<br /><img src="'.$siteurl.'/theme/alpha/doc/colors-btn-primary.png" class="img-fluid rounded mt-3" /><br /><br /><small class="mr-2">Your button style (preview):</small> <div class="btn btn-primary">Button Primary</div>';

    $string['docH4'] = '<div class="d-block text-center"><div class="d-block text-center"><br />Button Secondary</div>';
    $string['docH4_desc'] = '<br /><img src="'.$siteurl.'/theme/alpha/doc/colors-btn-secondary.png" class="img-fluid rounded mt-3" /><br /><br /><small class="mr-2">Your button style (preview):</small> <div class="btn btn-secondary">Button Secondary</div>';

    $string['bodybg'] = 'Background Color';
    $string['bodybg_desc'] = '';

    $string['bodybgfp'] = 'Background Color (Front page)';
    $string['bodybgfp_desc'] = '';

    $string['containerbg'] = 'Main Container Background';
    $string['containerbg_desc'] = '';

    $string['bodycolor'] = 'Body Color';
    $string['bodycolor_desc'] = '';

    $string['bodycolor'] = 'Text Color';
    $string['bodycolor_desc'] = '';

    $string['bodycolorsecondary'] = 'Text Color (Secondary)';
    $string['bodycolorsecondary_desc'] = '';

    $string['bodycolorlight'] = 'Text Color (Light)';
    $string['bodycolorlight_desc'] = '';


    $string['linkcolor'] = 'Link Color';
    $string['linkcolor_desc'] = '';

    $string['linkcolorhover'] = 'Link Color Hover';
    $string['linkcolorhover_desc'] = '';

    $string['btnprimarybg1'] = 'Button Primary<br />Background #1';
    $string['btnprimarybg1_desc'] = '';

    $string['btnprimarybg2'] = 'Button Primary<br />Background #2';
    $string['btnprimarybg2_desc'] = '';

    $string['btnprimarybg1hover'] = 'Button Primary<br />Background #1 Hover';
    $string['btnprimarybg1hover_desc'] = '';

    $string['btnprimarybg2hover'] = 'Button Primary<br />Background #2 Hover';
    $string['btnprimarybg2hover_desc'] = '';

    $string['btnprimarytext'] = 'Button Primary<br />Text';
    $string['btnprimarytext_desc'] = '';

    $string['btnprimarytexthover'] = 'Button Primary<br />Text Hover';
    $string['btnprimarytexthover_desc'] = '';

    $string['btnsecondarybg'] = 'Button Secondary<br />Background';
    $string['btnsecondarybg_desc'] = '';

    $string['btnsecondarybghover'] = 'Button Secondary<br />Background Hover';
    $string['btnsecondarybghover_desc'] = '';

    $string['btnsecondarybordercolor'] = 'Button Secondary<br />Border';
    $string['btnsecondarybordercolor_desc'] = '';

    $string['btnsecondarybordercolorhover'] = 'Button Secondary<br />Border Hover';
    $string['btnsecondarybordercolorhover_desc'] = '';

    $string['btnsecondarytext'] = 'Button Secondary<br />Text';
    $string['btnsecondarytext_desc'] = '';

    $string['btnsecondarytexthover'] = 'Button Secondary<br />Text Hover';
    $string['btnsecondarytexthover_desc'] = '';


    //HTML
    $string['additionalheadhtml'] = '<span class="badge badge-danger mx-0 mb-2">Only for developers</span><br />Head HTML';
    $string['additionalheadhtml_desc'] = 'Before the closing &#x3C;/head&#x3E; tag';
    $string['additionalfooterhtml'] = '<span class="badge badge-danger mx-0 mb-2">Only for developers</span><br />Footer HTML';
    $string['additionalfooterhtml_desc'] = 'Before the closing &#x3C;/body&#x3E; tag';


    $string['privacy:metadata:preference:draweropennav'] = 'The user\'s preference for hiding or showing the drawer menu navigation.';
    $string['privacy:drawernavclosed'] = 'The current preference for the navigation drawer is closed.';
    $string['privacy:drawernavopen'] = 'The current preference for the navigation drawer is open.';

    $string['privacy:metadata:preference:fpdraweropennav'] = 'The user\'s preference for hiding or showing the drawer menu navigation.';
    $string['privacy:fpdrawernavclosed'] = 'The current preference for the navigation drawer is closed.';
    $string['privacy:fpdrawernavopen'] = 'The current preference for the navigation drawer is open.';


    $string['backtotop'] = 'Back to top';
    $string['showhintcoursehiddensetting'] = 'Show hint in hidden courses';
    $string['showhintcoursehiddensetting_desc'] = 'With this setting a hint will appear in the course header as long as the visibility of the course is hidden. This helps to identify the visibility state of a course at a glance without the need for looking at the course settings.';
    $string['showhintcoursehiddensettingslink'] = 'You can change the visibility in the <a href="{$a->url}">course settings</a>.';
    $string['showhintcoursehiddengeneral'] = 'This course is currently <strong>hidden</strong>. Only enrolled teachers can access this course when hidden.';

    $string['showhintcourseguestaccesssetting'] = 'Show hint for guest access';
    $string['showhintcourseguestaccesssetting_desc'] = 'With this setting a hint will appear in the course header when a user is accessing it with the guest access feature. If the course provides an active self enrolment, a link to that page is also presented to the user.';
    $string['showhintcourseguestaccessgeneral'] = 'You are currently viewing this course as <strong>{$a->role}</strong>.';
    $string['showhintcourseguestaccesslink'] = 'To have full access to the course, you can <a href="{$a->url}">self enrol into this course</a>.';

    // ...Switch role information.
    $string['switchedroleto'] = 'You are viewing this course currently with the role:';

    $string['boostfumblingnav'] = 'Boost navigation fumbling';
    $string['boostfumblingnav_desc'] = 'This option will remove Space in-build course section. <br /> <a href="https://moodle.org/plugins/local_boostnavigation" target="_blank">Download Boost navigation fumbling →</a>';

    $string['teachers'] = 'Teachers';

    $string['displaynavdrawerfp'] = 'Display Navigation Sidebar<br />on the front page';
    $string['displaynavdrawerfp_desc'] = 'This option will display navigation sidebar on the front page.';
