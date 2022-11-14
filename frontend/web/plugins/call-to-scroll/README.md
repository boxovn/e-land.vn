# callToScroll
jQuery plugin which creates call-to-scroll-down navigation links on the right side of viewport, hidden on < 768px width viewport. 

This branch uses SVG elements instead of png images and links shaped in circles. Also includes SCSS sources.

[Demo page]


## Usage
Add stylesheet in head section
```html
<link rel="stylesheet" href="js/callToScroll/css/callToScroll.min.css" type="text/css" />
```
Then, before end of body link main plugin js file, libs are already included.
```html
<script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="js/callToScroll/callToScroll.min.js" type="text/javascript"></script>
```
####And use:
```js
<script type="text/javascript">
    jQuery(function(){
        $('h1').ctscroll({
            'text': 'Scroll down', /*Text between arrows*/
            'autoIdText': 'myIdText', /*if target element dont have id parameter, this text and element index is used to set it*/
            'scrollDuration': 450, /*in ms*/
            'scrollOffset': -35, /*positive or negative*/
            'html5Hash': false, /*switch between HTML5 ans non-HTML5 location manipulation*/
            'viewPortTolerance': 100, /*in-viewport detection tolerance in px*/
            'logEvents': false, /*if true, each internal catch of event ctsScrollUp and ctsScrollDown will be logged in console*/
            'dotsRadius': '15', /*size of navigation dots*/
            
        });
    });
</script>
```
#### Events
```js
    $(window).on('ctsScrollUp', function(){
        /*do something*/
    });
        
    $(window).on('ctsScrollDown', function(){
        /*do something*/
    });
```

### Dependencies

* [jQuery]
* [zeusdeux/isInViewPort] - (included in source) Nice minimalistic library for testing if element is in Viewport
* [shinnn/set-location-hash.js] - (included in source) Non HTML5 location hash manipulation (Optional)

License
----

MIT

[zeusdeux/isInViewPort]:https://github.com/zeusdeux/isInViewport
[shinnn/set-location-hash.js]:https://github.com/shinnn/set-location-hash.js
[jQuery]:http://jquery.com
[Demo page]:http://gitdemos.valiasek.cz/callToScroll-svg.html
