<div id="app">
	<div class="bg__white">
		<div class="page-title">
			<div class="title_left">
		        <h3>DATA REPORT HADITS</h3>
		        <p>CONTENT MANAGEMENT SYSTEM</p>
		    </div>
		</div>
	</div>
    <div class="col-md-12 col-sm-12 col-xs-12">
    	<!-- Include form -->
    	@include('wibs.auth.pages.report.hadis.partials.form')
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
		    		<li class="news__list__wrapper sort-item" v-for="report_hadis in responseData.report_hadis" :data-id="report_hadis.id">
		    			<div class="news__list__detail">
							<div class="news__list__detail__middle-right">
								<div class="news__list__detail__middle">
									<div class="news__list__desc">
										<div class="news__name">
											<a href="#edit-data" class="title__name content__edit__hover" title="Edit Data" @click="editData(report_hadis.id)">
												<b>Nama Lengkap : </b> @{{ report_hadis.nama_siswa }}
											</a>
										</div>
										<div class="news__desc">
											<p class="news__cat">
												<b>Nis : </b> @{{ report_hadis.nis_siswa }} 
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
