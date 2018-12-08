<?php
    $raw=@$_POST["raw"];
    if (is_null($raw)) {
        exit(json_encode([
            "ret"=>"1000",
            "desc"=>"LACK PARAM",
            "data"=>[
                "raw"=>"ERROR",
            ]
        ]));
    }

    // My Easter Egg

    if ($raw=="127.0.0.1") {
        exit(json_encode([
            "ret"=>200,
            "desc"=>"SUCCESS",
            "data"=>[
                "raw"=>$raw,
                "ans"=>"Home"
            ]
        ]));
    }

    if (strlen($raw)>25) {
        exit(json_encode([
            "ret"=>1001,
            "desc"=>"ERROR",
            "data"=>[
                "raw"=>"TOO LONG"
            ]
        ]));
    }

    if (!preg_match("<^[.+\-*/0123456789]+$>", $raw)) {
        exit(json_encode([
            "ret"=>1003,
            "desc"=>"ERROR",
            "data"=>[
                "raw"=>"ILLEGAL EQUATION"
            ]
        ]));
    }

    try {
        $ans=eval("return $raw;");
    } catch (ParseError $e) {
        exit(json_encode([
            "ret"=>1002,
            "desc"=>"ERROR",
            "data"=>[
                "raw"=>"SYNTAX ERROR"
            ]
        ]));
    }

    echo json_encode([
        "ret"=>200,
        "desc"=>"SUCCESS",
        "data"=>[
            "raw"=>$raw,
            "ans"=>$ans
        ]
    ]);
