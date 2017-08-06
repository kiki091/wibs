<div id="app__dashboard">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title msc_table">
				<h2>@{{ form_title }}</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
					<div class="profile_img">
						<div id="crop-avatar">
							<img class="img-responsive avatar-view" :src="models_siswa.avatar_url" :title="models_siswa.nama_lengkap">
						</div>
					</div>
					<h3>@{{ models_siswa.nama_lengkap }}</h3>
					<ul class="list-unstyled user_data">
						<li>@{{ models_siswa.tingkatan }}</li>
						<li>Kelas : @{{ models_siswa.kelas }}</li>
					</ul>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 profile_left">
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
							<tr v-for="(report_quran, index) in models.quran_recitation">
								<th>@{{ index+1 }}</th>
								<th>@{{ report_quran.report_from }}</th>
								<th>@{{ report_quran.disiplin }}</th>
								<th>@{{ report_quran.total_hafalan }} Juz</th>
								<th>@{{ report_quran.nilai_hafalan }}</th>
								<th>@{{ report_quran.nilai_tajwid }}</th>
								<th>@{{ report_quran.nilai_mahraj }}</th>
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