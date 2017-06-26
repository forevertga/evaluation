(function () {
    var $selectAll = $('.select-all-check');
    var $name = $('.department-name');

    $selectAll.change(function () {
        var $parentForm = $(this).closest('form');
        var $checkboxes = $parentForm.find('.check-list input');
        $checkboxes.prop('checked', $(this).prop("checked"));
    });
    $('.modal').on('show.bs.modal', function (event) {
        var src = $(event.relatedTarget),
            title = src.data('name');
        $name.html(title);
    });
})(jQuery);