<?php
/**
 * Created by PhpStorm.
 * User: Raluca Gherase
 * Date: 06.06.2017
 * Time: 19:29
 */

	class Markers extends Controller{

        public function get($params){

            require_once '../database/dbconfig.php';

            if($_SERVER['REQUEST_METHOD'] === 'GET'){

                // check if script is running from console
                if(!empty($params['cli_token']) && $params['cli_token'] === 'eqJTNcpOQmdFKoBhhpa3'){
                    $markers = $db_con->prepare("SELECT * FROM tbl_markers WHERE movable = 1");
                    $markers->execute();
                    $array = $markers->fetchAll( PDO::FETCH_ASSOC );
                    echo json_encode($array, true);
                    exit;
                }

                if(!empty($params['token'])){
                    $query = $db_con->prepare("SELECT * FROM tbl_users WHERE user_token=:user_token");
                    $query->execute([':user_token' => $params['token']]);

                    $user = $query->fetchAll( PDO::FETCH_ASSOC );
                    if(empty($user)){
                        echo json_encode([
                            'error' => true,
                            'errorCode' => 1002,
                            'errorMessage' => '400: Bad Request - invalid token provided']);
                        exit;
                    }
                }else{
                    echo json_encode([
                        'error' => true,
                        'errorCode' => 1001,
                        'errorMessage' => '400: Bad Request - token parameter is missing']);
                    exit;
                }

                if(!empty($params['id'])){
                    $markers = $db_con->prepare("SELECT * FROM tbl_markers WHERE id=:id");
                    $markers->execute([':id' => $params['id']]);
                }else{
                    $markers = $db_con->prepare("SELECT * FROM tbl_markers WHERE user_id=:id");
                    $markers->execute([':id' => $user[0]['user_id']]);
                }

                $array = $markers->fetchAll( PDO::FETCH_ASSOC );
                $json = json_encode( $array );
                echo $json;
                exit;
            }else{

                echo json_encode([
                    'error' => true,
                    'errorCode' => 1000,
                    'errorMessage' => '405: Method Not Allowed']);
                exit;
            }
        }

        public function delete($params){

            if($_SERVER['REQUEST_METHOD'] === 'DELETE'){

                if(!empty($params['token'])){

                    require_once '../database/dbconfig.php';

                    $query = $db_con->prepare("SELECT * FROM tbl_users WHERE user_token=:user_token");
                    $query->execute([':user_token' => $params['token']]);

                    $user = $query->fetchAll( PDO::FETCH_ASSOC );
                    if(empty($user)){
                        echo json_encode([
                            'error' => true,
                            'errorCode' => 1002,
                            'errorMessage' => '400: Bad Request - invalid token provided']);
                        exit;
                    }

                    if(!empty($params['id'])){
                        $markers = $db_con->prepare("DELETE FROM tbl_markers WHERE id=:id");
                        echo $markers->execute([
                            ':id' => $params['id']
                        ]);
                        exit;
                    }else{
                        echo json_encode([
                            'error' => true,
                            'errorCode' => 1003,
                            'errorMessage' => '400: Bad Request - marker id not provided']);
                        exit;
                    }
                }else{
                    echo json_encode([
                        'error' => true,
                        'errorCode' => 1001,
                        'errorMessage' => '400: Bad Request - token parameter is missing']);
                    exit;
                }
            }else{

                echo json_encode([
                    'error' => true,
                    'errorCode' => 1000,
                    'errorMessage' => '405: Method Not Allowed']);
                exit;
            }
        }

        public function add($params){

            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                if(!empty($params['token'])){

                    require_once '../database/dbconfig.php';

                    $query = $db_con->prepare("SELECT * FROM tbl_users WHERE user_token=:user_token");
                    $query->execute([':user_token' => $params['token']]);

                    $user = $query->fetchAll( PDO::FETCH_ASSOC );
                    if(empty($user)){
                        echo json_encode([
                            'error' => true,
                            'errorCode' => 1002,
                            'errorMessage' => '400: Bad Request - invalid token provided']);
                        exit;
                    }

                    $markers = $db_con->prepare("INSERT INTO tbl_markers(id, user_id, type, title, lat, lng, movable) VALUES(:id, :user_id, :type, :title, :lat, :lng, :movable)");
                    echo $markers->execute([
                        ':id' => $_POST['id'],
                        ':user_id' => $user[0]['user_id'],
                        ':type' => $_POST['marker_type'],
                        ':title' => $_POST['title'],
                        ':lat' => $_POST['lat'],
                        ':lng' => $_POST['lng'],
                        ':movable' => $_POST['marker_movable'],
                    ]);
                    exit;
                }else{
                    echo json_encode([
                        'error' => true,
                        'errorCode' => 1001,
                        'errorMessage' => '400: Bad Request - token parameter is missing']);
                    exit;
                }
            }else{

                echo json_encode([
                    'error' => true,
                    'errorCode' => 1000,
                    'errorMessage' => '405: Method Not Allowed']);
                exit;
            }
        }

        public function move($params){

            if($_SERVER['REQUEST_METHOD'] === 'PUT'){

                require_once '../database/dbconfig.php';

                if(!empty($params['cli_token']) && $params['cli_token'] === 'eqJTNcpOQmdFKoBhhpa3'){ // console script
                    $markers = $db_con->prepare("UPDATE tbl_markers SET lat=:lat, lng=:lng WHERE id=:id");

                    $res = $markers->execute([
                        ':id' => $params['id'],
                        ':lat' => $params['lat'],
                        ':lng' => $params['lng']
                    ]);
                    exit;
                }
            }
        }
    }