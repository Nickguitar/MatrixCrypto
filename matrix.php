<?php 
$chars = array("");
for($i=0;$i<=255;$i++){
	array_push($chars, chr($i));
}
$palavra = "test";    //change to encrypt

$A = array( //matriz chave
		array(5, 6),
		array(7, 8)
	);

$num_linhas = count($A);
$num_coluna = count($A[0]);
$det = ($A[0][0]*$A[1][1]) - ($A[0][1]*$A[1][0]);
$det_inv = 1/$det;
$inv_A = array( //matriz inversa da chave, para decodificar
	array($det_inv*($A[1][1]), $det_inv*(-$A[0][1])),
	array($det_inv*(-$A[1][0]), $det_inv*($A[0][0]))
);
	
echo "Matriz A (codificadora): ".$num_linhas."x".$num_coluna.":";
echo "<table>
";
for($i=0;$i<=$num_linhas-1;$i++){
		echo "<tr>
			";
		for($j=0;$j<=$num_coluna-1;$j++){
			echo "<td>".$A[$i][$j]."</td>
			";
		}
		echo "</tr>
		";
}
echo "</table><bR><br>";

echo "Matriz A^-1 (inversa): ".$num_linhas."x".$num_coluna.":";
echo "<table>
";
for($i=0;$i<=$num_linhas-1;$i++){
		echo "<tr>
			";
		for($j=0;$j<=$num_coluna-1;$j++){
			echo "<td>".$inv_A[$i][$j]."</td>
			";
		}
		echo "</tr>
		";
}
echo "</table><bR><br>";
	

$separada = str_split($palavra); 
$arr = array();

$B = array( //matriz com duas linhas com os numeros correspondentes; vazia agora
		array(), 
		array()
);

$C = array( //matriz com duas linhas com os numeros correspondentes; vazia agora (BxA)
		array(), 
		array()
);

$D = array( //matriz com duas linhas com os numeros correspondentes; vazia agora (BxA^-1)
	array(),
	array()
);

foreach($separada as $letra){
	array_push($arr, array_search($letra, $chars)); //cria um array com os numeros correspondentes as letras da palavra
}

if((count($arr) % 2) !== 0){ //numero impar de caracteres, divisao por 2 não dá resto 0
	array_push($arr, 1); //adiciona um caracter de escape pra ficar par
}

for($i=0;$i<count($arr);$i++){ // monta a primeira linha da matriz
	if($i<count($arr)/2){
		array_push($B[0], $arr[$i]);
	}elseif($i>=(count($arr)/2)){
		array_push($B[1], $arr[$i]);
	}
}


echo "Matriz B (Texto: <b>".$palavra."</b>): ".count($B)."x".count($B[0]).":";
echo "<table>
";
for($i=0;$i<=count($B)-1;$i++){
		echo "<tr>
			";
		for($j=0;$j<=count($B[0])-1;$j++){
			echo "<td>".dechex($B[$i][$j])."</td>
			";
		}
		echo "</tr>
		";
}
echo "</table><bR><br>";


for($i=0;$i<count($B[0]);$i++){
	array_push($C[0], ($B[0][$i]*$A[0][0])+($B[1][$i]*$A[0][1]));
	array_push($C[1], ($B[0][$i]*$A[1][0])+($B[1][$i]*$A[1][1]));
}

echo "Matriz BxA (codificada): ".count($C)."x".count($C[0]).":";
echo "<table>
";
for($i=0;$i<=count($C)-1;$i++){
		echo "<tr>";
		for($j=0;$j<=count($C[0])-1;$j++){
			echo "<td>".$C[$i][$j]."</td>";
		}
		echo "</tr>";
}
echo "</table><bR><br>";

for($i=0;$i<count($B[0]);$i++){
	array_push($D[0], ($C[0][$i]*$inv_A[0][0])+($C[1][$i]*$inv_A[0][1]));
	array_push($D[1], ($C[0][$i]*$inv_A[1][0])+($C[1][$i]*$inv_A[1][1]));
}

$descriptografado = "";
foreach($D[0] as $letra){
	$descriptografado .= $chars[$letra];
}
foreach($D[1] as $letra){
	if($chars[$letra] !== "#"){
		$descriptografado .= $chars[$letra];
	}
}

echo "Matriz BxA^-1 (decodificada: <b>".$descriptografado."</b>): ".count($C)."x".count($C[0]).":";
echo "<table>
";
for($i=0;$i<=count($C)-1;$i++){
		echo "<tr>
			";
		for($j=0;$j<=count($C[0])-1;$j++){
			echo "<td>".dechex($D[$i][$j]) ."</td>
			";
		}
		echo "</tr>
		";
}
echo "</table><bR><br><br><BR><BR><BR><BR>";

?>
