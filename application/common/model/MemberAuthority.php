<?php

namespace app\common\model;

use think\Model;

class MemberAuthority extends BaseModel
{

    /**
     * 根据openid和platform 获取授权信息
     *
     * @param [type] $openid
     * @param [type] $platform
     * @return void
     */
    public function getByOpenIdAndPlatform($openid, $platform){
        $where = array(
            'openid' => $openid,
            'platform' => $platform,
        );
        return $this->where($where)->find();
    }



    /**
     * 根据会员id和平台类型获取授权记录
     *
     * @param [type] $member_id
     * @param [type] $platform
     * @return void
     */
    public function getByMemberIdAndPlatform($member_id, $platform){
        $where = array(
            'member_id' => $member_id,
            'platform' => $platform,
        );
        return $this->where($where)->find();
    }



    /**
     * 更新授权记录关联的会员Id
     *
     * @param [type] $id
     * @param [type] $member_id
     * @return void
     */
    public function updateAuthMember($openid, $platform, $member_id){
        $where = array(
            'openid' => $openid,
            'platform' => $platform,
        );
        $data = array(
            'member_id' => $member_id,
            'update_time' => now()
        );
        return $this->where($where)->update($data);
    }

}
