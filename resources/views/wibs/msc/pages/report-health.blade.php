<div id="app__dashboard">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title msc_table">
				<h2>@{{ form_title }}</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="col-md-2 col-sm-2 col-xs-12 profile_left">
					<div id="profile_img" class="profile_img">
						<div id="crop-avatar">
							<img class="img-responsive avatar-view" :src="models_siswa.foto_url" :title="models_siswa.nama_lengkap">
						</div>
					</div>
					<h3 class="title_name">@{{ models_siswa.nama_lengkap }}</h3>
					<ul class="list-unstyled user_data">
						<li>@{{ models_siswa.tingkatan }}</li>
						<li>Kelas : @{{ models_siswa.kelas }}</li>
					</ul>
				</div>
				<div class="col-md-7 col-sm-7 col-xs-12 profile_left">
					<div class="profile_title">
						<div class="col-md-6">
							<h2>@{{ form_sub_title }}</h2>
						</div>
					</div>
					<table align="center" cellspacing="0" cellpadding="0" class="table__style">
						<tbody>
							<tr>
								<th>#</th>
								<th>بيان الصحة<br>Mountly Report</th>
								<th>طول الجسم<br>Hight</th>
								<th>الوزن<br>Weight</th>
								<th>ضغط الدم<br>Tension Blood</th>
								<th>نوع الدم<br>Blood Type</th>
								<th>خلفية المرض<br>Medical Record</th>
							</tr>
							<tr v-for="(report_health, index) in models.report_health">
								<th>@{{ index+1 }}</th>
								<th>@{{ report_health.report_from }}</th>
								<th>@{{ report_health.berat_badan }} Kg</th>
								<th>@{{ report_health.tinggi_badan }} Cm</th>
								<th>@{{ report_health.tensi_darah }}</th>
								<th>@{{ report_health.golongan_darah }}</th>
								<th>@{{ report_health.riwayat_sakit }}</th>
						</tbody>
					</table>
				</div>
				<!-- Statistic Rangking -->
				@include('wibs.msc.partials.statistic-bar')
				<!-- End Statistic Rangking -->
			</div>
		</div>
	</div>
</div>