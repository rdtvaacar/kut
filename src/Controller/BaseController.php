<?php
namespace Acr\Kut\Controller;

use Illuminate\Routing\Controller;
use Acr\Demirbas\Model\Demirbas_model;
use Auth;

class BaseController extends Controller
{
    public $uye_id;
    public $kurum_id;

    function uye_id()
    {
        $demirbas_model = new Demirbas_model();
        if (Auth::check()) {
            return $this->uye_id = $demirbas_model->uye_id();

        } else {
            return $this->uye_id = 0;
        }

    }

    function kurum_id()
    {
        $demirbas_model = new Demirbas_model();
        if (Auth::check()) {
            return $this->kurum_id = $demirbas_model->kurum_id();
        } else {
            return $this->kurum_id = 0;
        }
    }
}
