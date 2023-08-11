@extends("dashboard.layouts.main")

@section("title","Dashboard")

@section("css")
<style>
    #clock {
        font-size: 5rem;
        font-weight: 900;
        text-align: center;
    }

    #date {
        font-size: 2rem;
        font-weight: 900;
        text-align: center;
    }
</style>
@endsection

@section("breadcumb")
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Dashboard</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div>
                    <p>
                        Hi, <b>{{ Auth::user()->name ?? null}}</b>. Selamat datang di aplikasi <b>{{env("APP_NAME")}}</b>!
                    </p>
                    <p>
                        Waktu server saat ini:
                    </p>
                    <div id="date"></div>
                    <div id="clock"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<script>
    function displayCurrentTime() {
        let currentTime = new Date();
        let hours = currentTime.getHours();
        let minutes = currentTime.getMinutes();
        let seconds = currentTime.getSeconds();
        hours = addZero(hours);
        minutes = addZero(minutes);
        seconds = addZero(seconds);
        document.getElementById("clock").innerText = `${hours} : ${minutes} : ${seconds}`;
        setTimeout(displayCurrentTime, 1000);
    }

    function addZero(component) {
        return component < 10 ? "0" + component : component;
    }

    function displayCurrentDate() {
        let currentDate = new Date();
        let day = currentDate.getDay();
        let date = currentDate.getDate();
        let month = currentDate.getMonth();
        let year = currentDate.getFullYear();
        document.getElementById("date").innerText = `${getIndonesianDay(day)}, ${date} ${getIndonesianMonth(month)} ${year}`;
        setTimeout(displayCurrentDate, 1000);
    }

    function getIndonesianDay(day) {
        switch (day) {
            case 0:
                return "Minggu";
            case 1:
                return "Senin";
            case 2:
                return "Selasa";
            case 3:
                return "Rabu";
            case 4:
                return "Kamis";
            case 5:
                return "Jumat";
            case 6:
                return "Sabtu";
        }
    }

    function getIndonesianMonth(month) {
        switch (month) {
            case 0:
                return "Januari";
            case 1:
                return "Februari";
            case 2:
                return "Maret";
            case 3:
                return "April";
            case 4:
                return "Mei";
            case 5:
                return "Juni";
            case 6:
                return "Juli";
            case 7:
                return "Agustus";
            case 8:
                return "September";
            case 9:
                return "Oktober";
            case 10:
                return "November";
            case 11:
                return "Desember";
        }
    }
    displayCurrentTime();
    displayCurrentDate();
</script>
@endsection