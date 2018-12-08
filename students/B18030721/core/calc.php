<?php
    $raw=@$_POST["raw"];
    if(is_null($raw)){
        $output=[
            "ret"=>"1000",
            "desc"=>"参数不全",
            "data"=>[
                "raw"=>"ERROR",
                "ans"=>""
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

    /** ToDo
     * 1. 【制作简单的API】完成对字符串$raw（形如"1+2*3/4"）的计算并将结果输出；
     * 2. 【检测合法性】检测$raw的值是否是合法的算术表达式，以及判断最终结果是否超出了表示范围，分别对两种情况报错（ret>1000）并处理； 
     */
    $List1=['+','-','*','/','.'];
    function errorFind($raw){
        $List2=['++','+-','+*','+/','+.','-+','--','-*','-/','-.','*+','*-','*/','*.','/+','/-','/*','//','/.','.+','.-','.*','./','..','**'];
        foreach($List2 as $i){
            if(strpos($raw,$i)){
                if(preg_match('/\d\*\*\d/',$raw)){
                    return 0;
                }
                else{
                    return 1;   
                }
            }
        }
        return 0;
    }
    if(in_array(substr($raw,-1),$List1)||in_array(substr($raw,0,1),$List1)||errorFind($raw)){
        $raw="SYNTAX ERROR";
        $ans="ERROR";
    }
    else{
        $ans=eval("return $raw;");
        if($ans===INF){
            $raw="DATA OVERFLOW";
            $ans="ERROR";
        }
    }   

    // MY EGG
    switch($ans){
        case 404: $ans='GOOGLE';break;
        case 101: $ans='大佬云集的大活101';break;
        case 503: $ans='BAD GATEWAY';break;
    }

    echo json_encode([
        "ret"=>200,
        "desc"=>"成功",
        "data"=>[
            "raw"=>$raw,
            "ans"=>$ans //calc the answer and put it here
        ]
    ]);
?>