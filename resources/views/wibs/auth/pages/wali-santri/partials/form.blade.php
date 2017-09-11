<form action="{{ route('cms_store_data_wali_santri') }}" method="POST" id="form__cms__wali__santri" class="form" enctype="multipart/form-data" @submit.prevent>
	<div class="main__content__form__layer" id="toggle-form-content" style="display: none;">
		<div class="create__form__wrapper">
			<div class="form--top flex-between">
				<div class="form__title">@{{ form_add_title }}</div>
				<div class="form--top__btn">
					<a href="#" class="btn__add__cancel" @click="resetForm">Cancel</a>
				</div>
			</div>
			<div class="form--mid">

				<!-- LANGUAGE ENGLISH -->
				<div class="create__form">
					<div class="form__group__row">
						<div class="create__form__row">
							<span class="form__group__title">GENERAL INFORMATION<a href="javascript:void(0);" class="style__accordion" data-accordion="form-accordion-1"><i>@include('wibs.auth.svg-logo.ico-expand-arrow')</i></a></span>
						</div>
						<div id="form-accordion-1">
							<div class="create__form__row" v-if="edit == false">
								<div class="new__form__field">
									<label>NIS SISWA</label>
									<input name="nis" type="text" class="new__form__input__field" placeholder="Isikan nis" id="form-search-data" v-on:keyup="getDataSiswa">

									<div class="form--error--message--left" id="form--error--message--nis"></div>
								</div>
							</div>
							<div class="create__form__row" v-if="edit == false">
								<div class="new__form__field">
									<label>NAMA SISWA</label>
									<input name="nis" type="text" class="new__form__input__field" placeholder="Isikan nis" id="form-search-data" :value="responseDataSantri.nama_lengkap" readonly="readonly">

									<div class="form--error--message--left" id="form--error--message--nis"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>NAMA LENGKAP AYAH</label>
									<input name="nama_lengkap_ayah" v-model="models.nama_lengkap_ayah" type="text" class="new__form__input__field" placeholder="Isikan nama lengkap ayah">

									<div class="form--error--message--left" id="form--error--message--nama_lengkap_ayah"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>NAMA LENGKAP IBU</label>
									<input name="nama_lengkap_ibu" v-model="models.nama_lengkap_ibu" type="text" class="new__form__input__field" placeholder="Isikan nama lengkap ibu">

									<div class="form--error--message--left" id="form--error--message--nama_lengkap_ibu"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>TEMPAT LAHIR AYAH</label>
									<input v-model="models.tempat_lahir_ayah" name="tempat_lahir_ayah" type="text" id="tempat_lahir_ayah" class="new__form__input__field" placeholder="Isikan tempat kelahiran ayah">

									<div class="form--error--message--left" id="form--error--message--tempat_lahir_ayah"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>TEMPAT LAHIR IBU</label>
									<input v-model="models.tempat_lahir_ibu" name="tempat_lahir_ibu" type="text" id="tempat_lahir_ibu" class="new__form__input__field" placeholder="Isikan tempat kelahiran ibu">

									<div class="form--error--message--left" id="form--error--message--tempat_lahir_ibu"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>TANGGAL LAHIR AYAH</label>
									<div class="content__input__wrapper__form">
										<div class="input-icon">
											<input v-model="models.tanggal_lahir_ayah" name="tanggal_lahir_ayah" type="text" class="form-control datepick" placeholder="Isikan tanggal lahir ayah">
											<div class="icon__wrapper__form date-icon">
		                                        <i class="ico-date"></i>
		                                    </div>
										</div>
									</div>

									<div class="form--error--message--left" id="form--error--message--tanggal_lahir_ayah"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>TANGGAL LAHIR IBU</label>
									<div class="content__input__wrapper__form">
										<div class="input-icon">
											<input v-model="models.tanggal_lahir_ibu" name="tanggal_lahir_ibu" type="text" class="form-control datepick" placeholder="Isikan tanggal lahir ibu">
											<div class="icon__wrapper__form date-icon">
		                                        <i class="ico-date"></i>
		                                    </div>
										</div>
									</div>

									<div class="form--error--message--left" id="form--error--message--tanggal_lahir_ibu"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>KEWARGANEGARAAN AYAH</label>
									<select name="kewarganegaraan_ayah" v-model="models.kewarganegaraan_ayah">
										<option value="1">WNI</option>
										<option value="2">WNA</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--kewarganegaraan_ayah"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>KEWARGANEGARAAN IBU</label>
									<select name="kewarganegaraan_ibu" v-model="models.kewarganegaraan_ibu">
										<option value="1">WNI</option>
										<option value="2">WNA</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--kewarganegaraan_ibu"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>PENDIDIKAN AYAH</label>
									<select name="pendidikan_ayah" v-model="models.pendidikan_ayah">
										<option value="1">SD</option>
										<option value="2">SMP</option>
										<option value="3">SMA</option>
										<option value="4">D3</option>
										<option value="5">S1</option>
										<option value="6">S2</option>
										<option value="7">S3</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--pendidikan_ayah"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>PENDIDIKAN IBU</label>
									<select name="pendidikan_ibu" v-model="models.pendidikan_ibu">
										<option value="1">SD</option>
										<option value="2">SMP</option>
										<option value="3">SMA</option>
										<option value="4">D3</option>
										<option value="5">S1</option>
										<option value="6">S2</option>
										<option value="7">S3</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--pendidikan_ibu"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>PEKERJAAN AYAH</label>
									<select name="pekerjaan_ayah" v-model="models.pekerjaan_ayah">
										<option value="1">PNS</option>
										<option value="2">SWASTA</option>
										<option value="3">WIRA USAHA</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--pekerjaan_ayah"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>PEKERJAAN IBU</label>
									<select name="pekerjaan_ibu" v-model="models.pekerjaan_ibu">
										<option value="1">PNS</option>
										<option value="2">SWASTA</option>
										<option value="3">WIRA USAHA</option>
										<option value="4">IBU RUMAH TANGGA</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--pekerjaan_ibu"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>PENGHASILAN SEBULAN AYAH</label>
									<input name="penghasilan_bulanan_ayah" v-model="models.penghasilan_bulanan_ayah" type="text" class="new__form__input__field" placeholder="Isikan penghasilan bulanan">

									<div class="form--error--message--left" id="form--error--message--penghasilan_bulanan_ayah"></div>
								</div>
							</div>

							<div class="create__form__row" v-if="models.pekerjaan_ibu != '4'">
								<div class="new__form__field">
									<label>PENGHASILAN SEBULAN IBU</label>
									<input name="penghasilan_bulanan_ibu" v-model="models.penghasilan_bulanan_ibu" type="text" class="new__form__input__field" placeholder="Isikan penghasilan bulanan">

									<div class="form--error--message--left" id="form--error--message--penghasilan_bulanan_ibu"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>EMAIL AYAH</label>
									<input name="email_ayah" v-model="models.email_ayah" type="text" class="new__form__input__field" placeholder="Isikan email ayah">

									<div class="form--error--message--left" id="form--error--message--email_ayah"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>EMAIL IBU</label>
									<input name="email_ibu" v-model="models.email_ibu" type="text" class="new__form__input__field" placeholder="Isikan email ibu">

									<div class="form--error--message--left" id="form--error--message--email_ibu"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>STATUS AYAH</label>
									<select name="status_ayah" v-model="models.status_ayah">
										<option value="1">HIDUP</option>
										<option value="2">MENINGGAL</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--status_ayah"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>STATUS IBU</label>
									<select name="status_ibu" v-model="models.status_ibu">
										<option value="1">HIDUP</option>
										<option value="2">MENINGGAL</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--status_ibu"></div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>

			<div class="form--bot">
				<div class="create__form">
					<div class="create__form__row flex-between">
						<div class="new__form__btn"></div>
						<div class="new__form__btn">
							{{ csrf_field() }}
							<input type="hidden" name="siswa_id" :value="responseDataSantri.id" v-if="edit == false">
							<input v-model="models.id" type="hidden" name="id" value="@{{ models.id }}" v-if="edit == true">
							<button class="btn__form" type="submit" @click="storeData">Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>