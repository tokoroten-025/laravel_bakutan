<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
    
	$this->registerPolicies();

	// 管理者
	Gate::define('admin', function ($user) {
		return ($user->role == 1);
	});

	// 旅館
	Gate::define('ryokan', function ($user) {
		return ($user->role >= 2);
	});

    // 一般ユーザー
	Gate::define('user', function ($user) {
		return ($user->role > 10);
	});

	// // 閲覧者
	// Gate::define('read', function ($user) {
	// 	return ($user->role > 0);
	// });
}
    
}
