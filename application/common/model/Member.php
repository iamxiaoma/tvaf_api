<?php

namespace app\common\model;

use think\Model;

class Member extends BaseModel
{
    //


    /**
	 * @param  通过手机号码获取会员信息
	 * @return [type]
	 */
	public function getByMobile($region, $mobile) {
		$where = array(
			'region' => $region,
			'mobile' => $mobile,
		);
		return $this->where($where)->find();
	}
}
