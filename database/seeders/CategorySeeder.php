<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Cerámica ',
            'description' => 'Productos como jarrones, tazas, platos y esculturas de barro o porcelana.',
        ]);

        Category::create([
            'name' => 'Textiles',
            'description' => 'Telas, ropa, y accesorios tejidos, bordados o estampados (bufandas, mantas, tapices).',
        ]);

        Category::create([
            'name' => 'Joyería',
            'description' => 'Collares, pulseras, anillos, pendientes hechos a mano con materiales como metales, cuentas o piedras preciosas.',
        ]);

        Category::create([
            'name' => 'Cestería',
            'description' => 'Cestas, bolsos y otros productos tejidos con fibras naturales.',
        ]);

        Category::create([
            'name' => 'Pintura',
            'description' => 'Obras de arte en diferentes estilos y técnicas (acuarelas, óleos, ilustraciones).',
        ]);

        Category::create([
            'name' => 'Escultura',
            'description' => 'Figuras talladas en madera, piedra u otros materiales.',
        ]);

        Category::create([
            'name' => 'Vidrio',
            'description' => 'Productos decorativos o utilitarios hechos de vidrio (espejos, jarrones, vitrales).',
        ]);

        Category::create([
            'name' => 'Cuero',
            'description' => 'Artículos como carteras, cinturones, bolsos, y otros objetos de cuero.',
        ]);

        Category::create([
            'name' => 'Muebles',
            'description' => 'Mobiliario pequeño y decorativo hecho a mano (mesas, sillas, estantes).',
        ]);

        Category::create([
            'name' => 'Instrumentos Musicales',
            'description' => 'Instrumentos artesanales como tambores, flautas, maracas.',
        ]);
    }
}
