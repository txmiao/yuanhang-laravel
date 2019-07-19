<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerPurchaseRecord extends Model
{
    protected $table = 'partner_purchase_records';
    protected $fillable = ['user_id', 'sku_number'];
    public $timestamps = false;

    /**
     * 新增合伙人购买记录
     * @param User $user
     * @param PartnerGoods $partnerGoods
     * @return bool
     */
    public function insert_data(User $user, PartnerGoods $partnerGoods)
    {
        self::fill([
            'user_id' => $user->id,
            'sku_number' => $partnerGoods->sku_number,
        ]);
        $this->change_partner_level($user);

        return self::save();
    }

    /**
     * 调整合伙人等级
     * @param User $user
     * @return bool
     */
    private function change_partner_level(User $user)
    {
        $partnerLevelId = 0;
        $records = self::where('user_id', $user->id)->pluck('sku_number')->toArray();
        $records = array_unique($records);
        $partnerLevels = PartnerLevel::orderByDesc('level')->get();
        if ($partnerLevels) {
            foreach ($partnerLevels as $partnerLevelItem) {
                if (!array_diff($partnerLevelItem['sku_number'][0], $records) || !array_diff($partnerLevelItem['sku_number'][1], $records)) {
                    $partnerLevelId = $partnerLevelItem->id;
                    break;
                }
            }

            $user->update([
                'type' => $user::TYPE_PARTNER,
                'partner_level_id' => $partnerLevelId
            ]);
        }

        return true;
    }
}
