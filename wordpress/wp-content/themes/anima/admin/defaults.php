<?php
/**
 * Theme Defaults
 *
 * @package Anima
 */

function anima_get_option_defaults() {

	$sample_pages = anima_get_default_pages();

	// DEFAULT OPTIONS ARRAY
	$anima_defaults = array(

	"anima_db" 					=> "0.9",

	"anima_sitelayout"			=> "2cSr", // two columns, sidebar right
	"anima_layoutalign"			=> 0, 		// 0=wide, 1=boxed
	"anima_sitewidth"  			=> 1380, 	// pixels
	"anima_primarysidebar"		=> 300, 	// pixels
	"anima_secondarysidebar"	=> 340, 	// pixels
	"anima_magazinelayout"		=> 2, 		// two columns
	"anima_elementpadding" 		=> 0, 		// percent
	"anima_footercols"			=> 3, 		// 0, 1, 2, 3, 4
	"anima_footeralign"			=> 0,		// default

	"anima_landingpage"			=> 1, // 1=enabled, 0=disabled
	"anima_lpposts"				=> 2, // 2=static page, 1=posts, 0=disabled
	"anima_lpposts_more"		=> 'More Posts',
	"anima_lpslider"			=> 1, // 2=shortcode, 1=static, 0=disabled
	"anima_lpsliderimage"		=> get_template_directory_uri() . '/resources/images/slider/static.jpg', // static image
	"anima_lpslidershortcode"	=> '',
	"anima_lpslidertitle"		=> get_bloginfo('name'),
	"anima_lpslidertext"		=> get_bloginfo('description'),
	"anima_lpslidercta1text"	=> 'More',
	"anima_lpslidercta1link"	=> '#lp-blocks',
	"anima_lpslidercta2text"	=> 'Posts',
	"anima_lpslidercta2link"	=> '#lp-boxes-1',

	"anima_lpblockmainttitle"	=> '',
	"anima_lpblockmaindesc"		=> '',
	"anima_lpblockone"			=> $sample_pages[1],
	"anima_lpblockoneicon"		=> 'users2',
	"anima_lpblocktwo"			=> $sample_pages[2],
	"anima_lpblocktwoicon"		=> 'map',
	"anima_lpblockthree"		=> $sample_pages[3],
	"anima_lpblockthreeicon"	=> 'equalizer',
	"anima_lpblockfour"			=> 0,
	"anima_lpblockfouricon"		=> 'megaphone',
	"anima_lpblockscontent"		=> 1, // 0=disabled, 1=excerpt, 2=full
	"anima_lpblocksclick"		=> 0,

	"anima_lpboxmainttitle1"	=> '',
	"anima_lpboxmaindesc1"		=> '',
	"anima_lpboxcat1"			=> '',
	"anima_lpboxcount1"			=> 6,
	"anima_lpboxrow1"			=> 3, // 1-4
	"anima_lpboxheight1"		=> 350, // pixels
	"anima_lpboxlayout1"		=> 2, // 1=full width, 2=boxed
	"anima_lpboxmargins1"		=> 2, // 1=no margins, 2=margins
	"anima_lpboxanimation1"		=> 2, // 1=animated, 2=static
	"anima_lpboxreadmore1"		=> 'Read More',
	"anima_lpboxlength1"		=> 25,

	"anima_lpboxmainttitle2"	=> '',
	"anima_lpboxmaindesc2"		=> '',
	"anima_lpboxcat2"			=> '',
	"anima_lpboxcount2"			=> 6,
	"anima_lpboxrow2"			=> 3, 	// 1-4
	"anima_lpboxheight2"		=> 400, // pixels
	"anima_lpboxlayout2"		=> 2, 	// 1=full width, 2=boxed
	"anima_lpboxmargins2"		=> 1, 	// 1=no margins, 2=margins
	"anima_lpboxanimation2"		=> 1, 	// 1=animated, 2=static
	"anima_lpboxreadmore2"		=> 'Read More',
	"anima_lpboxlength2"		=> 25,

	"anima_lptextone"			=> $sample_pages[1],
	"anima_lptexttwo"			=> $sample_pages[2],
	"anima_lptextthree"			=> $sample_pages[3],
	"anima_lptextfour"			=> $sample_pages[4],

	"anima_menuheight"			=> 85, 	// pixels
	"anima_menustyle"			=> 1, 	// normal, fixed
	"anima_menuposition"		=> 0, 	// normal, on header image
	"anima_menulayout"			=> 1, 	// 0=left, 1=right, 2=center
	"anima_headerheight" 		=> 420, // pixels
	"anima_headerresponsive" 	=> 0, 	// cropped, responsive

	"anima_logoupload"			=> '', // empty
	"anima_siteheader"			=> 'title', // title, logo, both, empty
	"anima_sitetagline"			=> '', // 1= show tagline
	"anima_headerwidgetwidth"	=> "33%", // 25%, 33%, 50%, 60%, 100%
	"anima_headerwidgetalign"	=> "right", // left, center, right

	"anima_fgeneral" 			=> 'Raleway/gfont',
	"anima_fgeneralgoogle" 		=> 'Raleway:400,300,700',
	"anima_fgeneralsize" 		=> '15px',
	"anima_fgeneralweight" 		=> '400',

	"anima_fsitetitle" 			=> 'Raleway/gfont',
	"anima_fsitetitlegoogle"	=> '',
	"anima_fsitetitlesize" 		=> '120%',
	"anima_fsitetitleweight"	=> '400',
	"anima_fmenu" 				=> 'Raleway/gfont',
	"anima_fmenugoogle"			=> '',
	"anima_fmenusize" 			=> '100%',
	"anima_fmenuweight"			=> '300',

	"anima_fwtitle" 			=> 'Roboto/gfont',
	"anima_fwtitlegoogle"		=> '',
	"anima_fwtitlesize" 		=> '100%',
	"anima_fwtitleweight"		=> '700',
	"anima_fwcontent" 			=> 'Raleway/gfont',
	"anima_fwcontentgoogle"		=> '',
	"anima_fwcontentsize" 		=> '100%',
	"anima_fwcontentweight"		=> '400',

	"anima_ftitles" 			=> 'Raleway/gfont',
	"anima_ftitlesgoogle"		=> '',
	"anima_ftitlessize" 		=> '250%',
	"anima_ftitlesweight"		=> '300',
	"anima_metatitles" 			=> 'Roboto/gfont',
	"anima_metatitlesgoogle"	=> '',
	"anima_metatitlessize" 		=> '100%',
	"anima_metatitlesweight"	=> '300',
	"anima_fheadings" 			=> 'Raleway/gfont',
	"anima_fheadingsgoogle"		=> '',
	"anima_fheadingssize" 		=> '100%',
	"anima_fheadingsweight"		=> '300',

	"anima_lineheight"			=> "1.8em",
	"anima_textalign"			=> "Default",
	"anima_paragraphspace"		=> "1.0em",
	"anima_parindent"			=> "0.0em",

	"anima_sitebackground" 		=> "#FFF",
	"anima_sitetext" 			=> "#666",
	"anima_headingstext" 		=> "#333",
	"anima_contentbackground"	=> "#FFF",
	"anima_primarybackground"	=> "",
	"anima_secondarybackground"	=> "",
	"anima_overlaybackground"	=> "#000",
	"anima_overlayopacity"		=> "60",
	"anima_menubackground"		=> "#FFFFFF",
	"anima_menutext" 			=> "#63666B",
	"anima_submenutext" 		=> "#63666B",
	"anima_submenubackground" 	=> "#FFFFFF",
	"anima_footerbackground"	=> "#222A2C",
	"anima_footertext"			=> "#AAAAAA",
	"anima_lpsliderbg"			=> "#FFFFFF",
	"anima_lpblocksbg"			=> "#F8F8F8",
	"anima_lpboxesbg"			=> "#FFFFFF",
	"anima_lptextsbg"			=> "#F8F8F8",
	"anima_accent1" 			=> "#D0422C",
	"anima_accent2" 			=> "#777777",

	"anima_breadcrumbs"			=> 1,
	"anima_pagination"			=> 1,
	"anima_singlenav"			=> 2,
	"anima_contenttitles" 		=> 1, // 1, 2, 3, 0
	"anima_totop"				=> 'anima-totop-normal',
	"anima_tables"				=> 'anima-stripped-table',
	"anima_normalizetags"		=> 1, // 0,1
	"anima_copyright"			=> '&copy;'. date_i18n('Y') . ' '. get_bloginfo('name'),

	"anima_elementborder" 		=> 0,
	"anima_elementshadow" 		=> 0,
	"anima_elementborderradius"	=> 0,
	"anima_articleanimation"	=> 3, // 0=none, 1=fade, 2=scroll, 3=slide-left

	"anima_searchboxmain" 		=> 1,
	"anima_searchboxfooter"		=> 0,
	"anima_image_style"			=> 'anima-image-none',
	"anima_caption_style"		=> 'anima-caption-one',

	"anima_meta_author" 		=> 1,
	"anima_meta_date"	 		=> 1,
	"anima_meta_time" 			=> 0,
	"anima_meta_category" 		=> 1,
	"anima_meta_tag" 			=> 0,
	"anima_meta_comment" 		=> 1,

	"anima_headertitles_posts" 	=> 1,
	"anima_headertitles_pages" 	=> 1,
	"anima_headertitles_archives"=> 1,
	"anima_headertitles_home"=> 1,

	"anima_comlabels"			=> 1, // 1, 2
	"anima_comdate"				=> 2, // 1, 2
	"anima_comclosed"			=> 1, // 1, 2, 3, 0
	"anima_comformwidth"		=> 650, // pixels

	"anima_excerpthome"			=> 'excerpt',
	"anima_excerptsticky"		=> 'full',
	"anima_excerptarchive"		=> 'excerpt',
	"anima_excerptlength"		=> "50",
	"anima_excerptdots"			=> " &hellip;",
	"anima_excerptcont"			=> "Read more",

	"anima_fpost" 				=> 1,
	"anima_fauto" 				=> 0,
	"anima_fheight"				=> 350,
	"anima_fresponsive" 		=> 1, // cropped, responsive
	"anima_falign" 				=> "center center",
	//"anima_fwidth" 			=> "250",
	"anima_fheader" 			=> 1,

	"anima_socials_header"		=> 0,
	"anima_socials_footer"		=> 0,
	"anima_socials_left_sidebar"=> 0,
	"anima_socials_right_sidebar"=> 0,

	"anima_postboxes" 			=> '',

	"anima_masonry"				=> 1,
	"anima_defer"				=> 1,
	"anima_fitvids"				=> 1,
	"anima_autoscroll"			=> 1,
	"anima_editorstyles"		=> 1,


	); // anima_defaults array

	return apply_filters( 'anima_option_defaults_array', $anima_defaults );
} // anima_get_option_defaults()

/* Get sample pages for options defaults */
function anima_get_default_pages( $number = 4 ) {
	$block_ids = array( 0, 0, 0, 0, 0 );
	$default_pages = get_pages(
		array(
			'sort_order' => 'desc',
			'sort_column' => 'post_date',
			'number' => $number,
		)
	);
	foreach ( $default_pages as $key => $page ) {
		if ( ! empty ( $page->ID ) ) {
			$block_ids[$key+1] = $page->ID;
		}
		else {
			$block_ids[$key+1] = 0;
		}
	}
	return $block_ids;
} //anima_get_default_pages()
