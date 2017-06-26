App.extend({
    Pages: {}
});

App.Pages.Poi = (function ($) {
    var pub = {
        name: 'CMS.Pages.Poi',

        $deletePoiModal: $('#deletePOIModal'),
        deleteModalIdSelector: '[data-id]',

        deletePoiModalCallback: function () {
            var modal = this.$deletePoiModal;
            modal.on('show.bs.modal', function (event) {
                var id = $(event.relatedTarget).data('id');
                modal.find(pub.deleteModalIdSelector).val(id);
            });
        },

        init: function () {
            this.deletePoiModalCallback();
        }
    };

    return pub;
})(jQuery);

App.initModule(App.Pages.Poi);
