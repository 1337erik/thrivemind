<?php

namespace App;

class ModelUtility
{

    /**
     * 
     * I probably did way too much here..
     * 
     * By default this returns the full list,
     *  with options to return a specific index or a small list of randomly picked items..
     */
    public function acceptedRepetitions( $howMuch = null, $specificOne = false )
    {

        $fullList = [

            'once a week',
            'twice a week',
            'three times a week',
            'four times a week',
            'five times a week',
            'six times a week',
            'seven times a week',
            'daily',
            'monthly',
            'twice a day',
            'three times a day',
            'four times a day',
            'five times a day'
        ];

        if( $specificOne ) return $fullList[ $specificOne ];
        else if( $howMuch ) {

            $randoList = [];
            for( $i = 0; $i < $howMuch; $i++ ){

                $rando = mt_rand( 0, count( $fullList ) - 1 );
                array_push( $randoList, $fullList[ $rando ] );
            }
            return $randoList;
        } else return $fullList;
    }
}