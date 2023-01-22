<!--Important link source from https://bootsnipp.com/snippets/ooa9M-->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

<style>
@import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;1,600&display=swap');
li{
  list-style: none;
}
a{
  text-decoration: none;
}
:root{
  --primary-color:#fff;
  --secondary-color:#000;
}
.dark_mode{
  background-color:#000;
  
  /* --secondary-color:#fff; */
}
footer{

  width: 100%;
  bottom: 0;
  left: 0;
  background-color: var(--primary-color);
  box-shadow: 0 16px 0px -8px rgba(0, 0 ,0, 0.25);
  border-radius: 20px 20px 0 0;
  transition: background 0.3s linear;
}
.container{
  max-width: 1240px;
  padding: 30px 40px;
  margin: auto;
}
.content_footer{
  display: flex;
  /* justify-content: space-between; */
  align-items: center;
  margin-bottom: 1rem;
}
.profil .logo_area{
  display: flex;
  align-items: center;
  margin-bottom: 1rem;
}
.profil .logo_area img{
  border-radius: 50%;
  border: 1px solid var(--primary-color);
}

.logo_area .logo_name{
  font-size: 1.5rem;
  font-weight: 700;
  margin: 0 1rem;
  color: var(--secondary-color);
}
.desc_area{
  max-width: 320px;
  margin-bottom: 1.25rem;
}
.desc_area p{
  color: #828282;
  font-weight: 400;
  line-height: 28px;
}
.social_media a{
  color: #828282;
  margin-right: 22px;
  font-size: 24px;
}
.social_media a:hover{
 color: #313131;
}
.service_header{
  margin-right: -100px;
}
li.service_name{
  color: var(--secondary-color);
  font-weight: 600;
}
.service_header li a{
  color: #828282;
  padding-bottom: 1px;
  font-weight: 400;
}
.service_header li a:hover{
  color: #313131;
}
.service_header li{
  margin-bottom: 10px;
}
hr{
  height: 1px;
  border: none;
  background-color: #828282;
  margin-bottom: 1rem;
}
.footer_bottom{
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 0.875rem;
}
.copy_right{
  color: #828282;
  display: flex;
  align-items: center ;
}
.copy_right span{
  margin-left: 8px;
  font-weight: 400;
  letter-spacing: 0.135rem;
}
.tou a{
  color: #828282;
  margin-left: 1.5rem;
}
.tou a :hover{
  color: #818181;
}
@media screen and (max-width:768px) {
  .content_footer{
    flex-wrap: wrap;
    justify-content: left;
  }
  .service_area{
    flex-wrap: wrap;
    justify-content: left;
  }
  .service_header{
    margin-left: 0;
    margin-right: 40px;
  }
  .social_media{
    margin-bottom: 1rem;
  }
  .footer_bottom{
    flex-wrap: wrap;
    justify-content: center;
  }
}
@media screen and (max-width: 510px) {
  .service_header{
    margin-bottom: 8px;
  }
  .copy_right{
    margin-bottom: 8px;
  }
  
}

.service_area{
  display: flex;
  justify-content: space-around;
  width: 100% ;
}

</style>
<body>
<footer class="footer">
  <div class="container">
    <div class="content_footer">
      <div class="profil">
        <div class="logo_area">
          <img style="width: 45px;" src="/website_TMDT/assets/uploads/icon/logo.png" alt="">
          <span class="logo_name">2TL-GROUP</span>
          <button id="dark-more" class="moon"><i class='bx bxs-moon' ></i></button>
          <button id="light-more" class="sun"><i class='bx bxs-sun' ></i></button>
        </div>
        <div class="desc_area">
          <p>Công Ty Cổ Phần Công Nghệ Và Sản Xuất Quang Nguyễn

Trụ sở: Tầng 3, số 1 ngõ 120 Trần chiên, Phường An Bình, Quận Cái Răng, Thành Phố Cần Thơ, Việt Nam

GPĐKKD Số: 0898.546.429 Do Sở DQ VÀ TN TP.CT cấp ngày: 09.09.2022

© Duy Quang-Thế Nguyễn</p>
        </div>
        <div class="social_media">
          <a href="#"><i class='bx bxl-linkedin-square'></i></a>
          <a href="#"><i class='bx bxl-facebook-square' ></i></a>
          <a href="#"><i class='bx bxl-instagram-alt' ></i></a>
          <a href="#"><i class='bx bxl-github' ></i></a>      

        </div>
      </div>
      <div class="service_area">
        <ul class="service_header">
          <li class="service_name">Thông tin công ty</li>
          <li><a href="">Giới thiệu công ty</a></li>
          <li><a href="">Thông tin liên hệ</a></li>
          <li><a href="">Thông tin tuyển dụng</a></li>
          <li><a href="">Điều khoản giao dịch</a></li>
          <li><a href="">Chính sách bảo mật thông tin khách hàng</a></li>
        </ul>
        <ul class="service_header">
          <li class="service_name">Quy định & chính sách</li>
          <li><a href="">Chính sách kinh doanh</a></li>
          <li><a href="">Ưu đãi cho khách hàng doanh nghiệp</a></li>
          <li><a href="">Ưu đãi cho khách hàng Game-Net</a></li>
          <li><a href="">Chính sách vận chuyển và giao nhận</a></li>
          <li><a href="">Chính sách bảo hành</a></li>
          <li><a href="">Chính sách đổi trả sản phẩm</a></li>
        </ul> 
        <ul class="service_header">
          <li class="service_name">Hỗ trợ khách hàng</li>
          <li><a href="">Hướng dẫn mua hàng online</a></li>
          <li><a href="">Hướng dẫn mua hàng trả góp</a></li>
          <li><a href="">Phương thức thanh toán</a></li>
          <li><a href="">Yêu cầu báo giá  </a></li>
          <li><a href="">Liên hệ kỹ thuật  </a></li>
          <li><a href="">Gửi góp ý, khiếu nại  </a></li>
        </ul>
 
      </div>
    </div>
    <hr>
    <div class="footer_bottom">
      <div class="copy_right">
        <i class='bx bxs-copyright'></i>
        <span>2022 2TL-GROUP</span>
      </div>
      <div class="tou">
        <a href="#">Chúng tôi sẽ luôn đông hành cùng bạn</a>
        <a href="#"></a>
        <a href="#"></a>
      </div>
    </div>
  </div>
</footer>
<script>
  

    const darkMode = document.querySelector('#dark-more')
   
    const lightMode = document.getElementById('light-more')
   
    darkMode.addEventListener('click',() => {
      const footer = document.querySelector('.footer')
      footer.classList.toggle('dark_mode')
    })
    lightMode.addEventListener('click',() => {
      const footer = document.querySelector('.footer')
      footer.classList.toggle('dark_mode')
    })
  </script>
</body>


   
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/jquery/jscript_one.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
