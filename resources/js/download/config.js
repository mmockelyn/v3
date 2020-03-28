let asset = $("#asset")
let asset_id = asset.attr('data-id')

function loadConfig()
{
    let div = $("#config")

    KTApp.block(div);

    $.get('/api/'+asset_id+'/loadConfig')
        .done((data) => {
            KTApp.unprogress(data)
            div.html(data.data)
        })

}

loadConfig();
