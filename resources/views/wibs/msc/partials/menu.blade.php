
<header class="main" id="siteheader">
  <a href="#menu" class="menu-link active"><span></span> MENU NAVIGATION</a>
  <nav id="menu" class="menu">
    <ul class="level-1">
      <li>
          <a href="{{ route('msc_dashboard') }}">
            <img src="{{ asset(LOGO_IMAGES_DIRECTORY.'logo.png') }}" class="logo__images img-responsive">
          </a>
      </li>
      <li>
          <a href="{{ route('msc_dashboard') }}">
            <div class="count">التعريف</div>
            <div class="count">Personal Details</div>
          </a>
      </li>
      <li>
          <a href="">
              <div class="count">كشف مراقبة الطلاب ومراعاتهم<br/>Students Monitoring</div>
          </a>
          <span class="has-subnav">&#x25BC;</span>
          <ul class="wide level-2">
              <li>
                  <a href="javascript:void(0)" onclick="menu_report_hadis()">
                      <div class="count">كشف متابعة حفظ القرآن الكريم<br/>Report Hadis</div>
                  </a>
              </li>
              <li>
                  <a href="javascript:void(0)" onclick="menu__report__tahfidz()">
                      <div class="count">كشف متابعة حفظ القرآن الكريم<br/>Report Tahfidz Al-Qur'an</div>
                  </a>
              </li>
              <li>
                  <a href="javascript:void(0)" onclick="menu_report_health()">
                      <div class="count">كشف متابعة حفظ القرآن الكريم<br/>Report Kesehatan</div>
                  </a>
              </li>
          </ul>
      </li>
      
      <li>
          <a href="javascript:void(0)" onclick="menu_default()">
              <div class="count">كشف شؤون الطلاب</div>
              <div class="count">Report Kesantrian</div>
          </a>
      </li>
      <li style="right: 2%">
          <a href="javascript:void(0)" onclick="menu_default()">
              <div class="count">كشف الدرجات</div>
              <div class="count">Report Academic</div>
          </a>
      </li>
    </ul>
  </nav>
</header>