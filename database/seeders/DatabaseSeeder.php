<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $path = 'camiseta-anime-6adeaa81-88ff-420b-aadc-06035c20a86a.png';

        // Obtener la URL usando el facade Storage
        $url = \Illuminate\Support\Facades\Storage::url($path);

        // También puedes usar la función helper storage_path() para obtener la ruta completa del archivo
        $fullPath = storage_path('app/public/'.$path);

        // Para verificar si el archivo existe
        $exists = \Illuminate\Support\Facades\Storage::exists($path);

        // Para obtener la URL con un disco específico (por ejemplo, 's3' o 'public')
        $publicUrl = \Illuminate\Support\Facades\Storage::disk('public')->url($path);
        dd($publicUrl);
    }
}
