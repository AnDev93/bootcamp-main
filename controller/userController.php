<?php 
    if($peticionAjax){
        require_once "../model/userModel.php";
    }else{
        require_once "./model/userModel.php";
    }

class userController extends userModel {
    public function  add_user_controller(){
        $alert = [
            "Alerta" => "simple",
            "Titulo" => "todo bien",
            "Texto" => "",
            "Tipo" => "success"
        ];
        echo json_encode($alert);
        exit();
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
        if($nombre=="" || $usuario=="" || $password=="" || $password2=="" || $email=="" || $tipo=="" || $estatus==""){
            $alert = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alert);
            exit();
        }

        

        // $password = mainModel::encryption($password);

        // $data = [
        //     "Nombre" => $nombre,
        //     "Usuario" => $usuario,
        //     "Password" => $password,
        //     "Email" => $email,
        //     "Telefono" => $telefono,
        //     "Tipo" => $tipo,
        //     "Estatus" => $estatus
        // ];

        // $add_user = userModel::add_user_model($data);

        // if($add_user->rowCount() == 1){
        //     $alert = [
        //         "Alerta" => "limpiar",
        //         "Titulo" => "Usuario registrado",
        //         "Texto" => "El usuario se ha registrado con éxito",
        //         "Tipo" => "success"
        //     ];
        // }else{
        //     $alert = [
        //         "Alerta" => "simple",
        //         "Titulo" => "Ocurrió un error inesperado",
        //         "Texto" => "No se ha podido registrar el usuario",
        //         "Tipo" => "error"
        //     ];
        // }
        
        // echo json_encode($alert);
        // exit();
    }
}

