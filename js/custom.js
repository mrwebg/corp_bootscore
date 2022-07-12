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
  // var parallaxcols = $('.parallax-col');
  // var isObj = typeof(parallaxcols);
  // var isFull = (parallaxcols.length > 0) ? true : false;
  // var $window = $(window);
  // if (isObj && isFull) {
  //   $window.scroll(function () {
  //     var win_sctop = Math.round($(window).scrollTop());
  //     var win_width = $(window).width();
  //     var win_height = $(window).height();
  //     var doc_height = $(document).height();
  //     var breakpoint = 992;
  //     if (win_width >= breakpoint && (win_sctop + win_height + 1 < doc_height)) {
  //       parallaxcols.each(function () {
  //         var $this = $(this),
  //           scrollspeed = parseInt($this.data('scroll-speed')),
  //           val = - win_sctop / scrollspeed;
  //         $this.css('transform', 'translateY(' + val + 'px)');
  //         $this.css('margin-bottom', val + 'px');
  //       });
  //     }
  //   });
  // }  

   /* ==============================
  On window.scroll use requestAnimationFrame to move cols
  ============================== */
  let movingContainers = true;
  function moveContainers() {

    var parallaxcols = $('.parallax-col');
    var isObj = typeof(parallaxcols);
    var isFull = (parallaxcols.length > 0) ? true : false;
    var $window = $(window);
    var win_sctop = Math.round($window.scrollTop());
    var win_width = $window.width();
    var win_height = $window.height();
    var doc_height = $(document).height();
    var breakpoint = 992;

    if (isObj && isFull && win_width >= breakpoint && (win_sctop + win_height + 1 < doc_height)) {
      parallaxcols.each(function () {
        var $this = $(this),
        scrollspeed = parseInt($this.data('scroll-speed')),
        val = - win_sctop / scrollspeed;
        $this.css('transform', 'translateY(' + val + 'px)');
        $this.css('margin-bottom', val + 'px');
      });
    }
  }

  window.addEventListener('scroll', function () {
    if (movingContainers) {
      movingContainers = false;
      window.requestAnimationFrame(moveContainers);
      window.setTimeout(() => movingContainers = true, 15);
    }
  })

  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
  })


}); // jQuery End