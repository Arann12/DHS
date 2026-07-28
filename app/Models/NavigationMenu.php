<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavigationMenu extends Model
{
    protected $table = 'navigation_menus';

    protected $fillable = [
        'parent_id', 'menu_label', 'menu_url', 'menu_type',
        'target_blank', 'icon_class', 'is_active', 'display_order',
    ];

    protected $casts = [
        'target_blank' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function children()
    {
        return $this->hasMany(NavigationMenu::class, 'parent_id')->orderBy('display_order');
    }

    public function parent()
    {
        return $this->belongsTo(NavigationMenu::class, 'parent_id');
    }
}
