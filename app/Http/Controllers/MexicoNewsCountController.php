<?php

namespace App\Http\Controllers;

use App\Models\MexicoNews;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class MexicoNewsCountController extends Controller
{
    public function __invoke(Request $request)
    {
        $year = $request->get('year', date('Y'));
        $month = $request->get('month');

        // Query base
        $query = MexicoNews::query();

        // Aplicar filtros
        if ($year) {
            $query->whereYear('published_at', $year);
        }

        if ($month) {
            $query->whereMonth('published_at', $month);
        }

        // Obtener conteos para el dashboard
        $totalCount = $query->count();

        // Conteo por año (últimos 6 años)
        $yearlyCounts = MexicoNews::selectRaw('YEAR(published_at) as year, COUNT(*) as count')
            ->whereYear('published_at', '>=', date('Y') - 5)
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();

        // Conteo por mes del año seleccionado
        $monthlyCounts = MexicoNews::selectRaw('MONTH(published_at) as month, COUNT(*) as count')
            ->whereYear('published_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();


        // Obtener años disponibles para el filtro
        $availableYears = MexicoNews::selectRaw('YEAR(published_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // Obtener meses disponibles para el año seleccionado
        $availableMonths = MexicoNews::selectRaw('MONTH(published_at) as month')
            ->whereYear('published_at', $year)
            ->distinct()
            ->orderBy('month')
            ->pluck('month');

        $filters = [
            'year' => $year,
            'month' => $month,
        ];

        return Inertia::render('MexicoNewsCount', [
            'totalCount' => $totalCount,
            'yearlyCounts' => $yearlyCounts,
            'monthlyCounts' => $monthlyCounts,
            'availableYears' => $availableYears,
            'availableMonths' => $availableMonths,
            'filters' => $filters,
        ]);
    }
}

