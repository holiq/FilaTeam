<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'team_user', 'team_id', 'user_id')
            ->withPivot('role')->withTimestamps();
    }

    public function allUsers(): Collection
    {
        return $this->users->merge([$this->owner]);
    }

    public function hasUser(User $user): bool
    {
        return $this->users->contains($user) || $user->ownsTeam($this);
    }

    public function removeUser(User $user): void
    {
        if ($user->current_team_id === $this->id) {
            $user->forceFill([
                'current_team_id' => null,
            ])->save();
        }

        $this->users()->detach($user);
    }

    public function purge(): void
    {
        $this->owner()->where('current_team_id', $this->id)
            ->update(['current_team_id' => null]);

        $this->users()->where('current_team_id', $this->id)
            ->update(['current_team_id' => null]);

        $this->users()->detach();

        $this->delete();
    }

    public function getRoleUser(User $user): ?string
    {
        return $user->ownsTeam($this) ? 'Owner' : collect($this->users->find($user->id))
            ->pluck('role')->implode(' ');
    }
}
