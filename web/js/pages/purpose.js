App.extend({
    Pages: {}
});

App.Pages.Purpose = (function ($) {
    var pub = {
        name: 'CMS.Pages.Purpose',

        $deletePurposeModal: $('#deletePurposeModal'),
        deleteModalIdSelector: '[data-id]',

        deletePurposeModalCallback: function () {
            var modal = this.$deletePurposeModal;
            modal.on('show.bs.modal', function (event) {
                var id = $(event.relatedTarget).data('id');
                modal.find(pub.deleteModalIdSelector).val(id);
            });
        },

        init: function () {
            this.deletePurposeModalCallback();
        }
    };

    return pub;
})(jQuery);


App.initModule(App.Pages.Purpose);
