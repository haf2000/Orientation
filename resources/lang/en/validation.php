<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | L\'attribut following language lines contain L\'attribut default error messages used by
    | L\'attribut validator class. Some of L\'attributse rules have multiple versions such
    | as L\'attribut size rules. Feel free to tweak each of L\'attributse messages here.
    |
    */

    'accepted' => 'L\'attribut :attribute doit être accepté.',
    'active_url' => 'L\'attribut :attribute n\'est pas une valide URL.',
    'after' => 'L\'attribut :attribute doit être une date postérieure à :date.',
    'after_or_equal' => 'L\'attribut :attribute doit être une date postérieure ou égale à :date.',
    'alpha' => 'L\'attribut :attribute ne peut contenir que des lettres.',
    'alpha_dash' => 'L\'attribut :attribute ne peut contenir que des lettres, des chiffres, des tirets et des traits de soulignement.',
    'alpha_num' => 'L\'attribut :attribute ne peut contenir que des lettres et des chiffres.',
    'array' => 'L\'attribut :attribute doit être un tableau.',
    'before' => 'L\'attribut :attribute doit être une date antérieure à :date.',
    'before_or_equal' => 'L\'attribut :attribute doit être une date antérieure ou égale à :date.',
    'between' => [
        'numeric' => 'L\'attribut :attribute doit être entre :min et :max.',
        'file' => 'L\'attribut :attribute doit être entre :min et :max kilobytes.',
        'string' => 'L\'attribut :attribute doit être entre :min et :max caractères.',
        'array' => 'L\'attribut :attribute doit être entre :min et :max articles.',
    ],
    'boolean' => 'L\'attribut :attribute doit être vrai ou faux.',
    'confirmed' => 'La confirmation de l\'attribut :attribute ne correspond pas',
    'date' => 'L\'attribut :attribute n\'est pas une date valide',
    'date_equals' => 'L\'attribut :attribute doit être une date égale à :date.',
    'date_format' => 'L\'attribut :attribute ne correspond pas au format :format.',
    'different' => 'L\'attribut :attribute et :other doivent être différents',
    'digits' => 'L\'attribut :attribute doit être :digits chiffres.',
    'digits_between' => 'L\'attribut :attribute doit être entre :min et :max chiffres.',
    'dimensions' => 'L\'attribut :attribute a des dimensions d\'image non valides.',
    'distinct' => 'L\'attribut :attribute a une valeur en double.',
    'email' => 'L\'attribut :attribute doit être une adresse e-mail valide.',
    'ends_with' => 'L\'attribut :attribute doit se terminer par l\'un des éléments suivants: :values.',
    'exists' => 'L\'attribut selectionné :attribute est invalide',
    'file' => 'L\'attribut :attribute doit être un fichier.',
    'filled' => 'L\'attribut :attribute doit avoir une valeur.',


    'gt' => [
        'numeric' => 'L\'attribut :attribute doit être supérieur à :value.',
        'file' => 'L\'attribut :attribute doit être supérieur à :value kilobytes.',
        'string' => 'L\'attribut :attribute doit être supérieur à :value caractères.',
        'array' => 'L\'attribut :attribute doit avoir plus que :value articles.',
    ],
    'gte' => [
        'numeric' => 'L\'attribut :attribute doit être supérieur ou égal à :value.',
        'file' => 'L\'attribut :attribute doit être supérieur ou égal à :value kilobytes.',
        'string' => 'L\'attribut :attribute doit être supérieur ou égal à :value caractères.',
        'array' => 'L\'attribut :attribute doit avoir :value articles ou plus.',
    ],
    'image' => ':attribute doit être une image.',
    'in' => 'L\'attribut selectionné :attribute est invalide.',
    'in_array' => 'L\'attribut :attribute n\'exite pas dans :oL\'attributr.',
    'integer' => 'L\'attribut :attribute doit être un entier.',
    'ip' => 'L\'attribut :attribute doit être une adresse IP valide.',
    'ipv4' => 'L\'attribut :attribute doit être une adresse IPv4 valide.',
    'ipv6' => 'L\'attribut :attribute doit être une adresse IPv6 valide.',
    'json' => 'L\'attribut :attribute doit être une chaîne JSON valide.',
    'lt' => [
        'numeric' => 'L\'attribut :attribute doit être inférieur à :value.',
        'file' => 'L\'attribut :attribute doit être inférieur à :value kilobytes.',
        'string' => 'L\'attribut :attribute doit être inférieur à :value caractères.',
        'array' => 'L\'attribut :attribute doit avoir moins de :value articles.',
    ],
    'lte' => [
        'numeric' => 'L\'attribut :attribute doit être inférieur ou égal :value.',
        'file' => 'L\'attribut :attribute doit être inférieur ou égal :value kilobytes.',
        'string' => 'L\'attribut :attribute doit être inférieur ou égal :value caractères.',
        'array' => 'L\'attribut :attribute ne doit pas avoir plus de :value articles.',
    ],
    'max' => [
        'numeric' => 'L\'attribut :attribute ne peut pas être supérieur à :max.',
        'file' => 'L\'attribut :attribute ne peut pas être supérieur à :max kilobytes.',
        'string' => 'L\'attribut :attribute ne peut pas être supérieur à :max caractères.',
        'array' => 'L\'attribut :attribute ne peut pas avoir plus de :max articles.',
    ],
    'mimes' => 'L\'attribut :attribute doit être un fichier de type: :values.',
    'mimetypes' => 'L\'attribut :attribute doit être un fichier de type: :values.',
    'min' => [
        'numeric' => 'L\'attribut :attribute doit être au moins :min.',
        'file' => 'L\'attribut :attribute doit être au moins :min kilobytes.',
        'string' => 'L\'attribut :attribute doit être au moins :min caractères.',
        'array' => 'L\'attribut :attribute doit avoir au moins :min articles.',
    ],
    'not_in' => 'L\'attribut selectionné :attribute est invalide.',
    'not_regex' => 'L\'attribut :attribute est de format invalide.',
    'numeric' => 'L\'attribut :attribute doit être un nombre.',
    'password' => 'Le mot de passe est incorrect.',
    'present' => 'Le champ :attribute doit être présent.',
    'regex' => 'L\'attribut :attribute est de format invalide.',
    'required' => 'Le champ :attribute est obligatoire.',
    'required_if' => 'Le champ :attribute est requis lorsque :other est :value.',
    'required_unless' => 'Le champ :attribute est requis sauf si :other est dans :values.',
    'required_with' => 'Le champ :attribute est requis lorsque :values est present.',
    'required_with_all' => 'Le champ :attribute est requis lorsque :values sont présents.',
    'required_without' => 'Le champ :attribute est requis lorsque :values n\'est pas présent.',
    'required_without_all' => 'Le champ :attribute est requis lorsqu\'aucun des :values ne sont présents.',
    'same' => 'L\'attribut :attribute et :other doivent correspondre.',
    'size' => [
        'numeric' => 'L\'attribut :attribute doit être :size.',
        'file' => 'L\'attribut :attribute doit être :size kilobytes.',
        'string' => 'L\'attribut :attribute doit être :size caractères.',
        'array' => 'L\'attribut :attribute doit avoir :size articles.',
    ],
    'starts_with' => 'L\'attribut :attribute doit commencer par l\'un des éléments suivants: :values.',
    'string' => 'L\'attribut :attribute doit être une chaine de caractères.',
    'timezone' => 'L\'attribut :attribute doit être une zone valide.',
    'unique' => 'L\'attribut :attribute a déjà été pris.',
    'uploaded' => 'L\'attribut :attribute n\'a pas pu être téléchargé.',
    'url' => 'L\'attribut :attribute est de format invalide.',
    'uuid' => 'L\'attribut :attribute doit être un UUID valide.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using L\'attribut
    | convention "attribute.rule" to name L\'attribut lines. This makes it quick to
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
    | L\'attribut following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
