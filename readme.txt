Engipress Library README file


==Notes==
Plugin: Engipress Library
Version: 2.0
Creator: James Lewitzke
Creator URL: http://engipress.com/


==Description==
* Allows usage of Engipress's Themes.
* Many useful Wordpress features and functions are included.


==Install==
1. Download the ZIP file
2. Unzip and upload the folder to the Wordpress plugins directory
3. Activate the plugin within the Plugin Dashboard


==Changelog==
=2.0=
* Complete overhaul / inclusion of many new features and relaunching
* Transform most eng_*() functions into eng_get_*() that return, and re-add eng_*() functions to echo eng_get_*() results
* "core" and "Design-main" CSS files reorganized into a *mobile-first* perspective
* "position" parameter added to thumbnail() method within "eng_query" class and according CSS added to "design-main" CSS file
* eng_wnm_html_items_wrap() function created to power Mobile jQuery Menu script integrated into library with transition effect


=1.6=
* engipress_schema_atts_nav() disabled because it breaks Custom Menu Widgets
* eng_comment() callback bug fixed
* Custom Image Sizes no longer set to "required"


=1.5=
* "style" Option Page added
* $location parameter for eng_logo() made optional
* $location parameter for eng_copyright() added
* eng_banner() updated to accommodate shortcodes and home page
* eng_banner() function re-worked to accomodate more parameters
* eng_banner() "position" parameter added
* "Home Banner Title" General Theme Option added and integrated into eng_banner() function
* eng_phone() function added
* "address" Phrase Theme Option and eng_address() function added
* "tagline" Phrase Theme Option and eng_tagline() function added
* "poweredby" Phrase Theme Option and eng_poweredby() function added
* "phone prefix" Phrase Theme Option added and integrated into eng_phone() function
* is_blog_list() conditional added
* eng_classes_body() function updated to accommodate is_blog_list() conditional


=1.4=
* eng_banner() function variable fix and shortcode enabling
* engipress_query class pagination reworked into query base / no longer a function
* New is_tax_cpt() function created to fix is_posttype() function 
* engipress_query class datetime() function modified for more accurate HTML classes


=1.3=
* engipress_query class title() function modified for suffix terms
* is_posttype() function tweaked for multiple taxonomy usage


=1.2=
* Code theme options added
* HTML Classes Tweaked
* Misc bug fixes


=1.1=
* Automatic Upgrade Feature included


=1.0=
* Most Features brought in from previous work libraries and the Engipress Framework


==Help==
Please contact via email (james@engipress.com) and include "Engipress Library Support" in the Title.