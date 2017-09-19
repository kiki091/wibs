<div class="col-md-3 col-sm-3 col-xs-12">
		<h4>ترتيب الطلاب في الحفظ<br>Penghafal Qur'an Terbaik</h4>
  	<ul class="list-unstyled user_data">
      	<li v-for="data_tahfidz in data_tahfidz">
        		<p>@{{ data_tahfidz.nama_siswa }}</p>
        		<div class="w3-border">
                <div class="w3-red" :style="'height:10px;width:'+data_tahfidz.nilai_hafalan+'%'"></div>
            </div>
      	</li>
 	  </ul>
    <h4>ترتيب الطلاب في الحفظ<br>Penghafal Hadis Terbaik</h4>
    <ul class="list-unstyled user_data">
        <li v-for="data_hadis in data_hadis">
            <p>@{{ data_hadis.nama_siswa }}</p>
            <div class="w3-border">
                <div class="w3-red" :style="'height:10px;width:'+data_hadis.nilai_hafalan+'%'"></div>
            </div>
        </li>
    </ul>
    <!-- end of skills -->
</div>