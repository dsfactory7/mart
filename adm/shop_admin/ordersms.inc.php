<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
if (!defined("_ORDERSMS_")) exit;

$receive_number = preg_replace("/[^0-9]/", "", $od_hp);	// 수신자번호 (받는사람 핸드폰번호 ... 여기서는 주문자님의 핸드폰번호임)
//$send_number = preg_replace("/[^0-9]/", "", $default['de_admin_company_tel']); // 발신자번호

if ($config['cf_sms_use']) {
    if ($od_sms_ipgum_check && $default['de_sms_use4'])
    {
        if ($od_bank_account && $od_receipt_price && $od_deposit_name)
        {
            $sms_contents = $default['de_sms_cont4'];
            $sms_contents = str_replace("{이름}", $od_name, $sms_contents);
            $sms_contents = str_replace("{입금액}", number_format($od_receipt_price), $sms_contents);
            $sms_contents = str_replace("{주문번호}", $od_id, $sms_contents);
            $sms_contents = str_replace("{회사명}", $default['de_admin_company_name'], $sms_contents);


            // SMS 전송을 위해서 'SMS_PENDING_TABLE'에 Insert 한다.
            $sql = " insert {$g5['smsgw_pending_table']}
                            set mb_id       = '{$member['mb_id']}',
                            mb_name         = '$od_name',
                            recv_tel        = '$recv_number',
                            req_date        = '".G5_TIME_YMDHIS."',
                            sms_type        = 4,
                            sms_msg         = '$sms_contents'
                        ";
            $result = sql_query($sql, false);

            // when insert is failed,..
            if( !$result ) {
                error_log("Failed to insert 'smsgw_pending' table", 0);
            }


//            $SMS = new SMS;
//            $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $config['cf_icode_server_port']);
//            $SMS->Add($receive_number, $send_number, $config['cf_icode_id'], iconv("utf-8", "euc-kr", stripslashes($sms_contents)), "");
//            $SMS->Send();
        }
    }

    if ($od_sms_baesong_check && $default['de_sms_use5'])
    {
        $sms_contents = $default['de_sms_cont5'];
        $sms_contents = str_replace("{이름}", $od_name, $sms_contents);
        $sms_contents = str_replace("{HOPE_DATE}", $od['od_hope_date'], $sms_contents);
        $sms_contents = str_replace("{HOPE_TIME}", $od['od_hope_time'], $sms_contents);

        $sms_contents = str_replace("{회사명}", $default['de_admin_company_name'], $sms_contents);


        // SMS 전송을 위해서 'SMS_PENDING_TABLE'에 Insert 한다.
        $sql = " insert {$g5['smsgw_pending_table']}
                            set mb_id       = '{$member['mb_id']}',
                            mb_name         = '$od_name',
                            recv_tel        = '$recv_number',
                            req_date        = '".G5_TIME_YMDHIS."',
                            sms_type        = 5,
                            sms_msg         = '$sms_contents'
                        ";
        $result = sql_query($sql, false);

        // when insert is failed,..
        if( !$result ) {
            error_log("Failed to insert 'smsgw_pending' table", 0);
        }

//            $SMS = new SMS;
//            $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $config['cf_icode_server_port']);
//            $SMS->Add($receive_number, $send_number, $config['cf_icode_id'], iconv("utf-8", "euc-kr", stripslashes($sms_contents)), "");
//            $SMS->Send();
        }
}
?>
