<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'iPhone 15 Pro',
                'description' => 'El iPhone 15 Pro cuenta con el chip A17 Pro, cámara principal de 48MP y diseño en titanio. Perfecto para fotografía profesional y rendimiento extremo.',
                'price' => 1199.99,
                'stock' => 25,
                'category' => 'Electrónicos'
            ],
            [
                'name' => 'MacBook Air M2',
                'description' => 'Laptop ultradelgada con chip M2, pantalla Liquid Retina de 13.6 pulgadas y hasta 18 horas de duración de batería. Ideal para trabajo y creatividad.',
                'price' => 1299.99,
                'stock' => 15,
                'category' => 'Electrónicos'
            ],
            [
                'name' => 'Sony WH-1000XM5',
                'description' => 'Auriculares inalámbricos con la mejor cancelación de ruido del mercado. Sonido Hi-Res y 30 horas de batería.',
                'price' => 399.99,
                'stock' => 40,
                'category' => 'Audio'
            ],
            [
                'name' => 'Nike Air Max 270',
                'description' => 'Zapatillas deportivas con tecnología Air Max para máxima comodidad. Diseño moderno y materiales de alta calidad.',
                'price' => 150.00,
                'stock' => 60,
                'category' => 'Calzado'
            ],
            [
                'name' => 'Samsung Galaxy Watch 6',
                'description' => 'Smartwatch con monitoreo avanzado de salud, GPS integrado y batería de larga duración. Compatible con Android.',
                'price' => 329.99,
                'stock' => 30,
                'category' => 'Electrónicos'
            ],
            [
                'name' => 'Canon EOS R6 Mark II',
                'description' => 'Cámara mirrorless profesional con sensor de 24.2MP, estabilización de 8 paradas y grabación 4K. Para fotógrafos exigentes.',
                'price' => 2499.99,
                'stock' => 8,
                'category' => 'Fotografía'
            ],
            [
                'name' => 'Adidas Ultraboost 22',
                'description' => 'Zapatillas de running con tecnología BOOST para retorno de energía superior. Perfectas para corredores de todos los niveles.',
                'price' => 180.00,
                'stock' => 45,
                'category' => 'Calzado'
            ],
            [
                'name' => 'iPad Pro 12.9"',
                'description' => 'Tablet profesional con chip M2, pantalla Liquid Retina XDR y soporte para Apple Pencil. Perfecta para diseño y productividad.',
                'price' => 1099.99,
                'stock' => 20,
                'category' => 'Electrónicos'
            ],
            [
                'name' => 'Bose QuietComfort Earbuds',
                'description' => 'Auriculares inalámbricos in-ear con cancelación de ruido activa. Sonido inmersivo y ajuste cómodo para uso prolongado.',
                'price' => 279.99,
                'stock' => 35,
                'category' => 'Audio'
            ],
            [
                'name' => 'PlayStation 5',
                'description' => 'Consola de videojuegos de nueva generación con SSD ultrarrápido, ray tracing y audio 3D. Incluye mando DualSense.',
                'price' => 499.99,
                'stock' => 12,
                'category' => 'Gaming'
            ],
            [
                'name' => 'Tesla Model 3 Accessories Kit',
                'description' => 'Kit completo de accesorios para Tesla Model 3 incluyendo alfombrillas, organizadores y protector de pantalla.',
                'price' => 299.99,
                'stock' => 18,
                'category' => 'Automotriz'
            ],
            [
                'name' => 'Dyson V15 Detect',
                'description' => 'Aspiradora inalámbrica con tecnología láser que detecta polvo microscópico. Potencia de succión superior y filtración avanzada.',
                'price' => 749.99,
                'stock' => 22,
                'category' => 'Hogar'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
