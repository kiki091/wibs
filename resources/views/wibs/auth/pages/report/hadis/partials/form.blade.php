<form action="{{ route('cms_report_hadis_store_data') }}" method="POST" id="form__cms__report_hadis" class="form" enctype="multipart/form-data" @submit.prevent>
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
									<label>KEDISIPLINAN</label>
									<input name="kedisiplinan" v-model="models.kedisiplinan" type="text" class="new__form__input__field" placeholder="Isikan NILAI kedisiplinan santri">

									<div class="form--error--message--left" id="form--error--message--kedisiplinan"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>TOTAL HAFALAN</label>
									<input name="total_hafalan" v-model="models.total_hafalan" type="text" class="new__form__input__field" placeholder="Isikan nilai total hafalan santri">

									<div class="form--error--message--left" id="form--error--message--total_hafalan"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>KEKUATAN HAFALAN</label>
									<input v-model="models.kekuatan_hafalan" name="kekuatan_hafalan" type="text" id="kekuatan_hafalan" class="new__form__input__field" placeholder="Isikan kekuatan hafalan santri">

									<div class="form--error--message--left" id="form--error--message--kekuatan_hafalan"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>NILAI HAFALAN</label>
									<input v-model="models.nilai_hafalan" name="nilai_hafalan" type="text" id="nilai_hafalan" class="new__form__input__field" placeholder="Isikan nilai hafalan santri">

									<div class="form--error--message--left" id="form--error--message--nilai_hafalan"></div>
								</div>
							</div>


							<div class="create__form__row">
								<div class="new__form__field">
									<label>KITAB</label>
									<select name="kitab_id" v-model="models.kitab_id">
										<option value="list_kitab.id" v-for="list_kitab in responseDataKitab">@{{ list_kitab.title }}</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--kitab_id"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>KETERANGAN</label>
									<textarea name="description" v-model="models.description" style="width:500px;" id="description"></textarea>

									<div class="form--error--message--left" id="form--error--message--description"></div>
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