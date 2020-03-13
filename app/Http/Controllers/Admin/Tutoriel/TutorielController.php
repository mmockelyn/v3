<?php

namespace App\Http\Controllers\Admin\Tutoriel;

use App\Http\Controllers\Controller;
use App\Repository\Stat\StatVideoRepository;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TutorielController extends Controller
{
    /**
     * @var StatVideoRepository
     */
    private $statVideoRepository;

    /**
     * TutorielController constructor.
     * @param StatVideoRepository $statVideoRepository
     */
    public function __construct(StatVideoRepository $statVideoRepository)
    {
        $this->statVideoRepository = $statVideoRepository;
    }

    public function index()
    {
        return view("admin.tutoriel.index", [
            "chartJour" => $this->chartJour(),
            "chartMonth" => $this->chartMonth()
        ]);
    }

    private function chartJour()
    {
        $chart = new LarapexChart();
        $chart->setXAxis(["00:00", "01:00", "02:00", "03:00", "04:00", "05:00", "06:00", "07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00"])
            ->setType('line')
            ->setDataset([
                [
                    "name" => "Aujourd'hui",
                    "data" => [
                        $this->statVideoRepository->loadViewToday(00, 01),
                        $this->statVideoRepository->loadViewToday(01, 02),
                        $this->statVideoRepository->loadViewToday(02, 03),
                        $this->statVideoRepository->loadViewToday(03, 04),
                        $this->statVideoRepository->loadViewToday(04, 05),
                        $this->statVideoRepository->loadViewToday(05, 06),
                        $this->statVideoRepository->loadViewToday(06, 07),
                        $this->statVideoRepository->loadViewToday(07, '08'),
                        $this->statVideoRepository->loadViewToday('08', '09'),
                        $this->statVideoRepository->loadViewToday('09', 10),
                        $this->statVideoRepository->loadViewToday(10, 11),
                        $this->statVideoRepository->loadViewToday(11, 12),
                        $this->statVideoRepository->loadViewToday(12, 13),
                        $this->statVideoRepository->loadViewToday(13, 14),
                        $this->statVideoRepository->loadViewToday(14, 15),
                        $this->statVideoRepository->loadViewToday(15, 16),
                        $this->statVideoRepository->loadViewToday(16, 17),
                        $this->statVideoRepository->loadViewToday(17, 18),
                        $this->statVideoRepository->loadViewToday(18, 19),
                        $this->statVideoRepository->loadViewToday(19, 20),
                        $this->statVideoRepository->loadViewToday(20, 21),
                        $this->statVideoRepository->loadViewToday(21, 22),
                        $this->statVideoRepository->loadViewToday(22, 23),
                        $this->statVideoRepository->loadViewToday(23, 00),
                    ]
                ]
            ]);

        return $chart;
    }

    private function chartMonth()
    {
        $chart = new LarapexChart();
        $chart->setXAxis([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31])
            ->setType('line')
            ->setDataset([
                [
                    "name" => "Nb de Vue",
                    "data" => [
                        $this->statVideoRepository->loadViewMonthly(1),
                        $this->statVideoRepository->loadViewMonthly(2),
                        $this->statVideoRepository->loadViewMonthly(3),
                        $this->statVideoRepository->loadViewMonthly(4),
                        $this->statVideoRepository->loadViewMonthly(5),
                        $this->statVideoRepository->loadViewMonthly(6),
                        $this->statVideoRepository->loadViewMonthly(7),
                        $this->statVideoRepository->loadViewMonthly(8),
                        $this->statVideoRepository->loadViewMonthly(9),
                        $this->statVideoRepository->loadViewMonthly(10),
                        $this->statVideoRepository->loadViewMonthly(11),
                        $this->statVideoRepository->loadViewMonthly(12),
                        $this->statVideoRepository->loadViewMonthly(13),
                        $this->statVideoRepository->loadViewMonthly(14),
                        $this->statVideoRepository->loadViewMonthly(15),
                        $this->statVideoRepository->loadViewMonthly(16),
                        $this->statVideoRepository->loadViewMonthly(17),
                        $this->statVideoRepository->loadViewMonthly(18),
                        $this->statVideoRepository->loadViewMonthly(19),
                        $this->statVideoRepository->loadViewMonthly(20),
                        $this->statVideoRepository->loadViewMonthly(21),
                        $this->statVideoRepository->loadViewMonthly(22),
                        $this->statVideoRepository->loadViewMonthly(23),
                        $this->statVideoRepository->loadViewMonthly(24),
                        $this->statVideoRepository->loadViewMonthly(25),
                        $this->statVideoRepository->loadViewMonthly(26),
                        $this->statVideoRepository->loadViewMonthly(27),
                        $this->statVideoRepository->loadViewMonthly(28),
                        $this->statVideoRepository->loadViewMonthly(29),
                        $this->statVideoRepository->loadViewMonthly(30),
                        $this->statVideoRepository->loadViewMonthly(31),
                    ]
                ]
            ]);

        return $chart;
    }
}
