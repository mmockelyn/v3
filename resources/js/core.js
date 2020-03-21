import * as $ from "jquery";
import tooltip from 'bootstrap'


export function reloadNotifBar() {
    let countNotifBar = document.querySelector('#countNotifBar');
    let value = parseInt(countNotifBar.textContent);
    if (value === 0) {
        let iconEl = $(".kt-header__topbar-icon");
        iconEl.classList.remove('kt-hidden');
        iconEl.textContent = 1
    } else {
        countNotifBar.textContent = parseInt(value + 1);
    }
}

export function blockElement(el, message, state = 'success') {
    return KTApp.block(el, {
        overlayColor: '#000000',
        type: 'v2',
        state: state,
        size: 'lg',
        message: message
    })
}

export function unblockElement(el) {
    return KTApp.unblock(el)
}

export function addPremium() {
    $.get('/account/api/isPremium')
        .done((data) => {
            if (data.data === 'true') {
                $("#TutorielIndex").attr('data-premium', 'on');
                $("#TutorielList").attr('data-premium', 'on');
                $("#TutorielShow").attr('data-premium', 'on')
            } else {
                $("#TutorielIndex").attr('data-premium', 'off');
                $("#TutorielList").attr('data-premium', 'off');
                $("#TutorielShow").attr('data-premium', 'off')
            }
        })
}

export function formatDate(date, format = 'LL') {
    moment.locale('fr');
    return moment(date).format(format)
}

export function NotifyMe(title, body) {
    if (!("Notification" in window)) {
        toastr.warning('Ce Navigateur ne supporte pas les notifications')
    } else if (Notification.permission === 'granted') {
        let notification = new Notification(title, {
            body: body
        })
    } else if (Notification.permission !== 'denied') {
        Notification.requestPermission((permission) => {
            // Quelque soit la réponse de l'utilisateur, nous nous assurons de stocker cette information
            if (!('permission' in Notification)) {
                Notification.permission = permission;
            }

            // Si l'utilisateur est OK, on crée une notification
            if (permission === "granted") {
                let notification = new Notification(title, {
                    body: body
                });
            }
        })
    }

}

function hidingAlerting() {
    let alerts = document.querySelectorAll('#showAlerting');

    Array.from(alerts).forEach((alert) => {
        setTimeout(function () {
            fadeEffect('fadeOut', alert)
        }, 2500)
    })
}

/**
 *
 * @param type fadeIn or fadeOut
 * @param el element recuperer
 */
function fadeEffect(type, el) {
    if (type === 'fadeIn') {
        let fadeEffect = setInterval(function () {
            if (!el.style.opacity) {
                el.style.opacity = 0;
            }
            if (el.style.opacity < 1) {
                el.style.opacity += 0.1;
            } else {
                clearInterval(fadeEffect)
            }
        }, 200);
        return fadeEffect;
    }
    if (type === 'fadeOut') {
        let fadeEffect = setInterval(function () {
            if (!el.style.opacity) {
                el.style.opacity = 1;
            }
            if (el.style.opacity > 0) {
                el.style.opacity -= 0.1;
            } else {
                clearInterval(fadeEffect)
            }
        }, 200);
        return fadeEffect;
    }
}

hidingAlerting();

//$('[data-toggle="kt-tooltip"]').tooltip();



