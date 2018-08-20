<?php
namespace app\api\controller\v1;

use aliyun\dy_sdk_lite\SignatureHelper;
use think\Request;
use think\Cache;
use think\helper\Str;
use think\exception\HttpException;

Class VerificationCodes
{
	/**
	 * 创建并发送验证码
	 * @param  Request         $request         [description]
	 * @param  SignatureHelper $signatureHelper [description]
	 * @return [type]                           [description]
	 */
	public function create(Request $request, SignatureHelper $signatureHelper)
	{
		$phone = $request->get('phone');

		// 生成4位随机数，左侧补0
        $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);

		$params = array ();

    	// *** 需用户填写部分 ***

    	// fixme 必填: 请参阅 https://ak-console.aliyun.com/ 取得您的AK信息
		$accessKeyId = "LTAIl4VUAOPckZtw";
		$accessKeySecret = "xLRn7JlNgUoC8lTYnFqkmHWYFAzGKM";

    	// fixme 必填: 短信接收号码
		$params["PhoneNumbers"] = $phone;

    	// fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
		$params["SignName"] = "当代名师";

    	// fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
		$params["TemplateCode"] = "SMS_142380197";

    	// fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
		$params['TemplateParam'] = Array (
			"code" => $code,
			//"product" => "阿里通信"
		);

    	// fixme 可选: 设置发送短信流水号
		$params['OutId'] = "12345";

    	// fixme 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
		$params['SmsUpExtendCode'] = "1234567";


    	// *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
		if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
			$params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
		}

    	// 初始化SignatureHelper实例用于设置参数，签名以及发送请求
		//$helper = new SignatureHelper();
		
    	// 此处可能会抛出异常，注意catch
    	try {
    		$content = $signatureHelper->request(
    			$accessKeyId,
    			$accessKeySecret,
    			"dysmsapi.aliyuncs.com",
    			array_merge($params, array(
    				"RegionId" => "cn-hangzhou",
    				"Action" => "SendSms",
    				"Version" => "2017-05-25",
    			))
        		// fixme 选填: 启用https
        		// ,true
    		);
    	} catch(\Exception $e) {
    		abort(404, '短信发送异常');
    	}

    	if ($content->Code == 'OK') {
    		$key = 'verificationCode_'.Str::random(15);
    		$expiredAt = 180;
        	// 缓存验证码 3分钟过期。
    		Cache::set($key, ['phone' => $phone, 'code' => $code], $expiredAt);
    	} else {
    		abort(404, $content->Message);
    	}

		return json(['key' => $key, 'expired_at' => $expiredAt]);
	}
}