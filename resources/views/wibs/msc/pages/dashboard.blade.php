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
							<img class="img-responsive avatar-view" :src="responseData.foto_url" :title="responseData.nama_lengkap">
						</div>
					</div>
					<h3>@{{ responseData.nama_lengkap }}</h3>
					<ul class="list-unstyled user_data">
						<li>@{{ responseData.tingkatan }}</li>
						<li>Kelas : @{{ responseData.kelas }}</li>
						<li><a class="btn btn-info" href="javascript:void(0);" @click="editData(responseData.siswa_id)">Edit Profile</a>
					</ul>
				</div>
				
				<div class="col-md-6 col-sm-6 col-xs-12">
					<!-- FORM UPDATE DATA -->
					<form action="{{ route('msc_store_data_siswa') }}" method="POST" id="from__siswa" class="form" enctype="multipart/form-data" @submit.prevent>
						<div class="main__content__form__layer" id="toggle-form-content" style="display: none;">
							<div class="create__form__wrapper">
								<div class="form--top flex-between">
									<div class="form__title">EDIT PROFILE</div>
								</div>
								<div class="form--mid">
									<div class="create__form">
										<div class="form__group__row">
											<div class="create__form__row">
												<div class="new__form__field">
													<label>Email</label>
													<input type="text" v-model="models.email" name="email" class="new__form__input__field" >
													<div class="form--error--message--left" id="form--error--message--email"></div>
												</div>
											</div>
											<div class="create__form__row">
												<div class="new__form__field">
													<label>No Telpon</label>
													<input type="text" v-model="models.no_telpon" name="no_telpon" class="new__form__input__field" >
													<div class="form--error--message--left" id="form--error--message--no_telpon"></div>
												</div>
											</div>
											<div class="create__form__row">
												<div class="new__form__field upload__image">
													<label>Foto Image </label>
													<div class="upload__img" v-bind:class="{hide__element: foto}">
														<input name="foto" class="upload__img__input" type="file" id="foto" @change="onImageChange('foto', $event)">
														<label for="foto" class="upload__img__label"></label>
													</div>
													<div class="upload__img" v-bind:class="{hide__element: !foto}">
														<img class="upload__img__preview" :src="foto" />
														<input type="text" v-model="image" hidden="hidden" />
														<button class="upload__img__remove" @click="removeImage('foto')"></button>
													</div>
													<div class="form--error--message--left" id="form--error--message--foto"></div>
													<!-- upload tip -->
													<div class="upload__tip">
														<span><b>Upload Tip: </b>Please upload high resolution photo only with format of *jpeg,png. (With maximum width of {{ FOTO_IMAGES_WIDTH }} x {{ FOTO_IMAGES_HEIGHT }} px and max size {{ IMAGES_SIZE }} on potret)</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form--bot">
									<div class="create__form">
										<div class="create__form__row flex-between">
											<div class="new__form__btn">
												<a href="javascript:void(0);" class="btn btn-default" @click="resetForm">Cancel</a>
											</div>
											<div class="new__form__btn">
												{{ csrf_field() }}
												<input v-model="models.siswa_id" type="hidden" name="id">
												<button class="btn btn-primary" type="submit" @click="storeData">Save</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
					<div class="profile_title hide__form">
						<div class="col-md-6">
							<h2>التعريف  |  Personal Information</h2>
						</div>
					</div>
					<div class="form-horizontal form-label-left hide__form">
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">
								الاسم الكامل | Name
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="" :value="responseData.nama_lengkap" class="form-control col-md-7 col-xs-12" readonly="readonly">
							</div>
						</div>
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">
								العنوان | Address
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="" :value="responseData.nama_panggilan" class="form-control col-md-7 col-xs-12" readonly="readonly">
							</div>
						</div>
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">
								تاريخ الميلاد | Date of birth
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="" :value="responseData.jenis_kelamin" class="form-control col-md-7 col-xs-12" readonly="readonly">
							</div>
						</div>
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">
								اسم الأب | Father
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="" :value="responseData.nama_ayah" class="form-control col-md-7 col-xs-12" readonly="readonly">
							</div>
						</div>
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">
								اسم الأم | Mother
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="" :value="responseData.nama_ibu" class="form-control col-md-7 col-xs-12" readonly="readonly">
							</div>
						</div>
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">
								رقم الهاتف | No. Tlpn
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="" :value="responseData.no_telpon" class="form-control col-md-7 col-xs-12" readonly="readonly">
							</div>
						</div>
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">
								البريد الإلكتروني | Email
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="" :value="responseData.email" class="form-control col-md-7 col-xs-12" readonly="readonly">
							</div>
						</div>
					</div>
					<div class="profile_title hide__form">
						<div class="col-md-6">
							<h2>التعريف | About</h2>
						</div>
					</div>
					<div class="item form-group hide__form">
						<blockquote>@{{ responseData.description }}</blockquote>
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