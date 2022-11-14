
 jQuery(document).ready(function () {
     'use strict';
     jQuery.datetimepicker.setLocale('vi');
    /* jQuery('#articlebooking-date').datetimepicker({
           dayOfWeekStart : 1,
  //   inline:true,
           format:'H:i d/m/Y'
       });*/

   jQuery('.datetimepicker').datetimepicker({
                             ownerDocument: document,
                             contentWindow: window,

                             value: '',
                             rtl: false,

                             format: 'd/m/Y H:i',
                             formatTime: 'H:i',
                             formatDate: 'd/M/Y',

                             startDate:  false, // new Date(), '1986/12/08', '-1970/01/05','-1970/01/05',
                             step: 60,
                             monthChangeSpinner: true,

                             closeOnDateSelect: false,
                             closeOnTimeSelect: true,
                             closeOnWithoutClick: true,
                             closeOnInputClick: true,
                             openOnFocus: true,

                             timepicker: true,
                             datepicker: true,
                             weeks: false,

                             defaultTime: false, // use formatTime format (ex. '10:00' for formatTime: 'H:i')
                             defaultDate: false, // use formatDate format (ex new Date() or '1986/12/08' or '-1970/01/05' or '-1970/01/05')

                             minDate: false,
                             maxDate: false,
                             minTime: false,
                             maxTime: false,
                             minDateTime: false,
                             maxDateTime: false,

                             allowTimes: [],
                             opened: false,
                             initTime: true,
                             inline: false,
                             theme: '',
                             touchMovedThreshold: 5,

                             onSelectDate: function (v) {
                               var d =  v.getDate();
                               console.log(d);
                               
                             },
                             onSelectTime: function (v) {
                               var t = v.getTime();
                               console.log(t);
                             },
                             onChangeMonth: function () {
                             
                             },
                             onGetWeekOfYear: function () {},
                             onChangeYear: function () {},
                             onChangeDateTime: function () {},
                             onShow: function () {},
                             onClose: function () {},
                             onGenerate: function () {},

                             withoutCopyright: true,
                             inverseButton: false,
                             hours12: false,
                             next: 'xdsoft_next',
                             prev : 'xdsoft_prev',
                             dayOfWeekStart: 0,
                             parentID: 'body',
                             timeHeightInTimePicker: 25,
                             //timepicker<a href="https://www.jqueryscript.net/tags.php?/Scroll/">Scroll</a>bar: true,
                             todayButton: true,
                             prevButton: true,
                             nextButton: true,
                             defaultSelect: true,

                             scrollMonth: true,
                             scrollTime: true,
                             scrollInput: true,

                             lazyInit: true,
                             mask: false,
                             validateOnBlur: true,
                             allowBlank: true,
                             yearStart: 1950,
                             yearEnd: 2050,
                             monthStart: 0,
                             monthEnd: 11,
                             style: '',
                             id: '',
                             fixed: false,
                             roundTime: 'round', // ceil, floor
                             className: '',
                             weekends: [],
                             highlightedDates: [],
                             highlightedPeriods: [],
                             allowDates : [],
                             allowDateRe : null,
                             disabledDates : [],
                             disabledWeekDays: [],
                             yearOffset: 0,
                             beforeShowDay: null,

                             enterLikeTab: true,
                             showApplyButton: false
                             });
 });
