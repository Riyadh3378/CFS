$(function() {
  $("select.mads").on("change", function() {
    $("select.madsd.active").removeClass("active");
    $("select.mausd.active").removeClass("active");
    $("input.addr_input.active").removeClass("active");

    var unionList = $("select.madsd." + $(this).val());

    if (unionList.length) {
      unionList.addClass("active");

      $(unionList).on("change", function() {
        $("select.mausd.active").removeClass("active");

        // var wardList = $("select.mausd").val();
        let wardList = $("select.mausd." + $(this).val());

        if (wardList.length) {
          wardList.addClass("active");
          $("input.addr_input.active").addClass("active");
        }

      });
    }

  });
});