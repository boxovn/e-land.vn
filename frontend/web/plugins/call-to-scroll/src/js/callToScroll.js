/*
 * @author  Tomáš Valiašek
 * @license MIT
 */
(function ($) {
    $.fn.ctscroll = function (options) {

        var $settings = $.extend({
            'text': 'Scroll down',
            'autoIdText': 'ctsAddedId',
            'scrollDuration': 450,
            'scrollOffset': -25,
            'html5Hash': false,
            'viewPortTolerance': 0,
            'logEvents': false,
            'dotsRadius': 10
        }, options);
        
        var $targets = this;
        var $iScrollPos = 0;

        function appendBasicElements() {
            $('body').append('<div id="ctsElsWrapper"><a target="_self" title="" id="ctsArUp" class="cts-arrow cts-up cts-smsc"></a><p class="cts-text">'+$settings.text+'</p><a target="_self" title="" id="ctsArDown" class="cts-arrow cts-down cts-smsc"></a><div id="ctsDotsWrapper"></div><div>');
            $targets.each(function(){
                if($(this).attr('id')!==false && $(this).attr('id')!==undefined){
                    var $elId = $(this).attr('id');
                } else {                   
                    var $elId = $settings.autoIdText+$($targets).index(this);
                    $(this).attr('id', $elId);
                }
                $('#ctsDotsWrapper').append('<a href="#'+$elId+'" target="_self" title="" class="cts-dot cts-smsc"></a>');
                $('#ctsDotsWrapper').find('[href="#'+$elId+'"]').last().append(getSVGDot($settings.dotsRadius));
            });
        }
        
        function getSVGArrow($direction, $width, $height){
            var $NS = 'http://www.w3.org/2000/svg';
            var $points = ($direction==='up') ? '15,'+$height+' '+Math.floor($width/2)+',5 '+($width-15)+','+$height : '15,0 '+Math.floor($width/2)+','+($height-5)+' '+($width-15)+',0';
            var $svg = document.createElementNS($NS, 'svg');
            $svg.setAttributeNS(null, 'width', $width+'px');
            $svg.setAttributeNS(null, 'height', $height+'px');
            $svg.setAttributeNS(null, 'viewBox', '0,0 '+$width+','+$height);
            var $poly = document.createElementNS($NS, 'polyline');
            $poly.setAttributeNS(null, 'points', $points);
            $poly.setAttributeNS(null, 'class', 'cts-svg-arrow');           
            $svg.appendChild($poly);
            return $svg;
        }
        
        function getSVGDot($radius){
            var $NS = 'http://www.w3.org/2000/svg';
            var $svg = document.createElementNS($NS, 'svg');
            $svg.setAttributeNS(null, 'width', (2*$radius)+'px');
            $svg.setAttributeNS(null, 'height', (2*$radius)+'px');
            $svg.setAttributeNS(null, 'viewBox', '0,0 '+(2*$radius)+','+(2*$radius));
            var $circle = document.createElementNS($NS, 'circle');
            $circle.setAttributeNS(null, 'cx', $radius);
            $circle.setAttributeNS(null, 'cy', $radius);
            $circle.setAttributeNS(null, 'r', $radius);
            $circle.setAttributeNS(null, 'class', 'cts-svg-circle');
            $svg.appendChild($circle);
            return $svg;
        }
        
        function appendBasicSVGElements(){
            var $arrowUpSvg = getSVGArrow('up', 80, 20);
            var $arrowDownSvg = getSVGArrow('down', 80, 20); 
            document.getElementById('ctsArUp').appendChild($arrowUpSvg);
            document.getElementById('ctsArDown').appendChild($arrowDownSvg);
        }
        
        function init(){
            appendBasicElements();
            appendBasicSVGElements();
            checkViewport();
        }
        
        function setActiveDot($index){
            if( $index > -1){
                $('.cts-dot.cts-active').removeClass('cts-active');
                var $el = $('.cts-dot').eq($index);
                if($el !== false && $el !== undefined){
                    if(!$el.hasClass('cts-active')){
                        $el.addClass('cts-active');
                        setPrevNextLinks($index);
                    }
                }
            }
        }
        
        function checkViewport(){
            if($targets.filter(':in-viewport('+$settings.viewPortTolerance+')').length > 0){
                var $firstEl = $targets.filter(':in-viewport('+$settings.viewPortTolerance+'):first');
                var $index = $targets.index($firstEl);
                setActiveDot($index);
            }
        }
        
        function detectScrollDirection(){
            var $iCurScrollPos = $(window).scrollTop();
            ($iCurScrollPos > $iScrollPos) ? $(window).trigger('ctsScrollDown') : $(window).trigger('ctsScrollUp');
            $iScrollPos = $iCurScrollPos;
        } 
        
        function moveToTarget($id){            
            var $targetOffset = ($($id).offset().top + $settings.scrollOffset);
            
	    $('html, body').stop().animate({
	        'scrollTop': $targetOffset
	    }, $settings.scrollDuration, 'swing', function () {
	        //window.location.hash = $id;
                if(!$settings.html5Hash){
                    setLocationHash($id.replace('#',''));
                } else {
                    history.replaceState(null, null, $id);
                }
	    });
        }
        
        function setPrevNextLinks($currIndex){
            var $maxIndex = $('.cts-dot').length;
            var $nextIndex = ($currIndex <= $maxIndex) ? 1+$currIndex : null;
            var $prevIndex = ($currIndex <= 0) ? null : -1+$currIndex;
            var $prevHash = ($prevIndex!==null) ? $('a.cts-dot').eq($prevIndex).attr('href') : null;
            var $nextHash = ($nextIndex!==null) ? $('a.cts-dot').eq($nextIndex).attr('href') : null;
            $('a.cts-up').attr('href', $prevHash);
            $('a.cts-down').attr('href', $nextHash);
        }
        
        $(window).on('ctsScrollUp', function(){
            if($settings.logEvents === true){
                console.log('CallToScroll.js event catched: ctsScrollUp');
            }
            $('.cts-up').addClass('cts-active');//$arActiveClass);
            $('.cts-down').removeClass('cts-active');//$arActiveClass);
        });
        
        $(window).on('ctsScrollDown', function(){
            if($settings.logEvents === true){
                console.log('CallToScroll.js event catched: ctsScrollDown');
            }
            $('.cts-down').addClass('cts-active');//$arActiveClass);
            $('.cts-up').removeClass('cts-active');//$arActiveClass);
        });
        
        $(window).scroll(function(){
            detectScrollDirection();
            checkViewport();
        });
        
        $('body').on('click', '.cts-smsc', function (event) {
	    event.preventDefault();
	    var $id = $(this).attr('href');
            moveToTarget($id);
	});
        
        init();
        
        return this;
    };
}(jQuery));

