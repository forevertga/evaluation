App.extend({
    Polyfills: {}
});

App.Polyfills.Array = (function () {

    var pub = {
        name: 'App.Polyfills.Array',
        init: function () {
            indexOfPolyfill();
        }
    };

    /**
     *  Polyfill for Array.indexOf()
     *
     *  Production steps of ECMA-262, Edition 5, 15.4.4.14
     *  Reference: http://es5.github.io/#x15.4.4.14
     *
     *  Grabbed from https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/indexOf
     */
    function indexOfPolyfill() {
        if (!Array.prototype.indexOf) {
            Array.prototype.indexOf = function (searchElement, fromIndex) {
                var k;

                if (this == null) {
                    throw new TypeError('"this" is null or not defined');
                }

                var o = Object(this);
                var len = o.length >>> 0;

                if (len === 0) {
                    return -1;
                }

                var n = +fromIndex || 0;

                if (Math.abs(n) === Infinity) {
                    n = 0;
                }

                if (n >= len) {
                    return -1;
                }

                k = Math.max(n >= 0 ? n : len - Math.abs(n), 0);

                while (k < len) {
                    if (k in o && o[k] === searchElement) {
                        return k;
                    }
                    k++;
                }
                return -1;
            };
        }
    }

    return pub;
})();

App.initModule(App.Polyfills.Array);
