<?php
class User{
    public $name;
    public $login;
    public $email;
    public $password;

    public function signUp($name, $login, $email, $password, $jsonArr)
    {
        $data = array();
        $s = 'jimk5';
        
        $data['name'] = $name;
        $data['login'] = $login;
        $data['email'] = $email;
        $data['password'] = md5($password.$s);
        
        //Запись в файл data.json
        $jsonArr[] = $data;
        $jsonData = json_encode($jsonArr);
        file_put_contents('../data/data.json', $jsonData);
        

        $response = [
            "status" => true
        ];
        echo json_encode($response);
    }
    public function signIn($login, $password, $jsonArr)
    {
        $search = false;
    
        for($i = 0; $i < count($jsonArr); $i++){
            if($jsonArr[$i]['login'] === $login && $jsonArr[$i]['password'] === $password){
                $_SESSION["user"] = [
                    "name" => $jsonArr[$i]['name'],
                    "login" => $jsonArr[$i]['login'],
                    "email" => $jsonArr[$i]['email'],
                    "password" => $jsonArr[$i]['password']
        
                ];
        
                $response = [
                    "status" => true
                ];
                echo json_encode($response);
                $search = true;
            }
        }
    
        if(!$search){
            
            $response = [
                "status" => false,
                "message" => 'Неверный логин или пароль'
            ];
    
            echo json_encode($response);
    
        };
    }
    public function update($name, $login, $email, $jsonArr)
    {
        $data = array();
        
        $data['name'] = $name;
        $data['login'] = $login;
        $data['email'] = $email;
        
        //Внести изменения в сессию
        for($i = 0; $i < count($jsonArr); $i++){
            if($jsonArr[$i]['login'] === $_SESSION["user"]['login']){
    
                $jsonArr[$i]['name'] = $name;
                $jsonArr[$i]['login'] = $login;
                $jsonArr[$i]['email'] = $email;
            }
        }

        //Записать новые данные в файл data.json
        $jsonData = json_encode($jsonArr);
        file_put_contents('../data/data.json', $jsonData);
        
        $_SESSION["user"]['name'] = $name;
        $_SESSION["user"]['login'] = $login;
        $_SESSION["user"]['email'] = $email;

        $response = [
            "status" => true
        ];
        echo json_encode($response);
    }
    public function updatePassword($new_password, $jsonArr)
    {
        $data = array();
        $s = 'jimk5';
        
        $new_password = md5($new_password.$s);
        
        //Внести изменения 
        for($i = 0; $i < count($jsonArr); $i++){
            if($jsonArr[$i]['login'] === $_SESSION["user"]['login']){
    
                $jsonArr[$i]['password'] = $new_password; 
            }
        }

        //Записать новые данные в файл data.json
        $jsonData = json_encode($jsonArr);
        file_put_contents('../data/data.json', $jsonData);
        
        $_SESSION["user"]['password'] = $new_password; 

        $response = [
            "status" => true
        ];
        echo json_encode($response);
    }
    public function delete($jsonArr)
    {
        for($i = 0; $i < count($jsonArr); $i++){
            if($_SESSION["user"]["login"] === $jsonArr[$i]["login"]){
                unset($jsonArr[$i]);        
            }
        }
        
        //Записать обновленные данные в файл data.json
        $jsonData = json_encode($jsonArr);
        file_put_contents('../data/data.json', $jsonData);

        unset($_SESSION['user']);
        header('Location: ../index.php');
    }
}