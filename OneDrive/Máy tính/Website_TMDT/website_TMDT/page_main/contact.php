<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <title>Liên Hệ</title>
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;1,600&display=swap');
  *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
  }
  .contact{
    position: relative;
    min-height: 100vh;
    padding: 50px 100px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    background: url(https://img3.thuthuatphanmem.vn/uploads/2019/09/11/background-tet-trung-thu-dep-va-don-gian_105459369.jpg);
    background-size: cover;
  }
  .contact .content{
    max-height: 800px;
    text-align: center;
  }
  .contact .content .h2{
    font-size: 36px;
    font-weight: 500;
    color: #fff;
  }
  .contact .content .p{
    
    font-weight: 300;
    color: #fff;
  }
  .container{
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 30px;
  }
  .container .contactinfo{
    width: 50%;
    display: flex;
    flex-direction: column;
  }
  .container .contactinfo .box{
    position: relative;
    padding: 20px 0;
    display: flex;
  }
  .container .contactinfo .box .icon{
    min-width: 60px;
    height: 60px;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    font-size: 22px;
  }
  .container .contactinfo .box .text{
    display: flex;
    margin-left: 20px;
    font-size: 16px;
    color: #000;
    flex-direction: column;
    font-weight: 300;
  }
  .container .contactinfo .box .text .h3{
    font-weight: 500;
    color: #00bcd4;
  }
  .contactform{
    width: 40%;
    padding: 40px;
    background: #fff;
  }
  .contactform .h2{
    font-size: 30px;
    color: #333;
    font-weight: 500;
  }
  .contactform .inputBox{
    position: relative;
    width: 100%;
    margin-top: 10px;
  }
  .contactform .inputBox input, .contactform .inputBox textarea{
    width: 100%;
    padding: 5px 0;
    font-size: 16px;
    margin: 10px 0;
    border: none;
    border-bottom: 2px solid #333;
    outline: none;
    resize: none;
  }
  .contactform .inputBox span{
    position: absolute;
    left: 0;
    padding: 5px 0;
    font-size: 16px;
    margin: 10px 0;
    pointer-events: none;
    transition: 0.5s;
    color: #666;
  }
  .contactform .inputBox input:focus ~ span,
  .contactform .inputBox input:valid ~ span,
  .contactform .inputBox textarea:focus ~ span,
  .contactform .inputBox textarea:valid ~ span{
    color: #e91e63;
    font-size: 12px;
    transform: translateY(-20px);
  }
  .contactform .inputBox input[type="submit"]{
    width: 100px;
    background: #00bcd4;
    color: #000;
    border: none;
    cursor: pointer;
    padding: 10px;
    font-size: 18px;
  }
  @media (max-width: 911px){
    .contact{
      padding: 50px;
    }
    .container{
      flex-direction: column;
    }
    .container .contactinfo{
      margin-bottom: 40px;
    }
    .container .contactinfo,
    .contactform{
      width: 100%;
    }
  }
</style>
<body>
  <section class="contact">
    <div class="content">
      <h2>Liên Hệ Với Chúng Tôi</h2>
      <p>Mọi chi tiết xin liên hệ vào địa chỉ gmail, địa chỉ cụ thể hoặc gọi đến số điện thoại của chúng tôi.</p>
      <p>Tôi xin cảm ơn!</p>
    </div>
    <div class="container">
      <div class="contactinfo">
        <div class="box">
          <div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
            <div class="text">
              <h3>Địa Chỉ Liên Hệ</h3>
              <p>Đường Trần Chiên, Phường Lê Bình, Quận Cái Răng, TP. Cần Thơ</p>
            </div>
        </div>
        <div class="box">
          <div class="icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
            <div class="text">
              <h3>Gmail</h3>
              <p>nguyenthenguyen126cm@gmail.com</p>
            </div>
        </div>
        <div class="box">
          <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
            <div class="text">
              <h3>Số Điện Thoại</h3>
              <p>0837341871 hoặc 0898546429</p>
            </div>
        </div>
      </div>
      <div class="contactform">
        <form action="">
          <h2>Phản Hồi Của Bạn</h2>
          <div class="inputBox">
            <input type="text" name="" required="required">
            <span>Họ Và Tên</span>
          </div>
          <div class="inputBox">
            <input type="text" name="" required="required">
            <span>Gmail</span>
          </div>
          <div class="inputBox">
            <textarea required="required"></textarea>
            <span>Nội Dung</span>
          </div>
          <div class="inputBox">
       <a href="/website_TMDT/index.php" class="btn btn-info">Gửi</a>
          </div>
        </form>
      </div>
    </div>
  </section>
</body>
</html>