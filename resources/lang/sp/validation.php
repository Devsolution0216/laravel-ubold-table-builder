<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'El :attribute debe ser aceptado.',
    'active_url'           => ':attribute no es una URL válida.',
    'after'                => ':attribute debe ser una fecha posterior a :date.',
    'after_or_equal'       => ':attribute debe ser una fecha posterior o igual a :date.',
    'alpha'                => ':attribute sólo puede contener números.',
    'alpha_dash'           => ':attribute sólo puede contener letras, números y guiones.',
    'alpha_num'            => ':attribute sólo puede contener letras y números.',
    'array'                => ':attribute debe ser un arreglo.',
    'before'               => ':attribute debe ser una fecha anterior a :date.',
    'before_or_equal'      => ':attribute debe ser una fecha antes o igual a :date.',
    'between'              => [
        'numeric' => ':attribute debe estar entre :min y :max.',
        'file'    => ':attribute debe estar entre :min y :max kilobytes.',
        'string'  => ':attribute debe estar entre :min y :max caracteres.',
        'array'   => ':attribute debe estar entre :min y :max items.',
    ],
    'boolean'              => 'El campo :attribute debe ser falso o verdadero únicamente.',
    'confirmed'            => 'La confirmación de :attribute no coincide.',
    'date'                 => 'La :attribute no es una fecha válida.',
    'date_format'          => 'La :attribute no coincide con el formato :format.',
    'different'            => ':attribute y :other deben ser diferentes.',
    'digits'               => ':attribute debe ser :digits digits.',
    'digits_between'       => ':attribute debe estar entre :min y :max digitos.',
    'dimensions'           => ':attribute es de una dimensión inválida.',
    'distinct'             => 'El campo :attribute tiene un valor duplicado.',
    'email'                => ':attribute debe ser una dirección de email válida.',
    'exists'               => 'La selección :attribute es inválida.',
    'file'                 => ':attribute debe ser un archivo.',
    'filled'               => 'El campo :attribute debe tener un valor.',
    'image'                => ':attribute debe ser una imagen.',
    'in'                   => 'La selección de :attribute es inválida.',
    'in_array'             => 'El campo :attribute no existe en :other.',
    'integer'              => ':attribute debe ser un entero.',
    'ip'                   => ':attribute debe ser una dirección IP válida.',
    'json'                 => ':attribute debe ser un string válido de JSON.',
    'max'                  => [
        'numeric' => ':attribute no debe ser mayor a :max.',
        'file'    => ':attribute no debe ser mayor a :max kilobytes.',
        'string'  => ':attribute no debe ser mayor a :max caracteres.',
        'array'   => ':attribute no debe tener más de :max items.',
    ],
    'mimes'                => ':attribute debe ser un archivo de tipo: :values.',
    'mimetypes'            => ':attribute debe ser un archivo de tipo: :values.',
    'min'                  => [
        'numeric' => ':attribute debe ser de al menos :min.',
        'file'    => ':attribute debe ser de al menos :min kilobytes.',
        'string'  => ':attribute debe tener al menos :min caracteres.',
        'array'   => ':attribute debe tener al menos :min items.',
    ],
    'not_in'               => 'La selección de :attribute es inválida.',
    'numeric'              => ':attribute debe ser un número.',
    'present'              => 'El campo :attribute debe estar completo.',
    'regex'                => 'El formato de :attribute es inválido.',
    'required'             => 'El campo :attribute es requerido.',
    'required_if'          => 'El campo :attribute es requerido cuando :other es :value.',
    'required_unless'      => 'El campo :attribute es requerido al menos que :other sea :values.',
    'required_with'        => 'El campo :attribute es requerido cuando :values este presente.',
    'required_with_all'    => 'El campo :attribute es requerido cuando :values este presente.',
    'required_without'     => 'El campo :attribute es requerido cuando :values no este presente.',
    'required_without_all' => 'El campo :attribute es requerido cuando ninguno de :values esten presentes.',
    'same'                 => ':attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => ':attribute debe ser de :size.',
        'file'    => ':attribute debe ser de :size kilobytes.',
        'string'  => ':attribute debe ser de :size caracteres.',
        'array'   => ':attribute debe contener :size items.',
    ],
    'string'               => ':attribute debe ser un texto.',
    'timezone'             => ':attribute debe ser de una zona horaria válida.',
    'unique'               => ':attribute ya ha sido usado.',
    'uploaded'             => ':attribute falló la subida.',
    'url'                  => 'El formato de :attribute es inválido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
