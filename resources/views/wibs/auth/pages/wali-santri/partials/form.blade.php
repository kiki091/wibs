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
									<label>TEMPAT LAHIR</label>
									<input v-model="models.tempat_lahir" name="tempat_lahir" type="text" id="tempat_lahir" class="new__form__input__field" placeholder="Isikan tempat kelahiran">

									<div class="form--error--message--left" id="form--error--message--tempat_lahir"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>TANGGAL LAHIR</label>
									<div class="content__input__wrapper__form">
										<div class="input-icon">
											<input v-model="models.tanggal_lahir" name="tanggal_lahir" type="text" class="form-control datepick" placeholder="Isikan tanggal lahir">
											<div class="icon__wrapper__form date-icon">
		                                        <i class="ico-date"></i>
		                                    </div>
										</div>
									</div>

									<div class="form--error--message--left" id="form--error--message--tanggal_lahir"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>AGAMA</label>
									<select name="agama" v-model="models.agama">
										<option value="1">ISLAM</option>
										<option value="2">KRISTEN KATOLIK</option>
										<option value="3">KRISTEN PROTESTAN</option>
										<option value="4">HINDU</option>
										<option value="5">BUDHA</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--agama"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>KEWARGANEGARAAN</label>
									<select name="kewarganegaraan" v-model="models.kewarganegaraan">
										<option value="1">WNI</option>
										<option value="2">WNA</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--kewarganegaraan"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>PENDIDIKAN</label>
									<select name="pendidikan" v-model="models.pendidikan">
										<option value="1">SD</option>
										<option value="2">SMP</option>
										<option value="3">SMA</option>
										<option value="4">D3</option>
										<option value="5">S1</option>
										<option value="6">S2</option>
										<option value="7">S3</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--pendidikan"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>PEKERJAAN</label>
									<select name="pekerjaan" v-model="models.pekerjaan">
										<option value="1">PNS</option>
										<option value="2">SWASTA</option>
										<option value="3">WIRA USAHA</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--pekerjaan"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>PENGHASILAN SEBULAN</label>
									<input name="penghasilan_bulanan" v-model="models.penghasilan_bulanan" type="text" class="new__form__input__field" placeholder="Isikan penghasilan bulanan">

									<div class="form--error--message--left" id="form--error--message--penghasilan_bulanan"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>ALAMAT KANTOR</label>
									<textarea name="alamat_kantor" v-model="models.alamat_kantor" style="width: 500px;"></textarea>

									<div class="form--error--message--left" id="form--error--message--alamat_kantor"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>NOMER TELPON KANTOR</label>
									<input name="telpon_kantor" v-model="models.telpon_kantor" type="text" class="new__form__input__field" placeholder="Isikan telpon kantor">

									<div class="form--error--message--left" id="form--error--message--telpon_kantor"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>ALAMAT RUMAH</label>
									<textarea name="alamat_rumah" v-model="models.alamat_rumah" style="width: 500px;"></textarea>

									<div class="form--error--message--left" id="form--error--message--alamat_rumah"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>NOMER TELPON</label>
									<input name="no_telepon" v-model="models.no_telepon" type="text" class="new__form__input__field" placeholder="Isikan nomer telpon">

									<div class="form--error--message--left" id="form--error--message--no_telepon"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>EMAIL</label>
									<input name="email" v-model="models.email" type="text" class="new__form__input__field" placeholder="Isikan email">

									<div class="form--error--message--left" id="form--error--message--email"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>STATUS</label>
									<select name="status" v-model="models.status">
										<option value="1">HIDUP</option>
										<option value="2">MENINGGAL</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--status"></div>
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