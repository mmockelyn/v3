import KTDatatable from '../../../../demo5/src/assets/js/global/components/base/datatable/core.datatable.js'
import {formatDate} from '../../../core'

let asset = $("#asset");
let asset_id = asset.attr('data-id');
let assetBase;

async function showInfo() {
    let asset_title = document.querySelector('#asset_title');
    let asset_block = document.querySelector('#asset_block');
    let asset_category = document.querySelector('#asset_category');
    let asset_publish = document.querySelector('#asset_publish');
    let asset_kuid = document.querySelector('#asset_kuid');
    let asset_price = document.querySelector('#asset_price');
    let asset_social = document.querySelector('#asset_social');
    let asset_downloaded = document.querySelector('#asset_downloaded');
    let asset_mesh = document.querySelector('#asset_mesh');
    let asset_config = document.querySelector('#asset_config');
    KTApp.block(asset_block);

    await getAsset()
        .then((response) => {
            KTApp.unblock(asset_block);
            asset_title.innerHTML = response.designation;
            asset_category.innerHTML = response.category.name + ' - ' + response.subcategory.name;
            asset_kuid.innerHTML = response.kuid;
            asset_downloaded.innerHTML = response.countDownload;
            if (response.published === 0) {
                asset_publish.innerHTML = `<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill"><i class="la la-times"></i> Non Publier</span>`
            } else {
                if (response.published_at !== null) {
                    asset_publish.innerHTML = `<span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill"><i class="la la-check"></i> Publier</span><br>Publié le ${formatDate(response.published_at, 'LLLL')}`
                }
            }
            if (response.pricing === 0) {
                asset_price.innerHTML = `<span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">Gratuit</span>`
            } else {
                asset_social.setAttribute('data-toggle', 'kt-tooltip');
                asset_social.setAttribute('title', 'Désactivé');
                asset_price.innerHTML = `<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">${response.price}</span>`
            }
            if (response.social === 0) {
                asset_social.style.color = '#6b6b6b';
                asset_social.setAttribute('data-toggle', 'kt-tooltip');
                asset_social.setAttribute('title', 'Désactivé')
            } else {
                asset_social.setAttribute('data-toggle', 'kt-tooltip');
                asset_social.setAttribute('title', 'Activé');
                asset_social.style.color = '#235ebf'
            }
            if (response.mesh === 0) {
                asset_social.style.color = '#6b6b6b';
                asset_mesh.setAttribute('data-toggle', 'kt-tooltip');
                asset_mesh.setAttribute('title', 'Désactivé')
            } else {
                asset_social.style.color = '#235ebf';
                asset_mesh.setAttribute('data-toggle', 'kt-tooltip');
                asset_mesh.setAttribute('title', 'Activé')
            }
            if (response.config === 0) {
                asset_social.style.color = '#6b6b6b';
                asset_config.setAttribute('data-toggle', 'kt-tooltip');
                asset_config.setAttribute('title', 'Désactivé')
            } else {
                asset_social.style.color = '#235ebf';
                asset_config.setAttribute('data-toggle', 'kt-tooltip');
                asset_config.setAttribute('title', 'Activé')
            }
        })
}

function getAsset() {
    return new Promise((resolve, reject) => {
        $.get('/api/admin/objet/objet/' + asset_id)
            .done((data) => {
                resolve(data.data)
            })
            .fail((err) => {
                reject(err)
            })
    })
}

showInfo();

