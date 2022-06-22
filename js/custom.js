jQuery(function ($) {

  function consolelog(str){
    let development = true;
    if(development && typeof str === 'string' && '' !== str){
      console.log(str);
    }
  }

  /* ==============================
  Animate sticky navbar
  ============================== */
  if(document.getElementById('nav-main') !== null){
    let navbar = document.getElementById('nav-main');
    let sticky_offset = 20;
    let sticky_class = 'nav-main-sticky';
    window.onscroll = function() {scrollFunction()};
    function scrollFunction() {
      if (document.body.scrollTop > sticky_offset || document.documentElement.scrollTop > sticky_offset) {
        if(!navbar.classList.contains(sticky_class)){ // do it ounce only
          navbar.classList.add(sticky_class);
          consolelog('ADDED class ' + sticky_class + ' to #nav-main');
        }
      } else {
        if(navbar.classList.contains(sticky_class)){ // do it ounce only
          navbar.classList.remove(sticky_class);
          consolelog('REMOVED class ' + sticky_class + ' from #nav-main');
        }
      }
    }
  }


}); // jQuery End
