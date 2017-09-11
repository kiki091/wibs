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
							<img class="img-responsive avatar-view" :src="models_siswa.foto_url" :title="models_siswa.nama_lengkap">
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
								<th>درجة التجويد<br>Description</th>
								<th>درجة المخرج<br>Kitab</th>
							</tr>
							<tr v-for="(report_hadis, index) in models.report_hadis">
								<th>@{{ index+1 }}</th>
								<th>@{{ report_hadis.report_from }}</th>
								<th>@{{ report_hadis.kedisiplinan }}</th>
								<th>@{{ report_hadis.kekuatan_hafalan }}</th>
								<th>@{{ report_hadis.nilai_hafalan }}</th>
								<th>@{{ report_hadis.description }}</th>
								<th>@{{ report_hadis.kitab }}</th>
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