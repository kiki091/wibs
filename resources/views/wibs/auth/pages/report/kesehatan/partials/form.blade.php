<form action="{{ route('cms_report_kesehatan_store_data') }}" method="POST" id="form__cms__report_kesehatan" class="form" enctype="multipart/form-data" @submit.prevent>
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
									<label>BERAT BADAN (KG)</label>
									<input name="berat_badan" v-model="models.berat_badan" type="text" class="new__form__input__field" placeholder="Isikan nilai berat badan santri">

									<div class="form--error--message--left" id="form--error--message--berat_badan"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>TINGGI BADAN (CM)</label>
									<input name="tinggi_badan" v-model="models.tinggi_badan" type="text" class="new__form__input__field" placeholder="Isikan nilai tinggi badan santri">

									<div class="form--error--message--left" id="form--error--message--tinggi_badan"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>TENSI DARAH</label>
									<input v-model="models.tensi_darah" name="tensi_darah" type="text" id="tensi_darah" class="new__form__input__field" placeholder="Isikan tensi darah santri">

									<div class="form--error--message--left" id="form--error--message--tensi_darah"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>GOLONGAN DARAH</label>
									<input v-model="models.golongan_darah" name="golongan_darah" type="text" id="golongan_darah" class="new__form__input__field" placeholder="Isikan golongan darah santri">

									<div class="form--error--message--left" id="form--error--message--golongan_darah"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>RIWAYAT SAKIT</label>
									<input v-model="models.riwayat_sakit" name="riwayat_sakit" type="text" id="riwayat_sakit" class="new__form__input__field" placeholder="Isikan riwayat sakit santri">

									<div class="form--error--message--left" id="form--error--message--riwayat_sakit"></div>
								</div>
							</div>


							<div class="create__form__row">
								<div class="new__form__field">
									<label>KEADAAN SISWA</label>
									<select name="keadaan_siswa" v-model="models.keadaan_siswa">
										<option value="Sehat Jasmani">Sehat Jasmani</option>
										<option value="Kurang begitu sehat">Kurang begitu sehat</option>
										<option value="Sedang dalam perawatan">Sedang dalam perawatan</option>
										<option value="Lainnya">Lainnya</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--keadaan_siswa"></div>
								</div>
							</div>

							<div class="create__form__row" v-if="models.keadaan_siswa == 'Lainnya'">
								<div class="new__form__field">
									<label>KETERANGAN</label>
									<input v-model="models.keadaan_siswa_other" name="keadaan_siswa_other" type="text" id="keadaan_siswa_other" class="new__form__input__field" placeholder="Isikan riwayat sakit santri">

									<div class="form--error--message--left" id="form--error--message--keadaan_siswa_other"></div>
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