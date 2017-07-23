<div class="row bg__gray">
	<div class="tile_count">
		<div class="col-md-2 col-sm-4 col-xs-6">
          	<img src="{{ asset(LOGO_IMAGES_DIRECTORY.'logo.png') }}" class="img-responsive">
        </div>
		<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          	<span class="count_top"></span>
            <a href="{{ route('msc_dashboard') }}">
              	<div class="count">Personal</div>
              	<div class="count">Details</div>
              	<span class="count_bottom"><i class="green"></i> Biodata</span>
            </a>
        </div>
		<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          	<span class="count_top"></span>
            <a href="javascript:void(0)" onclick="menu_student_monitoring()">
              	<div class="count">Students</div>
              	<div class="count">Monitoring</div>
              	<span class="count_bottom"><i class="green"></i> Monitor Santri</span>
            </a>
        </div>
		<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          	<span class="count_top"></span>
            <a href="javascript:void(0)" onclick="menu__report__tahfidz()">
              	<div class="count">Raport</div>
              	<div class="count">Tahfidz</div>
              	<span class="count_bottom"><i class="green"></i> Raport Hafalan</span>
            </a>
        </div>
		<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          	<span class="count_top"></span>
            <a href="javascript:void(0)" onclick="menu__report__kesantrian()">
              	<div class="count">Raport</div>
              	<div class="count">Kesantrian</div>
              	<span class="count_bottom"><i class="green"></i> Raport Kesantrian</span>
            </a>
        </div>
		<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          	<span class="count_top"></span>
            <a href="javascript:void(0)" onclick="menu__report__akademik()">
              	<div class="count">Raport</div>
              	<div class="count">Academic</div>
              	<span class="count_bottom"><i class="green"></i> Raport Akademik</span>
            </a>
        </div>
    </div>
</div>