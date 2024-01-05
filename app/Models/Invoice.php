<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'number', 
        'value', 
        'date_of_issue', 
        'sender_cnpj', 
        'sender_name', 
        'transporter_cnpj', 
        'transporter_name',
        'created_by',
    ];
    
    protected $with = ['created_by_user'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($item) {
            $item->created_by = Auth::user()->id;
        });

        static::updating(function ($post) {
            if($post->image && !is_string($post->image))
            $post->image = $post->image->store('post_image');
        });
    }
    public function created_by_user() {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
    public function scopeMyInvoices($query)
    {
        $userLogged = Auth::user();
        $query->where('created_by', $userLogged->id);
    }
}
