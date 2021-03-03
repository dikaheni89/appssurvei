 
 function fixPosition(slider, fromPercent) {
  var w;

  if (fromPercent === 100) {
    w = "calc(100% - 14px)";
  } else {
    w = "calc(" + fromPercent + "% - 6px)";
  }

  slider.find(".irs-bar").css("left", "auto").css("width", w);
  slider.find(".irs-slider").css("left", "auto").css("right", w);
}

 
  var min = 10;
  var max = 1000;

  $(".shop-price").ionRangeSlider({
	  prefix:"$",
    onStart: function (data) {
      fixPosition(data.slider, 0);
    },
    onChange: function (data) {
      data.from = min + (max - data.from);
      data.from_percent = 100 - data.from_percent;
      fixPosition(data.slider, data.from_percent);
    },
    prettify: function (num) {
      num = min + (max - num);
      return num;
    }
  });

 
 
	
 
	//   show hide------------------
    $(".show-cart").on("click", function() {
        $(".cart-overlay").fadeIn(400);
        $(".cart-modal").animate({
            left: 0
        }, 400);
        return false;
    });
    $(".cart-overlay , .close-cart").on("click", function() {
        $(".cart-overlay").fadeOut(400);
        $(".cart-modal").animate({
            left: "-350px"
        }, 400);
        return false;
    });