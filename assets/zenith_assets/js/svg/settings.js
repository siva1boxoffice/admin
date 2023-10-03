/* MapSVG Builder Settings */


/*  Set URL to markers folder */ 
//var markersPathURL = '//' + window.location.host + window.location.pathname + "admin_assets/";
var getUrl = window.location;
//var base_url = getUrl.origin; // + '/' +getUrl.pathname.split('/')[1]

var markersPathURL =base_url+'/assets/'
//console.log(markersPathURL);
/*  If you don't use PHP (it gets all markers from the folder automatically)
    and if you want to use custom markers, add their filenames here
*/
var markerFiles = [
    '_pin_default.png',
    'pin1_black.png',
    'pin1_blue.png',
    'pin1_green.png',
    'pin1_grey.png',
    'pin1_orange.png',
    'pin1_purple.png',
    'pin1_red.png',
    'pin1_violet.png',
    'pin1_yellow.png',
    'small_blue.png',
    'small_grey.png'
];


/* Absolte path to your folder with CSS files. For example, if URL to CSS files is
 * http://yoursite.com/css/ then you should set cssPath as "/css/"
 * */
var cssPath = "css/svg/";

var cssFiles = [
    'bootstrap.min.css',
    // 'font-awesome.min.css',
    'bootstrap-colorpicker.min.css',
    'jquery.message.css',
    'select2.min.css',
    'ion.rangeSlider.css',
    'ion.rangeSlider.skinNice.css',
    'nanoscroller.css',
    'codemirror.css',
    'mapsvg.css',
    'main.css',
];

cssFiles.forEach(function(f){
    document.write('<link rel="stylesheet" type="text/css" href="'+markersPathURL+cssPath+f+'">');
});



