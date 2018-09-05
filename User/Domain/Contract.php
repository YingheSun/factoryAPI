<?php

class Domain_Contract {

    public function set_Contract($data) {
        $this->sendRemindMail($data);
        $this->sendreturnMail($data);
    }

    public function sendRemindMail($data) {
        $mailer = new PHPMailer_Lite(true);
        DI()->logger->info("发送邮件:网站联络提醒", $data->email);
        $name = $data->name;
        $phone = $data->phone;
        $comment = $data->comment;
        $warningStr = "系统提示您: <br><br> $name 发来联络,<br><br> 对方邮件: " . $data->email . "， <br><br> 对方电话: $phone <br><br> 留言: $comment ,<br><br>请及时处理！<br><br> 祝您身体健康，心情愉快！";
        $mailer->send('pro_2011@163.com', '网站联络提醒', $warningStr);
    }

    public function sendreturnMail($data) {
        $mailer = new PHPMailer_Lite(true);
        DI()->logger->info("发送邮件:网站联络已受理提醒", $data->email);
        $name = $data->name;
        $email = $data->email;
        $phone = $data->phone;
        $comment = $data->comment;
        $warningStr = "尊敬的 $name: <br><br> 您好,<br>您发送的联络系统已受理。请确认您的信息准确以方便我方人员<br> 电话: $phone <br><br>内容:$comment <br><br> 祝您身体健康，心情愉快！";
        $mailer->send($email, '关注物料已入库提醒', $warningStr);
    }

}
