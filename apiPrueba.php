<?php
/*$arrayPrueba=[
    [
        "trip_name"=>'Prueba 1',
        "trip_thumb"=>'https://picsum.photos/200'
    ],
    [
        "trip_name"=>'Prueba 2',
        "trip_thumb"=>'https://picsum.photos/200'
    ],
    [
        "trip_name"=>'Prueba 3',
        "trip_thumb"=>'https://picsum.photos/200'
    ],
    [
        "trip_name"=>'Prueba 4',
        "trip_thumb"=>'https://picsum.photos/200'
    ]
];
echo json_encode($arrayPrueba);*/
    if (isset($_POST["apiCode"])){
        if(!empty($_POST["apiCode"])){
            $code=htmlentities($_POST["apiCode"]);
            if($code=="101"){
                $arrayPrueba=[
                    [
                        "trip_name"=>'Prueba 1',
                        "trip_thumb"=>'https://picsum.photos/200'
                    ],
                    [
                        "trip_name"=>'Prueba 2',
                        "trip_thumb"=>'https://picsum.photos/200'
                    ],
                    [
                        "trip_name"=>'Prueba 3',
                        "trip_thumb"=>'https://picsum.photos/200'
                    ],
                    [
                        "trip_name"=>'Prueba 4',
                        "trip_thumb"=>'https://picsum.photos/200'
                    ]
                ];
                echo json_encode($arrayPrueba);
            }
            if($code=="202"){
                $nickname=htmlentities($_POST["nickname"]);
                $name=htmlentities($_POST["name"]);
                $surname=htmlentities($_POST["surname"]);
                $password=htmlentities($_POST["password"]);
                $email=htmlentities($_POST["email"]);
                $treatment=htmlentities($_POST["treatment"]);
                $error=validateData($nickname,$name,$surname,$password,$email,$treatment);
                if(!empty($error) && $error!=""){
                    echo $error;
                }
                else{
                    echo "";
                }
            }
        }
    }


        function validateData($nickname,$name,$surname,$password,$email,$treatment){
            $error="";
            if(empty($nickname)){
                $error .= "<li>The nickname is empty</li>";
            }
            if(empty($name) ){
                $error .= "<li>The name is empty</li>";
            }
            if(empty($password)){
                $error .= "<li>The password is empty</li>";
            }
            if(empty($email) ){
                $error .= "<li>The email is empty</li>";
            }
            if(empty($treatment)){
                $error .= "<li>The treatment is empty</li>";
            }
        /*    if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $nickname)){
                $error .= "<li>The nickname must not have especials chard</li>";
            }
            if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $name)){
                $error .= "<li>The name must not have especials chars</li>";
            }
            if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $surname)){
                $error .= "<li>The surnames must not have especials chars</li>";
            }
            if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $treatment)){
                $error .= "<li>The treatment must not have especials chars</li>";
            }
            if(!preg_match('/[\'^£$%&*()}{#~?><>,|=_+¬-]/', $email)){
                $error .= "<li>The email must not have especials chars</li>";
            }*/
            if (strlen($password) < 6 || strlen($password) > 12) {
                $error .= "<li>The password must be between 6 and 12 chars</li>";
            }
            if(!preg_match("#[0-9]+#",$password)) {
                $error .= "<li>The password must have one number</li>";
            }
            if(!preg_match("#[A-Z]+#",$password)) {
                $error .= "<li>The password must have minimun one capital letter</li>";
            }   
            if(!preg_match("#[a-z]+#",$password)) {
                $error .= "<li>The password must have minimun one small letter</li>";
            }  
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error.="<li>Wrong email</li>";
            }
            
            return $error;
           
        }
