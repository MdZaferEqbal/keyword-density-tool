<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Html2Text\Html2Text;

class ToolApiController extends Controller
{
    public function CalculateAndGetDensity(Request $request) {
        if ($request->isMethod('POST')) {
            if (isset($request->keywordInput)) { // Test the parameter is set.
                try {
                    $html = new Html2Text($request->keywordInput); // Setup the html2text obj.
                    $text = $html->getText(); // Execute the getText() function.
                    
                    $totalWordCount = str_word_count($text); // Get the total count of words in the text string
                    $wordsAndOccurrence  = array_count_values(str_word_count($text, 1)); // Get each word and the occurrence count as key value array
                    arsort($wordsAndOccurrence); // Sort into descending order of the array value (occurrence)
    
                    $keywordDensityArray = [];
                    // Build the array
                    foreach ($wordsAndOccurrence as $key => $value) {
                        $keywordDensityArray[] = ["keyword" => $key, // keyword
                            "count" => $value, // word occurrences
                            "density" => round(($value / $totalWordCount) * 100,2)]; // Round density to two decimal places.
                    }
    
                    $response = [
                        'heading'             => 'Analysis complete',
                        'message'             => 'Access your keyword density data now.',
                        'status'              => 1,
                        'keywordDensityArray' => $keywordDensityArray
                    ];
                    $responseCode = 200;
                } catch (\Exception $error) {
                    $response = [
                        'message' => 'An unexpected error occurred. Please try again later.',
                        'status'  => 0,
                        'error'   => $error->getMessage()
                    ];
                    $responseCode = 500;
                }
            } else {
                $response = [
                    'message' => 'Input required. Please paste or type text for keyword density analysis.',
                    'status'  => 0,
                    'error'   => 'Bad Request'
                ];
                $responseCode = 400;
            }
        } else {
            $response = [
                'message' => "This endpoint only accepts POST requests.",
                'status'  => 0,
                'error'   => "Method Not Allowed",
            ];
            $responseCode = 404;
        }
        return response()->json($response, $responseCode);
    }
}
