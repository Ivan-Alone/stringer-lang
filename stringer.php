<?php
    $variables = array();
    $functions = array();
    $stack = array();

    $src = $argv[1];

    if (!file_exists($src)) crash('Source file is not exists!');

    $source = file_get_contents($src);

	preg_match_all('/\'(.+)[^\\\\]\'/U', $source, $reformed);
	foreach($reformed[0] as $id => $string) {
		$name = '_CONST_'.$id;
		$variables[$name] = str_replace('\\\'', '\'', substr($string,1,-1));
		$source = str_replace_once($string, $name, $source);
	}
	
	if (contains($source, '\'')) crash('Syntaxix error, string parsing exception');
		
	preg_match_all('/#stringer(.+)#!stringer/Uis', $source, $code);
    

	$blocks = explode('#', $code[1][0]);
	foreach($blocks as $block) {
		preg_match_all('/new (.+)/smi', $block, $func);
		$lines = explode("\n",trim($func[1][0]));
		$header = trim(spacesFree($lines[0]));
		if ($header == null) continue;
		$header = explode(' ', $header);
		
	};
		
	function contains($search, $that) {
		return str_replace($that,null,$search) != $search;
	}
	
	function spacesFree($string) {
		while (contains($string, '  ')) {
			$string = str_replace('  ', ' ', $string);
		}
		return $string;
	}
	
	function str_replace_once($search, $replace, $text) { 
	   $pos = strpos($text, $search); 
	   return $pos!==false ? substr_replace($text, $replace, $pos, strlen($search)) : $text; 
	}
	
    function crash($message) {
        echo '['.date('H:i:s').'] Error: '.($message == null ? 'Error!' : $message).PHP_EOL;
        exit;
    }
