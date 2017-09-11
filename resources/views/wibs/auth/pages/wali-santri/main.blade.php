<div id="app">
	<div class="bg__white">
		<div class="page-title">
			<div class="title_left">
		        <h3>DATA WALI SANTRI </h3>
		        <p>ACCOUNT MANAGEMENT SYSTEM</p>
		    </div>
		</div>
	</div>
    <div class="col-md-12 col-sm-12 col-xs-12">
    	<!-- Include form -->
    	@include('wibs.auth.pages.wali-santri.partials.form')
    	<!-- / End include form -->
		<div class="main__content__layer">
			<div class="content__top flex-between">
				<div class="content__title">
					<h2>@{{ form_add_title }}</h2>
				</div>
				<div class="content__btn">
					<a href="#" class="btn__add" id="toggle-form">Add Data</a>
		       	</div>
		    </div>
		    
		    <div class="content__bottom">
		    	<ul class="news__list sortable" id="sort" v-sort>
		    		<li class="news__list__wrapper sort-item" v-for="wali_santri in responseData.wali_santri" :data-id="wali_santri.id">
		    			<div class="news__list__detail">
							<div class="news__list__detail__middle-right">
								<div class="news__list__detail__middle">
									<div class="news__list__desc">
										<div class="news__name">
											<a href="javascript:void(0);" class="title__name content__edit__hover" title="Edit Data">
												<b> Nis :</b><i> @{{ wali_santri.nis_siswa }}</i>, <b>Nama Santri : </b><i>@{{ wali_santri.nama_siswa }}</i>
											</a>
										</div>
										<div class="news__desc">
											<p class="news__cat">
												<b> Nama Ayah : </b>@{{ wali_santri.nama_lengkap_ayah }},
												<b> Nama Ibu : </b>@{{ wali_santri.nama_lengkap_ibu }}
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>

    </div>
</div>
