// JavaScript Document
function backtotop() {
	var timeOut;
  if (document.body.scrollTop!==0 || document.documentElement.scrollTop!==0){
    window.scrollBy(0,-50);
    timeOut=setTimeout('backtotop()',75);
  }
  else clearTimeout(timeOut);
}
//------------------------------------------------
/*
$(document).ready(function(){
  $(".submenu > a").click(function(e) {
    e.preventDefault();
    var $li = $(this).parent("li");
    var $ul = $(this).next("ul");

    if($li.hasClass("open")) {
      $ul.slideUp(350);
      $li.removeClass("open");
    } else {
      $(".nav > li > ul").slideUp(350);
      $(".nav > li").removeClass("open");
      $ul.slideDown(350);
      $li.addClass("open");
    }
  });
  
});
*/
//---------------------------------------------------
  
  /*
    $(document).ready(function () {
        $('#membre').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "http://localhost/forum/admin/1/",
					data: 'query=' + query,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
						result($.map(data, function (item) {
							return item;
                        }));
                    }
                });
            }
        });
    });
	*/