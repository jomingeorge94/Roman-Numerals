<?php

namespace App\Http\Controllers;

use App\IntegerConversion;
use App\IntegerConversionInterface;
use Illuminate\Http\Request;

class HomeController extends Controller implements IntegerConversionInterface
{
    /**
     * Function to get the Integer conversion blade file
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function integerConversionView() {
        return view('task1');
    }

    /**
     * Function to handle once user input an integer and with to conver into roman numeral
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function integerConversionHandler(Request $request) {
        $this->validate($request, array(
            'integer' => 'required|numeric|min:1|max:3999'
        ));

        // Converts the integer to Roman Numerals
        $romanNumeral = $this->toRomanNumerals($request->integer);

        // Lookup if the record exist in the database
        // Only create a record if record already not exist, otherwise
        // update the number of times converted and last seen
        $lookup = IntegerConversion
            ::firstOrCreate(array(
                'integer' => $request->integer,
                'roman_numeral' => $romanNumeral
            ));

        $lookup->number_of_times_converted++;
        $lookup->save();

        $response = array(
            'integer' => $request->integer,
            'roman_numeral' => $romanNumeral,
            'number_of_times_converted' => $lookup->number_of_times_converted,
            'last_time_converted' => $lookup->updated_at
        );

        return view('task1', compact('response'));
    }

    /**
     * Function to get the recently converted integers
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recentlyConvertedIntegers() {
        $results = IntegerConversion
            ::take(10)
            ->orderBy('updated_at', 'DESC')
            ->get()
            ->toArray();

        return view('task2', [
            'records' => $results
        ]);
    }

    /**
     * Function to get the top 10 converted integers
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function topTenConvertedIntegers() {
        $results = IntegerConversion
            ::take(10)
            ->orderBy('number_of_times_converted', 'DESC')
            ->get()
            ->toArray();

        return view('task3', [
            'records' => $results
        ]);
    }

    /**
     * Function to convert an integer to Roman Numeral
     * Reference - https://stackoverflow.com/questions/14994941/numbers-to-roman-numbers-with-php
     * @param $integer
     * @return string
     */
    public function toRomanNumerals($integer)
    {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($integer > 0) {
            foreach ($map as $roman => $int) {
                if($integer >= $int) {
                    $integer -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
}
