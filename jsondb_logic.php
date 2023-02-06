<?php

class Work_jdb {
    public $file = 'jdb/users.json';
    public $file_handle;
    
    public $login;
    public $password;
    public $email;
    public $name;

    public function __construct()
    {
        if (file_exists($this->file)==false) {
            $this->file_handle = fopen($this->file, "x+");
        } else {
            $this->file_handle = fopen($this->file, "r");
        }
        return "connected to jdb";
    }

    public function __destruct() {
        if ($this->file_handle) {
            fclose($this->file_handle);
        }
    }

    public function check_unique($key_name, $value)
    {

        $lines = file_get_contents($this->file);
        if (strlen($lines>0)) {
            $lines_array = json_decode($lines, true);
            if (empty($lines_array)==false){
                foreach ($lines_array as $line_num => $line) {
                    
                    foreach ($line as $k => $v) {
                        if ($k == $key_name) {
                            if ($v == $value) {
                                return false;
                            }
                        }
                    }
                }
            }
        }
        return true;
    }

    public function delete_line($key_name, $value)
    {
        $lines = file_get_contents($this->file);
        if (strlen($lines>0)) {
            $lines_array = json_decode($lines, true);
            foreach ($lines_array as $line_num => $line) {
                
                foreach ($line as $k => $v) {
                    if ($k == $key_name) {
                        if ($v == $value) {
                            unset($lines_array[$line_num]);
                            $updated_srting = json_encode($lines_array);
                            fclose($this->file_handle);
                            $this->file_handle = fopen($this->file, "w+");
                            fwrite($this->file_handle, $updated_srting);
                            break;
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    public function add_line($login, $password, $email, $name)
    {
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->name = $name;
        
        $hash = password_hash($password, PASSWORD_BCRYPT);
        
        $data_arr = array('login' => $login, 'password' => $hash, 'email' => $email, 'name' => $name);
        
        $lines = file_get_contents($this->file);
        if (strlen($lines>0)) {
            $lines_array = json_decode($lines, true);
            $lines_array[count($lines_array)] = $data_arr;
        } else {
            $lines_array = array($data_arr);
        }

        $line_to_add = json_encode($lines_array);

        fclose($this->file_handle);
        $this->file_handle = fopen($this->file, "w+");
        fwrite($this->file_handle, $line_to_add);
        return $line_to_add;
    }

    public function logging($login, $password) {
        $lines = file_get_contents($this->file);
        $lines_array = json_decode($lines, true);

        if (empty($lines_array)==false){
            foreach ($lines_array as $line_num => $line) {
                
                $hash = $line['password']; 

                $arr_login = $line['login'];
                if ($arr_login == $login){
                    if (password_verify($password, $hash)){
                        return $line["name"];
                    } else {
                        return false;
                    }
                }
            }
        }
        return false;
    }
}

?>