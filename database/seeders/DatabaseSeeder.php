<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->insert(User::factory(20)->raw());

        $members = User::query()->get();

        $ownerOne = User::query()->create([
            'name' => 'Holiq',
            'email' => 'holiq@gmail.com',
            'password' => Hash::make('11111111'),
        ]);

        $ownerTwo = User::query()->create([
            'name' => 'Stipen',
            'email' => 'stipen@gmail.com',
            'password' => Hash::make('11111111'),
        ]);

        $ownerThree = User::query()->create([
            'name' => 'Banser',
            'email' => 'banser@gmail.com',
            'password' => Hash::make('11111111'),
        ]);

        $ownerFour = User::query()->create([
            'name' => 'Apih',
            'email' => 'apih@gmail.com',
            'password' => Hash::make('11111111'),
        ]);

        $teamOne = Team::query()->create([
            'name' => 'IndoSec',
            'user_id' => $ownerOne->id,
        ]);
        $teamOne->users()->attach($members->random(5)->pluck('id')->merge($ownerTwo->id), [
            'role' => 'member',
        ]);
        $ownerOne->update([
            'current_team_id' => $teamOne->id,
        ]);

        $teamTwo = Team::query()->create([
            'name' => 'KoalaFacade',
            'user_id' => $ownerTwo->id,
        ]);
        $teamTwo->users()->attach($ownerOne->id, [
            'role' => 'editor',
        ]);
        $teamTwo->users()->attach($members->random(5)->pluck('id'), [
            'role' => 'member',
        ]);
        $ownerTwo->update([
            'current_team_id' => $teamTwo->id,
        ]);

        $teamTwoOne = Team::query()->create([
            'name' => 'Stipen JR',
            'user_id' => $ownerTwo->id,
        ]);
        $teamTwoOne->users()->attach($ownerOne->id, [
            'role' => 'editor',
        ]);
        $teamTwoOne->users()->attach($members->random(5)->pluck('id'), [
            'role' => 'member',
        ]);

        $teamThree = Team::query()->create([
            'name' => 'Banser JR',
            'user_id' => $ownerThree->id,
        ]);
        $teamThree->users()->attach($members->random(5)->pluck('id')->merge($ownerOne->id), [
            'role' => 'member',
        ]);
        $ownerThree->update([
            'current_team_id' => $teamThree->id,
        ]);

        $teamThreeOne = Team::query()->create([
            'name' => 'DJ Banser',
            'user_id' => $ownerThree->id,
        ]);
        $teamThreeOne->users()->attach($members->random(5)->pluck('id')->merge($ownerOne->id), [
            'role' => 'member',
        ]);
        $ownerThree->update([
            'current_team_id' => $teamThreeOne->id,
        ]);

        $teamFour = Team::query()->create([
            'name' => 'Api x Air',
            'user_id' => $ownerFour->id,
        ]);
        $teamFour->users()->attach($members->random(5)->pluck('id'));
        $ownerFour->update([
            'current_team_id' => $teamFour->id,
        ]);

        Task::query()->insert(Task::factory(100)->raw());
    }
}
