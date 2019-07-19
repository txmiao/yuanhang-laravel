<?php

namespace App\Http\Controllers\Admin;

use App\Models\ChargeRecord;
use App\Models\Company;
use App\Models\SearchKeywordHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class StatisticController extends Controller
{
    /**
     * 关键词搜索统计列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function keywords(Request $request)
    {
        $params = [
            '_t' => $request->input('_t', 'keyword'),
            '_kw' => $request->input('_kw', ''),
            'start_time' => $request->input('start_time', ''),
            'end_time' => $request->input('end_time', ''),
        ];

        $count = SearchKeywordHistory::condition($params)->count();

        $lists = SearchKeywordHistory::select([
            'keyword',
            DB::raw('COUNT(keyword) AS count'),
        ])
            ->condition($params)
            ->groupBy('keyword')
            ->orderByDesc('count')
            ->paginate(10);
        return view('admin.statistics.keywords', compact('lists', 'count', 'params'));
    }

    /**
     * 充值记录统计列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chargeRecord(Request $request)
    {
        $params = [
            'type' => $request->input('type', ''),
            'start_time' => $request->input('start_time', ''),
            'end_time' => $request->input('end_time', ''),
        ];

        $count = ChargeRecord::condition($params)->sum('money');

        $lists = ChargeRecord::condition($params)->select([
            'type',
            DB::raw('SUM(money) AS total_money'),
        ])
            ->groupBy('type')
            ->get();

        return view('admin.statistics.charge_record', compact('lists', 'count', 'params'));
    }

    /**
     * 公司信息统计列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Companies(Request $request)
    {
        $params = [
            '_t' => $request->input('_t', 'full_name'),
            '_kw' => $request->input('_kw', ''),
            'start_time' => $request->input('start_time', ''),
            'end_time' => $request->input('end_time', ''),
        ];

        $lists = Company::select(['id', 'full_name', 'short_name', 'purchase_top_count', 'purchase_platform_auth_count'])
            ->withCount('exclusive')
            ->with('company_ext')
            ->statisticCondition($params)
            ->paginate(10);

        $companies = Company::select(['id', 'full_name', 'short_name', 'purchase_top_count', 'purchase_platform_auth_count'])
            ->withCount('exclusive')
            ->with('company_ext')
            ->statisticCondition($params)
            ->get();


        $count = [
            'exclusive_count' => 0,
            'view_times_count' => 0,
            'support_times_count' => 0,
            'share_times_count' => 0,
            'collection_times_count' => 0,
            'purchase_platform_auth_count' => 0,
            'purchase_top_count' => 0,
        ];

        if ($companies) {
            foreach ($companies as $company) {
                $count['exclusive_count'] += $company->exclusive_count;
                $count['view_times_count'] += $company->company_ext->view_times;
                $count['support_times_count'] += $company->company_ext->support_times;
                $count['share_times_count'] += $company->company_ext->share_times;
                $count['collection_times_count'] += $company->company_ext->collection_times;
                $count['purchase_platform_auth_count'] += $company->purchase_platform_auth_count;
                $count['purchase_top_count'] += $company->purchase_top_count;
            }
        }

        return view('admin.statistics.companies', compact('lists', 'count', 'params'));
    }

    /**
     * 导出搜索关键字列表
     * @return string|\Symfony\Component\HttpFoundation\StreamedResponse
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function keywordsExport()
    {
        $title = [[
            'id' => 'ID',
            'keyword' => '搜索关键词',
            'count' => '使用量'
        ]];

        $lists = SearchKeywordHistory::select([
            'keyword',
            DB::raw('COUNT(keyword) AS count'),
        ])
            ->groupBy('keyword')
            ->orderByDesc('count')
            ->get();

        $excelData = [];
        if ($lists) {
            foreach ($lists as $key => $list) {
                $temp = [
                    'id' => $key + 1,
                    'keyword' => $list['keyword'],
                    'count' => $list['count']
                ];
                array_push($excelData, $temp);
            }
        }
        $excelData = array_merge($title, $excelData);

        return (new FastExcel(collect($excelData)))->download('statistic_keyword.xlsx');
    }

    /**
     * 导出充值记录统计列表
     * @return string|\Symfony\Component\HttpFoundation\StreamedResponse
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function chargeRecordExport()
    {
        $title = [[
            'id' => 'ID',
            'type' => '充值类型',
            'total_money' => '充值金额'
        ]];

        $lists = ChargeRecord::select([
            'type',
            DB::raw('SUM(money) AS total_money'),
        ])
            ->groupBy('type')
            ->get();

        $excelData = [];
        if ($lists) {
            foreach ($lists as $key => $list) {
                array_push($excelData, [
                    'id' => $key + 1,
                    'type' => ChargeRecord::TYPE_TOP == $list['type'] ? '信息置顶' : '平台认证',
                    'total_money' => $list['total_money']
                ]);
            }
        }

        $excelData = array_merge($title, $excelData);
        return (new FastExcel(collect($excelData)))->download('statistic_charge_record.xlsx');

    }

    /**
     * 导出公司信息统计列表
     * @return string|\Symfony\Component\HttpFoundation\StreamedResponse
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function CompaniesExport()
    {
        $title = [[
            'id' => 'ID',
            'full_name' => '公司名称',
            'short_name' => '公司简称',
            'exclusive_count' => '专线数量',
            'view_times' => '浏览量',
            'support_times' => '点赞量',
            'share_times' => '分享量',
            'collection_times' => '收藏量',
            'purchase_platform_auth_count' => '平台认证期数',
            'purchase_top_count' => '购买置顶服务次数'
        ]];

        $companies = Company::select(['id', 'full_name', 'short_name', 'purchase_top_count', 'purchase_platform_auth_count'])
            ->withCount('exclusive')
            ->with('company_ext')
            ->get();

        $excelData = [];
        if ($companies) {
            foreach ($companies as $key => $company) {
                array_push($excelData, [
                    'id' => $key + 1,
                    'full_name' => $company['full_name'],
                    'short_name' => $company['short_name'],
                    'exclusive_count' => $company['exclusive_count'],
                    'view_times' => $company->company_ext->view_times,
                    'support_times' => $company->company_ext->support_times,
                    'share_times' => $company->company_ext->share_times,
                    'collection_times' => $company->company_ext->collection_times,
                    'purchase_platform_auth_count' => $company['purchase_platform_auth_count'],
                    'purchase_top_count' => $company['purchase_top_count'],
                ]);
            }
        }
        $excelData = array_merge($title, $excelData);

        return (new FastExcel(collect($excelData)))->download('statistic_companies.xlsx');
    }
}
