import Echo from 'laravel-echo'

let echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
})

echo.channel('trainznation_database_trainznation')
    .listen('update.info', function (event) {
        console.log(event)
    })
