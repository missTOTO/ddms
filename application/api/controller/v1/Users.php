<?php
namespace app\api\controller\v1;
use think\Request;
use think\Cache;
use OSS\OssClient;
use OSS\OssException;

class Users
{
	// 获取用户信息
    public function read($id)
    {
        $result= Model('Users','logic')->UserInfo($id);
        return json($result);
    }

    // 更新用户信息
    public function update(Request $request, $id)
    {
        $data = $request->param();
        $result = Model('Users','logic')->updateUserInfo($data, $id);
        return json($result);
    }
    
    // 用户注册
    public function create(Request $request)
    {
        $verifyData = Cache::get($request->param('verification_key'));

        if (!$verifyData) {
            abort(422, '验证码已失效');
        }

        if (!hash_equals($verifyData['code'], $request->param('verification_code'))) {
            // 返回401
            abort(401, '验证码错误');
        }
        //清除验证码缓存
        //Cache::rm($verifyData);
        return json($verifyData);
    }
    //用户上传头像
    public function head()
    {
        // 阿里云主账号AccessKey拥有所有API的访问权限，风险很高。强烈建议您创建并使用RAM账号进行API访问或日常运维，请登录 https://ram.console.aliyun.com 创建RAM账号。
        $accessKeyId = "LTAIl4VUAOPckZtw";
        $accessKeySecret = "xLRn7JlNgUoC8lTYnFqkmHWYFAzGKM";
        // Endpoint以杭州为例，其它Region请按实际情况填写。
        $endpoint = "http://oss-cn-beijing.aliyuncs.com";
        // 存储空间名称
        $bucket = "dangdaimingshi";
        // 文件名称
        $object = "head/head_image";
        // <yourLocalFile>由本地文件路径加文件名包括后缀组成，例如/users/local/myfile.txt
        $filePath = "image.jpg";
        try{
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
            $result = $ossClient->uploadFile($bucket, $object, $filePath);
        } catch(OssException $e) {
            abort('500', $e->getMessage());
        }
        if ($result['info']['http_code'] == 200) {
            return json($result['info']['url']);
        }
        abort('401', '头像上传失败');
    }
}