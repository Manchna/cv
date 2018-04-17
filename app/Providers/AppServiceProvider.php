<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    public function register()
    {
        //for user
        $this->app->bind(
            'App\Repositories\User\UserInterface',
            'App\Repositories\User\UserRepository'
        );
        $this->app->bind(
            'App\Repositories\User\Profession\ProfessionInterface',
            'App\Repositories\User\Profession\ProfessionRepository'
        );
        $this->app->bind(
            'App\Repositories\User\Answer\AnswerInterface',
            'App\Repositories\User\Answer\AnswerRepository'
        );

        //for admin
        $this->app->bind(
            'App\Repositories\Admin\User\UserInterface',
            'App\Repositories\Admin\User\UserRepository'
        );
        $this->app->bind(
            'App\Repositories\Admin\Question\QuestionInterface',
            'App\Repositories\Admin\Question\QuestionRepository'
        );
        $this->app->bind(
            'App\Repositories\Admin\ProfessionQuestion\ProfessionQuestionInterface',
            'App\Repositories\Admin\ProfessionQuestion\ProfessionQuestionRepository'
        );
        $this->app->bind(
        'App\Repositories\Admin\Profession\ProfessionInterface',
        'App\Repositories\Admin\Profession\ProfessionRepository'
        );
        $this->app->bind(
            'App\Repositories\Admin\Answer\AnswerInterface',
            'App\Repositories\Admin\Answer\AnswerRepository'
        );
    }
}
