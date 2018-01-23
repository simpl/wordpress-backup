=============
Anima WordPress Theme
Copyright 2017 Cryout Creations
https://www.cryoutcreations.eu/

Author: Cryout Creations
Requires at least: 4.2
Tested up to: 4.8.2
Stable tag: 1.0.3
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html
Donate link: https://www.cryoutcreations.eu/donate/

Anima is a free, highly customizable WordPress theme created for personal and business sites alike. Photography and portfolio, freelancer and corporate sites will also greatly benefit from the theme’s clean, responsive and modern design. A few perks: eCommerce (WooCommerce) support, WPML, qTranslate, Polylang, RTL, SEO ready, wide and boxed layouts, masonry, editable content and sidebars layout and widths, social icons, Google fonts and other typography options, customizable colors. Not to mention the landing page with countless featured icon blocks, boxes and text areas, all editable.

== License ==

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see http://www.gnu.org/copyleft/gpl.html


== Third Party Resources ==

Anima WordPress Theme bundles the following third-party resources:

HTML5Shiv, Copyright Alexander Farkas (aFarkas)
Dual licensed under the terms of the GPL v2 and MIT licenses
Source: https://github.com/aFarkas/html5shiv/

FitVids, Copyright Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
Licensed under the terms of the WTFPLlicense
Source: http://fitvidsjs.com/

== Bundled Fonts ==

Raleway, Copyright The League of Moveable Type
Licensed under the terms of Apache License Version 2.0
Source: https://www.theleagueofmoveabletype.com/raleway

Roboto, Copyright Christian Robertson
Licensed under the terms of SIL Open Font License, Version 1.1.
Source: https://github.com/google/roboto/

Icomoon icons, Copyright Keyamoon.com
Licensed under the terms of the GPL license
Source: https://icomoon.io/#icons-icomoon

Zocial CSS social buttons, Copyright Sam Collins
Licensed under the terms of the MIT license
Source: https://github.com/smcllns/css-social-buttons

Feather icons, Copyright Cole Bemis
Licensed under the terms of the MIT license
Source: http://colebemis.com/feather/

== Bundled Images ==

The following bundled images are released into the public domain under Creative Commons CC0:
https://static.pexels.com/photos/324030/pexels-photo-324030.jpeg
https://www.pexels.com/photo/person-using-laptop-computer-during-daytime-196655/

Preview demo images:
1.jpg - https://pixabay.com/en/apple-devices-artificial-flowers-1867761/
2.jpg - https://pixabay.com/en/coffee-computer-cup-desk-drink-1869820/
3.jpg - https://pixabay.com/en/clock-glasses-pen-desk-wooden-1461689/
4.jpg - https://pixabay.com/en/old-retro-antique-vintage-classic-1130731/
5.jpg - https://pixabay.com/en/office-desk-computer-technology-1834294/
6.jpg - https://pixabay.com/en/camera-photography-photograph-581126/
7.jpg - https://pixabay.com/en/imac-ipad-computer-tablet-mobile-605421/
8.jpg - https://pixabay.com/en/children-win-success-video-game-593313/
9.jpg - https://pixabay.com/en/office-notes-notepad-entrepreneur-620817/
10.jpg - https://pixabay.com/en/write-plan-business-startup-593333/

The rest of the bundled images are created by Cryout Creations and released with the theme under GPLv3


== Changelog ==

= 1.0.3 =
* Fixed extra space under menu when main menu is set to fixed and on top of header image with boxed layout when no header image is set
* Adjusted static slider caption margin and padding to fix missing background on caption container
* Fixed fixed menu missing background color on mobile devices when menu is on top of header image
* Fixed missing text areas numbers in theme options
* Fixed non-translatable strings in theme options
* Added auto-match for mailto: URL in social icons
* Improved masonry initiation to check if function is available
* Adjusted landing page static slider image responsiveness to make image more visible on mobile devices
* Added workaround for horizontal scrollbar on mobile devices when large menus are used
* Reverted padding back to margin on static slider caption due to extra space before the static slider title
* Fixed incorrect usage of site background color option on slider text, featured boxes background, aside border, socials background; switched header socials background to use menu background instead of site background
* Fixed icon blocks background/border to use correct color option
* Fixed featured boxes image background to use correct color option
* Added content background to featured posts / featured page area
* Fixed missing breadcrumbs background color when header titles are not active

= 1.0.2 =
* Added integrated styling for our Serious Slider plugin
* Renamed $animas variables to be more generic
* Fixed editor styling option not controlling style.css enqueue
* Fixed featured boxes not deactivating by setting the category to 'disabled'
* Fixed dropdown menu width issue in Chrome with very short menu items
* Fixed static slider caption container being displayed when no static slider caption fields are used
* Adjusted static slider CTA buttons styling to be more generic
* Increased content headers line-height to 1.2
* Fixed author pages displaying empty biography area

= 1.0.1 =
* Revamped single post previous/next buttons
* Changed article markup to improve search engine readability (separated actual article content from article extra information)
* Changed comment headers to 'footer' elements
* Changed author bio div to 'section' element
* Updated to Cryout Framework 0.6.6

= 1.0.0 =
* Removed font-weight from admin editor styles
* Fixed sidebar socials height issue
* Adjusted header titles padding
* Adjusted menu search padding
* Fixed site title overlapping menu icon on mobile
* Fixed sidebars padding on mobile
* Fixed landing page title top margin on mobile
* Increase article responsiveness
* Fixed slider next/prev buttons having rounded corners
* Changed default lp blocks and lp text areas background colors
* Changed default menu background color
* Added meta hover effect
* Removed empty "templates" folder
* Changed default header image and set default image size to 420px
* Changed default header image vertical position from center to top
* Changed screenshot.png

= 0.9.4 =
* Fixed un-numbered 'printf' placeholders in back-compat.php
* Fixed cryout_compat_upgrade_notice() not properly hooked in back-compat.php

= 0.9.3 =
* Fixed featured image animation leftover background
* Added header links and metas hover effects
* Clarified landing page activation requirements in the customize panel
* Improved header video support and fixed header height on non-homepage sections
* Further improved responsiveness
* Removed font-size reset
* Restored default quotes on q tag
* Adjusted fixed post navigation colors/opacity
* Removed main search border radius in conjunction with menu over image layout
* Added height to the header-image-main-inside container for cropped header image
* Adjusted the footer widget area description
* Updated to Cryout Framework 0.6.5+

= 0.9.2 =
* Added option to show the site title and tagline on the home page (when the landing page is disabled)
* Fixed breadcrumbs offset in header titles
* Fixed inconsistent content padding on mobile
* Fixed sidebars responsiveness
* Updated translations

= 0.9.1 =
* Renamed sidebar areas
* Removed save/load theme settings
* Escaped variables in custom-styles.php, loop.php, meta.php and main.php
* Changed images inside links vertical alignment to "middle"
* Increased site wrapper left/right padding to 2em
* Removed sidebar margins
* Fixed minor layout responsiveness issues
* Fixed content background issues and replaced it with site background color in many instances in custom-styles.php
* Removed prev/next fixed navigation hover effect on mobile
* Added 'hentry' class to article post_class() in content/content.php
* Changed default featured image height to 350px
* Fixed icon blocks responsiveness
* Reversed landing page buttons
* Fixed landing page second button hover color
* Removed content background color from the landing page slider and above slider text
* Improved first image handling in text areas
* Added demo content
* Added a new screenshot
* Improved admin logo images
* Changed coffee text

= 0.9 =
Initial release
