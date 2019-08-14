$(document).ready(function() {
	$('[data-plugin="appear"]').appear();
	$('[data-plugin="appear"]').not(':appeared').addClass("invisible");
    $(document).on("appear", '[data-plugin="appear"]', function() {
      var $item = $(this),
        animate = $item.data("animate");
      if ($item.hasClass('appear-no-repeat')) return;
      $item.removeClass("invisible").addClass('animation-' + animate);
      if ($item.data("repeat") === false) {
        $item.addClass('appear-no-repeat');
      }
    });

    $(document).on("disappear", '[data-plugin="appear"]', function() {
      var $item = $(this),
        animate = $item.data("animate");
      if ($item.hasClass('appear-no-repeat')) return;
      $item.addClass("invisible").removeClass('animation-' + animate);
    });
})