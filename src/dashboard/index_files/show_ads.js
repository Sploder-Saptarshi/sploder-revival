var searchadsReplaceSizes = {
	"728x90": "728x90",
	"300x250": "300x250",
	"160x600": "160x600",
	"336x280": "336x280",
	"468x60": "468x60",
	"300x600": "300x600",
	"120x600": "120x600",
	"250x250": "250x250",
	"200x200": "200x200",
	"320x50": "320x50",
	"180x150": "180x150",
	"970x110": "728x90",
	"970x90": "728x90",
	"1000x124": "728x90",
};

var adUrl = "//ib.adnxs.com/tt?id=2032697&size=[WIDTH]x[HEIGHT]&referrer=[REFERRER_URL]";

if (typeof google_ad_width != 'undefined' && typeof google_ad_height != 'undefined') {
	var orignalSize = google_ad_width + "x" + google_ad_height;
	var processedSize = searchadsReplaceSizes[orignalSize] || "0x0";
	var [width, height] = processedSize.split("x");
	if (width && height) {
		var src = adUrl.replace(/\[WIDTH\]/g, parseInt(width)).replace(/\[HEIGHT\]/g, parseInt(height)).replace(/\[REFERRER_URL\]/g, encodeURIComponent(top.window.location.href));
		document.write('<div class="_ad4u">');
		document.write('<iframe border=0 frameBorder=0 scrolling="no" style="width:' + width + 'px;height:' + height + 'px" src="' + src + '"></iframe>');
		document.write('</div>');
		[].forEach.call(document.querySelectorAll('._ad4u'), function (item) {
			if (item.parentNode.nodeName != 'TD') item.parentNode.style.setProperty('display', 'block', 'important');
		});
		window.postMessage({ type: "BGcall", name: "stats", opts: 405, callback: null }, "*");
	}
}
