/*!
 * set-location-hash.js | MIT (c) Shinnosuke Watanabe
 * https://github.com/shinnn/set-location-hash.js
*/
!function(){var b;if(typeof history.pushState==="function"&&typeof history.replaceState==="function"){b=function b(g,f){f=f||{force:false,replace:false};var e;if(f.replace){e="replaceState"}else{e="pushState"}var d="#"+g;if(location.hash!==d||f.force){history[e](null,document.title,location.pathname+location.search+d)}return location.href}}else{var a=document.body;var c=document.documentElement;b=function b(e){var d=a.scrollTop||c.scrollTop;location.hash=""+e;a.scrollTop=d;c.scrollTop=d;return location.href}}window.setLocationHash=b}();