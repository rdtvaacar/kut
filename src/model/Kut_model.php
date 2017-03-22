<?php

namespace Acr\Kut\Model;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Kut_model extends Model

{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'demirbas';
    public    $uye_id;
    public    $kurum_id;

    function uye_id()
    {
        if (Auth::check()) {
            return $this->uye_id = Auth::user()->id;

        } else {
            return $this->uye_id = 0;
        }

    }

    function kurum_id()
    {
        if (Auth::check()) {
            return $this->kurum_id = Auth::user()->kurum_id;
        } else {
            return $this->kurum_id = 0;
        }
    }

    function tum_demirbaslar()
    {
        $demirbaslar = Demirbas_model::leftJoin('demirbas_amortisman', 'demirbas_amortisman.id', '=', 'demirbas.amortisman_id')
            ->leftJoin('demirbas_firma', 'demirbas_firma.id', '=', 'demirbas.firma_id')
            ->leftJoin('demirbas_hesap', 'demirbas_hesap.id', '=', 'demirbas.hesap_id')
            ->leftJoin('demirbas_grup', 'demirbas_grup.id', '=', 'demirbas.grup_id')
            ->leftJoin('demirbas_birim', 'demirbas_birim.id', '=', 'demirbas.birim_id')
            ->select("demirbas.*", "demirbas_amortisman.*", "demirbas_firma.*", "demirbas_grup.*", "demirbas_birim.*", "demirbas_hesap.*", "demirbas.id as demirbas_id", "demirbas_amortisman.id as amortisman_id", "demirbas_firma.id as firma_id", "demirbas_grup.id as grup_id", "demirbas_birim.id as birim_id", "demirbas_hesap.id as hesap_id")
            ->where('demirbas.kurum_id', $this->kurum_id())
            ->where('demirbas.sil', 0)
            ->orderBy('demirbas.grup_id')
            ->get();
        return $demirbaslar;
    }

    function demirbas($id)
    {
        $demirbas = Demirbas_model::leftJoin('demirbas_amortisman', 'demirbas_amortisman.id', '=', 'demirbas.amortisman_id')
            ->leftJoin('demirbas_firma', 'demirbas_firma.id', '=', 'demirbas.firma_id')
            ->leftJoin('demirbas_grup', 'demirbas_grup.id', '=', 'demirbas.grup_id')
            ->leftJoin('demirbas_birim', 'demirbas_birim.id', '=', 'demirbas.birim_id')
            ->leftJoin('demirbas_hesap', 'demirbas_hesap.id', '=', 'demirbas.hesap_id')
            ->select("demirbas.*", "demirbas_amortisman.*", "demirbas_firma.*", "demirbas_grup.*", "demirbas_birim.*", "demirbas_hesap.*", "demirbas.id as demirbas_id", "demirbas_amortisman.id as amortisman_id", "demirbas_firma.id as firma_id", "demirbas_grup.id as grup_id", "demirbas_birim.id as birim_id", "demirbas_hesap.id as hesap_id")
            ->where('demirbas.kurum_id', $this->kurum_id())
            ->where('demirbas.id', $id)
            ->first();
        return $demirbas;

    }

    function amortisman($id)
    {
        return Amortisman_model::where('id', $id)->first();
    }

    function firmalar()
    {
        return Demirbas_firma_model::where('kurum_id', $this->kurum_id())->where('sil', 0)->get();
    }

    function birimler()
    {
        return Demirbas_birim_model::where('sil', 0)->get();
    }

    function gruplar()
    {
        return Demirbas_grup_model::where('kurum_id', $this->kurum_id())->where('sil', 0)->get();
    }

    function hesaplar()
    {
        return Demirbas_hesap_model::get();
    }

    function demirbas_guncelle($demirbas_id, $data)
    {
        Demirbas_model::where('id', $demirbas_id)->where('kurum_id', $this->kurum_id())->update($data);
    }

    function amortismanlar()
    {
        return Amortisman_model::join('demirbas_amortisman as a2', 'demirbas_amortisman.id', '=', 'a2.amortisman_id')
            ->select('demirbas_amortisman.*', 'a2.*', 'demirbas_amortisman.amortisman as grup_isim')
            ->get();
    }

    function personellerUye()
    {
        return Personel_model::where('uye_id', $this->uye_id())->get();
    }

    function demirbasDizi($dizi)
    {
        return $demirbaslar = Demirbas_model::leftJoin('demirbas_amortisman', 'demirbas_amortisman.id', '=', 'demirbas.amortisman_id')
            ->leftJoin('demirbas_firma', 'demirbas_firma.id', '=', 'demirbas.firma_id')
            ->leftJoin('demirbas_hesap', 'demirbas_hesap.id', '=', 'demirbas.hesap_id')
            ->leftJoin('demirbas_grup', 'demirbas_grup.id', '=', 'demirbas.grup_id')
            ->leftJoin('demirbas_birim', 'demirbas_birim.id', '=', 'demirbas.birim_id')
            ->select("demirbas.*", "demirbas_amortisman.*", "demirbas_firma.*", "demirbas_grup.*", "demirbas_birim.*", "demirbas_hesap.*", "demirbas.id as demirbas_id", "demirbas_amortisman.id as amortisman_id", "demirbas_firma.id as firma_id", "demirbas_grup.id as grup_id", "demirbas_birim.id as birim_id", "demirbas_hesap.id as hesap_id")
            ->where('demirbas.kurum_id', $this->kurum_id())
            ->where('demirbas.sil', 0)
            ->whereIn('demirbas.id', $dizi)
            ->orderBy('demirbas.grup_id')
            ->get();
    }

    function olasiTifTarih($dizi)
    {
        $demirbas_tarih = Demirbas_model::where('kurum_id', $this->kurum_id())
            ->where('sil', 0)
            ->whereIn('id', $dizi)
            ->orderBy('grup_id')
            ->select('demirbas_alis_tarihi')
            ->first()->demirbas_alis_tarihi;
        return date('d/m/Y', strtotime($demirbas_tarih));

    }

    function hesap_kod_ara($kod1, $kod2, $kod3, $kod4, $kod5, $kod6)
    {
        $kod2 = empty($kod2) ? 0 : $kod2;
        $kod3 = empty($kod3) ? 0 : $kod3;
        $kod4 = empty($kod4) ? 0 : $kod4;
        $kod5 = empty($kod5) ? 0 : $kod5;
        $kod6 = empty($kod6) ? 0 : $kod6;
        return Demirbas_hesap_model::where('kod_1', $kod1)
            ->where('kod_2', $kod2)
            ->where('kod_3', $kod3)
            ->where('kod_4', $kod4)
            ->where('kod_5', $kod5)
            ->where('kod_6', $kod6)
            ->first();
    }

    function demirbas_ayar()
    {
        return Demirbas_ayar_model::where('kurum_id', $this->kurum_id())->first();
    }

    function demirbas_ayar_kaydet($data)
    {
        $dataUser = [
            'kurum_id' => $this->kurum_id(),
            'uye_id'   => $this->uye_id()
        ];

        if (empty(self::demirbas_ayar())) {
            $datas = array_merge($dataUser, $data);
            Demirbas_ayar_model::insert($datas);
        } else {
            Demirbas_ayar_model::where('kurum_id', $this->kurum_id())->update($data);
        }
    }

    function demirbas_no()
    {
        $demirbasSorgu = Demirbas_model::where('kurum_id', $this->kurum_id())->where('sil', 0)->orderBy('id', 'desc')->select('demirbas_no');
        return $demirbasSorgu->count() > 0 ? $demirbasSorgu->first()->demirbas_no + 1 : 1;

    }
}
