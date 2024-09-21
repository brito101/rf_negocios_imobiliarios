<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        DB::table('permissions')->insert([
            /** ACL  1 to 11 */
            [
                'name' => 'Acessar ACL',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Listar Permissões',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Criar Permissões',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Editar Permissões',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Excluir Permissões',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Listar Perfis',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Criar Perfis',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Editar Perfis',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Excluir Perfis',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Sincronizar Perfis',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Atribuir Perfis',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],

            /** Users 12 to 17 */
            [
                'name' => 'Acessar Usuários',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Listar Usuários',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Criar Usuários',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            /** 15 */
            [
                'name' => 'Editar Usuário',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Editar Usuários',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Excluir Usuários',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            /** Agencies 18 to 22 */
            [
                'name' => 'Acessar Agências',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Listar Agências',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Criar Agências',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Editar Agências',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Excluir Agências',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            /** Agencies 23 to 27 */
            [
                'name' => 'Acessar Propriedades',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Listar Propriedades',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Criar Propriedades',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Editar Propriedades',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Excluir Propriedades',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            /** Configurations 28 */
            [
                'name' => 'Acessar Configurações',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            /** Steps 29 to 33 */
            [
                'name' => 'Acessar Etapas',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Listar Etapas',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Criar Etapas',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Editar Etapas',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Excluir Etapas',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            /** Clients 34 to 38 */
            [
                'name' => 'Acessar Clientes',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Listar Clientes',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Criar Clientes',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Editar Clientes',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Excluir Clientes',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            /** Experiences 39 to 43 */
            [
                'name' => 'Acessar Experiências',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Listar Experiências',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Criar Experiências',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Editar Experiências',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Excluir Experiências',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            /** Categories 44 to 48 */
            [
                'name' => 'Acessar Categorias',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Listar Categorias',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Criar Categorias',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Editar Categorias',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Excluir Categorias',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            /** Types 49 to 53 */
            [
                'name' => 'Acessar Tipos',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Listar Tipos',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Criar Tipos',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Editar Tipos',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Excluir Tipos',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            /** Differentials 54 to 58 */
            [
                'name' => 'Acessar Diferenciais',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Listar Diferenciais',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Criar Diferenciais',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Editar Diferenciais',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],
            [
                'name' => 'Excluir Diferenciais',
                'guard_name' => 'web',
                'created_at' => new DateTime('now'),
            ],

        ]);
    }
}
