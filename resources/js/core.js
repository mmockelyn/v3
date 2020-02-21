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


