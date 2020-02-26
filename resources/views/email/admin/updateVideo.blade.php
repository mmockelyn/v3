@component('mail::message')
Bonjour,

    <p>Une ou plusieurs vidéos ont été mis à jours:</p>
    <table style="width: 100%; border: solid 1px;">
        <tr>
            <td>Nombre de vidéo</td>
            <td>{{ $count }} {{ \App\HelpersClass\Generator::formatPlural('vidéo', $count) }}</td>
        </tr>
        <tr>
            <td>Nom des vidéos</td>
            <td>
                <ul>
                    @foreach($arr as $item)
                        <li>{{ $item['name'] }}</li>
                    @endforeach
                </ul>
            </td>
        </tr>
    </table>
@endcomponent
