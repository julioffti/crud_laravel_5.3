<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    const ESTADOS_CIVIS = [
        1 => 'Solteiro',
        2 => 'Casado',
        3 => 'Divorciado',
        4 => 'Viúvo'
    ];

    const DEFICIENCIAS = [

        1 => 'Nenhuma',
        2 => 'Visual',
        3 => 'Auditiva',
        4 => 'Motora',
        5 => 'Mental',
        6 => 'Fisica',
        7 => 'Múltipla'
    ];

    const SEXO = [
        'm' => 'Masculino',
        'f' => 'Feminino'

    ];

    const PESSOA_FISICA = 'fisica';
    const PESSOA_JURIDICA = 'juridica';

    protected $fillable = [
        'nome',
        'documento',
        'email',
        'telefone',
        'idade',
        'inadimplente',
        'date_nasc',
        'sexo',
        'estado_civil',
        'deficiencia_fisica',
        'pessoa'
    ];

    public static function getPessoa($value){
        return $value == Client::PESSOA_JURIDICA?$value:Client::PESSOA_FISICA;
    }

    public function setDocumentoAttribute($value){
        $this->attributes['documento'] = preg_replace('/[^0-9]/', '', $value);
    }


    public function getDocumentoFormattedAttribute()
    {

        $string = $this->documento;
        if (!empty($string)) {
            if (strlen($string) == 11) {
                $string = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $string);
            } else {
                $string = preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3.$4-$5', $string);
            }
        }
        return $string;
    }

    public function getDateNascFormattedAttribute()
    {
        return $this->pessoa == self::PESSOA_FISICA ? (new \DateTime($this->date_nasc))->format('d/m/Y') : "";
    }

    public function getQueueableConnection()
    {
        // TODO: Implement getQueueableConnection() method.
    }

    public function resolveRouteBinding($value)
    {
        // TODO: Implement resolveRouteBinding() method.
    }
}
