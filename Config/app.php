<?php

/**
 * 请在下面放置任何您需要的应用配置
 */
return array(
    /**
     * 应用接口层的统一参数
     */
    'apiCommonRules' => array(
//        'sign' => array('name' => 'sign', 'require' => true),
    ),
    /*
     * 邮箱参数
     */
    'PHPMailer' => array(
        'email' => array(
            'host' => 'smtp.163.com',
            'username' => 'pro_2011@163.com',
            'password' => 'pro2011',
            'from' => 'pro_2011@163.com',
            'fromName' => '志达科技系统自动邮件',
            'sign' => '<br><br>************************************<br>请不要回复此邮件，谢谢！<br>志达科技官网:http://www.esclouds.cn<br>联系人:孙滢贺<br>联系电话:18513363627<br>--志达科技系统自动邮件 <br>************************************',
        ),
    ),
);
