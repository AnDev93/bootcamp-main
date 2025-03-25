<?php 
    if($peticionAjax){
        require_once "../model/userModel.php";
    }else{
        require_once "./model/userModel.php";
    }

class userController extends userModel {
    public function  add_user_controller(){
        // $alert = [
        //     "Alerta" => "simple",
        //     "Titulo" => "todo bien",
        //     "Texto" => "",
        //     "Tipo" => "success"
        // ];
        // echo json_encode($alert);
        // exit();
        /*== recibir campos via post ==*/
        $nombre = mainModel::clean_string($_POST['nombre_reg']);
        $usuario = mainModel::clean_string($_POST['usuario_reg']);
        $password = mainModel::clean_string($_POST['password_reg']);
        $password2 = mainModel::clean_string($_POST['password2_reg']);
        $email = mainModel::clean_string($_POST['email_reg']);
        $telefono = mainModel::clean_string($_POST['telefono_reg']);
        $tipo = mainModel::clean_string($_POST['tipo_reg']);
        $estatus = mainModel::clean_string($_POST['estatus_reg']);
        
        /*== comprobar campos vacios ==*/
        if($nombre=="" || $usuario=="" || $password=="" || $password2=="" || $telefono=="" || $tipo=="" || $estatus==""){
            $alert = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alert);
            exit();
        }

        /*== Verificando integridad de los datos ==*/

        if(mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{5,50}", $nombre)){
            $alert = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Campo Nombre no coincide con el formato solicitado: [a-zA-ZáéíóúÁÉÍÓÚñÑ ]{5,50}",
                "Tipo" => "error"
            ];
            echo json_encode($alert);
            exit();
        }

        if(mainModel::verificar_datos("[a-zA-ZñÑ0-9]{5,35}", $usuario)){
            $alert = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Campo Usuario no coincide con el formato solicitado: [a-zA-ZñÑ0-9]{5,35}",
                "Tipo" => "error"
            ];
            echo json_encode($alert);
            exit();
        }

        // if(mainModel::verificar_datos("a-zA-Z0-9ñÑ]{7,35}", $password)){
        //     $alert = [
        //         "Alerta" => "simple",
        //         "Titulo" => "Ocurrió un error inesperado",
        //         "Texto" => "El Campo Contraseña no coincide con el formato solicitado: [a-zA-Z0-9ñÑ*$.#]{7,35}",
        //         "Tipo" => "error"
        //     ];
        //     echo json_encode($alert);
        //     exit();
        // }

        if(mainModel::verificar_datos("[a-zA-Z0-9ñÑ]{7,35}", $password2)){
            $alert = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Campo Repetir Contraseña no coincide con el formato solicitado: [a-zA-Z0-9ñÑ*$.#]{7,35}",
                "Tipo" => "error"
            ];
            echo json_encode($alert);
            exit();
        }

        if($password != $password2){
            $alert = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "Las contraseñas no coinciden",
                "Tipo" => "error"
            ];
            echo json_encode($alert);
            exit();
        }

        /*== Comprobando email ==*/
        if($email!=""){
            if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                $check_email=mainModel::ejecutar_consulta_simple("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
                if($check_email->rowCount()>0){
                    $alert=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrió un error inesperado",
                        "Texto"=>"El EMAIL ingresado ya se encuentra registrado en el sistema",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alert);
                    exit();
                }
            }else{
                $alert=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"Ha ingresado un correo no valido",
                    "Tipo"=>"error"
                ];
                echo json_encode($alert);
                exit();
            }
        }

        if(mainModel::verificar_datos("[0-9+]{11,15}",$telefono)){
            $alert=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrió un error inesperado",
                "Texto"=>"El Campo Telefono no coincide con el formato solicitado:[0-9+]{11,15}",
                "Tipo"=>"error"
            ];
            echo json_encode($alert);
            exit();
        }

        if($tipo==""){
            $alert=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrió un error inesperado",
                "Texto"=>"Selecione un tipo de usuario",
                "Tipo"=>"error"
            ];
            echo json_encode($alert);
            exit();
        }

        if($estatus!=0 && $estatus!=1){
            $alert=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrió un error inesperado",
                "Texto"=>"El estutus del usuario no es valido",
                "Tipo"=>"error"
            ];
            echo json_encode($alert);
            exit();
        }

        $password = mainModel::encryption($password);

        $data = [
            "Nombre" => $nombre,
            "Username" => $usuario,
            "Password" => $password,
            "Email" => $email,
            "Telefono" => $telefono,
            "Tipo" => $tipo,
            "Estatus" => $estatus
        ];

        $add_user = userModel::add_user_model($data);

        if($add_user->rowCount() == 1){
            $alert = [
                "Alerta" => "limpiar",
                "Titulo" => "Usuario registrado",
                "Texto" => "El usuario se ha registrado con éxito",
                "Tipo" => "success"
            ];
        }else{
            $alert = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No se ha podido registrar el usuario",
                "Tipo" => "error"
            ];
        }
        
        echo json_encode($alert);
        exit();
    }
}

