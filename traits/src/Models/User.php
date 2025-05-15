<?php

namespace Custospark\Traits\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Custospark\Traits\Models\Role;
use Custospark\Traits\Models\Permission;
use App\Models\Subtask;
use App\Models\Task;
use App\Models\TeamMember;
use App\Models\TimeLog;
use App\Models\Message;
use App\Models\Document;
use App\Models\BlogPost;
use App\Models\BlogComment;
use App\Models\BlogReaction;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Custospark\Traits\Traits\HasAppPermissions;
use Custospark\Traits\Traits\HasAppRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasAppRoles,HasAppPermissions,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     * 
     */
    protected $connection = 'auth_db';
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Duplicate declaration removed

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user')->withTimestamps();
    }
    public function permissions()
{
    return $this->belongsToMany(Permission::class, 'permission_user')->withTimestamps();
}

    public function assignedTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function assignedSubtasks(): HasMany
    {
        return $this->hasMany(Subtask::class, 'assigned_to');
    }

    public function teamMemberships(): HasMany
    {
        return $this->hasMany(TeamMember::class);
    }

    public function timeLogs(): HasMany
    {
        return $this->hasMany(TimeLog::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function uploadedDocuments(): HasMany
    {
        return $this->hasMany(Document::class, 'uploaded_by');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isProjectManager(): bool
    {
        return $this->role === 'project_manager';
    }
    public function posts(): HasMany
    {
        return $this->hasMany(BlogPost::class, 'author_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(BlogComment::class);
    }

    public function reactions(): HasMany
    {
        return $this->hasMany(BlogReaction::class);
    }

    public function hasReacted(BlogPost $post, string $type): bool
    {
        return $this->reactions()
            ->where('post_id', $post->id)
            ->where('type', $type)
            ->exists();
    }

}
