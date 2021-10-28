<?php
namespace Api\Support;
use Api\Http\Token;
use Api\Config\Config;
class Grammar
{
    public static function template($file)
    {
        /**
         * @var Regexp
         */
        $extendpattern = '/@extends\(\'(.*?)\'\)/';
        $yieldpattern = '/@yield\(\'(.*?)\'\)/';
        $sectionpattern = '/@section\(\'(.*)\'\)[\s]+(.*?)[\s]+@endsection/';
        $commandpattern = '/\{\{(.*?)\}\}/'; 
        /**
         * set Match String
         */

        preg_match_all($sectionpattern, $file, $sections);
        preg_match_all($commandpattern, $file, $commands);
        preg_match($extendpattern, $file, $extends);
        
        preg_match_all($yieldpattern, $eFile, $yields);        
        /**
         * replace @yield to @section
         */
        if(sizeof($yields[0]) > 0):
            if($yields = $yields[0])
            {
                for($index = 0; $index < sizeof($yields) ; $index++):
                    echo $sections[0][$index] . '<br>';
                endfor;
            }
        endif;
        /**
         * replace @extends to content
         */
        $file = str_replace($extends[0][0], $eFile, $file);
        return $file;
    }
    public static function getPathTemplate($file)
    {
        $extendpattern = '/\@extends\(\'(.*?)\'\)/';
        preg_match($extendpattern, $file, $extends);
        if($extnd = preg_match($extendpattern, $file)):
            preg_match($extendpattern, $file, $extends);
            return $extends[1];
        endif;
        return false;                
    }
    /**
     *  @var String $f1 (template)
     *  @var String $f2 (view)
     */
    public static function replaceYield($f1, $f2)
    {
        $result = $f1;        
        $yieldpattern = '/\@yield\(\'(.*)\'\)/';
        $echopattern = '/\{\{\\s(.*?)\s\}\}/';      
        $sectionpattern = '/\@section\(\'(.*)\'\)((?s).*)\@endsection/';

        if(self::selfPreg($yieldpattern, $f1) && self::selfPreg($sectionpattern, $f2))
        {
            preg_match($yieldpattern, $result, $yields);
            preg_match($sectionpattern, $f2, $sections);            
            if($yields[1] === $sections[1]):
                $result = str_replace($yields[0], $sections[2], $result);
            endif;
        }
        if(self::selfPreg($echopattern, $f1))
        {
            preg_match_all($echopattern, $result, $echosF1);
            foreach($echosF1[1] as $echo):
                // var_dump($echo);echo '<br/>';
                if(preg_match('/Config::get\(\'(.*?)\'\)/', $echo, $keyConfig)):
                // preg_match('/Config::get\(\'(.*?)\'\)/', $echo, $keyConfig);
                // var_dump($echo);
                // echo $key[1];
                // echo '<br>';
                // var_dump($keyToken);
                    $result = str_replace('{{ ', '', str_replace(' }}', '', str_replace($echo, Config::get($keyConfig[1]), $result)));
                endif;
                if(preg_match('/Token::generate\(\'(.*?)\'\)/', $echo, $keyToken)):
                    // var_dump($keyToken);
                    // $token = Token::generate($keyToken[1]);
                    // echo '<script>'.$token.'</script>';
                // preg_match('/Token::generate\(\'(.*?)\'\)/', $echo, $keyToken);                
                    $result = str_replace('{{ ', '', str_replace(' }}', '', str_replace($echo, Token::generate($keyToken[1]), $result)));
                endif;
            endforeach;
        }        
        // $y = $yields[0];
        // $s = $sections[0];
        // var_dump($yields);
        // echo '<br/>';
        // var_dump($sections);
        
        return $result;
    }
    public static function echos($file)
    {

    }
    public static function selfPreg($preg, $file)
    {
        if($result = preg_match($preg, $file))
            return true;
        return false;
    }
    public static function foreach($file)
    {
        $foreachpattern = '/\@foreach\s\((.*)\)\sas\s\((.*)\)((?s).*)\@endforeach/';
        preg_match_all($foreachpattern, $file, $foreach);
        var_dump($foreach); echo '<br/>';
        // $var = $foreach[1];
        // $as = $foreach[2];
        // $val = $foreach[3];
        // for($index = 0; $index < sizeof($foreach[0]) ; $index++ )
        // {
        //     // $explVal = explode('.', $val[$index]);
        //     // print_r($explVal);
        //     // echo '<br>';
        //     echo $var[$index] . ' as ' . $as[$index] . ' args ' . $val[$index] .'<br/>';
        // }
        // foreach($foreach as $for)
        // {
        //     print_r($for[0]);
        //     echo '<br/>';
        // }         
    }
}