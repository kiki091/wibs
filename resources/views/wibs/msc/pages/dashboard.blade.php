@extends('wibs.msc.layouts.main')
@section('content')
<div id="app__dashboard">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>@{{form_title}}</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
					<div class="profile_img">
						<div id="crop-avatar">
							<img class="img-responsive avatar-view" :src="models.avatar_url" :title="models.nama_lengkap">
						</div>
					</div>
					<h3>@{{ models.nama_lengkap }}</h3>
					<ul class="list-unstyled user_data">
						<li>@{{ models.tingkatan }}</li>
						<li>Kelas : @{{ models.kelas }}</li>
					</ul>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="profile_title">
						<div class="col-md-6">
							<h2>التعريف  |  Personal Information</h2>
						</div>
					</div>
					<div class="form-horizontal form-label-left">
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">
								الاسم الكامل | Name
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="" :value="models.nama_lengkap" class="form-control col-md-7 col-xs-12" readonly="readonly">
							</div>
						</div>
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">
								العنوان | Address
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="" :value="models.nama_panggilan" class="form-control col-md-7 col-xs-12" readonly="readonly">
							</div>
						</div>
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">
								تاريخ الميلاد | Date of birth
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="" :value="models.jenis_kelamin" class="form-control col-md-7 col-xs-12" readonly="readonly">
							</div>
						</div>
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">
								اسم الأب | Father
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="" :value="models.email" class="form-control col-md-7 col-xs-12" readonly="readonly">
							</div>
						</div>
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">
								اسم الأم | Mother
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="" :value="models.agama" class="form-control col-md-7 col-xs-12" readonly="readonly">
							</div>
						</div>
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">
								رقم الهاتف | No. Tlpn
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="" :value="models.email" class="form-control col-md-7 col-xs-12" readonly="readonly">
							</div>
						</div>
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">
								البريد الإلكتروني | Email
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="" :value="models.email" class="form-control col-md-7 col-xs-12" readonly="readonly">
							</div>
					<div class="profile_title">
						<div class="col-md-6">
							<h2>التعريف | About</h2>
						</div>
					</div>
					<div class="item form-group">
						<blockquote>@{{ models.description }}</blockquote>
					</div>
				</div>
				<!-- Statistic Rangking -->
				@include('wibs.msc.partials.statistic-bar')
				<!-- End Statistic Rangking -->
			</div>
		</div>
	</div>
</div>
@endsection