// slide image
$(document).ready(function () {
    // alert("nguyen truong an");
    $(".slide-show").mouseover(function () {
      var s = $(this).attr("src");
      //alert(s);
      $("#imgView").attr("src", s);
    });
    var s = $("#slide-wrap").children();
    var l = s.length;
    var i = 0;
    setInterval(function () {
      if (i === l) i = 0;
      var p = $(s[i]).attr("src");
      $("#imgView").attr("src", p);
      i++;
    }, 1500);
    //
    $("input.input-qty").each(function () {
      var $this = $(this),
        qty = $this.parent().find(".is-form"),
        min = Number($this.attr("min")),
        max = Number($this.attr("max"));
      if (min == 0) {
        var d = 0;
      } else d = min;
      $(qty).on("click", function () {
        if ($(this).hasClass("minus")) {
          if (d > min) d += -1;
        } else if ($(this).hasClass("plus")) {
          var x = Number($this.val()) + 1;
          if (x <= max) d += 1;
        }
        $this.attr("value", d).val(d);
      });
    });
  
    //
    $("#myModal").on("shown.bs.modal", function () {
      $("#myInput").trigger("focus");
    });
    //
  });
  