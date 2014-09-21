//============================================================================//
//  Animated Odometer class for use in Jellyfish Counter Widget for WordPress
//  Version 1.8
//  Copyright (C) 2014 Robert Miller
//  http://strawberryjellyfish.com
//
//  Originally inspired on
//  Gavin Brock's CSS/JavaScript Animated Odometer (Odometer.js)
//  Copyright (C) 2008 Gavin Brock
//  http://gavcode.wordpress.com/2008/04/07/cssjavascript-animated-odometer/
//============================================================================//
//
//  This program is free software: you can redistribute it and/or modify
//  it under the terms of the GNU General Public License as published by
//  the Free Software Foundation, either version 3 of the License, or
//  (at your option) any later version.
//
//  This program is distributed in the hope that it will be useful,
//  but WITHOUT ANY WARRANTY; without even the implied warranty of
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//  GNU General Public License for more details.
//
//  You should have received a copy of the GNU General Public License
//  along with this program.  If not, see <http://www.gnu.org/licenses/>.
//============================================================================//

function JellyfishOdometer(container) {
	if (!container)
		throw "ERROR: JellyfishOdometer object must be passed a document element.";

	// set up some default values
	this.container = container;
	this.format = '';
	this.digits = 6;
	this.tenths = true;
	this.digitHeight = 40;
	this.digitPadding = 0;
	this.digitWidth = 30;
	this.bustedness = 2;
	this.digitStyle = '';
	this.currentValue = -1;
	this.flat = false;

	this.waitTime = 10;
	this.startValue = 0;
	this.endValue = 0;
	this.currentValue = 0;
	this.direction = 'up';
	this.wholeNumber = 0;
	this.persist = false;
	this.persistInterval = 1;
	this.active = false;

	// get all instance specific configuration from container data attributes
	var opts = jQuery(this.container).data();
	for (var key in opts) {
		this[key] = opts[key];
	}

	if (this.format) {
		this.digits = (this.format.match(/0/g) || []).length;
	} else {
		this.format = new Array(this.digits + 1).join('0');
	}
	if (this.persist)
		this.tenths = false;
	this.currentValue = this.startValue;

	this.style = {
		digits: "height:" + this.digitHeight + "px; width:" + this.digitWidth +
			"px; padding:" + this.digitPadding + "px; font-size:" +
			(this.digitHeight - (2 * this.digitPadding)) + "px; line-height:" +
			(this.digitHeight - (2 * this.digitPadding)) + "px; " + this.digitStyle,

		columns: "height:" + this.digitHeight + "px; width:" + this.digitWidth +
			"px;"
	};

	this.highlights = [
		"jcw-highlight-1 jcw-highlight",
		"jcw-highlight-2 jcw-highlight",
		"jcw-highlight-3 jcw-highlight",
		"jcw-highlight-4 jcw-sidehighlight",
		"jcw-highlight-5 jcw-sidelowlight",
		"jcw-highlight-6 jcw-lowlight",
		"jcw-highlight-7 jcw-lowlight",
		"jcw-highlight-8 jcw-lowlight"
	];

	this.digitInfo = new Array();

	this.setDigitValue = function(digit, val, frac) {
		var di = this.digitInfo[digit];
		var px = Math.floor(this.digitHeight * frac);
		px += di.offset;
		if (val != di.last_val) {
			var tmp = di.digitA;
			di.digitA = di.digitB;
			di.digitB = tmp;
			di.digitA.innerHTML = val;
			di.digitB.innerHTML = (1 + Number(val)) % 10;
			di.last_val = val;
			di.last_px = this.digitHeight;
		}
		if (px != di.last_px) {
			di.digitA.style.top = (0 - px) + "px";
			di.digitB.style.top = (0 - px + this.digitHeight) + "px";
			di.last_px = px;
		}
	};

	this.set = function(inVal) {
		if (inVal < 0)
			throw "ERROR: JellyfishOdometer currentValue cannot be negative.";
		this.currentValue = inVal;
		if (this.tenths) inVal = inVal * 10;
		var numb = Math.floor(inVal);
		var frac = inVal - numb;
		numb = String(numb);
		for (var i = 0; i < this.digits; i++) {
			var num = numb.substring(numb.length - i - 1, numb.length - i) || 0;
			this.setDigitValue(this.digits - i - 1, num, frac);
			if (num != 9) frac = 0;
		}
	};

	this.get = function() {
		return (this.currentValue);
	};

	this.start = function() {
		this.active = true;
		this.updateOdometer();
	}

	this.stop = function() {
		this.active = false;
	}

	this.drawDigit = function(i) {
		var digitDivA = document.createElement("div");
		digitDivA.setAttribute("id", "odometer_digit_" + i + "a");
		digitDivA.className = "jcw-digit";
		digitDivA.style.cssText = this.style.digits;

		var digitDivB = document.createElement("div");
		digitDivB.setAttribute("id", "odometer_digit_" + i + "b");
		digitDivB.className = "jcw-digit";
		digitDivB.style.cssText = this.style.digits;

		var digitColDiv = document.createElement("div");
		digitColDiv.className = "jcw-digit-container";
		digitColDiv.style.cssText = this.style.columns;

		digitColDiv.appendChild(digitDivB);
		digitColDiv.appendChild(digitDivA);
		var offset = Math.floor(Math.random() * this.bustedness);
		this.digitInfo.push({
			digitA: digitDivA,
			digitB: digitDivB,
			last_val: -1,
			last_px: -1,
			offset: offset
		});
		return digitColDiv;
	};

	this.drawHighLights = function(digitColDiv) {
		if (!this.flat) {
			for (var j in this.highlights) {
				var hdiv = document.createElement("div");
				hdiv.innerHTML = "<p></p>"; // For Dumb IE
				hdiv.className = this.highlights[j];
				digitColDiv.appendChild(hdiv);
			}
		}
	};

	this.drawOdometer = function(container) {
		var odometerDiv = document.createElement("div");
		odometerDiv.className = "jcw-odometer-div";
		container.appendChild(odometerDiv);

		for (var i = 0; i < this.format.length; i++) {
			var character = this.format.charAt(i);
			if (character == '0') {
				var digitColDiv = this.drawDigit(i);
			} else {
				var separator = document.createElement("div");
				separator.innerHTML = character;
				separator.className = "jcw-digit";
				separator.style.cssText = this.style.digits;
				var digitColDiv = document.createElement("div");
				digitColDiv.className = "jcw-digit-container";
				digitColDiv.style.cssText = this.style.columns;
				digitColDiv.appendChild(separator);
			}
			this.drawHighLights(digitColDiv);
			odometerDiv.appendChild(digitColDiv);
		};

		if (this.tenths) {
			this.digitInfo[this.digits - 1].digitA.className = "jcw-tenth";
			this.digitInfo[this.digits - 1].digitB.className = "jcw-tenth";
		}

		if (this.currentValue >= 0) this.set(this.currentValue);
	};

	this.updateOdometer = function() {
		if (this.persist) {
			this.currentValue = (this.direction == 'down') ?
				this.currentValue - 0.15 : this.currentValue + 0.15;
			this.wholeNumber = this.wholeNumber + 0.15;
			if (this.wholeNumber >= 1) {
				this.wholeNumber = 0;
				this.currentValue = Math.round(this.currentValue);
				this.waitTime = this.persistInterval * 1000;
			} else {
				this.waitTime = 1;
			}
		} else {
			this.currentValue = (this.direction == 'down') ?
				this.currentValue - 0.01 : this.currentValue + 0.01;
		}
		if ((this.direction != 'down' && (this.currentValue < this.endValue)) ||
			(this.direction == 'down' && (this.currentValue > this.endValue)) &&
			this.active) {
			this.set(this.currentValue);
			var that = this;
			window.setTimeout(function() {
				that.updateOdometer();
			}, this.waitTime);
		} else {
			this.active = false;
		}
	};

	this.init = function(paused) {
		this.active = !paused;
		this.drawOdometer(this.container);
		this.set(this.startValue);
		if (this.endValue != this.startValue) {
			this.updateOdometer();
		}
	};
}