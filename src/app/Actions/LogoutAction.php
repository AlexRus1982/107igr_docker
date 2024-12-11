<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Auth;

    #[ActionFor('Logout')]
    class LogoutAction extends ActionClass {

        public function handle($args) {
            Session::flush();
            Auth::logout();
            return redirect('/');
        }
    }
?>