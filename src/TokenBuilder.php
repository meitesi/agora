<?php


namespace Meitesi\Agora;


use DateTime;
use DateTimeZone;
use Meitesi\Agora\code\RtcTokenBuilder;
use Meitesi\Agora\code\RtmTokenBuilder;
use Illuminate\Support\Facades\Config;

class TokenBuilder
{
    protected $appID;
    protected $appCertificate;

    public function __construct()
    {
        $config = Config::get('agora');
        $this->appID = $config['id'];
        $this->appCertificate = $config['secret'];
    }

    /**
     * 生成RTC_Token
     * @author: 鲁元
     * @time: 14:00
     * @date: 2021/8/3
     */
    public function rtcTokenBuild($channelName,$uid)
    {
        $role = RtcTokenBuilder::RoleAttendee;
        $expireTimeInSeconds = 7200;
        $currentTimestamp = (new DateTime("now", new DateTimeZone('PRC')))->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;
        return RtcTokenBuilder::buildTokenWithUserAccount($this->appID, $this->appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);
    }
    /**
     * 生成RTM_Token
     * @author: 鲁元
     * @time: 14:00
     * @date: 2021/8/3
     */
    public function rtmTokenBuild($uid)
    {
        $role = RtmTokenBuilder::RoleRtmUser;
        $expireTimeInSeconds = 7200;
        $currentTimestamp = (new DateTime("now", new DateTimeZone('PRC')))->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;
        return RtmTokenBuilder::buildToken($this->appID, $this->appCertificate, $uid, $role, $privilegeExpiredTs);
    }

}