import * as $ from "jquery";
let terms = [{
    time: 45,
    divide: 60,
    text: "moins d\'une minute"
},{
    time: 90,
    divide: 60,
    text: "environ une minute"
},{
    time: 45 * 60,
    divide: 60,
    text: "%d minutes"
},{
    time: 90 * 60,
    divide: 60 * 60,
    text: "environ une heure"
},{
    time: 24 * 60 * 60,
    divide: 60 * 60,
    text: "%d heures"
},{
    time: 42 * 60 * 60,
    divide: 24 * 60 * 60,
    text: "environ un jour"
},{
    time: 30 * 24 * 60 * 60,
    divide: 24 * 60 * 60,
    text: "%d jours"
},{
    time: 45 * 24 * 60 * 60,
    divide: 24 * 60 * 60 * 30,
    text: "environ un mois"
},{
    time: 365 * 24 * 60 * 60,
    divide: 24 * 60 * 60 * 30,
    text: "%d mois"
},{
    time: 365 * 1.5 * 24 * 60 * 60,
    divide: 24 * 60 * 60 * 365,
    text: "environ un ans"
},{
    time: Infinity,
    divide: 24 * 60 * 60 * 365,
    text: "%d ans"
}]

export function ago() {
    return setText()
}

function setText() {
    let countdownEl = document.querySelectorAll('.countdown')
    Array.from(countdownEl).forEach((countdown) => {
        let secondes = Math.floor((new Date()).getTime() / 1000 - parseInt(countdown.dataset.ago, 10))
        secondes = Math.abs(secondes)
        let term = null
        for(term of terms) {
            if(secondes < term.time) {
                break
            }
        }
        countdown.innerHTML = "Dans " + term.text.replace('%d', Math.round(secondes / term.divide))

        let nextTick = secondes % term.divide

        if(nextTick === 0) {
            nextTick = term.divide
        }

        window.setTimeout(function () {
            if(countdown.parentNode) {
                window.requestAnimationFrame(setText)
            }
        }, nextTick * 1000)
    })
}
