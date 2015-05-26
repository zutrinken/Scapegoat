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
* If custom excerpts are active you can display videos like post images on the frontpage by using the custom field called ```video``` with your embedded ```<iframe>``` code as the value.
* First of all, you have to insert some informations about yourself in your profile-section
* Use custom menues and insert the start-page to the main-menu, if you want to display the home icon in your header menu
* Use widgets for the sidebar and footer. The footer looks best with 4 Widgets with approximately equal heights. Don't use menu widgets in the footer, there is a separate footer-menu
* Firefox on Windows don't load the fonts of the theme. To fix that, you have to insert this on top of your **.htaccess**:
```<FilesMatch "\.(ttf|otf|eot|woff|svg)$">Header set Access-Control-Allow-Origin "*"</FilesMatch>```

## Shortcodes

### Columns

It's possible to create ````[two_````, ````[three_```` or ````[four_```` columns. The last column of an column group needs the attribute ````_last]````. Every column group has to be completed with a ````[divider]```` to clear the floating. Also The basic syntax for three columns is:

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

The first number ````[three_```` defines the grid and the second numer ````_one]```` the column width. Mind that every column also need its close tag. As the example above you can build other columns with the following paramenters:

#### 2 Columns

1-1 Columns: ````[two_columns_one][two_columns_one_last]````

#### 3 Columns

1-1-1 Columns: ````[three_columns_one][three_columns_one][three_columns_one_last]````

1-2 Columns: ````[three_columns_one][three_columns_two_last]````

2-1 Columns: ````[three_columns_two][three_columns_one_last]````

#### 4 Columns

1-1-1-1 Columns: ````[four_columns_one][four_columns_one][four_columns_one][four_columns_one_last]````

1-1-2 Columns: ````[four_columns_one][four_columns_one][four_columns_two_last]````

1-2-1 Columns: ````[four_columns_one][four_columns_two][four_columns_one_last]````

2-1-1 Columns: ````[four_columns_two][four_columns_one][four_columns_one_last]````

1-3 Columns: ````[four_columns_one][four_columns_three_last]````

3-1 Columns: ````[four_columns_three][four_columns_one_last]````

### Buttons

A default button is rectangled, orange and has a normal size. It only contains an attribute for your url and can be extended by the following attributes:

| Attribute | Shortcode |
| --- | --- |
| Default | ````[button link="http://yourdomain.com"]Text[/button]```` |
| Rounded | ````[button link="http://yourdomain.com" form="round"]Text[/button]```` |
| Colour | ````[button link="http://yourdomain.com" color="blue"]Text[/button]````<br />"blue, lightgrey, grey, darkgrey, red, green" |
| Size | ````[button link="http://yourdomain.com" size="large"]Text[/button]````<br />"xsmall, small, large, xlarge" |
