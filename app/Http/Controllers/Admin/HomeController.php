<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Account\InvoiceRepository;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class HomeController extends Controller
{
    /**
     * @var InvoiceRepository
     */
    private $invoiceRepository;

    /**
     * HomeController constructor.
     * @param InvoiceRepository $invoiceRepository
     */
    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function dashboard()
    {
        $chart = new LarapexChart();
        $chart->setXAxis(["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre"])
            ->setType('line')
            ->setDataset([
                [
                    'name' => "Année N",
                    'data' => [
                        $this->invoiceRepository->loadChartData('01-01-'.now()->year, '31-01-'.now()->year),
                        $this->invoiceRepository->loadChartData('01-02-'.now()->year, '29-02-'.now()->year),
                        $this->invoiceRepository->loadChartData('01-03-'.now()->year, '31-03-'.now()->year),
                        $this->invoiceRepository->loadChartData('01-04-'.now()->year, '30-04-'.now()->year),
                        $this->invoiceRepository->loadChartData('01-05-'.now()->year, '31-05-'.now()->year),
                        $this->invoiceRepository->loadChartData('01-06-'.now()->year, '30-06-'.now()->year),
                        $this->invoiceRepository->loadChartData('01-07-'.now()->year, '31-07-'.now()->year),
                        $this->invoiceRepository->loadChartData('01-08-'.now()->year, '31-08-'.now()->year),
                        $this->invoiceRepository->loadChartData('01-09-'.now()->year, '30-09-'.now()->year),
                        $this->invoiceRepository->loadChartData('01-10-'.now()->year, '31-10-'.now()->year),
                        $this->invoiceRepository->loadChartData('01-11-'.now()->year, '30-11-'.now()->year),
                        $this->invoiceRepository->loadChartData('01-12-'.now()->year, '31-12-'.now()->year),
                    ]
                ],
                [
                    'name' => "Année N-1",
                    'data' => [
                        $this->invoiceRepository->loadChartData('01-01-'.now()->subYear()->year, '31-01-'.now()->subYear()->year),
                        $this->invoiceRepository->loadChartData('01-02-'.now()->subYear()->year, '28-02-'.now()->subYear()->year),
                        $this->invoiceRepository->loadChartData('01-03-'.now()->subYear()->year, '31-03-'.now()->subYear()->year),
                        $this->invoiceRepository->loadChartData('01-04-'.now()->subYear()->year, '30-04-'.now()->subYear()->year),
                        $this->invoiceRepository->loadChartData('01-05-'.now()->subYear()->year, '31-05-'.now()->subYear()->year),
                        $this->invoiceRepository->loadChartData('01-06-'.now()->subYear()->year, '30-06-'.now()->subYear()->year),
                        $this->invoiceRepository->loadChartData('01-07-'.now()->subYear()->year, '31-07-'.now()->subYear()->year),
                        $this->invoiceRepository->loadChartData('01-08-'.now()->subYear()->year, '31-08-'.now()->subYear()->year),
                        $this->invoiceRepository->loadChartData('01-09-'.now()->subYear()->year, '30-09-'.now()->subYear()->year),
                        $this->invoiceRepository->loadChartData('01-10-'.now()->subYear()->year, '31-10-'.now()->subYear()->year),
                        $this->invoiceRepository->loadChartData('01-11-'.now()->subYear()->year, '30-11-'.now()->subYear()->year),
                        $this->invoiceRepository->loadChartData('01-12-'.now()->subYear()->year, '31-12-'.now()->subYear()->year),
                    ]
                ]
            ]);

        return view("admin.dashboard", [
            "chart" => $chart
        ]);
    }
}
