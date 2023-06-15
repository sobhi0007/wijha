
    AOS.init( // Global settings:
  {  offset: 0, // offset (in px) from the original trigger point
    delay: 200, // values from 0 to 3000, with step 50ms
    duration: 2000, // values from 0 to 3000, with step 50ms
    easing: 'ease', // default easing for AOS animations
    once: false, // whether animation should happen only once - while scrolling down
    anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation
  })
  

  
  
// mediaquery for swiper + datapicker
function resize(){
  var element =  document.getElementsByClassName('mySwiper') ; 
  for(var i = 0; i < element.length; i++) {
  if (window.matchMedia('screen and (max-width: 572px)').matches) {
    element[i].setAttribute('slides-per-view',2);
    return 1
  }else if (window.matchMedia('screen and (max-width: 792px)').matches) {
    element[i].setAttribute('slides-per-view',2);
      return 1
  }else if(window.matchMedia('screen and (max-width: 992px)').matches) {
    element[i].setAttribute('slides-per-view',3);
      return 1
  }else if (window.matchMedia('screen and (max-width: 1200px )').matches){
    element[i].setAttribute('slides-per-view',4);
      return 2
  }else{
    element[i].setAttribute('slides-per-view',5);
      return 2
  }
}
}
window.addEventListener('resize', resize);
resize();

 





       
  //  $(document).ready(function(){
  //     // Call global the function
  //     $('.t-datepicker').tDatePicker({
  //    iconDate: '<i class="fa-regular fa-calendar text-muted h5 "></i>',
  
  //    arrowPrev: '<i class="fa fa-chevron-left"></i>',
  //    numCalendar    :   windowSize(),
  //    arrowNext: '<i class="fa fa-chevron-right"></i>',
     
  
  //     });
  //   });

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);
  
    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  

    document.onreadystatechange = function () {
      var state = document.readyState
      if (state == 'interactive') {
           document.getElementById('contents').style.visibility="hidden";
      } else if (state == 'complete') {
          setTimeout(function(){
             document.getElementById('interactive');
             document.getElementById('load').style.visibility="hidden";
             document.getElementById('contents').style.visibility="visible";
          },1000);
      }
    }