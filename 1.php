<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>导航栏示例</title>
<link rel="stylesheet" href="frist.css">
<link rel="stylesheet" href="iconfont.css">
<script src="jquery.min.js"></script>
</head>
<body>
<div class="connatior">
      <!-- 导航栏 -->
    <div class="navbar">
      <!-- 左侧Logo和链接 -->
       <div class="navbar-con">
        <ul class="clearfix">
          <li><a href="#home" style="font-weight: bold; font-size: 1.5em;margin-right: 50px;">Logo</a> </li>
          <li><a href="#home">首页</a></li>
          <li><a href="#gallery">图库</a>
            <div>
              <a href="#">我的图册</a>
              <a href="#">我的项目</a>
              <a href="#">我的收藏</a>
            </div>
          </li>
          <li><a href="#resources">资源管理</a></li>
          <li><a href="#events">活动</a></li>
          <li><a href="#help">帮助</a></li>
        </ul>
       </div>
      <!-- <div>
        <a href="#home" style="font-weight: bold; font-size: 1.5em;margin-right: 50px;">Logo</a>
        <a href="#home">首页</a>
        <a href="#gallery">图库</a>
        <a href="#resources">资源管理</a>
        <a href="#events">活动</a>
        <a href="#help">帮助</a>
      </div> -->
      
      <!-- 右侧搜索、上传、购物车和用户图标 -->
      <div class="navbar-icons">
        <input type="text" placeholder="搜索...">
        <i class="iconfont icon-shangchuan1"></i>
        <i class="iconfont icon-yingwen"></i>
        <i class="iconfont icon-gouwuche1"></i>
        <i class="iconfont icon-tongzhi1"></i>
      </div>
    </div>
   <!-- 用户名列表 -->
    <div class="username-list">
      <!-- 用户名项 -->
      <div class="username-item">
        <img src="path-to-avatar.jpg" alt="Avatar" class="avatar">
        <div class="my-resources">
          <span class="username">用户名1</span>
          <ul class="resources">
            <li>我的资源</li>
            <li>我的收藏</li>
            <li>我的项目</li>
          </ul>
        </div>
      </div>
      <!-- 更多用户名项 -->
    
    </div>
    <div class="wrap">
      <div class="page-manage-left">
        <a href="#" class="option">图库</a>
        <a href="#" class="option">相册</a>
        <a href="#" class="option">其他添加自己做的内容</a>
      </div>
      <div class="page-manage-right">
	  
         <?php      
         error_reporting(E_ALL);        
         ini_set('display_errors', 1);        
                 
         // 数据库连接参数        
         $servername = "localhost";        
         $username = "root";        
         $password = "123456";        
         $dbname = "image";        
                 
         // 创建连接        
         $conn = new mysqli($servername, $username, $password, $dbname);        
                 
         // 检查连接        
         if ($conn->connect_error) {        
             die("连接失败: " . $conn->connect_error);        
         }        
                 
      // 每页显示的图片数量  
      $records_per_page = 8;  
        
      // 获取当前页码，默认为1  
      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;  
      $page = ($page < 1) ? 1 : $page;  
        
      // 计算偏移量  
      $offset = ($page - 1) * $records_per_page;  
        
      // 查询总记录数  
    $result_total = $conn->query("SELECT COUNT(*) as total FROM img");  
    if (!$result_total) {  
        die("查询总记录数失败: " . $conn->error);  
    }  
    $row_total = $result_total->fetch_assoc();  
    $total_rows = $row_total['total'];  
        
      // 计算总页数  
      $total_pages = ceil($total_rows / $records_per_page);  
        
      // 确保页码在有效范围内  
      $page = ($page > $total_pages) ? $total_pages : $page;  
        
      // 查询当前页的图片  
      $result = $conn->query("SELECT * FROM img LIMIT $offset, $records_per_page");  
        
      // 输出分页链接  
	  echo '<nav class="pagination">';  
	  for ($i = 1; $i <= $total_pages; $i++) {  
		  $class = ($i == $page) ? 'pagination-link active' : 'pagination-link'; // 检查当前页  
		  echo '<a href="?page=' . $i . '" class="' . $class . '">' . $i . '</a> ';  
	  }  
	  echo '</nav>';
        
     // 检查是否有图片记录  
     if ($result->num_rows > 0) {  
         echo '<div class="image-container">';  
           
         while ($row = $result->fetch_assoc()) {  
            echo '<div class="image-item" style="display: inline-block; margin-right: 10px; margin-bottom: 10px;">';  
			   echo '<img data-id="' . htmlspecialchars($row["id"]) . '" id="image-' . $row["id"] . '" src="data:image/jpeg;base64,' . base64_encode($row["image"]) . '" alt="' . htmlspecialchars($row['id']) . '" style="width: 220px; height: 200px; padding: 10px;" onclick="toggleBackgroundColor(this.id);" />';  
			         echo '</div>';  
         }  
         echo '</div>';  
     } else {  
         echo "没有找到图片。";  
     }  
       
     // 关闭数据库连接  
     $conn->close();
      ?>
      </div>
      <!-- 菜单栏HTML（默认隐藏） -->  
      <div id="sidebar-menu" style="position: fixed; right: 0; top: 0; bottom: 0; width: 300px; background:#F0FFFF; overflow-y: auto; display: none;">  
	   <button id="cartButton" style="width:300px;height:50px; background:#FAFAD2;font-size:38px;position: relative;top:500px;">加入购物车</button>
		<button style="width:300px;height:50px; background:#FAFAD2;font-size:38px;position: relative;top:520px;">收藏</button>
		<button style="width:300px;height:50px; background:#FAFAD2;font-size:38px;position: relative;top:540px;">下载</button>
      </div>  
        
      <!-- JavaScript代码 -->  
      <script> 
	   // 用于存储用户选择的图片ID的数组  
	  document.addEventListener('DOMContentLoaded', function() {  
	      var selectedImages = []; // 初始化选中的图片ID数组  
	    
	      var images = document.querySelectorAll('.image-container img');  
	      images.forEach(function(img) {  
	          img.addEventListener('click', function() {  
	              var imageId = this.getAttribute('data-id');  
	              selectedImages.push(imageId); // 将图片ID添加到数组中  
	         
	          });  
	      });  
	    
	      var cartButton = document.getElementById('cartButton');  
	      cartButton.addEventListener('click', function() {  
	          var queryParams = selectedImages.map(function(imageId) {  
	              return encodeURIComponent('imageId[]') + '=' + encodeURIComponent(imageId); // URL编码  
	          });  
	          var queryString = queryParams.join('&');  
	          window.location.href = 'cart.php?' + queryString; // 重定向到购物车页面  
	        
	      });  
	  });
	  // 获取按钮元素  
	  var cartButton = document.getElementById('cartButton');  
	    
	  // 添加点击事件监听器  
	  cartButton.addEventListener('click', function() {   
	      window.location.href = 'cart.php'; 
	  });  
	  
	 function toggleBackgroundColor(imageId) {  
	     var imageContainer = document.querySelector('#' + imageId).parentElement;  
	       
	     if (imageContainer.style.backgroundColor === 'pink') {  
	         imageContainer.style.backgroundColor = 'transparent';  
	     } else {  
	         imageContainer.style.backgroundColor = 'pink';  
	     } 
	        
	      showMenu(imageId);  
	  }  
	  
      function showMenu(imageId) {  
          // 显示菜单栏  
          document.getElementById('sidebar-menu').style.display = 'block';  
      }  
        

   document.addEventListener('click', function(event) {  
   
       var isSidebarMenu = event.target.matches('#sidebar-menu, #sidebar-menu *'); // 菜单栏及其子元素  
       var isImage = event.target.matches('.image-container img'); // 图片  
         
       if (!isSidebarMenu && !isImage) {  
           hideMenu(); // 隐藏菜单栏  
       }  
   });  
     
   // 隐藏菜单栏的函数  
   function hideMenu() {  
       document.getElementById('sidebar-menu').style.display = 'none';  
   } 
      </script>  
        
      <!-- 样式部分-->  
      <style>  
      #sidebar-menu {  
          z-index: 9999; 
          box-shadow: -3px 0px 5px rgba(139,134,130); 
		  color:black;
        
      }   
	  .pagination {  
	      display: flex;  
	      justify-content: center; /* 水平居中 */  
	      padding: 10px 0; /* 上下内边距 */  
	      margin-bottom: 20px; /* 下外边距 */  
	  }  
	    
	  .pagination-link {  
	      display: inline-block;  
	      padding: 5px 10px; /* 内边距 */  
	      margin: 0 5px; /* 外边距 */  
	      text-decoration: none; /* 移除下划线 */  
	      color: #333; /* 文字颜色 */  
	      background-color: #fff; /* 背景颜色 */  
	      border: 1px solid #ccc; /* 边框 */  
	      border-radius: 5px; /* 圆角 */  
	      transition: background-color 0.3s ease; /* 过渡效果 */  
	  }  
	    
	  .pagination-link:hover {  
	      background-color: #f2f2f2; /* 鼠标悬停时的背景颜色 */  
	  }  
	    
	  /* 如果需要高亮当前页，可以添加一个额外的类，比如 active */  
	  .pagination-link.active {  
	      background-color: #4CAF50; /* 选中时的背景颜色 */  
	      color: #fff; /* 选中时的文字颜色 */  
	  }
      </style>
    </div>
</div>

