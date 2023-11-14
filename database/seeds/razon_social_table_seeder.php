<?php

use Illuminate\Database\Seeder;

use app\Configuracion;

class razon_social_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuracion::create([
            'nombre_sistema' => 'SISTEMA WEB DE PARTES DIARIOS DE MAQUINARIA PESADA',
            'alias' => 'WEBPDMP',
            'razon_social' => 'EMPRESA DE PRUEBA',
            'nit' => '10000000111',
            'ciudad' => 'LA PAZ',
            'dir' => 'ZONA LOS OLIVOS CALLE 3 #322',
            'fono' => '2111111',
            'web' => '77777777',
            'actividad_economica' => 'ACTIVIDAD ECONOMICA',
            'correo' => 'correo@gmail.com',
            'logo' => 'logo.png',
        ]);
    }
}
