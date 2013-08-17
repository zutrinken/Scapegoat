# SCAPEGOAT

* Author: [Peter Amende](http://zutrinken.com/)
* License: GNU General Public License v2 or later

## ABOUT SCAPEGOAT

* the theme is made for the [Piratenpartei Berlin](http://berlin.piratenpartei.de/)
* the default slider images and the 404 image are taken by [Ben de Biel](http://www.bendebiel.com/)
* the font "PoliticsHeadBold" is made by [Fred Bordfeld](http://kaklotter.de/)

## HOW TO

*Slider Image Size ```1440x486```
*Post Image Size ```720x243```
* first of all, you have to insert some informations about yourself in your profile-section
* use custom menues and insert the start-page to the main-menu, if you want to display the home icon in your header menu
* use widgets for the sidebar and footer. The footer looks best with 4 Widgets with approximately equal heights. Don't use menu widgets in the footer, there is a separate footer-menu
* Firefox on Windows don't load the fonts of the theme. To fix that, you have to insert this on top of your **.htaccess**:
```<FilesMatch "\.(ttf|otf|eot|woff|svg)$">Header set Access-Control-Allow-Origin "*"</FilesMatch>```