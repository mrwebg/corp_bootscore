jQuery(function ($) {

  function consolelog(str){
    let development = false;
    if(development && '' !== str){
      console.log(String(str));
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
        }
      } else {
        if(navbar.classList.contains(sticky_class)){ // do it ounce only
          navbar.classList.remove(sticky_class);
        }
      }
    }
  }

  /* ==============================
  Parallax scrolling col
  ============================== */
  var parallaxcols = $('.parallax-col');
  var $window = $(window);
  $window.scroll(function () {
    var win_sctop = Math.round($(window).scrollTop());
    var win_width = $(window).width();
    var win_height = $(window).height();
    var doc_height = $(document).height();
    var breakpoint = 992;
    if (win_width >= breakpoint && (win_sctop + win_height + 1 < doc_height)) {
      parallaxcols.each(function () {
        var $this = $(this),
          scrollspeed = parseInt($this.data('scroll-speed')),
          val = - win_sctop / scrollspeed;
        $this.css('transform', 'translateY(' + val + 'px)');
        $this.css('margin-bottom', val + 'px');
      });    
    }
  });  


}); // jQuery End