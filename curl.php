<?php

    for ($i = 56; $i < 156; $i++) {
        $curl = curl_init('http://localhost/crud/delete.php?id='.$i);

        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, "task=$name&send=Add");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($curl);

        echo "Delete id = $i\n";
    }