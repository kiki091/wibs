<div class="row bg__gray">
	<div class="tile_count">
		<div class="col-md-2 col-sm-4 col-xs-6">
          	<img src="{{ asset(LOGO_IMAGES_DIRECTORY.'logo.png') }}" class="img-responsive">
        </div>
		<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          	<span class="count_top"></span>
            <a href="{{ route('msc_dashboard') }}">
              	<div class="count">التعريف</div>
              	<div class="count">Personal Details</div>
            </a>
        </div>
		<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          	<span class="count_top"></span>
            <a href="javascript:void(0)" onclick="menu_student_monitoring()">
              	<div class="count">كشف مراقبة الطلاب ومراعاتهم</div>
              	<div class="count">Students Monitoring</div>
            </a>
        </div>
		<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          	<span class="count_top"></span>
            <a href="javascript:void(0)" onclick="menu__report__tahfidz()">
              	<div class="count">كشف متابعة حفظ القرآن الكريم</div>
              	<div class="count">Report Tahfidz Al-Qur'an</div>
            </a>
        </div>
		<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          	<span class="count_top"></span>
            <a href="javascript:void(0)" onclick="menu__report__kesantrian()">
              	<div class="count">كشف شؤون الطلاب</div>
              	<div class="count">Report Kesantrian</div>
            </a>
        </div>
		<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          	<span class="count_top"></span>
            <a href="javascript:void(0)" onclick="menu__report__akademik()">
              	<div class="count">كشف الدرجات</div>
              	<div class="count">Report Academic</div>
            </a>
        </div>
    </div>
</div>