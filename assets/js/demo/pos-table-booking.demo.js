var handleCheckTime=function(e){"use strict";return e<10&&(e="0"+e),e},handleStartTime=function(){"use strict";var e,t=new Date,n=t.getHours(),a=t.getMinutes(),i=t.getSeconds();a=handleCheckTime(a),i=handleCheckTime(i),e=n>11?"pm":"am",n=n>12?n-12:n,document.getElementById("time").innerHTML=n+":"+a+e;setTimeout(handleStartTime,500)},handleDatepicker=function(){"use strict";$('[data-render="datepicker"]').datepicker({todayHighlight:!0,autoclose:!0})};$(document).ready((function(){handleStartTime(),handleDatepicker()}));