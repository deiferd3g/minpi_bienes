<?php

namespace Database\Seeders;

use App\Models\Organo;
use App\Models\Ubicacion;
use App\Models\CategoriaBien;
use App\Models\Fabricante;
use App\Models\Custodio;
use App\Models\Bien;
use App\Models\Asignacion;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Usuario administrador ───
        $admin = User::factory()->create([
            'name' => 'Deifer Garanton',
            'email' => 'admin@sbn.gob.ve',
        ]);

        // ─── Órganos / Entidades ───
        $ministerio = Organo::create([
            'codigo' => 'MPPE',
            'nombre' => 'Ministerio del Poder Popular para la Educación',
            'siglas' => 'MPPE',
            'rif' => 'G-20000001-0',
            'direccion' => 'Av. Baralt, Esq. de Monjas, Edif. Sede MPPE, Caracas',
            'nivel' => 'ministerio',
        ]);

        $instituto = Organo::create([
            'codigo' => 'INAPRE',
            'nombre' => 'Instituto Nacional de Preescolar',
            'siglas' => 'INAPRE',
            'rif' => 'G-20000002-0',
            'direccion' => 'Av. Andrés Bello, Torre INAPRE, Caracas',
            'nivel' => 'instituto',
            'organo_padre_id' => $ministerio->id,
        ]);

        $direccionTec = Organo::create([
            'codigo' => 'DGTI-MPPE',
            'nombre' => 'Dirección General de Tecnología e Informática',
            'siglas' => 'DGTI',
            'rif' => null,
            'direccion' => 'Edif. MPPE, Piso 7, Caracas',
            'nivel' => 'direccion',
            'organo_padre_id' => $ministerio->id,
        ]);

        // ─── Ubicaciones ───
        $ubicacionCentral = Ubicacion::create([
            'organo_id' => $ministerio->id,
            'nombre' => 'Sede Principal MPPE',
            'codigo' => 'MPPE-SP-001',
            'direccion' => 'Av. Baralt, Esq. de Monjas, Caracas',
            'ciudad' => 'Caracas',
            'estado' => 'Distrito Capital',
            'edificio' => 'Sede MPPE',
            'piso' => '7',
            'oficina' => '07-01',
        ]);

        $ubicacionAlmacen = Ubicacion::create([
            'organo_id' => $ministerio->id,
            'nombre' => 'Almacén Central MPPE',
            'codigo' => 'MPPE-ALM-001',
            'direccion' => 'Zona Industrial Los Cortijos, Caracas',
            'ciudad' => 'Caracas',
            'estado' => 'Distrito Capital',
            'edificio' => 'Galpón 3',
        ]);

        $ubicacionINAPRE = Ubicacion::create([
            'organo_id' => $instituto->id,
            'nombre' => 'Sede INAPRE',
            'codigo' => 'INAPRE-SP-001',
            'direccion' => 'Av. Andrés Bello, Torre INAPRE',
            'ciudad' => 'Caracas',
            'estado' => 'Distrito Capital',
            'edificio' => 'Torre INAPRE',
            'piso' => '3',
        ]);

        // ─── Categorías de Bienes ───
        $catMobiliario = CategoriaBien::create([
            'nombre' => 'Mobiliario y Equipo de Oficina',
            'codigo' => 'CAT-MOB',
            'tipo' => 'mobiliario',
            'vida_util_anios' => 10,
            'depreciable' => true,
        ]);

        $catComputo = CategoriaBien::create([
            'nombre' => 'Equipos de Computación',
            'codigo' => 'CAT-COMP',
            'tipo' => 'equipo_computacion',
            'vida_util_anios' => 4,
            'depreciable' => true,
        ]);

        $catVehiculos = CategoriaBien::create([
            'nombre' => 'Vehículos',
            'codigo' => 'CAT-VEH',
            'tipo' => 'vehiculo',
            'vida_util_anios' => 15,
            'depreciable' => true,
        ]);

        CategoriaBien::create([
            'nombre' => 'Sillas de Oficina',
            'codigo' => 'CAT-MOB-SILLA',
            'tipo' => 'mobiliario',
            'categoria_padre_id' => $catMobiliario->id,
            'vida_util_anios' => 10,
            'depreciable' => true,
        ]);

        CategoriaBien::create([
            'nombre' => 'Escritorios',
            'codigo' => 'CAT-MOB-ESC',
            'tipo' => 'mobiliario',
            'categoria_padre_id' => $catMobiliario->id,
            'vida_util_anios' => 10,
            'depreciable' => true,
        ]);

        CategoriaBien::create([
            'nombre' => 'Computadoras de Escritorio',
            'codigo' => 'CAT-COMP-DESK',
            'tipo' => 'equipo_computacion',
            'categoria_padre_id' => $catComputo->id,
            'vida_util_anios' => 4,
            'depreciable' => true,
        ]);

        CategoriaBien::create([
            'nombre' => 'Laptops',
            'codigo' => 'CAT-COMP-LAP',
            'tipo' => 'equipo_computacion',
            'categoria_padre_id' => $catComputo->id,
            'vida_util_anios' => 4,
            'depreciable' => true,
        ]);

        CategoriaBien::create([
            'nombre' => 'Impresoras',
            'codigo' => 'CAT-COMP-IMP',
            'tipo' => 'equipo_computacion',
            'categoria_padre_id' => $catComputo->id,
            'vida_util_anios' => 3,
            'depreciable' => true,
        ]);

        $catCamionetas = CategoriaBien::create([
            'nombre' => 'Camionetas',
            'codigo' => 'CAT-VEH-CAM',
            'tipo' => 'vehiculo',
            'categoria_padre_id' => $catVehiculos->id,
            'vida_util_anios' => 15,
            'depreciable' => true,
        ]);

        // ─── Fabricantes ───
        $hp = Fabricante::create(['nombre' => 'HP Inc.', 'pais_origen' => 'Estados Unidos']);
        $lenovo = Fabricante::create(['nombre' => 'Lenovo', 'pais_origen' => 'China']);
        $deli = Fabricante::create(['nombre' => 'Dell Technologies', 'pais_origen' => 'Estados Unidos']);
        $epson = Fabricante::create(['nombre' => 'Epson', 'pais_origen' => 'Japón']);
        $toyota = Fabricante::create(['nombre' => 'Toyota', 'pais_origen' => 'Japón']);
        Fabricante::create(['nombre' => 'Nacional (Venezuela)', 'pais_origen' => 'Venezuela']);

        // ─── Custodios ───
        $custodio1 = Custodio::create([
            'cedula' => 'V-12345678',
            'nombres' => 'María Isabel',
            'apellidos' => 'Rodríguez López',
            'cargo' => 'Directora General de Tecnología',
            'organo_id' => $direccionTec->id,
            'email' => 'mrodriguez@mppe.gob.ve',
            'telefono' => '0212-5550101',
            'tipo' => 'titular',
            'fecha_nombramiento' => '2024-03-15',
        ]);

        $custodio2 = Custodio::create([
            'cedula' => 'V-23456789',
            'nombres' => 'Carlos Andrés',
            'apellidos' => 'Mendoza Pérez',
            'cargo' => 'Jefe de Almacén',
            'organo_id' => $ministerio->id,
            'email' => 'cmendoza@mppe.gob.ve',
            'telefono' => '0212-5550202',
            'tipo' => 'titular',
            'fecha_nombramiento' => '2023-08-01',
        ]);

        $custodio3 = Custodio::create([
            'cedula' => 'V-34567890',
            'nombres' => 'Ana Carolina',
            'apellidos' => 'González Fernández',
            'cargo' => 'Coordinadora Administrativa INAPRE',
            'organo_id' => $instituto->id,
            'email' => 'agonzalez@inapre.gob.ve',
            'telefono' => '0212-5550303',
            'tipo' => 'titular',
        ]);

        // ─── Bienes ───
        $bienes = collect();

        // Laptops
        for ($i = 0; $i < 8; $i++) {
            $bien = Bien::create([
                'codigo_patrimonial' => 'MPPE-LP-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'codigo_interno' => 'DGTI-LP-' . ($i + 1),
                'nombre' => 'Laptop Corporativa ' . fake()->randomElement(['ProBook 450', 'ThinkPad X1', 'Latitude 5540']),
                'marca' => fake()->randomElement(['HP', 'Lenovo', 'Dell']),
                'modelo' => fake()->bothify('Model-####'),
                'serial' => strtoupper(fake()->bothify('SN-####-????')),
                'color' => 'Negro',
                'categoria_id' => 7, // Laptops
                'fabricante_id' => fake()->randomElement([$hp->id, $lenovo->id, $deli->id]),
                'organo_id' => $ministerio->id,
                'ubicacion_id' => $ubicacionCentral->id,
                'custodio_actual_id' => $custodio1->id,
                'valor_original' => fake()->randomFloat(2, 800, 2500),
                'valor_actual' => fake()->randomFloat(2, 400, 1500),
                'valor_residual' => 80,
                'fecha_adquisicion' => fake()->dateTimeBetween('-3 years', '-1 month')->format('Y-m-d'),
                'estado_fisico' => 'bueno',
                'condicion_uso' => 'operativo',
                'vida_util_anios' => 4,
            ]);
            $bienes->push($bien);
        }

        // PCs de escritorio
        for ($i = 0; $i < 10; $i++) {
            $bien = Bien::create([
                'codigo_patrimonial' => 'MPPE-PC-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'nombre' => 'Computadora de Escritorio',
                'marca' => fake()->randomElement(['HP', 'Lenovo', 'Dell']),
                'modelo' => fake()->bothify('OptiPlex ###'),
                'serial' => strtoupper(fake()->bothify('SN-????-####')),
                'color' => 'Gris/Plata',
                'categoria_id' => 6, // Desktop
                'fabricante_id' => $deli->id,
                'organo_id' => $ministerio->id,
                'ubicacion_id' => $ubicacionCentral->id,
                'valor_original' => fake()->randomFloat(2, 500, 1500),
                'valor_actual' => fake()->randomFloat(2, 200, 800),
                'valor_residual' => 50,
                'fecha_adquisicion' => fake()->dateTimeBetween('-4 years', '-6 months')->format('Y-m-d'),
                'estado_fisico' => fake()->randomElement(['bueno', 'regular', 'bueno']),
                'condicion_uso' => 'operativo',
                'vida_util_anios' => 4,
            ]);
            $bienes->push($bien);
        }

        // Impresoras
        for ($i = 0; $i < 4; $i++) {
            Bien::create([
                'codigo_patrimonial' => 'MPPE-IMP-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'nombre' => 'Impresora Multifuncional',
                'marca' => 'Epson',
                'modelo' => fake()->randomElement(['WorkForce Pro', 'EcoTank L15150']),
                'serial' => strtoupper(fake()->bothify('EPS-####-????')),
                'color' => 'Negro',
                'categoria_id' => 8, // Impresoras
                'fabricante_id' => $epson->id,
                'organo_id' => $ministerio->id,
                'ubicacion_id' => $ubicacionCentral->id,
                'valor_original' => fake()->randomFloat(2, 300, 1200),
                'valor_actual' => fake()->randomFloat(2, 150, 600),
                'valor_residual' => 30,
                'fecha_adquisicion' => fake()->dateTimeBetween('-2 years', '-3 months')->format('Y-m-d'),
                'estado_fisico' => 'bueno',
                'condicion_uso' => 'operativo',
                'vida_util_anios' => 3,
            ]);
        }

        // Vehículos
        for ($i = 0; $i < 3; $i++) {
            Bien::create([
                'codigo_patrimonial' => 'MPPE-VH-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'nombre' => 'Camioneta ' . fake()->randomElement(['Toyota Hilux', 'Ford Ranger', 'Chevrolet Silverado']),
                'marca' => 'Toyota',
                'modelo' => 'Hilux 4x4',
                'serial' => strtoupper(fake()->bothify('VIN-?????????????????')),
                'color' => fake()->randomElement(['Blanco', 'Plateado', 'Azul']),
                'categoria_id' => 9, // Camionetas
                'fabricante_id' => $toyota->id,
                'organo_id' => $ministerio->id,
                'ubicacion_id' => $ubicacionCentral->id,
                'valor_original' => fake()->randomFloat(2, 25000, 45000),
                'valor_actual' => fake()->randomFloat(2, 15000, 30000),
                'valor_residual' => 2500,
                'fecha_adquisicion' => fake()->dateTimeBetween('-5 years', '-1 year')->format('Y-m-d'),
                'documento_adquisicion' => 'OC-MPPE-' . fake()->bothify('####'),
                'estado_fisico' => 'bueno',
                'condicion_uso' => 'operativo',
                'vida_util_anios' => 15,
            ]);
        }

        // Mobiliario
        for ($i = 0; $i < 20; $i++) {
            $estadoFisico = fake()->randomElement(['nuevo', 'bueno', 'bueno', 'regular', 'bueno', 'malo']);
            Bien::create([
                'codigo_patrimonial' => 'MPPE-MB-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'nombre' => fake()->randomElement([
                    'Escritorio Ejecutivo', 'Silla Ergonómica', 'Archivador Metálico',
                    'Estantería', 'Mesa de Reuniones', 'Silla Visitante',
                    'Pupitre', 'Butaca'
                ]),
                'marca' => fake()->randomElement(['Oficenter', 'Ofimax', 'Nacional']),
                'modelo' => fake()->bothify('MOD-###'),
                'color' => fake()->randomElement(['Café', 'Negro', 'Gris', 'Blanco']),
                'categoria_id' => fake()->randomElement([1, 4, 5]), // mobiliario general, sillas, escritorios
                'fabricante_id' => 6, // Nacional
                'organo_id' => fake()->randomElement([$ministerio->id, $instituto->id]),
                'ubicacion_id' => fake()->randomElement([
                    $ubicacionCentral->id, $ubicacionINAPRE->id, $ubicacionAlmacen->id
                ]),
                'valor_original' => fake()->randomFloat(2, 50, 1500),
                'valor_actual' => fake()->randomFloat(2, 20, 800),
                'valor_residual' => fake()->randomFloat(2, 5, 150),
                'fecha_adquisicion' => fake()->dateTimeBetween('-8 years', '-1 month')->format('Y-m-d'),
                'estado_fisico' => $estadoFisico,
                'condicion_uso' => $estadoFisico === 'malo' ? 'inoperativo' : 'operativo',
                'vida_util_anios' => 10,
            ]);
        }

        // Bienes INAPRE
        for ($i = 0; $i < 10; $i++) {
            Bien::create([
                'codigo_patrimonial' => 'INAPRE-EQ-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'nombre' => fake()->randomElement([
                    'Aire Acondicionado Split', 'Televisor LED', 'Proyector Multimedia',
                    'Equipo de Sonido', 'Cámara de Seguridad'
                ]),
                'marca' => fake()->randomElement(['LG', 'Samsung', 'Sony', 'Panasonic']),
                'modelo' => fake()->bothify('MOD-####'),
                'serial' => strtoupper(fake()->bothify('SN-####-????')),
                'color' => fake()->randomElement(['Blanco', 'Negro', 'Plateado']),
                'categoria_id' => 10, // otro
                'fabricante_id' => fake()->randomElement([1, 2, 3]),
                'organo_id' => $instituto->id,
                'ubicacion_id' => $ubicacionINAPRE->id,
                'custodio_actual_id' => $custodio3->id,
                'valor_original' => fake()->randomFloat(2, 200, 5000),
                'valor_actual' => fake()->randomFloat(2, 100, 3000),
                'valor_residual' => fake()->randomFloat(2, 20, 500),
                'fecha_adquisicion' => fake()->dateTimeBetween('-4 years', '-2 months')->format('Y-m-d'),
                'estado_fisico' => fake()->randomElement(['bueno', 'regular', 'bueno']),
                'condicion_uso' => 'operativo',
                'vida_util_anios' => 5,
            ]);
        }

        // ─── Asignaciones ───
        Asignacion::create([
            'bien_id' => $bienes[0]->id,
            'custodio_id' => $custodio1->id,
            'organo_id' => $direccionTec->id,
            'ubicacion_id' => $ubicacionCentral->id,
            'tipo' => 'asignacion',
            'fecha_asignacion' => '2025-01-15',
            'numero_acta' => 'ACTA-DGTI-001-2025',
            'motivo' => 'Asignación de equipo para funciones de dirección',
            'autorizado_por' => $admin->id,
            'estado_fisico_al_recibir' => 'nuevo',
        ]);
    }
}
