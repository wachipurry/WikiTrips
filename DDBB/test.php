<?php

$table = 'user_details';
$hola = array('alias' => "'roger'", 'id_status' => 1);
$sql = "INSERT INTO " . $table . "(";
$fields_num = count(array_keys($hola));
for ($i = 0; $i < ($fields_num - 1); $i++) {
    $sql .= array_keys($hola)[$i] . ", ";
}
$sql .= array_keys($hola)[$fields_num - 1] . ') VALUES (';
$sql2 = "";
foreach ($hola as $key => $value) {
    $sql2 .= $value . ", ";
}
$res = substr($sql2, 0, -2);
$sql .= $res . ')';


echo $sql . "<hr>";
