<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\MetarRepository;
use App\Services\MetarObservationDecoder;

class ReportController extends Controller
{
    /**
     * @OA\Get(
     *     tags={"reports"},
     *     security={
     *          {"passport": {}},
     *     },
     *     path="/api/weather/report/pdf",
     *     @OA\Parameter(
     *         name="airports[]",
     *         in="query",
     *         description="List of airports code",
     *         required=true,
     *         @OA\Schema(type="array",
     *             @OA\Items(type="string")
     *         )
     *     ),
     *     @OA\Response(response="200", description="Download weather report pdf file", @OA\JsonContent())
     * )
     */
    public function getPdf()
    {
        $observations = $this->getObservationsData();
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('reports.html', [
            'observations' => $observations
        ]);

        return $pdf->download('report_' . time() . '.pdf');
    }


    /**
     * @OA\Get(
     *     tags={"reports"},
     *     security={
     *          {"passport": {}},
     *     },
     *     path="/api/weather/report/html",
     *     @OA\Parameter(
     *         name="airports[]",
     *         in="query",
     *         description="List of airports code",
     *         required=true,
     *         @OA\Schema(type="array",
     *             @OA\Items(type="string")
     *         )
     *     ),
     *     @OA\Response(response="200", description="Get weather report in html format", @OA\JsonContent())
     * )
     */
    public function getHtml()
    {
        $observations = $this->getObservationsData();

        return response()->view('reports.html',[
            'observations' => $observations
        ]);
    }


    /**
     * @OA\Get(
     *     tags={"reports"},
     *     security={
     *          {"passport": {}},
     *     },
     *     path="/api/weather/report/json",
     *     @OA\Parameter(
     *         name="airports[]",
     *         in="query",
     *         description="List of airports code",
     *         required=true,
     *         @OA\Schema(type="array",
     *             @OA\Items(type="string")
     *         )
     *     ),
     *     @OA\Response(response="200", description="Get weather report in json format", @OA\JsonContent())
     * )
     */
    public function getJson()
    {
        $observations = $this->getObservationsData();

        return response()->json($observations);
    }


    /**
     * @OA\Get(
     *     tags={"reports"},
     *     security={
     *          {"passport": {}},
     *     },
     *     path="/api/weather/report/text",
     *     @OA\Parameter(
     *         name="airports[]",
     *         in="query",
     *         description="List of airports code",
     *         required=true,
     *         @OA\Schema(type="array",
     *             @OA\Items(type="string")
     *         )
     *     ),
     *     @OA\Response(response="200", description="Get weather report in raw format")
     * )
     */
    public function getText()
    {
        $observations = $this->getObservationsData();

        return response()->view('reports.text', [
            'observations' => $observations
        ]);
    }

    /**
     * Get list of observations
     *
     * @return array List of objects MetarObservationDecoder
     */
    protected function getObservationsData()
    {
        $airports = request()->get('airports');
        $dataList = [];

        foreach ($airports as $airportCode) {
            $metarRepository = new MetarRepository;
            $observationData = $metarRepository->getDataByCode($airportCode);

            $dataList[] = new MetarObservationDecoder($airportCode, $observationData);
        }

        return $dataList;
    }
}
