  if ( jQuery( ".slider" ).length )
  {
    // slider
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
      showDivs(slideIndex += n);
    }

    function showDivs(n) {
      var i;
      var x = jQuery(".mySlides");
      if (n > x.length) {slideIndex = 1}
      if (n < 1) {slideIndex = x.length}
      for (i = 0; i < x.length; i++) {
         x[i].style.display = "none";
      }
      x[slideIndex-1].style.display = "block";
    }

    jQuery("#slider-left").click(function() {
      plusDivs(-1);
    });

    jQuery("#slider-right").click(function() {
      plusDivs(1);
    });
  }