<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class RangkingPoinController extends Controller
{
    public function index(Request $request)
    {
        $dummyData = [
            ['nama' => 'Retno Setianingrum', 'perusahaan' => 'WAROENG SEHAT', 'poin' => 8537],
            ['nama' => 'Kholila', 'perusahaan' => 'AYU REZEKI GROUP', 'poin' => 8455],
            ['nama' => 'Listiawati', 'perusahaan' => 'WAROENG SEHAT', 'poin' => 8352],
            ['nama' => 'Sahbandi Azis', 'perusahaan' => 'PT CARISMA SENTRA PERSADA', 'poin' => 8139],
            ['nama' => 'Sumini', 'perusahaan' => 'WAROENG SEHAT', 'poin' => 7953],
            ['nama' => 'Kurniawati', 'perusahaan' => 'WAROENG SEHAT', 'poin' => 7937],
            ['nama' => 'Abdur Rohim', 'perusahaan' => 'AYU REZEKI GROUP', 'poin' => 7933],
            ['nama' => 'Riski Sunanda', 'perusahaan' => 'WAROENG SEHAT', 'poin' => 7875],
            ['nama' => 'Sandy Prabowo', 'perusahaan' => 'JAGOWEB', 'poin' => 7757],
            ['nama' => 'Muzanih', 'perusahaan' => 'WAROENG SEHAT', 'poin' => 7743],
            ['nama' => 'Eny Maryam', 'perusahaan' => 'WAROENG SEHAT', 'poin' => 7740],
            ['nama' => 'Jalil', 'perusahaan' => 'CV. SUPER TIM INDONESIA', 'poin' => 7670],
            ['nama' => 'M Yakub', 'perusahaan' => 'PT CARISMA SENTRA PERSADA', 'poin' => 7617],
            ['nama' => 'Widiana', 'perusahaan' => 'CV. CIPTA PERDANA', 'poin' => 7573],
            ['nama' => 'I Gede Widiasa', 'perusahaan' => 'PT CARISMA SENTRA PERSADA', 'poin' => 7498],
        ];

        // Simulate more data for pagination (2455 pages mentioned in image)
        // For simplicity, we'll just paginate the existing 15 items but show many pages.
        $perPage = 15;
        $currentPage = $request->get('page', 1);
        $totalItems = 36825; // 2455 pages * 15 items

        $paginatedData = new LengthAwarePaginator(
            $dummyData,
            $totalItems,
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.rangking-poin', compact('paginatedData'));
    }
}
