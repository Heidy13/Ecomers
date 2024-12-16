<?php
    namespace App\Service;

    use Illuminate\Support\Facades\Auth;

    class FuncionService {

        public function obtenerIdClienteAutenticado () {
            $user = Auth::user();
            if ($user && $user->customer) {
                return $user->customer->id;
            }
            return null;
        }

        public function obtenerIdAdminAutenticado () {
            $user = Auth::user();
            if ($user && $user->admin) {
                return $user->admin->id;
            }
            return null;
        }

        public function obtenerIdArtesanoAutenticado () {
            $user = Auth::user();
            if ($user && $user->craftsman) {
                return $user->craftsman->id;
            }
            return "null";
        }

    }
?>