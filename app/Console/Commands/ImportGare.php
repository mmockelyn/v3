<?php

namespace App\Console\Commands;

use App\Repository\Core\GareRepository;
use Illuminate\Console\Command;

class ImportGare extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gare:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import les gares sncf en base de donnée';
    /**
     * @var GareRepository
     */
    private $gareRepository;

    /**
     * Create a new command instance.
     *
     * @param GareRepository $gareRepository
     */
    public function __construct(GareRepository $gareRepository)
    {
        parent::__construct();
        $this->gareRepository = $gareRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $params = [
            "dataset" => "referentiel-gares-voyageurs",
            "sort" => "gare_alias_libelle_noncontraint",
            "facet" => "gare_agencegc_libelle",
            "rows"   => 3270,
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
        $bar = $this->output->createProgressBar(count($jps->records));

        $bar->start();
        foreach ($jps->records as $gare) {
            if(isset($gare->fields->pltf_latitude_entreeprincipale_wgs84) ||  isset($gare->fields->pltf_longitude_entreeprincipale_wgs84)) {
                $this->gareRepository->create(
                    $gare->fields->gare_alias_libelle_noncontraint,
                    $gare->fields->pltf_latitude_entreeprincipale_wgs84,
                    $gare->fields->pltf_longitude_entreeprincipale_wgs84
                );
            }else{
                $this->gareRepository->create(
                    $gare->fields->gare_alias_libelle_noncontraint,
                    null,
                    null
                );
            }

            $bar->advance();
        }

        $bar->finish();
        $this->line("Terminer !");
        return null;
    }
}
