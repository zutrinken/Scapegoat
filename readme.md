# SCAPEGOAT

* Author: [Peter Amende](http://zutrinken.com/)
* License: GNU General Public License v2 or later

## About

* Made for the [Piratenpartei Berlin](http://berlin.piratenpartei.de/)
* Slider and 404 image by [Ben de Biel](http://www.bendebiel.com/)
* Font "PoliticsHeadBold" by [Fred Bordfeld](http://kaklotter.de/)
* Font "Awesome" by [Dave Gandy](http://fontawesome.io/)


## How to

* Slider Image Size ```1440x486```
* Post Image Size ```720x243```
* first of all, you have to insert some informations about yourself in your profile-section
* use custom menues and insert the start-page to the main-menu, if you want to display the home icon in your header menu
* use widgets for the sidebar and footer. The footer looks best with 4 Widgets with approximately equal heights. Don't use menu widgets in the footer, there is a separate footer-menu
* Firefox on Windows don't load the fonts of the theme. To fix that, you have to insert this on top of your **.htaccess**:
```<FilesMatch "\.(ttf|otf|eot|woff|svg)$">Header set Access-Control-Allow-Origin "*"</FilesMatch>```

## Shortcodes

### Columns

		[three_columns_one]
		 first column content here...
		[/three_columns_one]
		[three_columns_one]
		 second column content here...
		[/three_columns_one]
		[three_columns_one_last]
		 third column content here...
		[/three_columns_one_last]
		[divider]

### Buttons

* The default orange rectangle normal size button only contains a "link-attribute" ````[button link="http://yourdomain.com"]Text[/button]````
* For rounded buttons you have to add add the "form-attribute" ````[button link="http://yourdomain.com" form="round"]Text[/button]````
* For other Clolours as the default orange you have to add the "color-attribute" ````[button link="http://yourdomain.com" color="blue"]Text[/button]````. Possible colours are "blue, lightgrey, grey, darkgrey, red, green"
* For smaller oder larger buttons you can add the "size attribute" ````[button link="http://yourdomain.com" size="large"]Text[/button]````. Possible sizes are "xsmall, small, large, xlarge"

