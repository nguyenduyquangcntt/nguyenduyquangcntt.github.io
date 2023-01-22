<style>
    .admin{
        display: flex;
    }
    .admin-img{
        border-radius: 20px;
        margin-right: 10px;
    }
</style>

<?php
include_once __DIR__ . ('/../../dbconnect.php');
//admin    

$sqladmin = "select * from admin";
$resultadmin =  mysqli_query($conn, $sqladmin);
$admin = [];
while ($row = mysqli_fetch_array($resultadmin, MYSQLI_ASSOC)) {
    $admin = array(
        'username' => $row['username'],
        'tenadmin' => $row['tenadmin'],
        'hinhadmin' => $row['hinhadmin']
    );
}
?>
<header style="display: flex;">
    <h3>
        <label for="nav-toggle">
            <span class="las la-bars"></span>
        </label>
        Dashboard
    </h3>
    <div class="search-wraper">

        <form action="/website_tmdt/admin/searchproduct.php?quanly=timkiem" class="header_search_form clearfix" method="GET">
            <button style="width: 30px; height: 30px; margin-left: 5px; background-color: #007bff; color: white; border: none; border-radius: 50%;" type="submit" class="las la-search" value="Tìm kiếm" name="timkiem"></button>
            <input type="search" palceholder="Searh here" name="tukhoa" />
        </form>
    </div>
    <div class="user-wraper admin">
        <img class="admin-img" src="/website_tmdt/assets/uploads/icon/<?= $admin['hinhadmin'] ?>" width="60px" height="60px" alt="">
        <div>
            <h4><?= $admin['tenadmin'] ?></h4>
            <small><?= $admin['username'] ?></small>
        </div>
    </div>
</header>