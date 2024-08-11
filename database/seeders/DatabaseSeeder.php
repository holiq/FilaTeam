<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->insert(User::factory(50)->raw());

        $users = User::query()->latest()->get()->take(20);

        User::query()->insert([
            'name' => 'Holiq',
            'email' => 'holiq@gmail.com',
            'password' => Hash::make('11111111'),
        ]);

        $team = Team::query()->create([
            'name' => 'KoalaFacade',
            'user_id' => 1,
        ]);

        $users->each(function (User $user) use ($team) {
            $user->update([
                'current_team_id' => $team->id,
            ]);
        });

        $team->users()->attach($users->pluck('id'), [
            'role' => 'member'
        ]);
    }
}
