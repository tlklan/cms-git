/**
 * @namespace Holds the cms functionality.
 */
var Cms = Cms || {};

(function() {
	/**
	 * Rot13 class.
	 * @author Christoffer Niska <christoffer.niska@nordsoftware.com>
	 * @class Cms.Rot13
	 */
	Cms.Rot13 = {
		map: null,
		length: 0,
		init: function() {
			if (this.map)
				return;

			var i, map = [],
				chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz',
				length = chars.length;

			for (i = 0; i < length; ++i) {
				map.push(chars.charAt((i + 13) % length));
			}

			this.map = map;
			this.length = length;
		},
		decode: function(text) {
			this.init();

			var i, c, idx, result = '';

			for (i = 0; i < text.length; ++i) {
				c = text.charAt(i);
				
				// TODO: Remove this hack if es5-shim is ever included again
				if (!Array.prototype.indexOf) {
					// hack for IE6-8 which lack the indexOf method
					var indexOfC = -1;

					for (var r = 0; r < this.map.length; r++) {
						if(this.map[r] == c) {
							indexOfC = r;
							break;
						}
					}
					
					idx = (indexOfC - 13) % this.length;
				} else {
					idx = (this.map.indexOf(c) - 13) % this.length;
				}

				if (idx < 13 && idx >= 0 ) {
					idx += this.length / 2;
				}

				result += this.map[idx] ? this.map[idx] : c;
			}

			return result;
		}
	};

})();