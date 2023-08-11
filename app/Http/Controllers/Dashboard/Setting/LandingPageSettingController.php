<?php

namespace App\Http\Controllers\Dashboard\Setting;

use App\Enums\RoleEnum;
use App\Enums\Setting\LandingPageSettingEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use App\Http\Requests\Setting\LandingPageSettingRequest;
use App\Settings\LandingPageSetting;
use App\Helpers\UploadHelper;
use App\Helpers\ResponseHelper;
use Auth;

class LandingPageSettingController extends Controller
{
    protected $route;
    protected $view;

    public function __construct()
    {
        $this->route = "dashboard.settings.landing-page.";
        $this->view = "dashboard.settings.landing-page";
    }

    public function index(LandingPageSetting $landingPageSetting)
    {
        $data = [
            'result' => $landingPageSetting,
        ];

        return view($this->view, $data);
    }

    public function update(LandingPageSettingRequest $request)
    {
        try {
            $title = $request->title;
            $keyword = $request->keyword;
            $description = $request->description;
            $email = $request->email;
            $hotline = $request->hotline;
            $province = $request->province;
            $city = $request->city;
            $district = $request->district;
            $address = $request->address;
            $instagram = $request->instagram;
            $whatsapp = $request->whatsapp;
            $youtube = $request->youtube;
            $facebook = $request->facebook;
            $twitter = $request->twitter;
            $head_of_office_name = $request->head_of_office_name;
            $head_of_office_image = $request->file("head_of_office_image");
            $head_of_office_quotes = $request->head_of_office_quotes;
            $footer = $request->footer;
            $logo = $request->file("logo");
            $logo_footer = $request->file("logo_footer");
            $banner = $request->file("banner");
            $favicon = $request->file("favicon");
            $organization = $request->file("organization");

            if ($head_of_office_image) {
                $upload = UploadHelper::upload_file($head_of_office_image, 'settings', LandingPageSettingEnum::LOGO_EXT);

                if ($upload["IsError"] == TRUE) {
                    return ResponseHelper::apiResponse(false, $upload["Message"] , null, null, 422);
                }

                $head_of_office_image = $upload["Path"];
            }

            if ($logo) {
                $upload = UploadHelper::upload_file($logo, 'settings', LandingPageSettingEnum::LOGO_EXT);

                if ($upload["IsError"] == TRUE) {
                    return ResponseHelper::apiResponse(false, $upload["Message"] , null, null, 422);
                }

                $logo = $upload["Path"];
            }

            if ($logo_footer) {
                $upload = UploadHelper::upload_file($logo_footer, 'settings', LandingPageSettingEnum::LOGO_EXT);

                if ($upload["IsError"] == TRUE) {
                    return ResponseHelper::apiResponse(false, $upload["Message"] , null, null, 422);
                }

                $logo_footer = $upload["Path"];
            }

            if ($banner) {
                $upload = UploadHelper::upload_file($banner, 'settings', LandingPageSettingEnum::LOGO_EXT);

                if ($upload["IsError"] == TRUE) {
                    return ResponseHelper::apiResponse(false, $upload["Message"] , null, null, 422);
                }

                $banner = $upload["Path"];
            }

            if ($favicon) {
                $upload = UploadHelper::upload_file($favicon, 'settings', LandingPageSettingEnum::LOGO_EXT);

                if ($upload["IsError"] == TRUE) {
                    return ResponseHelper::apiResponse(false, $upload["Message"] , null, null, 422);
                }

                $favicon = $upload["Path"];
            }

            if ($organization) {
                $upload = UploadHelper::upload_file($organization, 'settings', LandingPageSettingEnum::LOGO_EXT);

                if ($upload["IsError"] == TRUE) {
                    return ResponseHelper::apiResponse(false, $upload["Message"] , null, null, 422);
                }

                $organization = $upload["Path"];
            }

            $landingPageSetting = new LandingPageSetting();
            if ($head_of_office_image) {
                $landingPageSetting->head_of_office_image = $head_of_office_image;
            }
            if ($logo) {
                $landingPageSetting->logo = $logo;
            }
            if ($logo_footer) {
                $landingPageSetting->logo_footer = $logo_footer;
            }
            if ($favicon) {
                $landingPageSetting->favicon = $favicon;
            }
            if ($banner) {
                $landingPageSetting->banner = $banner;
            }
            if ($organization) {
                $landingPageSetting->organization = $organization;
            }
            $landingPageSetting->title = $title;
            $landingPageSetting->keyword = $keyword;
            $landingPageSetting->description = $description;
            $landingPageSetting->footer = $footer;
            $landingPageSetting->email = $email;
            $landingPageSetting->hotline = $hotline;
            $landingPageSetting->province = $province;
            $landingPageSetting->city = $city;
            $landingPageSetting->district = $district;
            $landingPageSetting->address = $address;
            $landingPageSetting->instagram = $instagram;
            $landingPageSetting->whatsapp = $whatsapp;
            $landingPageSetting->youtube = $youtube;
            $landingPageSetting->twitter = $twitter;
            $landingPageSetting->facebook = $facebook;
            $landingPageSetting->head_of_office_name = $head_of_office_name;
            $landingPageSetting->head_of_office_quotes = $head_of_office_quotes;

            $landingPageSetting->save();

            return ResponseHelper::apiResponse(true, "Pengaturan landing page berhasil diubah" , $landingPageSetting , null, 200);

        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return ResponseHelper::apiResponse(false, $th->getMessage() , null, null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
