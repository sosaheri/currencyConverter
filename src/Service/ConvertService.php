<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;

class ConvertService
{
    public function convertCurrency( int $amount , string $from): Array
    {

        $currencies = [
            'MXN',
            'ERN',
            'DZD',
            'CDF',
            'MAD',
            'SYP'
        ];        

        $values = [];
        $data = [];


        for ( $index = 0; $index < count( $currencies ); $index++) {            
              array_push( $values , $this->getValue($amount, $from, $currencies[$index] ) );            
        }


        for ( $index = 0; $index < count( $currencies ); $index++) {   
            
            
            $data[$index] = [
               'amount' => $amount,
               'fromCurrency' => $from,
               'toCurrency' => $currencies[$index],
               'convertionAmount' => $values[$index],
           ];          
        }        



        return $mockdata; 
           
          
       
    }

    public function getValue(int $amount, string $from, string $to) : float 
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.apilayer.com/currency_data/convert?to=".$to."&from=".$from."&amount=".$amount,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: text/plain",
            //"apikey: RcePWY874SrK3Dr7jLSwIRuantAHJhp5"
            "apikey: rFjdiMlC3IagwbGS3WtNxMA38K7s7PRg"
                    ),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET"
        ));
      
        $response = curl_exec($curl);
        curl_close($curl);
        return (float)(json_decode($response, true)['result']);
    }
}
