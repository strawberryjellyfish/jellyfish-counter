=== Jellyfish Counter Widget ===
Contributors: toxicToad
Author URI: http://strawberryjellyfish.com/
Donate link: http://strawberryjellyfish.com/donate/
Plugin URI: http://strawberryjellyfish.com/wordpress-plugin-jellyfish-counter-widget/
Tags: counter, odometer, milometer, animated, widget, totaliser
Requires at least: 3.0
Tested up to: 3.8
Stable tag: 0.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

An odometer style counter widget to display either a static value or animates to a set total. Great for tracking totals, not for counting jellyfish.

== Description ==

This plugin adds a widget to your WordPress web site that displays a static or
animated odometer style counter that can display a set value or can animate
between a starting and ending value. The counter can now have a continuous and
non resetting operation where it increments over time in the background until
the goal is reached.

The counter can either count upwards or downwards and is suitable for both incrementing
totals or countdown situations.

A great visual effect for travel blogs or any website that wants to display a
running total of anything.

You can have as many counters as you wish, all can have individual settings for
totals and appearance.

The counters are created via css and javascript and require no external graphics
files.


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

* Static - If you only give a Start Value and no End Value the counter will display
a static number (useful if you just want to show a total and update it manually
as necessary)

* Animated – If you supply both start value and end value in the widget, when it
is displayed the counter will increment upwards until it reaches the end value.
Speed of the count is controlled by the Animation Speed option. Note, this counter
has no memory, it will reset when a page is reloaded or changed. Good for visual
effect where start and end values are very close together.

* Continuous – If you want to count over a long period of time and need your
counter to continue to count irrespective of page loads then just select the
continuous option in the widget. Then select the interval between the counter
increments, in seconds. As soon as you save the widget the counter will “start”
and will continue to tick away even if nobody is viewing your blog. You can of
course still use the start values and end values in this mode however animation
speed and display tenths have no effect.

You can also configure the digit height, width and font as well as animation
speed (animated mode only)  and "bustedness" (misalignment of the digits).

In the "Digit Style" setting you can specify a font or font style, this must be
valid css values as it it added to the digits css. Note you cannot adjust the size
of the font here, that is automatically set from the height/width and padding settings.



== Installation ==

Extract the zip file and just drop the contents in the wp-content/plugins/
directory of your WordPress installation and then activate the Plugin from
Plugins page. Go to the widgets admin page to add a counter widget, each widget
has it's own settings.

== Frequently Asked Questions ==

== Changelog ==

* 0.9 Added countdown feature. Fixed bug where end value could not be 0

* 0.8 by request, added  a non resetting continuous counter feature that can increment
every set number of seconds until it reaches its goal

* 0.6 initial release

== Upgrade Notice ==

Existing counter widgets may need the animation speed adjusting as the timing
method has changed slightly since 0.6 making the counter animate slightly faster on
some browsers.

== Screenshots ==