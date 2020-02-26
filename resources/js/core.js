import * as $ from "jquery";

export function reloadNotifBar() {
    let countNotifBar = document.querySelector('#countNotifBar')
    let value = parseInt(countNotifBar.textContent)
    if(value === 0) {
        let iconEl = $(".kt-header__topbar-icon")
        iconEl.classList.remove('kt-hidden')
        iconEl.textContent = 1
    }else{
        countNotifBar.textContent = parseInt(value+1);
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
            if(data.data == 'true') {
                $("#TutorielIndex").attr('data-premium', 'on')
                $("#TutorielList").attr('data-premium', 'on')
                $("#TutorielShow").attr('data-premium', 'on')
            }else{
                $("#TutorielIndex").attr('data-premium', 'off')
                $("#TutorielList").attr('data-premium', 'off')
                $("#TutorielShow").attr('data-premium', 'off')
            }
        })
}



