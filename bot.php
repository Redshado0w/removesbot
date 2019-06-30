<?php
define('API_KEY',"892765783:AAHgmQ2Q-OJzYeMmk8fdjOTrNM-LBZaYuzc");
@$update = json_decode(file_get_contents('php://input'),true);
@$message = $update["message"];
@$chat_id = $message["chat"]["id"];
@$type = $message["chat"]["type"];
function foxlearn($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
        return "null";
    }else{
        return json_decode($res);
    }
}
if($type == "private")
{
	foxlearn('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"سلام,این ربات از ورود سایر ربات ها به گروهتون جلوگیری میکنه!
	✅فقط کافیه این ربات را به گروه اد کنید و مدیرش کنید.
	🔴این ربات نیاز به تنظیمات خاصی ندارد.",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
    ['text'=>"🤖".";روبات های  کاربردی ما", 'url'=>"https://telegram.me/Vnumberz"]
    ]
    ]
    ])
    ]);
}else{
if(isset($message["new_chat_members"]))
{
	foreach($message["new_chat_members"] As $item)
	{
	if($item["is_bot"])
	{
	foxlearn('KickChatMember',[
		'chat_id'=>$chat_id,
		'user_id'=>$item["id"]
	]);
	}
	}
}
}
@eval(base64_decode("ZWNobyAiRm94TGVhcm4uaXIiOw=="));
