<form action="{{ route('cms_store_data_santri') }}" method="POST" id="form__cms__santri" class="form" enctype="multipart/form-data" @submit.prevent>
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
							<div class="create__form__row">
								<div class="new__form__field">
									<label>NIS</label>
									<input v-model="models.nis" name="nis" type="text" id="nis" class="new__form__input__field" placeholder="Isikan nis">

									<div class="form--error--message--left" id="form--error--message--nis"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>NAMA LENGKAP</label>
									<input v-model="models.nama_lengkap" name="nama_lengkap" type="text" id="nama_lengkap" class="new__form__input__field" placeholder="Isikan nama lengkap">

									<div class="form--error--message--left" id="form--error--message--nama_lengkap"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>NAMA PANGGILAN</label>
									<input v-model="models.nama_panggilan" name="nama_panggilan" type="text" id="nama_panggilan" class="new__form__input__field" placeholder="Isikan nama panggilan">

									<div class="form--error--message--left" id="form--error--message--nama_panggilan"></div>
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

							<div class="create__form__row">
								<div class="new__form__field">
									<label>EMAIL</label>
									<input v-model="models.email" name="email" type="text" id="email" class="new__form__input__field" placeholder="Isikan email">

									<div class="form--error--message--left" id="form--error--message--email"></div>
								</div>
							</div>

							<div class="create__form__row" v-if="edit == false">
								<div class="new__form__field">
									<label>PASSWORD</label>
									<input name="password" type="password" id="password" class="new__form__input__field" placeholder="Isikan password">

									<div class="form--error--message--left" id="form--error--message--password"></div>
								</div>
							</div>

							<div class="create__form__row" v-if="edit == false">
								<div class="new__form__field">
									<label>CONFIRM PASSWORD</label>
									<input name="confirm_password" type="password" id="confirm_password" class="new__form__input__field" placeholder="Isikan confirm password">

									<div class="form--error--message--left" id="form--error--message--confirm_password"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field full-width">
									<label>JENIS KELAMIN</label>
									<ul class="to_do">
										<li>
											<div class="radio icheck-primary">
    											<input v-model="models.jenis_kelamin" type="radio" v-bind:value="1" name="jenis_kelamin" id="jenis_kelamin_l" />
											    <label for="jenis_kelamin_l">LAKI-LAKI</label>
											</div>
										</li>
										<li>
											<div class="radio icheck-primary">
    											<input v-model="models.jenis_kelamin" type="radio" v-bind:value="2" name="jenis_kelamin" id="jenis_kelamin_p" />
											    <label for="jenis_kelamin_p">PEREMPUAN</label>
											</div>
										</li>
									</ul>
									<div class="form--error--message--left" id="form--error--message--jenis_kelamin"></div>
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
									<label>JUMLAH SAUDARA KANDUNG</label>
									<input v-model="models.jumlah_saudara_kandung" name="jumlah_saudara_kandung" type="text" id="jumlah_saudara_kandung" class="new__form__input__field" placeholder="Isikan jumlah saudara kandung">

									<div class="form--error--message--left" id="form--error--message--jumlah_saudara_kandung"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>JUMLAH SAUDARA TIRI</label>
									<input v-model="models.jumlah_saudara_tiri" name="jumlah_saudara_tiri" type="text" id="jumlah_saudara_tiri" class="new__form__input__field" placeholder="Isikan jumlah saudara tiri">

									<div class="form--error--message--left" id="form--error--message--jumlah_saudara_tiri"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>ANAK KE</label>
									<input v-model="models.anak_ke" name="anak_ke" type="text" id="anak_ke" class="new__form__input__field" placeholder="Isikan anak ke">

									<div class="form--error--message--left" id="form--error--message--anak_ke"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>STATUS ORANG TUA</label>
									<ul class="to_do">
										<li>
											<div class="radio icheck-primary">
    											<input v-model="models.status_orang_tua" type="radio" v-bind:value="1" name="status_orang_tua" id="status_orang_tua_1" />
											    <label for="status_orang_tua_1">KANDUNG</label>
											</div>
										</li>
										<li>
											<div class="radio icheck-primary">
    											<input v-model="models.status_orang_tua" type="radio" v-bind:value="2" name="status_orang_tua" id="status_orang_tua_2" />
											    <label for="status_orang_tua_2">TIRI</label>
											</div>
										</li>
										<li>
											<div class="radio icheck-primary">
    											<input v-model="models.status_orang_tua" type="radio" v-bind:value="3" name="status_orang_tua" id="status_orang_tua_3" />
											    <label for="status_orang_tua_3">YATIM / YATIM PIATU</label>
											</div>
										</li>
									</ul>

									<div class="form--error--message--left" id="form--error--message--status_orang_tua"></div>
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
									<label>JENIS BAHASA</label>
									<select name="jenis_bahasa" v-model="models.jenis_bahasa">
										<option value="1">BAHASA INDONESIA</option>
										<option value="2">BAHASA ENGLISH</option>
										<option value="3">BAHASA ARAB</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--jenis_bahasa"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>ALAMAT</label>
									<textarea name="alamat" v-model="models.alamat" style="width: 500px"></textarea>

									<div class="form--error--message--left" id="form--error--message--alamat"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>NOMER TELPON</label>
									<input v-model="models.no_telpon" name="no_telpon" type="text" id="no_telpon" class="new__form__input__field" placeholder="Isikan no telpon">

									<div class="form--error--message--left" id="form--error--message--no_telpon"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>STATUS TINGGAL</label>
									<select name="status_tinggal" id="status_tinggal" v-model="models.status_tinggal">
										<option value="1">TINGGAL DENGAN ORANG TUA</option>
										<option value="2">TINGGAL DENGAN SAUDARA</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--status_tinggal"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>ALAMAT ASRAMA KOST (OPTIONAL)</label>
									<textarea name="asrama_kost" v-model="models.asrama_kost" style="width: 500px"></textarea>

									<div class="form--error--message--left" id="form--error--message--asrama_kost"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>JARAK RUMAH (OPTIONAL)</label>
									<input v-model="models.jarak_rumah" name="jarak_rumah" type="text" id="jarak_rumah" class="new__form__input__field" placeholder="Isikan jarak rumah">

									<div class="form--error--message--left" id="form--error--message--jarak_rumah"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>GOLONGAN DARAH (OPTIONAL)</label>
									<input v-model="models.golongan_darah" name="golongan_darah" type="text" id="golongan_darah" class="new__form__input__field" placeholder="Isikan golongan darah">

									<div class="form--error--message--left" id="form--error--message--golongan_darah"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>TINGGI BADAN (OPTIONAL)</label>
									<input v-model="models.tinggi_badan" name="tinggi_badan" type="text" id="tinggi_badan" class="new__form__input__field" placeholder="Isikan tinggi badan">

									<div class="form--error--message--left" id="form--error--message--tinggi_badan"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>BERAT BADAN (OPTIONAL)</label>
									<input v-model="models.berat_badan" name="berat_badan" type="text" id="berat_badan" class="new__form__input__field" placeholder="Isikan berat badan">

									<div class="form--error--message--left" id="form--error--message--berat_badan"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>DERITA PENYAKIT (OPTIONAL)</label>
									<textarea name="derita_penyakit" v-model="models.derita_penyakit" style="width: 500px"></textarea>

									<div class="form--error--message--left" id="form--error--message--derita_penyakit"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>KELAINAN JASMANI (OPTIONAL)</label>
									<textarea name="kelainan_jasmani" v-model="models.kelainan_jasmani" style="width: 500px"></textarea>

									<div class="form--error--message--left" id="form--error--message--kelainan_jasmani"></div>
								</div>
							</div>
						</div>

						<div class="create__form__row">
							<span class="form__group__title">Detail Information<a href="javascript:void(0);" class="style__accordion" data-accordion="form-accordion-2"><i>@include('wibs.auth.svg-logo.ico-expand-arrow')</i></a></span>
						</div>
						<div id="form-accordion-2">
							

							<div class="create__form__row">
								<div class="new__form__field">
									<label>PENDIDIKAN SEBELUMNYA</label>

									<select name="pendidikan_sebelumnya" v-model="models.pendidikan_sebelumnya">
										<option value="smp">SEKOLAH MENENGAH PERTAMA</option>
										<option value="smu">SEKOLAH MENENGAH UMUM</option>
										<option value="smk">SEKOLAH MENENGAH KEJURUAN</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--pendidikan_sebelumnya"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>LULUSAN DARI</label>
									<input v-model="models.lulusan_dari" name="lulusan_dari" type="text" id="lulusan_dari" class="new__form__input__field" placeholder="Isikan lulusan dari">

									<div class="form--error--message--left" id="form--error--message--lulusan_dari"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>ALAMAT SEKOLAH ASAL</label>
									<textarea name="alamat_sekolah" v-model="models.alamat_sekolah" style="width: 500px"></textarea>


									<div class="form--error--message--left" id="form--error--message--alamat_sekolah"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>NOMOR STTB</label>
									<input v-model="models.tanggal_nomer_sttb" name="tanggal_nomer_sttb" type="text" id="tanggal_nomer_sttb" class="new__form__input__field" placeholder="Isikan tanggal nomer sttb">

									<div class="form--error--message--left" id="form--error--message--tanggal_nomer_sttb"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>LAMA BELAJAR</label>

									<select name="lama_belajar" v-model="models.lama_belajar">
										<option value="1">1 TAHUN</option>
										<option value="2">2 TAHUN</option>
										<option value="3">3 TAHUN</option>
										<option value="4">4 TAHUN</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--lama_belajar"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>TINGKATAN</label>
									<select name="tingkatan_id" v-model="models.tingkatan_id">
										<option value="1">SMP</option>
										<option value="2">SMA</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--tingkatan_id"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>KELAS</label>
									<select name="kelas_id" v-model="models.kelas_id">
										<option value="1">VII</option>
										<option value="2">VIII</option>
										<option value="3">IX</option>
										<option value="4">X</option>
										<option value="5">XI</option>
										<option value="6">XII</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--kelas_id"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>STATUS SISWA</label>
									<select name="status_siswa" v-model="models.status_siswa">
										<option value="1">Siswa Baru</option>
										<option value="2">Siswa Pindahan</option>
									</select>

									<div class="form--error--message--left" id="form--error--message--status_siswa"></div>
								</div>
							</div>

							<div class="create__form__row" v-if="models.status_siswa == 2 && edit == false">
								<div class="new__form__field">
									<label>ASAL SEKOLAH</label>
									<input v-model="models.asal_sekolah" name="asal_sekolah" type="text" id="asal_sekolah" class="new__form__input__field" placeholder="Isikan asal sekolah">
									<div class="form--error--message--left" id="form--error--message--asal_sekolah"></div>
								</div>
							</div>

							<div class="create__form__row" v-if="models.status_siswa == 2 && edit == false">
								<div class="new__form__field">
									<label>ALAMAT SEKOLAH</label>
									<textarea name="alamat_sekolah_lama" v-model="models.alamat_sekolah_lama" style="width: 500px"></textarea>


									<div class="form--error--message--left" id="form--error--message--alamat_sekolah_lama"></div>
								</div>
							</div>

							<div class="create__form__row" v-if="models.status_siswa == 2 && edit == false">
								<div class="new__form__field">
									<label>ALASAN PINDAH</label>
									<input v-model="models.alasan_pindah" name="alasan_pindah" type="text" id="alasan_pindah" class="new__form__input__field" placeholder="Isikan alasan pindah">
									<div class="form--error--message--left" id="form--error--message--alasan_pindah"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>KETERANGAN</label>
									<textarea name="description" v-model="models.description" style="width: 500px"></textarea>
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
							<input v-model="models.id" type="hidden" name="id" value="@{{ models.id }}" v-if="edit == true">
							<button class="btn__form" type="submit" @click="storeData">Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>