import * as $ from "jquery";
import * as L from "leaflet/dist/leaflet";

let $map = document.querySelector('#map')
let route = $("#route")
let route_id = route.attr('data-id')
let version = $("#freshVersion")
let version_id = version.attr('data-version-id')

console.log(version)
console.log(version_id)

class LeafletMap {
    constructor() {
        this.map = null
        this.bounds = []
    }

    async load(element) {
        return new Promise((resolve, reject) => {
            this.map = L.map(element).setView([51.505, -0.09], 13)
            L.tileLayer('https://tile.thunderforest.com/transport/{z}/{x}/{y}.png?apikey=4331c9da8af345bf8374aa345dcfb23a', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(this.map);
            resolve()
        })
    }

    addMarker(lat, lng, icon) {
        let point = [lat, lng]
        this.bounds.push(point)
        return new LeafletMarker(point, icon, this.map)
    }

    center() {
        this.map.fitBounds(this.bounds)
    }
}

class LeafletMarker {
    constructor(point, text, map) {
        this.popup = L.popup({
            autoClose: false,
            closeOnEscapeKey: false,
            closePopupOnClick: false,
            closeButton: false,
            className: 'marker',
            maxWidth: 50,
        })
            .setLatLng(point)
            .setContent(text)
            .openOn(map)
    }

    setActive() {
        this.popup.getElement().classList.add('is-active')
    }

    unsetActive() {
        this.popup.getElement().classList.remove('is-active')
    }

    addEventListener(event, callback) {
        this.popup.addEventListener('add', () => {
            this.popup.getElement().addEventListener(event, callback)
        })
    }

    setContent(text) {
        this.popup.setContent(text)
        this.popup.update()
    }
}

const InitMap = async function () {
    let map = new LeafletMap()
    let hoverMarker = null
    await map.load($map)

    Array.from(document.querySelectorAll('.js-marker')).forEach((item) => {
        let marker = map.addMarker(item.dataset.lat, item.dataset.lng, item.dataset.icon)

        item.addEventListener('mouseover', function () {
            if(hoverMarker !== null) {
                hoverMarker.unsetActive()
            }
            marker.setActive()
            hoverMarker = marker
        })
        item.addEventListener('mouseleave', function () {
            if(hoverMarker !== null) {
                hoverMarker.unsetActive()
            }
        })
        item.addEventListener('click', function () {
            marker.setContent(item.innerHTML)
        })
    })
    map.center()
}

export function loadGare() {
    let el = $(".route-trace")

    KTApp.progress(el)

    $.ajax({
        url: '/api/route/'+route_id+'/version/'+version_id+'/loadGares',
        success: function (data) {
            el.html(data.data.content)
            if($map !== null) {
                InitMap()
            }
        },
        error: function (jqxhr) {
            toastr.error("Erreur lors du chargement de la map", "Erreur Système")
            console.error(jqxhr.responseText)
        }
    })
}

loadGare();
