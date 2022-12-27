<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use App\Models\TimeLog;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'gerxhaliurinor@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        Task::create([
            'user_id' => $user->id,
            'name' => 'Task 1',
            'parent_id' => null,
            'description' => 'Task 1 description',
            'priority' => 'Low',
        ]);
        Task::create([
            'user_id' => $user->id,
            'name' => 'Task 2',
            'parent_id' => 1,
            'description' => 'Task 2 description',
            'priority' => 'Medium',
        ]);
        Task::create([
            'user_id' => $user->id,
            'name' => 'Task 3',
            'parent_id' => null,
            'description' => 'Task 3 description',
            'priority' => 'Low',
        ]);
        Task::create([
            'user_id' => $user->id,
            'name' => 'Task 4',
            'parent_id' => 3,
            'description' => 'Task 4 description',
            'priority' => 'High',
        ]);
        Task::create([
            'user_id' => $user->id,
            'name' => 'Task 5',
            'parent_id' => 4,
            'description' => 'Task 5 description',
            'priority' => 'Low',
        ]);
        Task::create([
            'user_id' => $user->id,
            'name' => 'Task 6',
            'parent_id' => 1,
            'description' => 'Task 6 description',
            'priority' => 'Medium',
        ]);
        Task::create([
            'user_id' => $user->id,
            'name' => 'Task 7',
            'parent_id' => null,
            'description' => 'Task 7 description',
            'priority' => 'High',
        ]);
        Task::create([
            'user_id' => $user->id,
            'name' => 'Task 8',
            'parent_id' => null,
            'description' => 'Task 8 description',
            'priority' => 'Low',
        ]);
        Task::create([
            'user_id' => $user->id,
            'name' => 'Task 9',
            'parent_id' => 8,
            'description' => 'Task 9 description',
            'priority' => 'Medium',
        ]);
        Task::create([
            'user_id' => $user->id,
            'name' => 'Task 10',
            'parent_id' => null,
            'description' => 'Task 10 description',
            'priority' => 'High',
        ]);
        TimeLog::create([
            'task_id' => 1,
            'hours' => 2,
            'minutes' => 30,
        ]);
        TimeLog::create([
            'task_id' => 2,
            'hours' => 3,
            'minutes' => 40,
        ]);
        TimeLog::create([
            'task_id' => 3,
            'hours' => 4,
            'minutes' => 30,
        ]);
        TimeLog::create([
            'task_id' => 4,
            'hours' => 5,
            'minutes' => 40,
        ]);
        TimeLog::create([
            'task_id' => 5,
            'hours' => 2,
            'minutes' => 30,
        ]);
        TimeLog::create([
            'task_id' => 6,
            'hours' => 4,
            'minutes' => 40,
        ]);
        TimeLog::create([
            'task_id' => 7,
            'hours' => 1,
            'minutes' => 40,
        ]);
        TimeLog::create([
            'task_id' => 8,
            'hours' => 2,
            'minutes' => 15,
        ]);
        TimeLog::create([
            'task_id' => 9,
            'hours' => 4,
            'minutes' => 15,
        ]);
        TimeLog::create([
            'task_id' => 10,
            'hours' => 5,
            'minutes' => 33,
        ]);
    }
}
