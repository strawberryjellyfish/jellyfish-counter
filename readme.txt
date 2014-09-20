=== Jellyfish Counter Widget ===
Contributors: toxicToad
Author URI: http://strawberryjellyfish.com/
Donate link: http://strawberryjellyfish.com/donate/
Plugin URI: http://strawberryjellyfish.com/wordpress-plugin-jellyfish-counter-widget/
Tags: counter, odometer, milometer, animated, widget, totaliser
Requires at least: 3.0
Tested up to: 3.8
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A highly configurable odometer style counter widget that can display either a
static value or animate to a predefined total over time.

== Description ==

This plugin allows you to add a widgets to your WordPress web site that can
display a static or animated odometer style counter. The counter can be used as
a manually updated total, an automatic counter updating over time or just as an
animated visual effect.

The counter can either count upwards or downwards and is suitable for both
incrementing totals or countdown situations.

A great visual effect for travel blogs or any website that wants to display a
running total of anything.

You can have as many counters as you wish, all can have individual settings for
totals and appearance.

The counters are highly configurable through the widget interface and are
generated using CSS and Javascript, requiring no external graphics files.


Demo

You can see a counter in action at http://sharkaroo.net/map
Using an animated counter adds visual and narrative impact to an otherwise
static value.

Another demo and further information can be found at the plugin website
http://strawberryjellyfish.com/wordpress-plugin-jellyfish-counter-widget/

This plugin uses a modified version of a javascript odometer class written by
Gavin Brock http://gavcode.wordpress.com/2008/04/07/cssjavascript-animated-odometer/


==Usage==

Add a counter widget to your sidebar and adjust the settings to suit your
requirements.

There are three basic modes of operation:

* Static - If you want the counter to simply display a non animate number just
set a Start Value to the desired number for the counter and set the
Counter Type to 'static'

* Animated – If you supply both start value and end value in the widget, the
counter will increment upwards or downwards depending on the chosen Counter Type
until it reaches the end value. Speed of the count is controlled by the
Animation Speed option. Note, this counter has no memory, it will reset when a
page is reloaded or changed but it is great for a visual effect where start and
end values are very close together.

* Continuous – If you want to count over a long period of time and need your
counter to continue to count irrespective of page loads then just select the
continuous option in the widget. Then choose the interval between the counter
increments, in seconds. As soon as you save the widget the counter will "start"
and will continue to tick away even if nobody is viewing your blog. Changing the
setting on an active continuous counter will not effect the count value and it
will keep count, if you wish to reset an active continuous counter just change
the start value and save the widget and the counter will restart from the new
starting value.
Note: In continuous mode, animation speed and display tenths have no effect.

The counter is very configurable through the widget panel. You can define the
digit height, width and font as well as animation speed (animated mode only) and
"bustedness" (misalignment of the digits). Additionally, through "Digit Style"
setting you can specify a font, font style, colour, background or any other CSS
display properties for the digits.
Note: you cannot adjust the size of the font here as is automatically calculated
from the height / width and padding settings.

Need a flat looking counter? "Disable 3D effect" removes the CSS shading effect.


== Installation ==

Extract the zip file and just drop the contents in the wp-content/plugins/
directory of your WordPress installation and then activate the Plugin from
Plugins page. Go to the widgets admin page to add a counter widget, each widget
has its own settings.


== Changelog ==

= 1.2 =
* Another major refactoring of JavaScript. All counter functions are now part
of the odometer class which now takes it's configuration from data attributes
on the counter container element. No more inline JavaScript!
* Much of the inline CSS has now been abstracted to a base stylesheet making
it easier to restyle counters. Individual counter can still be styled through
their widgets.

= 1.1 =
* No longer use widget_content filter instead of the_content filter on widget
before/after text
* Major reworking of odometer class to incorporate new features
* Added format option to allow formatting the counter display to include non
counting characters such as prefixes or separators

= 1.0 =
* Continuous counters no longer reset when their widget is saved unless the
start value is changed.
* Added ability to define text to be displayed before and after the counter.
* Added a "disable 3D effect" setting to blend with flat design themes.
* Added a more logical "Count Up | Static | Countdown" Counter Type setting.
* General improvements to the widget settings interface.
* The plugin is now localized and translation ready - let me know if you'd like
to translate the plugin into your language.

= 0.9 =
* Added countdown feature.
* Fixed bug where end value could not be 0

= 0.8 =
* by request, added  a non resetting continuous counter feature that can increment
every set number of seconds until it reaches its goal

= 0.6 =
* initial release


== Upgrade Notice ==

Existing counters should not be effected by an upgrade but it is always good
practice to backup your database and installation before performing an upgrade.

After an upgrade visit the widget admin page to check the new options available
to your counters.
