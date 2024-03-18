<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'rol-listar',
            'rol-crear',
            'rol-editar',
            'rol-eliminar',
            'usuarios-listar',
            'usuarios-crear',
            'usuarios-editar',
            'usuarios-eliminar'
        ];

        $permissions4 = [
            'eventos-list',
            'eventos-create',
            'eventos-edit',
            'eventos-delete'
        ];

        $permissions5 = [
            'buscarOfertas-list',
        ];

        $permissions6 = [
            'perfilProfesional-list',
            'perfilProfesional-edit',
            
        ];

        foreach ($permissions6 as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
