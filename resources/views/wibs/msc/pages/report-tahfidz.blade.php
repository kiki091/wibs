<div id="app__dashboard">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title msc_table">
				<h2>@{{ form_title }}</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="col-md-2 col-sm-2 col-xs-12 profile_left">
					<div class="profile_img">
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
								<th>متابعة الحفظ<br>Mountly Report</th>
								<th>الحضور والانضباط<br>Discipline</th>
								<th>عدد الحفظ<br>Total Memorization</th>
								<th>درجة الحفظ <br>Score</th>
								<th>درجة التجويد<br>Tazweed</th>
								<th>درجة المخرج<br>Makhraj</th>
							</tr>
							<tr v-for="(report_tahfidz, index) in models.report_tahfidz">
								<th>@{{ index+1 }}</th>
								<th>@{{ report_tahfidz.report_from }}</th>
								<th>@{{ report_tahfidz.disiplin }}</th>
								<th>@{{ report_tahfidz.total_hafalan }} Juz</th>
								<th>@{{ report_tahfidz.nilai_hafalan }}</th>
								<th>@{{ report_tahfidz.nilai_tajwid }}</th>
								<th>@{{ report_tahfidz.nilai_mahraj }}</th>
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