(function ($) {
  $("form").bind("submit", function () {
    $(this).find(":input").prop("disabled", false);
  });
})(jQuery);
