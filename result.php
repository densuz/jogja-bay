<?php
    $data=[];
    foreach ($_POST['id_user'] as $key => $value) {
        foreach ($_POST['id_kriteria_' .$value] as $key_sub => $value_sub) {
            $data[]= [
                'id_user'=> $value,
                'id_kriteria'=> $key_sub,
                'nilai'=> $value_sub,
                'tanggal'=> date('Y-m-d')
            ]; 
        }
    }
    echo "<pre>";
    // print_r($_POST);
    print_r($data);
    echo "</pre>";