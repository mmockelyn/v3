let cache = document.querySelector("#btnRefreshCache");
cache.addEventListener('click', function (e) {
    e.preventDefault();
    KTApp.progress(cache);
    $.get('/api/admin/cache')
        .done(() => {
            KTApp.unprogress(cache);
            toastr.success("Le cache à été nettoyer");
        })
        .fail(() => {
            KTApp.unprogress(cache);
            toastr.error("Erreur lors du nettoyage du cache")
        })
});
