<?
/**
  * Returns an string clean of UTF8 characters. It will convert them to a similar ASCII character
  * www.unexpectedit.com 
  */
function str_convert_chars ($string)
{
    // 1) convert á ô => a o
    $string = preg_replace("/[áàâãªäā]/u","a",$string);
    $string = preg_replace("/[ÁÀÂÃÄ]/u","A",$string);
    $string = preg_replace("/[ÍÌÎÏ]/u","I",$string);
    $string = preg_replace("/[íìîï]/u","i",$string);
    $string = preg_replace("/[éèêë]/u","e",$string);
    $string = preg_replace("/[ÉÈÊË]/u","E",$string);
    $string = preg_replace("/[óòôõºö]/u","o",$string);
    $string = preg_replace("/[ÓÒÔÕÖ]/u","O",$string);
    $string = preg_replace("/[úùûü]/u","u",$string);
    $string = preg_replace("/[ÚÙÛÜ]/u","U",$string);
    $string = preg_replace("/[š]/u","s",$string);
    $string = preg_replace("/[Š]/u","S",$string);
    $string = preg_replace("/[’‘‹›‚]/u","'",$string);
    $string = preg_replace("/[“”«»„]/u",'"',$string);
    $string = str_replace("–","-",$string);
    $string = str_replace(" "," ",$string);
    $string = str_replace("ç","c",$string);
    $string = str_replace("Ç","C",$string);
    $string = str_replace("ñ","n",$string);
    $string = str_replace("Ñ","N",$string);
 
    //2) Translation CP1252. &ndash; => -
    $trans = get_html_translation_table(HTML_ENTITIES); 
    $trans[chr(130)] = '&sbquo;';    // Single Low-9 Quotation Mark 
    $trans[chr(131)] = '&fnof;';    // Latin Small Letter F With Hook 
    $trans[chr(132)] = '&bdquo;';    // Double Low-9 Quotation Mark 
    $trans[chr(133)] = '&hellip;';    // Horizontal Ellipsis 
    $trans[chr(134)] = '&dagger;';    // Dagger 
    $trans[chr(135)] = '&Dagger;';    // Double Dagger 
    $trans[chr(136)] = '&circ;';    // Modifier Letter Circumflex Accent 
    $trans[chr(137)] = '&permil;';    // Per Mille Sign 
    $trans[chr(138)] = '&Scaron;';    // Latin Capital Letter S With Caron 
    $trans[chr(139)] = '&lsaquo;';    // Single Left-Pointing Angle Quotation Mark 
    $trans[chr(140)] = '&OElig;';    // Latin Capital Ligature OE 
    $trans[chr(145)] = '&lsquo;';    // Left Single Quotation Mark 
    $trans[chr(146)] = '&rsquo;';    // Right Single Quotation Mark 
    $trans[chr(147)] = '&ldquo;';    // Left Double Quotation Mark 
    $trans[chr(148)] = '&rdquo;';    // Right Double Quotation Mark 
    $trans[chr(149)] = '&bull;';    // Bullet 
    $trans[chr(150)] = '&ndash;';    // En Dash 
    $trans[chr(151)] = '&mdash;';    // Em Dash 
    $trans[chr(152)] = '&tilde;';    // Small Tilde 
    $trans[chr(153)] = '&trade;';    // Trade Mark Sign 
    $trans[chr(154)] = '&scaron;';    // Latin Small Letter S With Caron 
    $trans[chr(155)] = '&rsaquo;';    // Single Right-Pointing Angle Quotation Mark 
    $trans[chr(156)] = '&oelig;';    // Latin Small Ligature OE 
    $trans[chr(159)] = '&Yuml;';    // Latin Capital Letter Y With Diaeresis 
    $trans['euro'] = '&euro;';    // euro currency symbol 
    ksort($trans); 
     
    foreach ($trans as $k => $v) {
        $string = str_replace($v, $k, $string);
    }
 
    // 3) remove <p>, <br/> ...
    $string = strip_tags($string); 
     
    // 4) &amp; => & &quot; => '
    $string = html_entity_decode($string);
     
    // 5) remove Windows-1252 symbols like "TradeMark", "Euro"...
    $string = preg_replace('/[^(\x20-\x7F)]*/','', $string); 
     
    $targets=array('\r\n','\n','\r','\t');
    $results=array(" "," "," ","");
    $string = str_replace($targets,$results,$string);
     
    return ($string);
}
