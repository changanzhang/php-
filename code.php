<?php
/**
 * @function getCode 生成验证码
 * @author 张先生
 * @date 2020-04-01
 * @return array
 */
// 获取验证码（参数:验证码个数，验证码宽度，验证码高度）
if(!function_exists('getCode')) {
    function getBase64Code(string $code, $width = 100, $height = 30)
    {
        $image = imagecreate($width, $height); // 赋值宽度，高度
        imagecolorallocate($image, 255, 255, 255); // 设定图片背景颜色
        // 生成干扰像素
        for ($i = 0; $i < 80; $i++) {
            $dis_color = imagecolorallocate($image, rand(0, 2555), rand(0, 255), rand(0, 255));
            imagesetpixel($image, rand(1, $width), rand(1, $height), $dis_color);
        }
        // 打印字符到图像
        $num = strlen($code);
        for ($i = 0; $i < $num; $i++) {
            $char_color = imagecolorallocate($image, rand(0, 2555), rand(0, 255), rand(0, 255));
            imagechar($image, 100, ($width / $num) * $i, rand(0, 5), $code[$i], $char_color);
        }

        ob_start();
        imagepng($image);
        $imageData = ob_get_contents();
        imagedestroy($image);//释放资源
        ob_end_clean();

        return "data:image/png;base64," . base64_encode($imageData);
    }
}
