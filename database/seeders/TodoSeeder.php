<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $todos = [
            [
                'todo' => 'Learn Laravel',
                'completed' => false,
                'userId' => 1,
            ],
            [
                'todo' => 'Build Todo API',
                'completed' => true,
                'userId' => 1,
            ],
            [
                'todo' => 'Write documentation',
                'completed' => false,
                'userId' => 2,
            ],
            [
                'todo' => 'Test API endpoints',
                'completed' => false,
                'userId' => 2,
            ],
            [
                'todo' => 'Deploy to production',
                'completed' => false,
                'userId' => 3,
            ],
            [
                'todo' => 'Review code',
                'completed' => true,
                'userId' => 3,
            ],
            [
                'todo' => 'Update dependencies',
                'completed' => false,
                'userId' => 1,
            ],
            [
                'todo' => 'Create user interface',
                'completed' => false,
                'userId' => 2,
            ],
            [
                'todo' => 'Implement authentication',
                'completed' => false,
                'userId' => 3,
            ],
            [
                'todo' => 'Add error handling',
                'completed' => true,
                'userId' => 1,
            ],
        ];

        foreach ($todos as $todo) {
            Todo::create($todo);
        }
    }
}
