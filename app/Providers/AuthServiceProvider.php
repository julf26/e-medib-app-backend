<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Activity;
use App\Models\Diary;
use App\Models\Food;
use App\Models\UserRecordData;
use App\Policies\ActivityPolicy;
use App\Policies\DiaryPolicy;
use App\Policies\FoodPolicy;
use App\Policies\UserRecordDataPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        UserRecordData::class => UserRecordDataPolicy::class,
        Activity::class => ActivityPolicy::class,
        Diary::class => DiaryPolicy::class,
        Food::class => FoodPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
