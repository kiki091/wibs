<div id="app">
	<div class="bg__white">
		<div class="page-title">
			<div class="title_left">
		        <h3>DATA SANTRI </h3>
		        <p>ACCOUNT MANAGEMENT SYSTEM</p>
		    </div>
		</div>
	</div>
    <div class="col-md-12 col-sm-12 col-xs-12">
    	<!-- Include form -->
    	@include('wibs.auth.pages.santri.partials.form')
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
		    		<li class="news__list__wrapper sort-item" v-for="santri in responseData.santri" :data-id="santri.id">
		    			<div class="news__list__detail">
		    				<div class="drag__control">
								<div class="handle">
									@include('wibs.auth.svg-logo.ico-handle-drag')
								</div>
							</div>
							<div class="news__list__detail__left">
								<img :src=santri.foto_url>
							</div>
							<div class="news__list__detail__middle-right">
								<div class="news__list__detail__middle">
									<div class="news__list__desc">
										<div class="news__name">
											<a href="#edit-data" class="title__name content__edit__hover" title="Edit Data" @click="editData(santri.id)">
												@{{ santri.nama_lengkap }}
											</a>
										</div>
									</div>
								</div>
								<div class="news__list__detail__right">
									<label class="switch">
										<input class="switch-input" id="check_1" type="checkbox" :checked="santri.is_active == true" @change="changeStatus(santri.id)"/>
                                    	<span class="switch-label" data-on="Active" data-off="Inactive"></span> <span class="switch-handle"></span>
									</label>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>

    </div>
</div>
