import Echo from 'laravel-echo'
import {NotifyMe} from './core'

let echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

echo.channel('trainznation_database_trainznation')
    .listen('update.info', function (event) {
        console.log(event)
    })
    .listen('PublishArticle', (event) => {
        NotifyMe(event.title, event.short_content);
        console.log(event)
    })
    .listen('AssetPublish', (event) => {
        NotifyMe(event.title, event.short_content);
        console.log(event)
    })
    .listen('TestEvent', (event) => {
        console.log(event)
    });
