<?php
    $raw=@$_POST["raw"];
    if(is_null($raw)){
        $output=[
            "ret"=>"1000",
            "desc"=>"参数不全",
            "data"=>[
                "raw"=>"ERROR",
            ]
        ];
        echo json_encode($output);
        return;
    }

    // My Easter Egg

    if($raw=="127.0.0.1"){
        echo json_encode([
            "ret"=>200,
            "desc"=>"成功",
            "data"=>[
                "raw"=>$raw,
                "ans"=>"Home"
            ]
        ]);
        return;
    }


    echo json_encode([
        "ret"=>200,
        "desc"=>"成功",
        "data"=>[
            "raw"=>$raw,
            "ans"=>0 //calc the answer and put it here
        ]
    ]);