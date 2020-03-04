<?php

namespace App\Http\Controllers;


use App\Notifications\Account\AccountCreatedNotification;
use App\User;
use Carbon\Carbon;

class TestController extends Controller
{
    public function test()
    {
        $params = [
            "dataset" => "referentiel-gares-voyageurs",
            "sort" => "gare_alias_libelle_noncontraint",
            "facet" => "gare_agencegc_libelle",
            "rows"   => 1,
            "facet" => "gare_regionsncf_libelle",
            "facet" => "gare_ug_libelle",
            "facet" => "pltf_departement_libellemin",
            "facet" => "pltf_segmentdrg_libelle",
            "facet" => "pltf_latitude_entreeprincipale_wgs84",
            "facet" => "pltf_longitude_entreeprincipale_wgs84",
        ];

        $psm = http_build_query($params);
        $endpoint = 'https://ressources.data.sncf.com/api/records/1.0/search?';

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL => $endpoint.$psm,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($ch);
        $jps = json_decode($response);

        dd($jps->records[0]->fields->pltf_longitude_entreeprincipale_wgs84);
    }
}
