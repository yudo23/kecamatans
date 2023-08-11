<?php

namespace App\Http\Controllers\Dashboard\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use App\Http\Requests\Setting\DashboardSettingRequest;
use App\Settings\DashboardSetting;
use App\Helpers\UploadHelper;
use App\Helpers\ResponseHelper;
use App\Enums\Setting\DashboardSettingEnum;

class DashboardSettingController extends Controller
{
    protected $route;
    protected $view;

    public function __construct()
    {
        $this->route = "dashboard.settings.dashboard.";
        $this->view = "dashboard.settings.dashboard";
    }

    public function index(DashboardSetting $dashboardSetting)
    {
        $data = [
            'result' => $dashboardSetting,
        ];

        return view($this->view, $data);
    }

    public function update(DashboardSettingRequest $request)
    {
        try {
            $title = $request->title;
            $footer = $request->footer;
            $logo_light_lg = $request->file("logo_light_lg");
            $logo_light_sm = $request->file("logo_light_sm");
            $logo_auth = $request->file("logo_auth");
            $favicon = $request->file("favicon");

            if ($logo_light_lg) {
                $upload = UploadHelper::upload_file($logo_light_lg, 'settings', DashboardSettingEnum::LOGO_EXT);

                if ($upload["IsError"] == TRUE) {
                    return ResponseHelper::apiResponse(false, $upload["Message"] , null, null, 422);
                }

                $logo_light_lg = $upload["Path"];
            }

            if ($logo_light_sm) {
                $upload = UploadHelper::upload_file($logo_light_sm, 'settings', DashboardSettingEnum::LOGO_EXT);

                if ($upload["IsError"] == TRUE) {
                    return ResponseHelper::apiResponse(false, $upload["Message"] , null, null, 422);
                }

                $logo_light_sm = $upload["Path"];
            }

            if ($logo_auth) {
                $upload = UploadHelper::upload_file($logo_auth, 'settings', DashboardSettingEnum::LOGO_EXT);

                if ($upload["IsError"] == TRUE) {
                    return ResponseHelper::apiResponse(false, $upload["Message"] , null, null, 422);
                }

                $logo_auth = $upload["Path"];
            }

            if ($favicon) {
                $upload = UploadHelper::upload_file($favicon, 'settings', DashboardSettingEnum::LOGO_EXT);

                if ($upload["IsError"] == TRUE) {
                    return ResponseHelper::apiResponse(false, $upload["Message"] , null, null, 422);
                }

                $favicon = $upload["Path"];
            }

            $dashboardSetting = new DashboardSetting();
            if ($logo_light_lg) {
                $dashboardSetting->logo_light_lg = $logo_light_lg;
            }
            if ($logo_light_sm) {
                $dashboardSetting->logo_light_sm = $logo_light_sm;
            }
            if ($logo_auth) {
                $dashboardSetting->logo_auth = $logo_auth;
            }
            if ($favicon) {
                $dashboardSetting->favicon = $favicon;
            }
            $dashboardSetting->title = $title;
            $dashboardSetting->footer = $footer;
            $dashboardSetting->save();

            return ResponseHelper::apiResponse(true, "Pengaturan dashboard berhasil diubah" , $dashboardSetting , null, 200);

        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return ResponseHelper::apiResponse(false, $th->getMessage() , null, null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
