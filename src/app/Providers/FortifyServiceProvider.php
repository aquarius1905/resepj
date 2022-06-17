<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use App\Models\Administrator;
use App\Models\ShopRepresentative;
use App\Models\User;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //会員登録後、サンクスページに遷移
        $this->app->instance(RegisterResponse::class, new class implements RegisterResponse
        {
            public function toResponse($request)
            {
                return view('auth.thanks');
            }
        });
        //ログアウト後、ログイン画面に遷移
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse
        {
            public function toResponse($request)
            {
                return redirect('/login');
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //会員登録画面表示
        Fortify::registerView(function () {
            return view('auth.register');
        });

        //ユーザーログイン画面表示
        Fortify::loginView(function () {
            $login_error = null;
            return view('auth.login', ['login_error' => $login_error]);
        });

        //会員登録処理
        Fortify::createUsersUsing(CreateNewUser::class);

        //ログイン処理
        Fortify::authenticateUsing(function (Request $request) {
            $user = null;
            if ($request->is('admin/*')) {
                $user = Administrator::where('email', $request->email)->first();
            } else if ($request->is('shop/*')) {
                $user = ShopRepresentative::where('email', $request->email)->first();
            } else {
                $user = User::where('email', $request->email)->first();
            }
            if (
                $user &&
                Hash::check($request->password, $user->password)
            ) {
                return $user;
            } else {
                throw ValidationException::withMessages([
                    'login_error' => "メールアドレス・パスワードが一致しません"
                ]);
            }
        });
    }
}
