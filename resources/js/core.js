export function reloadNotifBar() {
    let countNotifBar = document.querySelector('#countNotifBar')
    let value = parseInt(countNotifBar.textContent)
    if(value === 0) {
        let iconEl = $(".kt-header__topbar-icon")
        iconEl.append('<span id="countNotifBar" class="kt-hidden- kt-badge kt-badge--danger">'+parseInt(value+1)+'</span>')
    }else{
        countNotifBar.textContent = parseInt(value+1);
    }
}


